<?php
require __DIR__ . '/../vendor/autoload.php';

use DigitalVirgo\DirectPay\Model\Request\OrderNotifyRequest;
use DigitalVirgo\DirectPay\Model\Request\PaymentPointInfoRequest;
use DigitalVirgo\DirectPay\Service\Client;
use DigitalVirgo\DirectPay\Model\PaymentPoint;
use DigitalVirgo\DirectPay\Model\Response\OrderNewResponse;
use DigitalVirgo\DirectPay\Model\Response\PaymentPointInfoResponse;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app = new App([
    'debug' => true,
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/',
    function (Request $request, Response $response) {
        $body = <<<html
<ul>
<li><a href="/new-order">Get payment point info and send new order</a></li>
<li><a href="/notification">Test notification form dp2</a></li>
</ul>
html;
        $response->getBody()->write($body);

        return $response;
    });

$app->get('/new-order',
    function (Request $request, Response $response) {
        $login = 'login';
        $password = 'password';
        $client = new Client();
        $client->setAuth($login, $password);
        $dpRequest = new PaymentPointInfoRequest([
            'product' => [
                'Name'  => 'product name',
                'Price' => [
                    'Net'      => '20,00',
                    'Gross'    => '24,60',
                    'Tax'      => '4,60',
                    'TaxRate'  => '23,00',
                    'Currency' => 'PLN',
                ],
            ],
        ]);
        try {
            $paymentPointResponse = $client->paymentPointInfo($dpRequest);
        } catch (Exception $e) {
            $response->getBody()->write("Exception: {$e->getMessage()}, code: {$e->getCode()}");
            return $response;
        }
        if ($paymentPointResponse->getError()) {
            throw new \Exception("Unable to get paymentPoints: {$paymentPointResponse->getError()} {$paymentPointResponse->getErrorDescription()}");
        }
        $response->getBody()->write('<h2>paymentPointInfo</h2>');
        $stringResponse = print_r($paymentPointResponse->getProduct()->getPaymentPoints(), true);
        $body = "PaymentPoints: <br /> <pre>$stringResponse</pre>";
        $response->getBody()->write($body);
        /** CREATING NEW ORDER */
        /** @var PaymentPoint $singlePaymentPoint */
        $singlePaymentPoint = $paymentPointResponse->getProduct()->getPaymentPoints()->getPaymentPoint()[0];
        $orderNewRequest = new \DigitalVirgo\DirectPay\Model\Request\OrderNewRequest([
            'order' => [
                'paymentPointId'   => $singlePaymentPoint->getPaymentPointId(),
                'orderDescription' => 'order_description',
                'product'          => [
                    'name'  => 'product name',
                    'price' => $singlePaymentPoint->getPrice(),
                ],
                'notifyUrl'        => 'https://partnerhost.com/notify',
                'orderFailureUrl'  => 'https://partnerhost.com/failure',
                'orderCompleteUrl' => 'https://partnerhost.com/complete',
            ],
        ]);
        /** @var OrderNewResponse $orderNewResponse */
        $orderNewResponse = $client->orderNewRequest($orderNewRequest);
        if ($orderNewResponse->getError()) {
            throw new \Exception("Unable to create order: {$orderNewResponse->getError()} {$orderNewResponse->getErrorDescription()}");
        }
        $response->getBody()->write('<h2>orderNewRequest</h2>');
        $body = "<pre>"
            . "orderId: {$orderNewResponse->getOrderId()}<br/>"
            . "transactionId: {$orderNewResponse->getTransactionId()}<br/>"
            . "paymentPointId: {$orderNewResponse->getPaymentPointId()}<br/>"
            . "orderStatus: {$orderNewResponse->getOrderStatus()}<br/>"
            . "customerRedirectUrl: {$orderNewResponse->getCustomerRedirectUrl()}"
            . "</pre>";
        $response->getBody()->write($body);

        /** GET ORDER */
        $orderGetResponse = $client->orderGetRequest([
            'orderId' => $orderNewResponse->getOrderId(),
        ]);
        if ($orderGetResponse->getError()) {
            throw new \Exception("Unable to get order: {$orderGetResponse->getError()} {$orderGetResponse->getErrorDescription()}");
        }
        $response->getBody()->write('<h2>orderGetRequest</h2>');
        $body = "<pre>"
            . "orderId: {$orderGetResponse->getOrder()->getOrderId()}<br/>"
            . "orderStatus: {$orderGetResponse->getOrder()->getOrderStatus()}"
            . "</pre>";
        $response->getBody()->write($body);

        return $response;
    });

$app->get(
    '/notification',
    function (Request $request, Response $response) {

        $xml = <<<xml
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
        $orderNotifyRequest = OrderNotifyRequest::fromXml($xml);
        $orderNotifyRequestString = print_r($orderNotifyRequest, true);
        $response->getBody()->write("Received:<pre>{$orderNotifyRequestString}</pre>");
    });

$app->run();
