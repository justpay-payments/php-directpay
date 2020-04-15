<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Request;

use DigitalVirgo\DirectPay\Model\Order;
use DigitalVirgo\DirectPay\Model\Request\OrderNewRequest;
use DigitalVirgo\DirectPay\Tests\TestCase;

class OrderNewRequestTest extends TestCase
{
    public function testCreateOrderNewRequest()
    {
        $orderNewRequest = new OrderNewRequest(
            [
                'Login' => 'Login',
                'Password' => 'Password',
                'ClientUID' => 'ClientUID',
                'CustomerToken' => 'CustomerToken',
                'PartnerToken' => 'PartnerToken',
                'order' => new Order($this->getOrderDefinition())
            ]
        );
        $DOMElement = $orderNewRequest->toDomElement();
        $this->assertNodeValue('ClientUID', 'ClientUID', $DOMElement);
        $this->assertNodeValue('CustomerToken', 'CustomerToken', $DOMElement);
        $this->assertNodeValue('PartnerToken', 'PartnerToken', $DOMElement);
        $this->assertNodeCount(1, 'Order', $DOMElement);
        $orderNewRequest = new OrderNewRequest(
            [
                'Login' => 'Login',
                'Password' => 'Password',
                'ClientUID' => 'ClientUID',
                'CustomerToken' => 'CustomerToken',
                'PartnerToken' => 'PartnerToken',
                'order' => $this->getOrderDefinition()
            ]
        );
        $this->assertNodeCount(1, 'Order', $DOMElement);
    }

    public function testCreateWithMissingField()
    {
        $this->expectException('InvalidArgumentException');
        $orderNewRequest = new OrderNewRequest(
            [
                'Login' => 'Login',
                'Password' => 'Password',
                'ClientUID' => 'ClientUID',
                'CustomerToken' => 'CustomerToken',
            ]
        );
    }
}
