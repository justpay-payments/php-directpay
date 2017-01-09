<?php

namespace DigitalVirgo\DirectPay\Service;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{
    private static $_instance = null;

    public static function getInstance($baseUrl)
    {
        if (null === static::$_instance) {
            static::$_instance = new static(array(
                'base_url' => $baseUrl,
//                'defaults' => array(
//                    'headers' => array(
//                        'Content-type' => 'application/x-www-form-urlencoded'
//                    )
//                )
            ));

//            static::$_instance->setDefaultOption('verify', false);
        }

        return static::$_instance;
    }

    public function orderNewRequest($data)
    {

    }
}