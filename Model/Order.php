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
    protected $_orderCreateData;

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
    protected $_transationId;

    /**
     * @var string
     */
    protected $_partnerTransationId;

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
    protected $_orderTokenStatus;

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
    public function getOrderCreateData()
    {

        return $this->_orderCreateData;
    }

    /**
     * @param \DateTime $orderCreateData
     * @return Order
     */
    public function setOrderCreateData($orderCreateData)
    {
        if (is_string($orderCreateData)) {
            $orderCreateData = new \DateTime($orderCreateData);
        }

        $this->_orderCreateData = $orderCreateData;
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
    public function getTransationId()
    {
        return $this->_transationId;
    }

    /**
     * @param string $transationId
     * @return Order
     */
    public function setTransationId($transationId)
    {
        $this->_transationId = $transationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerTransationId()
    {
        return $this->_partnerTransationId;
    }

    /**
     * @param string $partnerTransationId
     * @return Order
     */
    public function setPartnerTransationId($partnerTransationId)
    {
        $this->_partnerTransationId = $partnerTransationId;
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
     * @return string
     */
    public function getOrderTokenStatus()
    {
        return $this->_orderTokenStatus;
    }

    /**
     * @param string $orderTokenStatus
     * @return Order
     */
    public function setOrderTokenStatus($orderTokenStatus)
    {
        $this->_orderTokenStatus = $orderTokenStatus;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRedirectOnTop()
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

}