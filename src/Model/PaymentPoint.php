<?php

namespace DigitalVirgo\DirectPay\Model;

use DigitalVirgo\DirectPay\Model\Enum\PaymentType;
use InvalidArgumentException;

/**
 * Class PaymentPoint
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class PaymentPoint extends ModelAbstract
{

    /**
     * @var string
     */
    protected $paymentPointId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $provider;

    /**
     * @var string enum
     */
    protected $paymentType;

    /**
     * @var Price
     */
    protected $price;

    /**
     * @var string
     */
    protected $largeAccount;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var boolean
     */
    protected $customPrice;

    /**
     * @return string
     */
    public function getPaymentPointId()
    {
        return $this->paymentPointId;
    }

    /**
     * @param string $paymentPointId
     *
     * @return PaymentPoint
     */
    public function setPaymentPointId($paymentPointId)
    {
        $this->paymentPointId = $paymentPointId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return PaymentPoint
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return PaymentPoint
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
     * @param $paymentType
     *
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function setPaymentType($paymentType)
    {
        if ($paymentType !== null && !in_array($paymentType, PaymentType::getAllOptions(), true)) {
            throw new InvalidArgumentException('Invalid payment type.');
        }

        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Price|array $price
     *
     * @return PaymentPoint
     */
    public function setPrice($price)
    {
        if (is_array($price)) {
            $price = new Price($price);
        }

        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getLargeAccount()
    {
        return $this->largeAccount;
    }

    /**
     * @param string $largeAccount
     *
     * @return PaymentPoint
     */
    public function setLargeAccount($largeAccount)
    {
        $this->largeAccount = $largeAccount;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     *
     * @return PaymentPoint
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCustomPrice()
    {
        return $this->customPrice;
    }

    /**
     * @param boolean $customPrice
     *
     * @return PaymentPoint
     */
    public function setCustomPrice($customPrice)
    {
        $this->customPrice = $customPrice;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            'PaymentPoint' => [
                'PaymentPointId' => 'paymentPointId',
                'Description'    => 'description',
                'Provider'       => 'provider',
                'PaymentType'    => 'paymentType',
                'Price'          => 'price',
                'LargeAccount'   => 'largeAccount',
                'Prefix'         => 'prefix',
                'CustomPrice'    => 'customPrice',
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'price',

        ];
    }
}
