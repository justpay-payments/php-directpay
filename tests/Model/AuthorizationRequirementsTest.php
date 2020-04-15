<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\AuthorizationRequirements;
use DigitalVirgo\DirectPay\Tests\TestCase;

class AuthorizationRequirementsTest extends TestCase
{
    public function testCreateFunction()
    {
        $obj = new AuthorizationRequirements(
            [
                'SmsLargeAccount' => 'SmsLargeAccount',
                'SmsTextMessage' => 'SmsTextMessage',
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('SmsLargeAccount', 'SmsLargeAccount', $DOMElement);
        $this->assertNodeValue('SmsTextMessage', 'SmsTextMessage', $DOMElement);
    }
}
