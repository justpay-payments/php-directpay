<?php

namespace DigitalVirgo\DirectPay\Model;

class Order extends ModelAbstract
{

    /**
     * @var string
     */
    protected $_orderId;

    /**
     * @var string enum
     */
    protected $_orderStatus;

    /**
     * @var string
     */
    protected $_paymentPointId;

    /**
     * @var string
     */
    protected $_authorizationChannel;

    /**
     * @var \DateTime
     */
    protected $_orderCreateDate;

    /**
     * @var string
     */
    protected $_orderDescription;

    /**
     * @var Product
     */
    protected $_product;

    /**
     * @var string
     */
    protected $_notifyUrl;

    /**
     * @var string
     */
    protected $_orderFailureUrl;

    /**
     * @var string
     */
    protected $_orderCompleteUrl;

    /**
     * @var string
     */
    protected $_transactionId;

    /**
     * @var string
     */
    protected $_partnerTransactionId;

    /**
     * @var string
     */
    protected $_msisdn;

    /**
     * @var string
     */
    protected $_gcmRegistrationId;

    /**
     * @var int
     */
    protected $_causeStatus;

    /**
     * @var string
     */
    protected $_smsCode;

    /**
     * @var string
     */
    protected $_orderRejectedErrorMessage;

    /**
     * @var string
     */
    protected $_orangeTokenStatus;

    /**
     * @var boolean
     */
    protected $_redirectOnTop;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param string $orderId
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->_orderStatus;
    }

    /**
     * @param string $orderStatus
     * @return Order
     */
    public function setOrderStatus($orderStatus)
    {
        //@todo validate input

        $this->_orderStatus = $orderStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentPointId()
    {
        return $this->_paymentPointId;
    }

    /**
     * @param string $paymentPointId
     * @return Order
     */
    public function setPaymentPointId($paymentPointId)
    {
        $this->_paymentPointId = $paymentPointId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationChannel()
    {
        return $this->_authorizationChannel;
    }

    /**
     * @param string $authorizationChannel
     * @return Order
     */
    public function setAuthorizationChannel($authorizationChannel)
    {
        $this->_authorizationChannel = $authorizationChannel;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderCreateDate()
    {

        return $this->_orderCreateDate;
    }

    /**
     * @param \DateTime $orderCreateDate
     * @return Order
     */
    public function setOrderCreateDate($orderCreateDate)
    {
        if (is_string($orderCreateDate)) {
            $orderCreateDate = new \DateTime($orderCreateDate);
        }

        $this->_orderCreateDate = $orderCreateDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderDescription()
    {
        return $this->_orderDescription;
    }

    /**
     * @param string $orderDescription
     * @return Order
     */
    public function setOrderDescription($orderDescription)
    {
        $this->_orderDescription = $orderDescription;
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
     * @return Order
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
    public function getNotifyUrl()
    {
        return $this->_notifyUrl;
    }

    /**
     * @param string $notifyUrl
     * @return Order
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->_notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderFailureUrl()
    {
        return $this->_orderFailureUrl;
    }

    /**
     * @param string $orderFailureUrl
     * @return Order
     */
    public function setOrderFailureUrl($orderFailureUrl)
    {
        $this->_orderFailureUrl = $orderFailureUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderCompleteUrl()
    {
        return $this->_orderCompleteUrl;
    }

    /**
     * @param string $orderCompleteUrl
     * @return Order
     */
    public function setOrderCompleteUrl($orderCompleteUrl)
    {
        $this->_orderCompleteUrl = $orderCompleteUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerTransactionId()
    {
        return $this->_partnerTransactionId;
    }

    /**
     * @param string $partnerTransactionId
     * @return Order
     */
    public function setPartnerTransactionId($partnerTransactionId)
    {
        $this->_partnerTransactionId = $partnerTransactionId;
        return $this;
    }


    /**
     * @return string
     */
    public function getMsisdn()
    {
        return $this->_msisdn;
    }

    /**
     * @param string $msisdn
     * @return Order
     */
    public function setMsisdn($msisdn)
    {
        $this->_msisdn = $msisdn;
        return $this;
    }

    /**
     * @return string
     */
    public function getGcmRegistrationId()
    {
        return $this->_gcmRegistrationId;
    }

    /**
     * @param string $gcmRegistrationId
     * @return Order
     */
    public function setGcmRegistrationId($gcmRegistrationId)
    {
        $this->_gcmRegistrationId = $gcmRegistrationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->_transactionId;
    }

    /**
     * @param string $transactionId
     * @return Order
     */
    public function setTransactionId($transactionId)
    {
        $this->_transactionId = $transactionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCauseStatus()
    {
        return $this->_causeStatus;
    }

    /**
     * @param int $causeStatus
     * @return Order
     */
    public function setCauseStatus($causeStatus)
    {
        $this->_causeStatus = $causeStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmsCode()
    {
        return $this->_smsCode;
    }

    /**
     * @param string $smsCode
     * @return Order
     */
    public function setSmsCode($smsCode)
    {
        $this->_smsCode = $smsCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderRejectedErrorMessage()
    {
        return $this->_orderRejectedErrorMessage;
    }

    /**
     * @param string $orderRejectedErrorMessage
     * @return Order
     */
    public function setOrderRejectedErrorMessage($orderRejectedErrorMessage)
    {
        $this->_orderRejectedErrorMessage = $orderRejectedErrorMessage;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRedirectOnTop()
    {
        return $this->_redirectOnTop;
    }

    /**
     * @param boolean $redirectOnTop
     * @return Order
     */
    public function setRedirectOnTop($redirectOnTop)
    {
        $this->_redirectOnTop = $redirectOnTop;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrangeTokenStatus()
    {
        return $this->_orangeTokenStatus;
    }

    /**
     * @param string $orangeTokenStatus
     * @return Order
     */
    public function setOrangeTokenStatus($orangeTokenStatus)
    {
        $this->_orangeTokenStatus = $orangeTokenStatus;
        return $this;
    }

    protected function getDomMap()
    {
        return [
            'Order' => [
                'OrderId'                   => 'orderId',
                'OrderStatus'               => 'orderStatus',
                'PaymentPointId'            => 'paymentPointId',
                'AuthorizationChannel'      => 'authorizationChannel',
                'OrderCreateDate'           => 'orderCreateDate', // ? date time
                'OrderDescription'          => 'orderDescription',
                'Product'                   => 'product',
                'NotifyUrl'                 => 'notifyUrl',
                'OrderFailureUrl'           => 'orderFailureUrl',
                'OrderCompleteUrl'          => 'orderCompleteUrl',
                'TransactionId'             => 'transactionId',
                'PartnerTransactionId'      => 'partnerTransactionId',
                'Msisdn'                    => 'msisdn',
                'GcmRegistrationId'         => 'gcmRegistrationId',
                'CauseStatus'               => 'causeStatus',
                'SmsCode'                   => 'smsCode',
                'OrderRejectedErrorMessage' => 'orderRejectedErrorMessage',
                'orangeTokenStatus'         => 'orangeTokenStatus',
                'redirectOnTop'             => 'redirectOnTop'     //? boolean
            ]
        ];
    }

}