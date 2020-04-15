<?php

namespace DigitalVirgo\DirectPay\Model;

/**
 * Class Price
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class Price extends ModelAbstract
{
    /**
     * @var string
     */
    protected $net;

    /**
     * @var string
     */
    protected $gross;

    /**
     * @var string
     */
    protected $tax;

    /**
     * @var string
     */
    protected $taxRate;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @return string
     */
    public function getNet()
    {
        return $this->net;
    }

    /**
     * @param string $net
     *
     * @return Price
     */
    public function setNet($net)
    {
        $this->net = $net;
        return $this;
    }

    /**
     * @return string
     */
    public function getGross()
    {
        return $this->gross;
    }

    /**
     * @param string $gross
     *
     * @return Price
     */
    public function setGross($gross)
    {
        $this->gross = $gross;
        return $this;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     *
     * @return Price
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param string $taxRate
     *
     * @return Price
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return Price
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            'Price' => [
                'Net'      => 'net',
                'Gross'    => 'gross',
                'Tax'      => 'tax',
                'TaxRate'  => 'taxRate',
                'Currency' => 'currency'
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'currency',
            'gross',
            'net',
            'tax',
            'taxRate',
        ];
    }
}
