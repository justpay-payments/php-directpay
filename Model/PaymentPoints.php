<?php


namespace DigitalVirgo\DirectPay\Model;

class PaymentPoints extends ModelAbstract
{

    /**
     * @var PaymentPoint
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
        $this->_paymentPoint = $paymentPoint;
        return $this;
    }




}