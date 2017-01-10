<?php

namespace DigitalVirgo\DirectPay\Model\Enum;

/**
 * Class PaymentType
 * @package DigitalVirgo\DirectPay\Model\Enum
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
class PaymentType
{
    const SMS                     = "SMS";
    const MULTISMS                = "MULTISMS";
    const BANK_TRANSFER           = "BANK_TRANSFER";
    const CREDIT_CARD             = "CREDIT_CARD";
    const DEBIT                   = "DEBIT";
    const DIRECT_BILLING          = "DIRECT_BILLING";
    const USSD                    = "USSD";
    const SKY_CASH                = "SKY_CASH";
    const SKY_CASH_CREDIT_CARD    = "SKY_CASH_CREDIT_CARD";
    const P24_PAYMENT             = "P24_PAYMENT";
    const P24_CREDIT_CARD         = "P24_CREDIT_CARD";
    const P24_BANK_TRANSFER       = "P24_BANK_TRANSFER";
    const MOVILE_ON_DEMAND        = "MOVILE_ON_DEMAND";
    const SUBSCRIPTION            = "SUBSCRIPTION";
    const SMS_MT_WITH_CUSTOM_CODE = "SMS_MT_WITH_CUSTOM_CODE";
    const UNKNOWN                 = "UNKNOWN";
    const RWD                     = "RWD";
    const SMS_INSTANT_DB          = "SMS_INSTANT_DB";

    /**
     * Get all payment type options
     *
     * @return array paymentType options
     */
    public static function getAllOptions()
    {
        return [
            self::SMS,
            self::MULTISMS,
            self::BANK_TRANSFER,
            self::CREDIT_CARD,
            self::DEBIT,
            self::DIRECT_BILLING,
            self::USSD,
            self::SKY_CASH,
            self::SKY_CASH_CREDIT_CARD,
            self::P24_PAYMENT,
            self::P24_CREDIT_CARD,
            self::P24_BANK_TRANSFER,
            self::MOVILE_ON_DEMAND,
            self::SUBSCRIPTION,
            self::SMS_MT_WITH_CUSTOM_CODE,
            self::UNKNOWN,
            self::RWD,
            self::SMS_INSTANT_DB,
        ];
    }
}