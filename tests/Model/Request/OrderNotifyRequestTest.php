<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Request;

use DateTimeInterface;
use DigitalVirgo\DirectPay\Model\Request\OrderNotifyRequest;
use DigitalVirgo\DirectPay\Tests\TestCase;

class OrderNotifyRequestTest extends TestCase
{
    public function testCreateFromXml()
    {
        $orderNotifyRequest = OrderNotifyRequest::fromXml($this->getXml());
        $this->assertEquals('48500500555', $orderNotifyRequest->getOrder()->getMsisdn());
        $this->assertEquals('43113', $orderNotifyRequest->getOrder()->getOrderId());
        $this->assertInstanceOf(DateTimeInterface::class, $orderNotifyRequest->getUpdateDate());
    }

    public function getXml()
    {
        return <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<OrderNotifyRequest>    
    <Order>
        <AdapterLayoutId/>
        <AfiliantUrl/>
        <AuthorizationChannel>RWD_PAYMENT</AuthorizationChannel>
        <CauseStatus>16</CauseStatus>
        <GcmRegistrationId/>
        <Msisdn>48500500555</Msisdn>
        <NotifyUrl>https://chuchmala.pl/post.php</NotifyUrl>
        <OperatorCode/>
        <OrderCompleteUrl>https://chuchmala.pl/test.php</OrderCompleteUrl>
        <OrderCreateDate>2020-04-09T15:03:27.295066</OrderCreateDate>
        <OrderDescription>test order</OrderDescription>
        <OrderFailureUrl>https://chuchmala.pl/test.php</OrderFailureUrl>
        <OrderId>43113</OrderId>
        <OrderRejectedErrorMessage>Missisng operatorCode</OrderRejectedErrorMessage>
        <OrderStatus>ORDER_REJECTED</OrderStatus>
        <PartnerTransactionId>1586437406</PartnerTransactionId>
        <PaymentPointId>string</PaymentPointId>
        <Product>
            <Name>product name</Name>
            <PaymentPoints>
                <PaymentPoint>
                    <CustomPrice>false</CustomPrice>
                    <Description>DB SMS and MultiSMS Premium</Description>
                    <LargeAccount>7054</LargeAccount>
                    <PaymentPointId>2002</PaymentPointId>
                    <PaymentType>RWD</PaymentType>
                    <Prefix>DEVTEST.</Prefix>
                    <Price>
                        <Currency>PLN</Currency>
                        <Gross>24,60</Gross>
                        <Net>20,00</Net>
                        <Tax>4,60</Tax>
                        <TaxRate>23,00</TaxRate>
                    </Price>
                    <Provider>PROVIDER</Provider>
                </PaymentPoint>
            </PaymentPoints>
            <Price>
                <Currency>string</Currency>
                <Gross>0</Gross>
                <Net>0</Net>
                <Tax>0</Tax>
                <TaxRate>0</TaxRate>
            </Price>
        </Product>
        <SmsCode/>
        <TransactionId>2dc7796e24d3411c</TransactionId>
        <orangeTokenStatus/>
        <redirectOnTop/>
    </Order>
    <UpdateDate>2020-04-09T15:03:43.649613+02:00</UpdateDate>
</OrderNotifyRequest>
xml;
    }
}
