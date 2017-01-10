<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\Product;

/**
 * Class PaymentPointInfoResponse
 * @package DigitalVirgo\DirectPay\Model\Response
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class PaymentPointInfoResponse extends ResponseAbstract
{

    /**
     * @var string
     */
    protected $_partnerToken;

    /**
     * @var Product
     */
    protected $_product;

    /**
     * @return string
     */
    public function getPartnerToken()
    {
        return $this->_partnerToken;
    }

    /**
     * @param string $partnerToken
     * @return PaymentPointInfoResponse
     */
    public function setPartnerToken($partnerToken)
    {
        $this->_partnerToken = $partnerToken;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @param Product $product
     * @return PaymentPointInfoResponse
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
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        $parentMap = parent::_getDomMap()[0];

        return [
            'PaymentPointInfoResponse' => array_merge($parentMap, [
                'PartnerToken' => 'partnerToken',
                'Product'      => 'product',
            ]),
        ];
    }

}