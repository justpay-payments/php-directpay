<?php

namespace DigitalVirgo\DirectPay\Model;

class Product extends ModelAbstract
{

    /**
     * @var string
     */
    protected $_name;

    /**
     * @var Price
     */
    protected $_price;

    /**
     * @var PaymentPoints
     */
    protected $_paymentPoints;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param Price $price
     * @return Product
     */
    public function setPrice($price)
    {
        if (is_array($price)) {
            $price = new Price($price);
        }

        $this->_price = $price;
        return $this;
    }

    /**
     * @return PaymentPoints
     */
    public function getPaymentPoints()
    {
        return $this->_paymentPoints;
    }

    /**
     * @param PaymentPoints $paymentPoints
     * @return Product
     */
    public function setPaymentPoints($paymentPoints)
    {

        if (is_array($paymentPoints)) {
            $paymentPoints = new PaymentPoints($paymentPoints);
        }

        $this->_paymentPoints = $paymentPoints;
        return $this;
    }

    protected function getDomMap()
    {
        return [
            'Product' => [
                'Name'          => 'name',
                'Price'         => 'price',
                'PaymentPoints' => 'paymentPoints',
            ]
        ];
    }


}