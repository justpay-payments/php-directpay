<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\Order;

/**
 * Class OrderGetResponse
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderGetResponse extends ResponseAbstract
{

    /**
     * @var Order
     */
    protected $order;

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order|array $order
     *
     * @return OrderGetResponse
     */
    public function setOrder($order)
    {
        if (is_array($order)) {
            $order = new Order($order);
        }

        $this->order = $order;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = ResponseAbstract::getDomMap()[0];

        return [
            'OrderGetResponse' => array_merge(
                $parentMap,
                [
                    'Order' => 'order',
                ]
            ),
        ];
    }

}
