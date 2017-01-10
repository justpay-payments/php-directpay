<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\Order;

/**
 * Class OrderGetResponse
 * @package DigitalVirgo\DirectPay\Model\Response
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class OrderGetResponse extends ResponseAbstract
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
     * @return OrderGetResponse
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
            'OrderGetResponse' => array_merge($parentMap, [
                'Order' => 'order',
            ]),
        ];
    }

}
