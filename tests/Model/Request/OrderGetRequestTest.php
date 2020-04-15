<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Request;

use DigitalVirgo\DirectPay\Model\Request\OrderGetRequest;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

class OrderGetRequestTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateOrderGetRequest()
    {
        $orderGetRequest = new OrderGetRequest(
            [
                'Login' => 'Login',
                'Password' => 'Password',
                'OrderId' => 'OrderId',
                'PartnerTransactionId' => 'PartnerTransactionId'
            ]
        );

        $DOMElement = $orderGetRequest->toDomElement();
        $this->assertNodeValue('Login', 'Login', $DOMElement);
        $this->assertNodeValue('Password', 'Password', $DOMElement);
        $this->assertNodeValue('OrderId', 'OrderId', $DOMElement);
        $this->assertNodeValue('PartnerTransactionId', 'PartnerTransactionId', $DOMElement);
    }
}
