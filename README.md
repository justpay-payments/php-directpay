# Official DirectPay PHP Library

This library provides integration access to DirectPay Api.


## Instalation
### Composer 
Using cli
```
composer require digitalvirgo/directpay
```      

or manualy add to "require" in composer.json
```json
    "require": {
        "digitalvirgo/directpay":"^1.0.0"
    }
```

## Getting started
If you are using Composer use autoload functionality:
```php
include "vendor/autoload.php";
```


## Usage
### 1. Configuration
Basic setup for DirectPay version 2:
```php
use DigitalVirgo\DirectPay\Service\Client;

$client = new Client();
```
First parameter is DirectPay url. Default is for version 2. These urls are in constants:
`Client::DP_V1_BASE_URL` and `Client::DP_V2_BASE_URL`
You can pass options for Guzzle client as second parameter.  

```php
use DigitalVirgo\DirectPay\Service\Client;
$options = [
    'timeout' => 10,
]
$client = new Client(Client::DP_V2_BASE_URL, $options);
```

Set your credentials in client:
```php
$client->setAuth($login, $password);
```
Alternatively you can pass credentials directly on every request:
```php
$request = new \DigitalVirgo\DirectPay\Model\Request\PaymentPointInfoRequest([
    'product' => $product,
    'login' => $login,
    'password' => $password, 
])
```

### 2. Getting Payment Points
Before you will able to generate new order You have to get know your PaymentPoints

```php
$paymentPointResponse = $client->paymentPointInfo([
    'product' => [
        'name' => 'product name',
        'price' => [ // net price and currency is mandatory
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
```

### 3. Choose your PaymentPoint
```php
    $singlePaymentPoint = $paymentPointResponse->getProduct()->getPaymentPoints()->getPaymentPoint()[0]; // we use first given
```

### 4. Generate new order
```php
$orderNewResponse = $client->orderNewRequest([
    'order' => [
        'paymentPointId' => $singlePaymentPoint->getPaymentPointId(),
        'orderDescription' => 'order_description',
        'product' => [
            'name' => 'product name',
            'price' => $singlePaymentPoint->getPrice(),
        ],
        'notifyUrl' => 'https://partnerhost.com/notify',  //setup your url's
        'orderFailureUrl' => 'https://partnerhost.com/failure',
        'orderCompleteUrl' => 'https://partnerhost.com/complete',
    ],
]);
```

### 5. Check order status
```php
$orderGetResponse = $client->orderGetRequest([
    'orderId' => $orderNewResponse->getOrderId()
]);

if ($orderGetResponse->getError()) {
    throw new \Exception("Unable to get order: {$orderGetResponse->getError()} {$orderGetResponse->getErrorDescription()}");
}

var_dump($orderGetResponse->getOrder()->getOrderId());
var_dump($orderGetResponse->getOrder()->getOrderStatus());

```

### 6. Receiving notifications
When you set up `notifyUrl` in `orderNewReqest` you will be notified By DirectPay. You culd parse received xml to `OrderNotifyRequest`:
```php
$body = file_get_contents('php://input');
//if you can't receive this notification throw some error.
// if everything is ok return status 200;
$orderNotifyRequest = OrderNotifyRequest::fromXml($body);
$response = new OrderNotifyResponse([
    'order' => $orderNotifyRequest->getOrder(),
    'updateDate' => new DateTimeImmutable(),
]);
print ($response->toXml());
```


##
All steps are in [example/index.php](example/index.php) and [example/notify.php](example/notify.php);
