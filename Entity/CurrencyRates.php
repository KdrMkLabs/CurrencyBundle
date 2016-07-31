<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * CurrencyRates
 *
 * @ORM\Table(name="kdr_currency_rates")
 * @ORM\Entity
 */
class CurrencyRates
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
     * @ORM\Column(name="from_iso_4217_3code", type="string", length=3)
     */
    private $fromIso42173code;

    /**
     * @var string
     *
     * @ORM\Column(name="to_iso_4217_3code", type="string", length=3)
     */
    private $toIso42173code;

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
     * @var integer
     * @GEDMO\Timestampable(on="create")
     * @ORM\Column(name="date_added", type="integer", nullable=true)
     */
    private $dateAdded;


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
     * Set fromIso42173code
     *
     * @param string $fromIso42173code
     * @return CurrencyRates
     */
    public function setFromIso42173code($fromIso42173code)
    {
        $this->fromIso42173code = $fromIso42173code;

        return $this;
    }

    /**
     * Get fromIso42173code
     *
     * @return string 
     */
    public function getFromIso42173code()
    {
        return $this->fromIso42173code;
    }

    /**
     * Set toIso42173code
     *
     * @param string $toIso42173code
     * @return CurrencyRates
     */
    public function setToIso42173code($toIso42173code)
    {
        $this->toIso42173code = $toIso42173code;

        return $this;
    }

    /**
     * Get toIso42173code
     *
     * @return string 
     */
    public function getToIso42173code()
    {
        return $this->toIso42173code;
    }

    /**
     * Set conversionRate
     *
     * @param string $conversionRate
     * @return CurrencyRates
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
     * @return CurrencyRates
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
     * @return CurrencyRates
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
     * Set dateAdded
     *
     * @param integer $dateAdded
     * @return CurrencyRates
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return integer 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
}
