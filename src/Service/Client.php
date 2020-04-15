<?php

namespace DigitalVirgo\DirectPay\Service;

use DigitalVirgo\DirectPay\Exception\UnableSendRequest;
use DigitalVirgo\DirectPay\Model\Request;
use DigitalVirgo\DirectPay\Model\Request\OrderGetRequest;
use DigitalVirgo\DirectPay\Model\Request\OrderNewRequest;
use DigitalVirgo\DirectPay\Model\Request\PaymentPointInfoRequest;
use DigitalVirgo\DirectPay\Model\Request\RequestAbstract;
use DigitalVirgo\DirectPay\Model\Response\OrderGetResponse;
use DigitalVirgo\DirectPay\Model\Response\OrderNewResponse;
use DigitalVirgo\DirectPay\Model\Response\PaymentPointInfoResponse;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\BadResponseException;
use InvalidArgumentException;

/**
 * Rest service for DirectPay orders for partners.
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class Client
{
    const DP_V1_BASE_URL = 'https://directpay-partner.services.avantis.pl/';
    const DP_V2_BASE_URL = 'http://justpay.staging.digitalvirgo.pl/direct-pay2-api/';
    const DP_V2_BASE_URL_STAGE = 'https://direct-pay2.staging.digitalvirgo.pl/direct-pay2-api/';

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var GuzzleClient
     */
    private $transport;

    /**
     * Client constructor.
     *
     * @param $baseUrl
     * @param array $config
     */
    public function __construct($baseUrl = self::DP_V2_BASE_URL, $config = [])
    {
        $defaultConfig = [
            'base_uri' => $baseUrl,
        ];
        $config = array_merge_recursive($defaultConfig, $config);
        $this->transport = new GuzzleClient($config);
    }

    /**
     * Set authorization data
     *
     * @param $login
     * @param string $password password
     */
    public function setAuth($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @param string          $url
     * @param RequestAbstract $request request object
     *
     * @return string xml response
     */
    protected function request($url, RequestAbstract $request)
    {
        $this->injectAuth($request);

        $xml = $request->toXml();
        try {
            $response = $this->transport->post(
                $url,
                [
                    'body'    => $xml,
                    'headers' => [
                        'Content-Type' => 'application/xml',
                    ],
                ]
            );
        } catch (BadResponseException $e) {
            if (500 <= $e->getCode()) {
                throw new UnableSendRequest('Unable to send request: ['.$e->getCode().'] '.$e->getMessage());
            }

            return (string) $e->getResponse()->getBody();
        }
        if (null === $response) {
            throw new UnableSendRequest('Unable to send request: response is null.');
        }

        $body = $response->getBody();

        if ($response->getStatusCode() === 200) {
            return (string)$body;
        }

        throw new UnableSendRequest('Unable to send request: ['.$response->getStatusCode().'] '.$body->getContents());
    }

    /**
     * Inject authorization parameters
     *
     * @param RequestAbstract $request request object
     */
    protected function injectAuth(RequestAbstract $request)
    {
        if ($this->login && $this->password) {
            $request
                ->setLogin($this->login)
                ->setPassword($this->password);
        }
    }

    /**
     * Creating new request
     *
     * @param $request OrderNewRequest|array
     *
     * @return OrderNewResponse response
     *
     * @throws Exception
     */
    public function orderNewRequest($request)
    {
        if (!(is_array($request) || $request instanceof OrderNewRequest)) {
            throw new InvalidArgumentException('Parameter must an array or instance of '.OrderNewRequest::class);
        }
        if (is_array($request)) {
            $request = new OrderNewRequest($request);
        }

        $response = $this->request('directpayPartner/OrderNew', $request);

        return OrderNewResponse::fromXml($response);
    }

    /**
     * Get payment points info
     *
     * @param $request PaymentPointInfoRequest|array
     *
     * @return PaymentPointInfoResponse response
     *
     * @throws Exception
     */
    public function paymentPointInfo($request)
    {
        if (!(is_array($request) || $request instanceof PaymentPointInfoRequest)) {
            throw new InvalidArgumentException('Parameter must an array or instance of '.PaymentPointInfoRequest::class);
        }
        if (is_array($request)) {
            $request = new PaymentPointInfoRequest($request);
        }

        $response = $this->request('directpayPartner/PaymentPointInfo', $request);

        return PaymentPointInfoResponse::fromXml($response);
    }

    /**
     * Get order by orderid or partner order id
     *
     * @param $request Request\OrderGetRequest|array
     *
     * @return OrderGetResponse response
     *
     * @throws Exception
     */
    public function orderGetRequest($request)
    {
        if (!(is_array($request) || $request instanceof OrderGetRequest)) {
            throw new InvalidArgumentException('Parameter must an array or instance of '.OrderGetRequest::class);
        }
        if (is_array($request)) {
            $request = new Request\OrderGetRequest($request);
        }

        $response = $this->request('directpayPartner/OrderGet', $request);

        return OrderGetResponse::fromXml($response);
    }
}
