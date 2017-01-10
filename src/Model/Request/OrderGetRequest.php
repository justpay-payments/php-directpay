<?php

namespace DigitalVirgo\DirectPay\Model\Request;

/**
 * Class OrderGetRequest
 * @package DigitalVirgo\DirectPay\Model\Request
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class OrderGetRequest extends RequestAbstract
{

    /**
     * @var string
     */
    protected $_orderId;

    /**
     * @var string
     */
    protected $_partnerTransactionId;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param string $orderId
     * @return OrderGetRequest
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
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
     * @return OrderGetRequest
     */
    public function setPartnerTransactionId($partnerTransactionId)
    {
        $this->_partnerTransactionId = $partnerTransactionId;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        $parentMap = parent::_getDomMap()[0];

        return [
            'OrderGetRequest' => array_merge($parentMap, [
                'OrderId' => 'orderId',
                'PartnerTransactionId' => 'partnerTransactionId',
            ]),
        ];
    }
}