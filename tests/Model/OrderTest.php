<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\Enum\OrderStatus;
use DigitalVirgo\DirectPay\Model\Order;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

/**
 * @preserveGlobalState
 * @runTestsInSeparateProcesses
 */
class OrderTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateOrder()
    {
        $order = new Order($this->getOrderDefinition());
        $DOMElement = $order->toDomElement();
        $this->assertNodeValue('adapterLayoutId', 'AdapterLayoutId', $DOMElement);
        $this->assertNodeValue('AfiliantUrl', 'AfiliantUrl', $DOMElement);
        $this->assertNodeValue('AuthorizationChannel', 'AuthorizationChannel', $DOMElement);
        $this->assertNodeValue(0, 'CauseStatus', $DOMElement);
        $this->assertNodeValue('GcmRegistrationId', 'GcmRegistrationId', $DOMElement);
        $this->assertNodeValue('Msisdn', 'Msisdn', $DOMElement);
        $this->assertNodeValue('NotifyUrl', 'NotifyUrl', $DOMElement);
        $this->assertNodeValue(1, 'OperatorCode', $DOMElement);
        $this->assertNodeValue('OrderCompleteUrl', 'OrderCompleteUrl', $DOMElement);
        $this->assertNodeValue('2020-04-07T12:51:15.616000Z', 'OrderCreateDate', $DOMElement);
        $this->assertNodeValue('OrderDescription', 'OrderDescription', $DOMElement);
        $this->assertNodeValue('OrderFailureUrl', 'OrderFailureUrl', $DOMElement);
        $this->assertNodeValue('OrderId', 'OrderId', $DOMElement);
        $this->assertNodeValue('OrderRejectedErrorMessage', 'OrderRejectedErrorMessage', $DOMElement);
        $this->assertNodeValue(OrderStatus::ORDER_PAYED, 'OrderStatus', $DOMElement);
        $this->assertNodeValue('PartnerTransactionId', 'PartnerTransactionId', $DOMElement);
        $this->assertNodeValue('PaymentPointId', 'PaymentPointId', $DOMElement);
        $this->assertNodeValue('SmsCode', 'SmsCode', $DOMElement);
        $this->assertNodeValue('TransactionId', 'TransactionId', $DOMElement);
        $this->assertNodeValue('orangeTokenStatus', 'orangeTokenStatus', $DOMElement);
        $this->assertNodeValue('true', 'redirectOnTop', $DOMElement);
        $this->assertNodeCount(1, 'Product', $DOMElement);
        $orderDefinition = $this->getOrderDefinition();
        $orderDefinition['Product'] = $this->getProductDefinition('ProductArray');
        $order = new Order($orderDefinition);
        $DOMElement = $order->toDomElement();
        $this->assertNodeCount(1, 'Product', $DOMElement);
    }

    public function testUnsupportedOrderType()
    {
        $this->expectException('InvalidArgumentException');
        $order = new Order(
            [
                'notifyUrl' => 'notifyUrl',
                'paymentPointId' => 'paymentPointId',
                'product' => $this->getProduct('Product 1'),
                'OrderStatus' => 'Invalid order status',
            ]
        );
    }
}
