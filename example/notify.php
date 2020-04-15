<?php

require __DIR__ . '/../vendor/autoload.php';

use DigitalVirgo\DirectPay\Model\Request\OrderNotifyRequest;
use DigitalVirgo\DirectPay\Model\Response\OrderNotifyResponse;

$body = file_get_contents('php://input');
//if you can't receive this notification throw some error.
// if everything is ok return status 200;
$orderNotifyRequest = OrderNotifyRequest::fromXml($body);
$response = new OrderNotifyResponse([
    'order' => $orderNotifyRequest->getOrder(),
    'updateDate' => new DateTimeImmutable(),
]);
print ($response->toXml());
