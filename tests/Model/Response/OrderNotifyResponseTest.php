<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Response;

use DigitalVirgo\DirectPay\Model\Response\OrderNotifyResponse;
use DigitalVirgo\DirectPay\Tests\TestCase;

class OrderNotifyResponseTest extends TestCase
{
    public function testCreateResponse()
    {
        $response = new OrderNotifyResponse();
        $this->assertInstanceOf(OrderNotifyResponse::class, $response);
    }
}
