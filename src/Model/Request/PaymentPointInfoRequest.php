<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\Product;

/**
 * Class PaymentPointInfoRequest
 * @package DigitalVirgo\DirectPay\Model\Request
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class PaymentPointInfoRequest extends RequestAbstract
{

    /**
     * @var Product
     */
    protected $_product;

    /**
     * @var string
     */
    protected $_provider;

    /**
     * @var string enum1
     */
    protected $_paymentType;

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @param Product $product
     * @return PaymentPointInfoRequest
     */
    public function setProduct($product)
    {
        if (is_array($product)) {
            $product = new Product($product);
        }

        $this->_product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->_provider;
    }

    /**
     * @param string $provider
     * @return PaymentPointInfoRequest
     */
    public function setProvider($provider)
    {
        $this->_provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->_paymentType;
    }

    /**
     * @param string $paymentType
     * @return PaymentPointInfoRequest
     */
    public function setPaymentType($paymentType)
    {
        $this->_paymentType = $paymentType;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        $parentMap = parent::_getDomMap()[0];

        return [
            'PaymentPointInfoRequest' => array_merge($parentMap, [
                'Product'     => 'product',
                'Provider'    => 'provider',
                'PaymentType' => 'paymentType',
            ]),
        ];
    }

}