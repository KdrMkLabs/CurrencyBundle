<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Services;

use Kdrmklabs\Bundle\CurrencyBundle\Entity\CurrencyRates;
use Kdrmklabs\Bundle\CurrencyBundle\Entity\Currency;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class CurrencyService { 

    protected $serviceContainer;
    protected $curl_url = "http://query.yahooapis.com/v1/public/yql";
    protected $base_iso_code;

    public function __construct($serviceContainer, $base_iso_code){
        $this->serviceContainer = $serviceContainer;
        $this->base_iso_code = strtoupper($base_iso_code);
    }
    
    /**
     * @return Container
     */
    public function getServiceContainer() {
        return $this->serviceContainer;
    }

    /**
     * @return EntityManager
     */
    public function getDoctrineManager() {
        return $this->serviceContainer->get('doctrine')->getManager();
    }
    
    public function getQuery(array $languages) { 
        $comma_separated = implode (",", $languages);
        $yql_query = 'select * from yahoo.finance.xchange where pair in ('.$comma_separated.')';
        $yql_query_url = $this->curl_url . "?q=" . urlencode($yql_query);
        $yql_query_url .= '&env='.rawurlencode("store://datatables.org/alltableswithkeys");
        
        return $yql_query_url;
    }

    public function getResponse(array $languages) { 
        $ch = curl_init($this->getQuery($languages));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    public function toObject($response) { 
        try { 
            return new \SimpleXMLElement($response);
        } catch (\Exception $exc) { 
            return null;
        }
    }
    
    public function getCurrencyConvert(\Symfony\Component\Console\Output\OutputInterface $output = null) { 
        $base_currency = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:Currency')
                            ->findOneBy(array('iso42173code' => $this->base_iso_code));
        
        if($base_currency instanceof Currency){
            
            $currencies = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:Currency')
                            ->findBy(array('active' => true));
            $languages = $this->getCurrencyCombinatios($currencies);
            $xml = $this->getResponse($languages);
            $response = $this->toObject($xml);
            
            if(isset($response->results->rate)) { 
                foreach($response->results->rate as $rated){ 
                    $id = strtoupper(trim((string)$rated['id']));
                    $name = trim((string)$rated->Name);
                    $iso_codes = explode("/", $name);
                    $fromIso42173code = strtoupper($iso_codes[0]);
                    $toIso42173code = strtoupper($iso_codes[1]);
                    $rate = (float)$rated->Rate;
                    $buy_rate = (float)$rated->Ask;
                    $sell_rate = (float)$rated->Bid;
                    
                    $currency_history = new CurrencyRates();
                    $currency_history->setConversionRate($rate);
                    $currency_history->setConversionRateBuy($buy_rate);
                    $currency_history->setConversionRateSell($sell_rate);
                    $currency_history->setFromIso42173code($fromIso42173code);
                    $currency_history->setToIso42173code($toIso42173code);
                    
                    $this->getDoctrineManager()->persist($currency_history);
                    
                    if($toIso42173code == $this->base_iso_code){
                        $currency = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:Currency')
                            ->findOneBy(array('iso42173code' => $fromIso42173code));
                        
                        if($currency instanceof Currency){
                            $currency->setTarget($this->base_iso_code);
                            $currency->setConversionRate($rate);
                            $currency->setConversionRateBuy($buy_rate);
                            $currency->setConversionRateSell($sell_rate);
                            
                            if($output){
                                $output->writeln($currency->getName().": actualizado...");
                            }
                        }
                    }
                }
                $this->getDoctrineManager()->flush();
            }
        }
    }
    
    public function getCurrencyCombinatios($currencies) {
        $combined = array();
        $n = count($currencies);
        for ($i = 0; $i < $n; $i++){
            for($j = 0; $j < $n; $j++){
                $currency1 = $currencies[$i];
                $currency2 = $currencies[$j];

                if($currency1 instanceof Currency AND $currency2 instanceof Currency ){
                    $combined[] = '"'.$currency1->getIso42173code().$currency2->getIso42173code().'"';
                }
            }
        }
        
        return $combined;
    }
    
    public function converter($number, $from_iso_code, $to_iso_code, $number_to_str = false, $decimals = null){
        $to_currency = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:Currency')
                            ->findOneBy(array('iso42173code' => $to_iso_code));
        $str_price = null;
        
        if($to_currency instanceof Currency) {     
            $convertion_rate = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:CurrencyRates')
                                ->findOneBy(
                                            array('fromIso42173code' => $from_iso_code, 'toIso42173code' => $to_iso_code),
                                            array('dateAdded' => 'DESC')
                                        );
            
            if($convertion_rate instanceof CurrencyRates) {
                $number = $number * $convertion_rate->getConversionRate();
                
                if($number_to_str){
                    $str_price = number_format($number, ($decimals !== null) ? (int)$decimals : $to_currency->getDecimals(), $to_currency->getDecPoint(), $to_currency->getThousandsSep());
                    if($to_currency->getSignPrefix()){
                        $str_price = $to_currency->getSign().$str_price;
                    } else if($to_currency->getSignSuffix()){
                        $str_price .= ' '.$to_currency->getSign();
                    }
                } else {
                    $str_price = round($number, ($decimals !== null) ? (int)$decimals : $to_currency->getDecimals());
                }
                
            }
        }
        
        return $str_price;
    }
    
    public function format($number, $to_iso_code, $decimals = null){
        $to_currency = $this->getDoctrineManager()->getRepository('KdrmklabsCurrencyBundle:Currency')
                            ->findOneBy(array('iso42173code' => $to_iso_code));
        $str_price = null;
        
        if($to_currency instanceof Currency) {
            $str_price = number_format($number, ($decimals !== null) ? (int)$decimals : $to_currency->getDecimals(), $to_currency->getDecPoint(), $to_currency->getThousandsSep());
            if($to_currency->getSignPrefix()){
                $str_price = $to_currency->getSign().$str_price;
            } else if($to_currency->getSignSuffix()){
                $str_price .= ' '.$to_currency->getSign();
            }
        }
        
        return $str_price;
    }
}
