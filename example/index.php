<?php
require 'vendor/autoload.php';

use DigitalVirgo\DirectPay\Service\Client;
use DigitalVirgo\DirectPay\Model\PaymentPoint;
use DigitalVirgo\DirectPay\Model\Response\OrderNewResponse;
use DigitalVirgo\DirectPay\Model\Response\PaymentPointInfoResponse;

$restApiUrl = 'https://directpay-partner.services.avantis.pl/';
$login = '...';        //FILL THIS WITH YOUR CREDENTIALS
$password = '...';

/** SETUP CLIENT */
/** @var Client $client */
$client = Client::getInstance($restApiUrl);
$client->setAuth($login, $password);

/** GET PAYMENT POINTS */
/** @var PaymentPointInfoResponse $paymentPointResponse */
$paymentPointResponse = $client->paymentPointInfo([
    'product' => [
        'name' => 'product name',
        'price' => [
            'net' => '1,00',
            'gross' => '1,23',
            'tax' => '0,23',
            'taxRate' => '23',
            'currency' => 'PLN',
        ]
    ]
]);

if ($paymentPointResponse->getError()) {
    throw new \Exception("Unable to get paymentPoints: {$paymentPointResponse->getError()} {$paymentPointResponse->getErrorDescription()}");
}

/** CREATING NEW ORDER */
/** @var PaymentPoint $singlePaymentPoint */
$singlePaymentPoint = $paymentPointResponse->getProduct()->getPaymentPoints()->getPaymentPoint()[0];


/** @var OrderNewResponse $orderNewResponse */
$orderNewResponse = $client->orderNewRequest([
    'order' => [
        'paymentPointId' => $singlePaymentPoint->getPaymentPointId(),
        'orderDescription' => 'order_description',
        'product' => [
            'name' => 'product name',
            'price' => $singlePaymentPoint->getPrice(),
        ],
        'notifyUrl' => 'https://partnerhost.com/notify',
        'orderFailureUrl' => 'https://partnerhost.com/failure',
        'orderCompleteUrl' => 'https://partnerhost.com/complete',
    ],
]);


if ($orderNewResponse->getError()) {
    throw new \Exception("Unable to create order: {$orderNewResponse->getError()} {$orderNewResponse->getErrorDescription()}");
} else {
    echo '<pre>';
    var_dump($orderNewResponse->getOrderId());
    var_dump($orderNewResponse->getTransactionId());
    var_dump($orderNewResponse->getPaymentPointId());
    var_dump($orderNewResponse->getOrderStatus());
    var_dump($orderNewResponse->getCustomerRedirectUrl());
    echo '</pre>';
}

/** GET ORDER */
$orderGetResponse = $client->orderGetRequest([
    'orderId' => $orderNewResponse->getOrderId()
]);

if ($orderGetResponse->getError()) {
    throw new \Exception("Unable to get order: {$orderGetResponse->getError()} {$orderGetResponse->getErrorDescription()}");
} else {
    var_dump($orderGetResponse->getOrder()->getOrderId());
    var_dump($orderGetResponse->getOrder()->getOrderStatus());
}

