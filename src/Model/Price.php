<?php

namespace DigitalVirgo\DirectPay\Model;

class Price extends ModelAbstract
{
    //@todo autogenerate prices on gross/net provided

    /**
     * @var string
     */
    protected $_net;

    /**
     * @var string
     */
    protected $_gross;

    /**
     * @var string
     */
    protected $_tax;

    /**
     * @var string
     */
    protected $_taxRate;

    /**
     * @var string
     */
    protected $_currency;

    /**
     * @return string
     */
    public function getNet()
    {
        return $this->_net;
    }

    /**
     * @param string $net
     * @return Price
     */
    public function setNet($net)
    {
        $this->_net = $net;
        return $this;
    }

    /**
     * @return string
     */
    public function getGross()
    {
        return $this->_gross;
    }

    /**
     * @param string $gross
     * @return Price
     */
    public function setGross($gross)
    {
        $this->_gross = $gross;
        return $this;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->_tax;
    }

    /**
     * @param string $tax
     * @return Price
     */
    public function setTax($tax)
    {
        $this->_tax = $tax;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxRate()
    {
        return $this->_taxRate;
    }

    /**
     * @param string $taxRate
     * @return Price
     */
    public function setTaxRate($taxRate)
    {
        $this->_taxRate = $taxRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param string $currency
     * @return Price
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
        return $this;
    }

    protected function getDomMap()
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


}