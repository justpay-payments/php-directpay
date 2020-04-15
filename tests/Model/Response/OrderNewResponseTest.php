<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Response;

use DigitalVirgo\DirectPay\Model\AuthorizationRequirements;
use DigitalVirgo\DirectPay\Model\Enum\ErrorType;
use DigitalVirgo\DirectPay\Model\Enum\OrderStatus;
use DigitalVirgo\DirectPay\Model\P24Parameters;
use DigitalVirgo\DirectPay\Model\Response\OrderGetResponse;
use DigitalVirgo\DirectPay\Model\Response\OrderNewResponse;
use DigitalVirgo\DirectPay\Tests\TestCase;

class OrderNewResponseTest extends TestCase
{
    public function testCreateFunction()
    {
        $response = new OrderNewResponse(
            [
                'AuthorizationRequirements' => new AuthorizationRequirements(),
                'CustomerRedirectUrl'       => 'CustomerRedirectUrl',
                'Error'                     => ErrorType::ORDER_NOT_FOUND,
                'ErrorDescription'          => 'ErrorDescription',
                'OrderErrorDescription'     => 'OrderErrorDescription',
                'OrderId'                   => 'OrderId',
                'OrderStatus'               => OrderStatus::ORDER_ACCEPTED,
                'P24Parameters'             => new P24Parameters(),
                'PaymentPointId'            => 'PaymentPointId',
                'transactionId'             => 'transactionId',
            ]
        );
        $DOMElement = $response->toDomElement();
        $this->assertNodeValue('CustomerRedirectUrl', 'CustomerRedirectUrl', $DOMElement);
        $this->assertNodeValue(ErrorType::ORDER_NOT_FOUND, 'Error', $DOMElement);
        $this->assertNodeValue('ErrorDescription', 'ErrorDescription', $DOMElement);
        $this->assertNodeValue('OrderErrorDescription', 'OrderErrorDescription', $DOMElement);
        $this->assertNodeValue('OrderId', 'OrderId', $DOMElement);
        $this->assertNodeValue(OrderStatus::ORDER_ACCEPTED, 'OrderStatus', $DOMElement);
        $this->assertNodeValue('PaymentPointId', 'PaymentPointId', $DOMElement);
        $this->assertNodeValue('transactionId', 'transactionId', $DOMElement);
        $this->assertNodeCount(1, 'AuthorizationRequirements', $DOMElement);
        $this->assertNodeCount(1, 'P24Parameters', $DOMElement);
    }

    public function testCreateFromXml()
    {
        $response = OrderNewResponse::fromXml($this->getXml());
        $this->assertEquals('SmsLargeAccount', $response->getAuthorizationRequirements()->getSmsLargeAccount());
        $this->assertEquals('CustomerRedirectUrl', $response->getCustomerRedirectUrl());
        $this->assertEquals('Crc', $response->getP24Parameters()->getCrc());
    }

    public function getXml()
    {
        return <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<OrderNewResponse>
    <AuthorizationRequirements>
        <SmsLargeAccount>SmsLargeAccount</SmsLargeAccount>
        <SmsTextMessage>SmsTextMessage</SmsTextMessage>
    </AuthorizationRequirements>
    <CustomerRedirectUrl>CustomerRedirectUrl</CustomerRedirectUrl>
    <Error>BAD_REQUEST</Error>
    <ErrorDescription>ErrorDescription</ErrorDescription>
    <OrderErrorDescription>OrderErrorDescription</OrderErrorDescription>
    <OrderId>OrderId</OrderId>
    <OrderStatus>ORDER_CANCELED</OrderStatus>
    <P24Parameters>
        <Crc>Crc</Crc>
        <Email>Email</Email>
        <MerchantId>MerchantId</MerchantId>
        <NotifyUrl>NotifyUrl</NotifyUrl>
    </P24Parameters>
    <PaymentPointId>PaymentPointId</PaymentPointId>
    <transactionId>transaction</transactionId>
</OrderNewResponse>
xml;
    }
}
