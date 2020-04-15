<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DateTimeInterface;
use DigitalVirgo\DirectPay\Model\ModelAbstract;
use DigitalVirgo\DirectPay\Model\Order;
use DigitalVirgo\DirectPay\Model\Request\RequestAbstract;

/**
 * Class OrderNewRequest
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderNotifyResponse extends ModelAbstract
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var DateTimeInterface
     */

    protected $updateDate;

    /**
     * @inheritDoc
     */
    protected static function getDomMap()
    {

        return [
            'OrderNotifyResponse' => [
                'Order' => 'order',
                'UpdateDate' => 'updateDate'
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [];
    }
}
