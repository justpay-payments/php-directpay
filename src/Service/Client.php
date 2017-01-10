<?php

namespace DigitalVirgo\DirectPay\Service;

use DigitalVirgo\DirectPay\Model\Request\OrderNewRequest;
use DigitalVirgo\DirectPay\Model\Request\RequestAbstract;
use DigitalVirgo\DirectPay\Model\Response\OrderNewResponse;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Stream\Stream;


class Client extends GuzzleClient
{
    private static $_instance = null;

    protected $_login;
    protected $_password;
    protected $_partnerToken;

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

    public function setAuth($loginOrToken, $password = null)
    {
        if ($password !== null) {
            $this
                ->setLogin($loginOrToken)
                ->setPassword($password);
        } else {
            $this->setPartnerToken($loginOrToken);
        }
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param mixed $login
     * @return Client
     */
    public function setLogin($login)
    {
        $this->_login = $login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     * @return Client
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartnerToken()
    {
        return $this->_partnerToken;
    }

    /**
     * @param mixed $partnerToken
     * @return Client
     */
    public function setPartnerToken($partnerToken)
    {
        $this->_partnerToken = $partnerToken;
        return $this;
    }



    protected function _request($url, RequestAbstract $request)
    {
        $this->_injectAuth($request);

        $xml = $request->toXml();

        $stream = Stream::factory($xml);

        $response = $this->post($url, array(
            'body' => $stream
        ));

        /** @var \GuzzleHttp\Stream\Stream $body */
        $body = $response->getBody();

        if ($response->getStatusCode() == 200) {

            return (string)$body;
            /*
            $responseXml = simplexml_load_string($body);
            if ((string)$responseXml->responseStatus == '200') {
                return (string)$responseXml->messageID;
            } else {
                throw new \Exception('Unable to send message: ['.$response->getStatusCode().'] '.$body->getContents());
            } */
        } else {
            throw new \Exception('Unable to send request: ['.$response->getStatusCode().'] '.$body->getContents());
        }
    }

    protected function _injectAuth(RequestAbstract $request)
    {
        if ($this->getLogin() && $this->getPassword()) {
            $request
                ->setLogin($this->getLogin())
                ->setPassword($this->getPassword());
        } else if ($this->getPartnerToken()) {
            $request->setPartnerToken($this->getPartnerToken());
        }
    }

    public function orderNewRequest($request)
    {
        if (is_array($request)) {
            $request = new OrderNewRequest($request);
        } else if (!$request instanceof OrderNewRequest) {
            throw new \Exception("Parameter must an array or instance of OrderNewRequest");
        }

        $response = $this->_request('/directpayPartner/OrderNew', $request);

        $responseObj = new OrderNewResponse();
        return $responseObj->fromXml($response);
    }

    public function paymentPointInfo($request)
    {
//        <PaymentPointInfoRequest>
//            <Login>directpay_test</Login>
//            <Password>directpay_test</Password>
//            <Product>
//                <Name>product name</Name>
//                <Price>
//                    <Net>1,00</Net>
//                    <Gross>1,23</Gross>
//                    <Tax>0,23</Tax>
//                    <TaxRate>23</TaxRate>
//                    <Currency>PLN</Currency>
//                </Price>
//            </Product>
//        </PaymentPointInfoRequest>
    }
}