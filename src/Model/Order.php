<?php

namespace DigitalVirgo\DirectPay\Model;

use DateTimeImmutable;
use DigitalVirgo\DirectPay\Model\Enum\OrderStatus;
use Exception;
use InvalidArgumentException;

/**
 * Class Order
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class Order extends ModelAbstract
{

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string enum
     */
    protected $orderStatus;

    /**
     * @var string
     */
    protected $paymentPointId;

    /**
     * @var string
     */
    protected $authorizationChannel;

    /**
     * @var \DateTime
     */
    protected $orderCreateDate;

    /**
     * @var string
     */
    protected $orderDescription;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var string
     */
    protected $adapterLayoutId;

    /**
     * @var string
     */
    protected $notifyUrl;

    /**
     * @var string
     */
    protected $orderFailureUrl;

    /**
     * @var string
     */
    protected $orderCompleteUrl;

    /**
     * @var string
     */
    protected $afiliantUrl;

    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $partnerTransactionId;

    /**
     * @var string
     */
    protected $msisdn;

    /**
     * @var string
     */
    protected $gcmRegistrationId;

    /**
     * @var int
     */
    protected $causeStatus;

    /**
     * @var string
     */
    protected $smsCode;

    /**
     * @var string
     */
    protected $operatorCode;
    /**
     * @var string
     */
    protected $orderRejectedErrorMessage;

    /**
     * @var string
     */
    protected $orangeTokenStatus;

    /**
     * @var boolean
     */
    protected $redirectOnTop;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param $orderStatus
     *
     * @return $this
     *
     * @throws Exception
     */
    public function setOrderStatus($orderStatus)
    {
        if ($orderStatus !== null && !in_array($orderStatus, OrderStatus::getAllOptions(), true)) {
            throw new InvalidArgumentException('Invalid order status.');
        }

        $this->orderStatus = $orderStatus;
        return $this;
    }

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
     * @return Order
     */
    public function setPaymentPointId($paymentPointId)
    {
        $this->paymentPointId = $paymentPointId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationChannel()
    {
        return $this->authorizationChannel;
    }

    /**
     * @param string $authorizationChannel
     *
     * @return Order
     */
    public function setAuthorizationChannel($authorizationChannel)
    {
        $this->authorizationChannel = $authorizationChannel;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderCreateDate()
    {

        return $this->orderCreateDate;
    }

    /**
     * @param DateTimeImmutable|string $orderCreateDate
     *
     * @return Order
     *
     * @throws Exception
     */
    public function setOrderCreateDate($orderCreateDate)
    {
        if (is_string($orderCreateDate)) {
            $orderCreateDate = new DateTimeImmutable($orderCreateDate);
        }
        $this->orderCreateDate = $orderCreateDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderDescription()
    {
        return $this->orderDescription;
    }

    /**
     * @param string $orderDescription
     *
     * @return Order
     */
    public function setOrderDescription($orderDescription)
    {
        $this->orderDescription = $orderDescription;
        return $this;
    }

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
     * @return Order
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
    public function getAdapterLayoutId()
    {
        return $this->adapterLayoutId;
    }

    /**
     * @param string $adapterLayoutId
     *
     * @return Order
     */
    public function setAdapterLayoutId($adapterLayoutId)
    {
        $this->adapterLayoutId = $adapterLayoutId;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     *
     * @return Order
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderFailureUrl()
    {
        return $this->orderFailureUrl;
    }

    /**
     * @param string $orderFailureUrl
     *
     * @return Order
     */
    public function setOrderFailureUrl($orderFailureUrl)
    {
        $this->orderFailureUrl = $orderFailureUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderCompleteUrl()
    {
        return $this->orderCompleteUrl;
    }

    /**
     * @param string $orderCompleteUrl
     *
     * @return Order
     */
    public function setOrderCompleteUrl($orderCompleteUrl)
    {
        $this->orderCompleteUrl = $orderCompleteUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getAfiliantUrl()
    {
        return $this->afiliantUrl;
    }

    /**
     * @param string $afiliantUrl
     */
    public function setAfiliantUrl($afiliantUrl)
    {
        $this->afiliantUrl = $afiliantUrl;
    }

    /**
     * @return string
     */
    public function getPartnerTransactionId()
    {
        return $this->partnerTransactionId;
    }

    /**
     * @param string $partnerTransactionId
     *
     * @return Order
     */
    public function setPartnerTransactionId($partnerTransactionId)
    {
        $this->partnerTransactionId = $partnerTransactionId;
        return $this;
    }


    /**
     * @return string
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param string $msisdn
     *
     * @return Order
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
        return $this;
    }

    /**
     * @return string
     */
    public function getGcmRegistrationId()
    {
        return $this->gcmRegistrationId;
    }

    /**
     * @param string $gcmRegistrationId
     *
     * @return Order
     */
    public function setGcmRegistrationId($gcmRegistrationId)
    {
        $this->gcmRegistrationId = $gcmRegistrationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     *
     * @return Order
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCauseStatus()
    {
        return $this->causeStatus;
    }

    /**
     * @param int $causeStatus
     *
     * @return Order
     */
    public function setCauseStatus($causeStatus)
    {
        $this->causeStatus = $causeStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmsCode()
    {
        return $this->smsCode;
    }

    /**
     * @param string $smsCode
     *
     * @return Order
     */
    public function setSmsCode($smsCode)
    {
        $this->smsCode = $smsCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderRejectedErrorMessage()
    {
        return $this->orderRejectedErrorMessage;
    }

    /**
     * @param string $orderRejectedErrorMessage
     *
     * @return Order
     */
    public function setOrderRejectedErrorMessage($orderRejectedErrorMessage)
    {
        $this->orderRejectedErrorMessage = $orderRejectedErrorMessage;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRedirectOnTop()
    {
        return $this->redirectOnTop;
    }

    /**
     * @param boolean $redirectOnTop
     *
     * @return Order
     */
    public function setRedirectOnTop($redirectOnTop)
    {
        $this->redirectOnTop = $redirectOnTop;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrangeTokenStatus()
    {
        return $this->orangeTokenStatus;
    }

    /**
     * @param string $orangeTokenStatus
     *
     * @return Order
     */
    public function setOrangeTokenStatus($orangeTokenStatus)
    {
        $this->orangeTokenStatus = $orangeTokenStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperatorCode()
    {
        return $this->operatorCode;
    }

    /**
     * @param string $operatorCode
     */
    public function setOperatorCode($operatorCode)
    {
        $this->operatorCode = $operatorCode;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
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
                'AdapterLayoutId'           => 'adapterLayoutId',
                'NotifyUrl'                 => 'notifyUrl',
                'OrderFailureUrl'           => 'orderFailureUrl',
                'OperatorCode'              => 'operatorCode',
                'OrderCompleteUrl'          => 'orderCompleteUrl',
                'AfiliantUrl'               => 'afiliantUrl',
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

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'notifyUrl',
            'paymentPointId',
            'product',
        ];
    }
}
