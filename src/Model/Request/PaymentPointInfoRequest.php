<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\Product;

/**
 * Class PaymentPointInfoRequest
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class PaymentPointInfoRequest extends RequestAbstract
{

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var string
     */
    protected $provider;

    /**
     * @var string enum1
     */
    protected $paymentType;

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product|array $product
     *
     * @return PaymentPointInfoRequest
     */
    public function setProduct($product)
    {
        if (is_array($product)) {
            $product = new Product($product);
        }

        $this->product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return PaymentPointInfoRequest
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     *
     * @return PaymentPointInfoRequest
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = parent::getDomMap()[0];

        return [
            'PaymentPointInfoRequest' => array_merge(
                $parentMap,
                [
                    'Product'     => 'product',
                    'Provider'    => 'provider',
                    'PaymentType' => 'paymentType',
                ]
            ),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {

        return [
            'product'
        ];
    }
}
