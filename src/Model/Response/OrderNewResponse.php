<?php

namespace DigitalVirgo\DirectPay\Model\Response;

class OrderNewResponse extends ResponseAbstract
{

    /**
     * @var string
     */
    protected $_orderId;

    /**
     * @var string
     */
    protected $_customerRedirectUrl;

    /**
     * @var string enum
     */
    protected $_orderStatus;

    /**
     * @var string
     */
    protected $_orderErrorDescription;

    /**
     * @var string
     */
    protected $_paymentPointId;

    /**
     * @var P24Parameters
     */
    protected $_p24Parameters;

    /**
     * @var AuthorizationRequirements
     */
    protected $_authorizationRequirements;

    /**
     * @var string
     */
    protected $_transactionId;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param string $orderId
     * @return OrderNewResponse
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRedirectUrl()
    {
        return $this->_customerRedirectUrl;
    }

    /**
     * @param string $customerRedirectUrl
     * @return OrderNewResponse
     */
    public function setCustomerRedirectUrl($customerRedirectUrl)
    {
        $this->_customerRedirectUrl = $customerRedirectUrl;
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
     * @return OrderNewResponse
     */
    public function setOrderStatus($orderStatus)
    {
        $this->_orderStatus = $orderStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderErrorDescription()
    {
        return $this->_orderErrorDescription;
    }

    /**
     * @param string $orderErrorDescription
     * @return OrderNewResponse
     */
    public function setOrderErrorDescription($orderErrorDescription)
    {
        $this->_orderErrorDescription = $orderErrorDescription;
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
     * @return OrderNewResponse
     */
    public function setPaymentPointId($paymentPointId)
    {
        $this->_paymentPointId = $paymentPointId;
        return $this;
    }

    /**
     * @return P24Parameters
     */
    public function getP24Parameters()
    {
        return $this->_p24Parameters;
    }

    /**
     * @param P24Parameters $p24Parameters
     * @return OrderNewResponse
     */
    public function setP24Parameters($p24Parameters)
    {
        $this->_p24Parameters = $p24Parameters;
        return $this;
    }

    /**
     * @return AuthorizationRequirements
     */
    public function getAuthorizationRequirements()
    {
        return $this->_authorizationRequirements;
    }

    /**
     * @param AuthorizationRequirements $authorizationRequirements
     * @return OrderNewResponse
     */
    public function setAuthorizationRequirements($authorizationRequirements)
    {
        $this->_authorizationRequirements = $authorizationRequirements;
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
     * @return OrderNewResponse
     */
    public function setTransactionId($transactionId)
    {
        $this->_transactionId = $transactionId;
        return $this;
    }

    protected function getDomMap()
    {
        $parentMap = parent::getDomMap()[0];

        return [
            'OrderNewResponse' => array_merge($parentMap, [
                'OrderId'                   => 'orderId',
                'CustomerRedirectUrl'       => 'customerRedirectUrl',
                'OrderStatus'               => 'orderStatus',
                'OrderErrorDescription'     => 'orderErrorDescription',
                'PaymentPointId'            => 'paymentPointId',
                'P24Parameters'             => 'p24Parameters',             //?
                'AuthorizationRequirements' => 'authorizationRequirements',    //?
                'transactionId'             => 'transactionId',
            ]),
        ];
    }

}
