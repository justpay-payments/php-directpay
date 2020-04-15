<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Response;

use DigitalVirgo\DirectPay\Model\Enum\ErrorType;
use DigitalVirgo\DirectPay\Model\Response\OrderGetResponse;
use DigitalVirgo\DirectPay\Tests\TestCase;

class OrderGetResponseTest extends TestCase
{
    public function testCreateFunction()
    {
        $response = new OrderGetResponse(
            [
                'Error' => ErrorType::ORDER_NOT_FOUND,
                'ErrorDescription' => 'ErrorDescription',
                'Order' => $this->getOrderDefinition()
            ]
        );
        $DOMElement = $response->toDomElement();
        $this->assertNodeValue(ErrorType::ORDER_NOT_FOUND, 'Error', $DOMElement);
        $this->assertNodeValue('ErrorDescription', 'ErrorDescription', $DOMElement);
        $this->assertNodeCount(1, 'Order', $DOMElement);
    }

    public function testCreateWithInvalidErrorFunction()
    {
        $this->expectException('InvalidArgumentException');
        $response = new OrderGetResponse(
            [
                'Error' => 'Error',
                'ErrorDescription' => 'ErrorDescription',
                'Order' => $this->getOrderDefinition()
            ]
        );
    }

    public function testCreateFromXml()
    {
        $response = OrderGetResponse::fromXml($this->getXml());
        $this->assertEquals('BAD_REQUEST', $response->getError());
        $this->assertEquals('AdapterLayoutId', $response->getOrder()->getAdapterLayoutId());
        $this->assertEquals('PLN', $response->getOrder()->getProduct()->getPaymentPoints()->getPaymentPoint()[0]->getPrice()->getCurrency());
        $this->assertEquals('EUR', $response->getOrder()->getProduct()->getPrice()->getCurrency());
    }

    protected function getXml()
    {
        return <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<OrderGetResponse>
    <Error>BAD_REQUEST</Error>
    <ErrorDescription>string</ErrorDescription>
    <Order>
        <AdapterLayoutId>AdapterLayoutId</AdapterLayoutId>
        <AfiliantUrl>string</AfiliantUrl>
        <AuthorizationChannel>string</AuthorizationChannel>
        <CauseStatus>0</CauseStatus>
        <GcmRegistrationId>string</GcmRegistrationId>
        <Msisdn>string</Msisdn>
        <NotifyUrl>string</NotifyUrl>
        <OperatorCode>0</OperatorCode>
        <OrderCompleteUrl>string</OrderCompleteUrl>
        <OrderCreateDate>2020-04-09T00:47:59.542Z</OrderCreateDate>
        <OrderDescription>string</OrderDescription>
        <OrderFailureUrl>string</OrderFailureUrl>
        <OrderId>string</OrderId>
        <OrderRejectedErrorMessage>string</OrderRejectedErrorMessage>
        <OrderStatus>ORDER_CANCELED</OrderStatus>
        <PartnerTransactionId>string</PartnerTransactionId>
        <PaymentPointId>string</PaymentPointId>
        <Product>
            <Name>string</Name>
            <PaymentPoints>
                <PaymentPoint>
                    <CustomPrice>true</CustomPrice>
                    <Description>string</Description>
                    <LargeAccount>string</LargeAccount>
                    <PaymentPointId>string</PaymentPointId>
                    <PaymentType>RWD</PaymentType>
                    <Prefix>string</Prefix>
                    <Price>
                        <Currency>PLN</Currency>
                        <Gross>0</Gross>
                        <Net>0</Net>
                        <Tax>0</Tax>
                        <TaxRate>0</TaxRate>
                    </Price>
                    <Provider>string</Provider>
                </PaymentPoint>
            </PaymentPoints>
            <Price>
                <Currency>EUR</Currency>
                <Gross>0</Gross>
                <Net>0</Net>
                <Tax>0</Tax>
                <TaxRate>0</TaxRate>
            </Price>
        </Product>
        <SmsCode>string</SmsCode>
        <TransactionId>string</TransactionId>
        <orangeTokenStatus>string</orangeTokenStatus>
        <redirectOnTop>true</redirectOnTop>
    </Order>
</OrderGetResponse>
xml;
    }
}
