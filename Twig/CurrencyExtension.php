<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Twig;

use Kdrmklabs\Bundle\CurrencyBundle\Services\CurrencyService;
use Symfony\Component\DependencyInjection\Container;

class CurrencyExtension extends \Twig_Extension {
    
    private $currency_service;
    private $serviceContainer;
    private $default_currency;

    function __construct($currency_service, $serviceContainer, $default_currency)
    {
        $this->currency_service = $currency_service;
        $this->serviceContainer = $serviceContainer;
        $this->default_currency = $default_currency;
    }
    
    /**
     * 
     * @return CurrencyService
     */
    public function getCurrencyService(){
        return $this->currency_service;
    }
    
    /**
     * @return Container
     */
    public function getServiceContainer() {
        return $this->serviceContainer;
    }

    
    public function getName() {
        return 'kdr_currency_extensions';
    }

    public function getFilters() {
        return array(
            'price' => new \Twig_SimpleFilter('price', array($this, 'getConversionBetween'))
        );
    }
 
    public function getConversionBetween($number, $from_iso_code = null, $to_iso_code = null, $decimals = null)
    {
        $session = $this->getServiceContainer()->get('session');
        $currency_service = $this->getCurrencyService();
        
        if($from_iso_code === $to_iso_code) {
            $from_iso_code = ( $from_iso_code ) ? $from_iso_code : ( $session->has('_currency') ? $session->get('_currency') : $this->default_currency );
            $str_price = $currency_service->format($number, $from_iso_code, $decimals);
        } else {
            $from_iso_code = ( $from_iso_code ) ? $from_iso_code : ( $session->has('_currency') ? $session->get('_currency') : $this->default_currency );
            $to_iso_code = ( $to_iso_code ) ? $to_iso_code : ( $session->has('_currency') ? $session->get('_currency') : $this->default_currency );
            $str_price = $currency_service->converter($number, $from_iso_code, $to_iso_code, true, $decimals);
        }
        
        return $str_price;
    }
}
