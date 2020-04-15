<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Response;

use DigitalVirgo\DirectPay\Model\Response\PaymentPointInfoResponse;
use DigitalVirgo\DirectPay\Tests\TestCase;

class PaymentPointInfoResponseTest extends TestCase
{
    public function testCreateFunction()
    {
        $response = new PaymentPointInfoResponse(
            [
                'Product'          => $this->getProductDefinition('product 1'),
            ]
        );
        $DOMElement = $response->toDomElement();
        $this->assertNodeCount(1, 'Product', $DOMElement);
    }

    public function createWithoutProduct()
    {
        $this->expectException('InvalidArgumentException');
        $response = new PaymentPointInfoResponse();
    }

    public function testCreateFromXml()
    {
        $response = PaymentPointInfoResponse::fromXml($this->getXml());
        $this->assertEquals('BAD_REQUEST', $response->getError());
        $this->assertEquals('Name', $response->getProduct()->getName());
        $this->assertEquals('PLN', $response->getProduct()->getPaymentPoints()->getPaymentPoint()[0]->getPrice()->getCurrency());
        $this->assertEquals('EUR', $response->getProduct()->getPrice()->getCurrency());
    }

    protected function getXml()
    {
        return <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<PaymentPointInfoResponse>
    <Error>BAD_REQUEST</Error>
    <ErrorDescription>string</ErrorDescription>
    <Product>
        <Name>Name</Name>
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
</PaymentPointInfoResponse>
xml;
    }
}
