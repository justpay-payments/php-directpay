<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\AuthorizationRequirements;
use DigitalVirgo\DirectPay\Model\P24Parameters;

/**
 * Class OrderNewResponse
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderNewResponse extends ResponseAbstract
{

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $customerRedirectUrl;

    /**
     * @var string enum
     */
    protected $orderStatus;

    /**
     * @var string
     */
    protected $orderErrorDescription;

    /**
     * @var string
     */
    protected $paymentPointId;

    /**
     * @var P24Parameters
     */
    protected $p24Parameters;

    /**
     * @var AuthorizationRequirements
     */
    protected $authorizationRequirements;

    /**
     * @var string
     */
    protected $transactionId;

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
     * @return OrderNewResponse
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRedirectUrl()
    {
        return $this->customerRedirectUrl;
    }

    /**
     * @param string $customerRedirectUrl
     *
     * @return OrderNewResponse
     */
    public function setCustomerRedirectUrl($customerRedirectUrl)
    {
        $this->customerRedirectUrl = $customerRedirectUrl;
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
     * @param string $orderStatus
     *
     * @return OrderNewResponse
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderErrorDescription()
    {
        return $this->orderErrorDescription;
    }

    /**
     * @param string $orderErrorDescription
     *
     * @return OrderNewResponse
     */
    public function setOrderErrorDescription($orderErrorDescription)
    {
        $this->orderErrorDescription = $orderErrorDescription;
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
     * @return OrderNewResponse
     */
    public function setPaymentPointId($paymentPointId)
    {
        $this->paymentPointId = $paymentPointId;
        return $this;
    }

    /**
     * @return P24Parameters
     */
    public function getP24Parameters()
    {
        return $this->p24Parameters;
    }

    /**
     * @param P24Parameters|array $p24Parameters
     *
     * @return OrderNewResponse
     */
    public function setP24Parameters($p24Parameters)
    {
        if (is_array($p24Parameters)) {
            $p24Parameters = new P24Parameters($p24Parameters);
        }

        $this->p24Parameters = $p24Parameters;
        return $this;
    }

    /**
     * @return AuthorizationRequirements
     */
    public function getAuthorizationRequirements()
    {
        return $this->authorizationRequirements;
    }

    /**
     * @param AuthorizationRequirements|array $authorizationRequirements
     *
     * @return OrderNewResponse
     */
    public function setAuthorizationRequirements($authorizationRequirements)
    {
        if (is_array($authorizationRequirements)) {
            $authorizationRequirements = new AuthorizationRequirements($authorizationRequirements);
        }
        $this->authorizationRequirements = $authorizationRequirements;
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
     * @return OrderNewResponse
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = ResponseAbstract::getDomMap()[0];

        return [
            'OrderNewResponse' => array_merge(
                $parentMap,
                [
                    'OrderId'                   => 'orderId',
                    'CustomerRedirectUrl'       => 'customerRedirectUrl',
                    'OrderStatus'               => 'orderStatus',
                    'OrderErrorDescription'     => 'orderErrorDescription',
                    'PaymentPointId'            => 'paymentPointId',
                    'P24Parameters'             => 'p24Parameters',             //?
                    'AuthorizationRequirements' => 'authorizationRequirements',    //?
                    'transactionId'             => 'transactionId',
                ]
            ),
        ];
    }

}
