<?php

namespace DigitalVirgo\DirectPay\Model\Enum;

/**
 * Class OrderStatus
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class ErrorType
{
    const BAD_REQUEST           = 'BAD_REQUEST';
    const AUTHORIZATION_FAILURE = 'AUTHORIZATION_FAILURE';
    const NO_PAYMENT_POINTS     = 'NO_PAYMENT_POINTS';
    const ORDER_NOT_FOUND       = 'ORDER_NOT_FOUND';
    const PAYMENT_UNAVAILABLE   = 'PAYMENT_UNAVAILABLE';

    /**
     * Get all order status options
     *
     * @return array orderStatus options
     */
    public static function getAllOptions()
    {
        return [
            self::BAD_REQUEST,
            self::AUTHORIZATION_FAILURE,
            self::NO_PAYMENT_POINTS,
            self::ORDER_NOT_FOUND,
            self::PAYMENT_UNAVAILABLE,
        ];
    }
}
