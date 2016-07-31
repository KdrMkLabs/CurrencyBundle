<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * Currency
 *
 * @ORM\Table(name="kdr_currency")
 * @ORM\Entity
 */
class Currency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=48)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_4217_3code", type="string", length=3)
     */
    private $iso42173code;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_4217_num", type="string", length=3)
     */
    private $iso4217Num;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=8)
     */
    private $sign;

    /**
     * @var string
     *
     * @ORM\Column(name="dec_point", type="string", length=1, options={"default" = "."})
     */
    private $decPoint;

    /**
     * @var string
     *
     * @ORM\Column(name="thousands_sep", type="string", length=1, options={"default" = ","})
     */
    private $thousandsSep;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default" = 2})
     */
    private $decimals;

    /**
     * @var string
     *
     * @ORM\Column(name="conversion_rate", type="decimal", precision=13, scale=6)
     */
    private $conversionRate;

    /**
     * @var string
     *
     * @ORM\Column(name="conversion_rate_sell", type="decimal", precision=13, scale=6)
     */
    private $conversionRateSell;

    /**
     * @var string
     *
     * @ORM\Column(name="conversion_rate_buy", type="decimal", precision=13, scale=6)
     */
    private $conversionRateBuy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sign_prefix", type="boolean", nullable=true, options={"default" = 1})
     */
    private $signPrefix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sign_suffix", type="boolean", nullable=true, options={"default" = 0})
     */
    private $signSuffix;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, options={"default" = 1})
     */
    private $active;

    /**
     * @var type 
     * @GEDMO\Timestampable(on="update")
     * @ORM\Column(name="last_update", type="integer", nullable=true)
     */
    private $lastUpdate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="target_iso_4217_3code", type="string", length=3)
     */
    private $target;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set iso42173code
     *
     * @param string $iso42173code
     * @return Currency
     */
    public function setIso42173code($iso42173code)
    {
        $this->iso42173code = $iso42173code;

        return $this;
    }

    /**
     * Get iso42173code
     *
     * @return string 
     */
    public function getIso42173code()
    {
        return $this->iso42173code;
    }

    /**
     * Set iso4217Num
     *
     * @param string $iso4217Num
     * @return Currency
     */
    public function setIso4217Num($iso4217Num)
    {
        $this->iso4217Num = $iso4217Num;

        return $this;
    }

    /**
     * Get iso4217Num
     *
     * @return string 
     */
    public function getIso4217Num()
    {
        return $this->iso4217Num;
    }

    /**
     * Set sign
     *
     * @param string $sign
     * @return Currency
     */
    public function setSign($sign)
    {
        $this->sign = $sign;

        return $this;
    }

    /**
     * Get sign
     *
     * @return string 
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set decPoint
     *
     * @param string $decPoint
     * @return Currency
     */
    public function setDecPoint($decPoint)
    {
        $this->decPoint = $decPoint;

        return $this;
    }

    /**
     * Get decPoint
     *
     * @return string 
     */
    public function getDecPoint()
    {
        return $this->decPoint;
    }

    /**
     * Set thousandsSep
     *
     * @param string $thousandsSep
     * @return Currency
     */
    public function setThousandsSep($thousandsSep)
    {
        $this->thousandsSep = $thousandsSep;

        return $this;
    }

    /**
     * Get thousandsSep
     *
     * @return string 
     */
    public function getThousandsSep()
    {
        return $this->thousandsSep;
    }

    /**
     * Set decimals
     *
     * @param integer $decimals
     * @return Currency
     */
    public function setDecimals($decimals)
    {
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * Get decimals
     *
     * @return integer 
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * Set conversionRate
     *
     * @param string $conversionRate
     * @return Currency
     */
    public function setConversionRate($conversionRate)
    {
        $this->conversionRate = $conversionRate;

        return $this;
    }

    /**
     * Get conversionRate
     *
     * @return string 
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * Set conversionRateSell
     *
     * @param string $conversionRateSell
     * @return Currency
     */
    public function setConversionRateSell($conversionRateSell)
    {
        $this->conversionRateSell = $conversionRateSell;

        return $this;
    }

    /**
     * Get conversionRateSell
     *
     * @return string 
     */
    public function getConversionRateSell()
    {
        return $this->conversionRateSell;
    }

    /**
     * Set conversionRateBuy
     *
     * @param string $conversionRateBuy
     * @return Currency
     */
    public function setConversionRateBuy($conversionRateBuy)
    {
        $this->conversionRateBuy = $conversionRateBuy;

        return $this;
    }

    /**
     * Get conversionRateBuy
     *
     * @return string 
     */
    public function getConversionRateBuy()
    {
        return $this->conversionRateBuy;
    }

    /**
     * Set signPrefix
     *
     * @param boolean $signPrefix
     * @return Currency
     */
    public function setSignPrefix($signPrefix)
    {
        $this->signPrefix = $signPrefix;

        return $this;
    }

    /**
     * Get signPrefix
     *
     * @return boolean 
     */
    public function getSignPrefix()
    {
        return $this->signPrefix;
    }

    /**
     * Set signSuffix
     *
     * @param boolean $signSuffix
     * @return Currency
     */
    public function setSignSuffix($signSuffix)
    {
        $this->signSuffix = $signSuffix;

        return $this;
    }

    /**
     * Get signSuffix
     *
     * @return boolean 
     */
    public function getSignSuffix()
    {
        return $this->signSuffix;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Currency
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function setLastUpdate(type $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    public function getTarget() {
        return $this->target;
    }

    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }


}
