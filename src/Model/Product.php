<?php

namespace DigitalVirgo\DirectPay\Model;

/**
 * Class Product
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class Product extends ModelAbstract
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Price
     */
    protected $price;

    /**
     * @var PaymentPoints
     */
    protected $paymentPoints;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Product
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
     * @return PaymentPoints
     */
    public function getPaymentPoints()
    {
        return $this->paymentPoints;
    }

    /**
     * @param PaymentPoints|array $paymentPoints
     *
     * @return Product
     */
    public function setPaymentPoints($paymentPoints)
    {
        if (is_array($paymentPoints)) {
            $paymentPoints = new PaymentPoints($paymentPoints);
        }

        $this->paymentPoints = $paymentPoints;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            'Product' => [
                'Name'          => 'name',
                'Price'         => 'price',
                'PaymentPoints' => 'paymentPoints',
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'name',
        ];
    }
}
