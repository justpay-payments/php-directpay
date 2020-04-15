<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DateTimeImmutable;
use DateTimeInterface;
use DigitalVirgo\DirectPay\Model\ModelAbstract;
use DigitalVirgo\DirectPay\Model\Order;
use DigitalVirgo\DirectPay\Model\Response\ResponseAbstract;
use Exception;

/**
 * Class OrderNewRequest
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderNotifyRequest extends ModelAbstract
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
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order|array $order
     */
    public function setOrder($order)
    {
        if (is_array($order)) {
            $order = new Order($order);
        }

        $this->order = $order;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param DateTimeInterface|string $updateDate
     *
     * @return OrderNotifyRequest
     *
     * @throws Exception
     */
    public function setUpdateDate($updateDate)
    {
        if (is_string($updateDate)) {
            $updateDate = new DateTimeImmutable($updateDate);
        }
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected static function getDomMap()
    {
        $parentMap = ResponseAbstract::getDomMap()[0];

        return [
            'OrderNotifyRequest' => array_merge(
                $parentMap,
                [
                    'Order' => 'order',
                    'UpdateDate' => 'updateDate'
                ]
            ),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'order',
        ];
    }
}
