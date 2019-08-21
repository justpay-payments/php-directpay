# Official DirectPay PHP Library

This library provides integration access to DirectPay Api.


## Instalation
### Composer 
Using cli
```
composer require digitalvirgo/directpay
```      

or manualy update composer.json
```javascript
{
...
    "require": {
        ...
        "digitalvirgo/directpay":"^0.1.5"
    }
}
```

## Getting started
If you are using Composer use autoload functionality:
```php
include "vendor/autoload.php";
```


## Usage
### 1. Configuration
Setup client 
```php
use DigitalVirgo\DirectPay\Service\Client;

$restApiUrl = 'https://directpay-partner.services.avantis.pl/';
$login = '...'; // Your login
$login = '...'; // Your password

$client = Client::getInstance($restApiUrl);
$client->setAuth($login, $password);
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

All steps in [example/index.php](example/index.php)