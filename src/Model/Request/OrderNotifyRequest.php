<?php

namespace DigitalVirgo\DirectPay\Model\Request;
use DigitalVirgo\DirectPay\Model\Order;

/**
 * Class OrderNotifyRequest
 * @package DigitalVirgo\DirectPay\Model\Request
 *
 */
class OrderNotifyRequest extends RequestAbstract
{

    /**
     * @var Order
     */
    protected $_order;

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @param Order $order
     * @return OrderNotifyResponse
     */
    public function setOrder($order)
    {
        if (is_array($order)) {
            $order = new Order($order);
        }

        $this->_order = $order;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        $parentMap = parent::_getDomMap()[0];

        return [
            'OrderNotifyRequest' => array_merge($parentMap, [
                'Order' => 'order',
            ]),
        ];
    }
}