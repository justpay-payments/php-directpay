<?php

namespace DigitalVirgo\DirectPay\Model\Response;

/**
 * Class OrderNotifyResponse
 * @package DigitalVirgo\DirectPay\Model\Response
 *
 */
class OrderNotifyResponse extends ResponseAbstract
{
    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        $parentMap = parent::_getDomMap()[0];

        return [
            'OrderNotifyResponse' => []
        ];
    }
}
