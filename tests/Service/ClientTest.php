<?php

namespace DigitalVirgo\DirectPay\Tests\Service;

use DigitalVirgo\DirectPay\Model\Enum\ErrorType;
use DigitalVirgo\DirectPay\Model\Enum\PaymentType;
use DigitalVirgo\DirectPay\Model\ModelAbstract;
use DigitalVirgo\DirectPay\Model\Order;
use DigitalVirgo\DirectPay\Model\Product;
use DigitalVirgo\DirectPay\Model\Request\OrderGetRequest;
use DigitalVirgo\DirectPay\Model\Request\OrderNewRequest;
use DigitalVirgo\DirectPay\Model\Request\PaymentPointInfoRequest;
use DigitalVirgo\DirectPay\Service\Client;
use DigitalVirgo\DirectPay\Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class ClientTest extends TestCase
{
    public function testOrderNewRequest()
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

        $mock = new MockHandler(
            [
                new Response(200, [], $this->getOrderNewResponseXml()),
            ]
        );

        $handlerStack = HandlerStack::create($mock);

        $response = $this->getClient($handlerStack)->orderNewRequest($orderNewRequest);
        $this->assertEquals('Crc', $response->getP24Parameters()->getCrc());
    }

    public function testOrderGetRequest()
    {
        $orderGetRequest = new OrderGetRequest(
            [
                'Login'                => 'Login',
                'Password'             => 'Password',
                'OrderId'              => 'OrderId',
                'PartnerTransactionId' => 'PartnerTransactionId',
            ]
        );
        $mock = new MockHandler(
            [
                new Response(200, [], $this->getOrderGetResponseXml()),
            ]
        );

        $handlerStack = HandlerStack::create($mock);

        $response = $this->getClient($handlerStack)->orderGetRequest($orderGetRequest);
        $currency = $response->getOrder()->getProduct()->getPaymentPoints()->getPaymentPoint()[0]->getPrice()->getCurrency();
        $this->assertEquals('PLN', $currency);
    }

    public function testPaymentPointInfoRequest()
    {
        $request = new PaymentPointInfoRequest(
            [
                'Login'       => 'Login',
                'Password'    => 'Password',
                'PaymentType' => PaymentType::RWD,
                'Product'     => new Product($this->getProductDefinition('Product1')),
                'Provider'    => 'Provider',
            ]
        );
        $mock = new MockHandler(
            [
                new Response(200, [], $this->getPaymentPointInfoXml()),
            ]
        );

        $handlerStack = HandlerStack::create($mock);

        $response = $this->getClient($handlerStack)->paymentPointInfo($request);
        $currency = $response->getProduct()->getPaymentPoints()->getPaymentPoint()[0]->getPrice()->getCurrency();
        $this->assertEquals('PLN', $currency);
    }

    public function testAuthByClient()
    {
        $client = $this->getClient();
        $client->setAuth($this->getLogin(), $this->getPassword());
        $request = new PaymentPointInfoRequest(
            [
                'product' => [
                    'Name' => 'product name',
                    'Price' => [
                        'Net' => '20,00',
                        'Gross' => '24,60',
                        'Tax' => '4,60',
                        'TaxRate' => '23,00',
                        'Currency' => 'PLN'
                    ]
                ]
            ]
        );
        $response = $client->paymentPointInfo($request);
        $DOMElement = $response->toDomElement();
        $this->assertNodeCount(3, 'PaymentPoint', $DOMElement);
    }

    public function testBadAuthError()
    {
        $client = $this->getClient();
        $client->setAuth('fake', 'fake');
        $request = new PaymentPointInfoRequest(
            [
                'product' => [
                    'Name' => 'product name',
                    'Price' => [
                        'Net' => '20,00',
                        'Gross' => '24,60',
                        'Tax' => '4,60',
                        'TaxRate' => '23,00',
                        'Currency' => 'PLN'
                    ]
                ]
            ]
        );
        $response = $client->paymentPointInfo($request);
        $this->assertTrue($response->isError());
        $this->assertEquals(ErrorType::AUTHORIZATION_FAILURE, $response->getError());
    }

    public function getClient($handlerStack = [])
    {
        $options = [];
        if (!empty($handlerStack)) {
            $options['handler'] = $handlerStack;
        }
        return new Client(Client::DP_V2_BASE_URL, $options);
    }

    public function testRealDP2OnStaging()
    {
        ModelAbstract::$ignoreUdefinedProperties = false;
        $orderNewRequest = new OrderNewRequest(
            [
                'Login' => $this->getLogin(),
                'Password' => $this->getPassword(),
                'Order' => [
                    'PartnerTransactionId' => time(),
                    'PaymentPointId' => '2002',
                    'OrderDescription' => 'test order',
                    'Product' => [
                        'Name' => 'product name',
                        'Price' => [
                            'Net' => '1,00',
                            'Gross' => '1,23',
                            'Tax' => '0,23',
                            'TaxRate' => 23,
                            'Currency' => 'PLN'
                        ]
                    ],
                    'OperatorCode' => '26003',
                    'NotifyUrl' => 'https://example.pl/notify',
                    'OrderFailureUrl' => 'https://example.pl/test',
                    'OrderCompleteUrl' => 'https://example.pl/test',
                ]
            ]
        );
        $client = new Client(Client::DP_V2_BASE_URL_STAGE);
        $response = $client->orderNewRequest($orderNewRequest);
        $this->assertFalse($response->isError());
        $orderGetRequest = new OrderGetRequest(
            [
                'Login' => $this->getLogin(),
                'Password' => $this->getPassword(),
                'orderId' => $response->getOrderId(),
            ]
        );
        $response = $client->orderGetRequest($orderGetRequest);
    }

    public function getOrderNewResponseXml()
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

    protected function getOrderGetResponseXml()
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

    protected function getPaymentPointInfoXml()
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
