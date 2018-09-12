<?php

namespace DigitalVirgo\DirectPay\Service;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Stream\Stream;
use DigitalVirgo\DirectPay\Model\Request;
use DigitalVirgo\DirectPay\Model\Response;

/**
 * Class Client
 * @package DigitalVirgo\DirectPay\Service
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 * Rest service for DirectPay orders for partners/
 */
class Client extends GuzzleClient
{
    /**
     * @var Client
     */
    private static $_instance = null;

    /**
     * @var string
     */
    protected $_login;

    /**
     * @var string
     */
    protected $_password;

    /**
     * @var string
     */
    protected $_partnerToken;

    /**
     * Get new instance of client
     *
     * @param string $baseUrl api base url
     * @return Client
     */
    public static function getInstance($baseUrl = null)
    {
        if (null === static::$_instance) {
            if ($baseUrl === null) {
                throw new \Exception('baseUrl required.');
            }

            static::$_instance = new static(array(
                'base_url' => $baseUrl,
            ));

        }

        return static::$_instance;
    }

    /**
     * Set authorization data
     *
     * @param string $loginOrToken login or authorization token
     * @param string $password password
     */
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
     * @return string
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param string $login
     * @return Client
     */
    public function setLogin($login)
    {
        $this->_login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerToken()
    {
        return $this->_partnerToken;
    }

    /**
     * @param string $partnerToken
     * @return Client
     */
    public function setPartnerToken($partnerToken)
    {
        $this->_partnerToken = $partnerToken;
        return $this;
    }

    /**
     * @param $url string url
     * @param Request\RequestAbstract $request request object
     * @return string xml response
     * @throws \Exception
     */
    protected function _request($url, Request\RequestAbstract $request)
    {
        $this->_injectAuth($request);

        $xml = $request->toXml();

        $stream = Stream::factory($xml);

        $response = $this->post($url, array(
            'body' => $stream,
            'headers' => array(
                'Content-Type' => 'application/xml'
            )
        ));

        /** @var \GuzzleHttp\Stream\Stream $body */
        $body = $response->getBody();

        if ($response->getStatusCode() == 200) {
            return (string)$body;
        } else {
            throw new \Exception('Unable to send request: ['.$response->getStatusCode().'] '.$body->getContents());
        }
    }

    /**
     * Inject authorization parameters
     *
     * @param Request\RequestAbstract $request request object
     */
    protected function _injectAuth(Request\RequestAbstract $request)
    {
        if ($this->getLogin() && $this->getPassword()) {
            $request
                ->setLogin($this->getLogin())
                ->setPassword($this->getPassword());
        } else if ($this->getPartnerToken()) {
            $request->setPartnerToken($this->getPartnerToken());
        }
    }

    /**
     * Creating new request
     *
     * @param $request Request\OrderNewRequest|array
     * @return Response\OrderNewResponse response
     * @throws \Exception
     */
    public function orderNewRequest($request)
    {
        if (is_array($request)) {
            $request = new Request\OrderNewRequest($request);
        } else if (!$request instanceof Request\OrderNewRequest) {
            throw new \Exception("Parameter must an array or instance of DigitalVirgo\\DirectPay\\Model\\Request\\OrderNewRequest");
        }

        $response = $this->_request('/directpayPartner/OrderNew', $request);

        $responseObj = new Response\OrderNewResponse();
        return $responseObj->fromXml($response);
    }

    /**
     * Get payment points info
     *
     * @param $request Request\PaymentPointInfoRequest|array
     * @return Response\PaymentPointInfoResponse response
     * @throws \Exception
     */
    public function paymentPointInfo($request)
    {

        if (is_array($request)) {
            $request = new Request\PaymentPointInfoRequest($request);
        } else if (!$request instanceof Request\PaymentPointInfoRequest) {
            throw new \Exception("Parameter must an array or instance of DigitalVirgo\\DirectPay\\Model\\Request\\PaymentPointInfoRequest");
        }

        $response = $this->_request('/directpayPartner/PaymentPointInfo', $request);

        $responseObj = new Response\PaymentPointInfoResponse();
        return $responseObj->fromXml($response);
    }

    /**
     * Get order by orderid or partner order id
     *
     * @param $request Request\OrderGetRequest|array
     * @return Response\OrderGetResponse response
     * @throws \Exception
     */
    public function orderGetRequest($request)
    {

        if (is_array($request)) {
            $request = new Request\OrderGetRequest($request);
        } else if (!$request instanceof Request\OrderGetRequest) {
            throw new \Exception("Parameter must an array or instance of DigitalVirgo\\DirectPay\\Model\\Request\\OrderGetRequest");
        }

        $response = $this->_request('/directpayPartner/OrderGet', $request);

        $responseObj = new Response\OrderGetResponse();
        return $responseObj->fromXml($response);
    }

}
