<?php


namespace DigitalVirgo\DirectPay\Model;

/**
 * Class PaymentPoints
 * @package DigitalVirgo\DirectPay\Model
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class PaymentPoints extends ModelAbstract
{

    /**
     * @var array[PaymentPoint]
     */
    protected $_paymentPoint;

    /**
     * @return PaymentPoint
     */
    public function getPaymentPoint()
    {
        return $this->_paymentPoint;
    }

    /**
     * @param PaymentPoint $paymentPoint
     * @return PaymentPoints
     */
    public function setPaymentPoint($paymentPoint)
    {
        if (!is_array($paymentPoint) || array_key_exists('PaymentPointId', $paymentPoint)) {
            $paymentPoint = [$paymentPoint];
        }

        $paymentPoint = array_map(function ($e) {
            return new PaymentPoint($e);
        }, $paymentPoint);

        $this->_paymentPoint = $paymentPoint;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        return [
            'PaymentPoints' => [
                'PaymentPoint' => 'paymentPoint'
            ]
        ];
    }
}