<?php

namespace DigitalVirgo\DirectPay\Model\Enum;

/**
 * Class OrderStatus
 * @package DigitalVirgo\DirectPay\Model\Enum
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class OrderStatus
{
    const ORDER_REJECTED = "ORDER_REJECTED";
    const ORDER_ACCEPTED = "ORDER_ACCEPTED";
    const ORDER_PENDING  = "ORDER_PENDING";
    const ORDER_LOCKED   = "ORDER_LOCKED";
    const ORDER_PAYED    = "ORDER_PAYED";
    const ORDER_CANCELED = "ORDER_CANCELED";

    /**
     * Get all order status options
     *
     * @return array orderStatus options
     */
    public static function getAllOptions()
    {
        return [
            self::ORDER_REJECTED,
            self::ORDER_ACCEPTED,
            self::ORDER_PENDING,
            self::ORDER_LOCKED,
            self::ORDER_PAYED,
            self::ORDER_CANCELED,
        ];
    }

}
