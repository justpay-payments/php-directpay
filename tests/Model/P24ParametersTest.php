<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\P24Parameters;
use DigitalVirgo\DirectPay\Tests\TestCase;

class P24ParametersTest extends TestCase
{
    public function testCreateFunction()
    {
        $obj = new P24Parameters(
            [
                'Crc' => 'Crc',
                'Email' => 'Email',
                'MerchantId' => 'MerchantId',
                'NotifyUrl' => 'NotifyUrl',
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('Crc', 'Crc', $DOMElement);
        $this->assertNodeValue('Email', 'Email', $DOMElement);
        $this->assertNodeValue('MerchantId', 'MerchantId', $DOMElement);
        $this->assertNodeValue('NotifyUrl', 'NotifyUrl', $DOMElement);
    }
}
