<?php

namespace DigitalVirgo\DirectPay\Tests;

use DigitalVirgo\DirectPay\Model\Enum\OrderStatus;
use DigitalVirgo\DirectPay\Model\Enum\PaymentType;
use DigitalVirgo\DirectPay\Model\PaymentPoint;
use DigitalVirgo\DirectPay\Model\Price;
use DigitalVirgo\DirectPay\Model\Product;
use DOMElement;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    /**
     * @param mixed      $expected
     * @param string     $actualNodeName
     * @param DOMElement $actualDOMElement
     * @param string     $message
     */
    public function assertNodeCount($expected, $actualNodeName, $actualDOMElement, $message = '')
    {
        $DOMNodeList = $actualDOMElement->getElementsByTagName($actualNodeName);
        $this->assertEquals($expected, $DOMNodeList->length, $message);
    }

    /**
     * @param mixed      $expected
     * @param string     $actualNodeName
     * @param DOMElement $actualDOMElement
     * @param string     $message
     */
    public function assertNodeValue($expected, $actualNodeName, $actualDOMElement, $message = '')
    {
        $DOMNodeList = $actualDOMElement->getElementsByTagName($actualNodeName);
        $this->assertEquals($expected, $DOMNodeList->item(0)->nodeValue, $message);
    }

    public function getPassword()
    {
        return getenv('DP_PASSWORD');
    }

    public function getLogin()
    {
        return getenv('DP_LOGIN');
    }

    /**
     * @param $name
     *
     * @return Product
     */
    public function getProduct($name)
    {
        return new Product($this->getProductDefinition($name));
    }

    public function getPaymentPointDefinition($description)
    {
        $price = new Price(
            [
                'Currency' => 'PLN',
                'Gross'    => '12,30',
                'Net'      => '10,00',
                'Tax'      => '2,30',
                'TaxRate'  => '23'
            ]
        );

        return [
            'CustomPrice'    => false,
            'Description'    => $description,
            'LargeAccount'   => 'LargeAccount',
            'PaymentPointId' => 'PaymentPointId',
            'PaymentType'    => PaymentType::RWD,
            'Prefix'         => 'Prefix',
            'Price'          => $price,
            'Provider'       => 'Provider',
        ];
    }

    /**
     * @param string $description
     *
     * @return PaymentPoint
     */
    protected function getPaymentPoint($description)
    {
        return new PaymentPoint($this->getPaymentPointDefinition($description));
    }

    /**
     * @return array
     */
    protected function getPriceDefinition()
    {
        return [
            'Currency' => 'PLN',
            'Gross'    => '12,30',
            'Net'      => '10,00',
            'Tax'      => '2,30',
            'TaxRate'  => '23'
        ];
    }

    /**
     * @return array
     */
    protected function getOrderDefinition()
    {
        return [
            'adapterLayoutId'           => 'adapterLayoutId',
            'AfiliantUrl'               => 'AfiliantUrl',
            'AuthorizationChannel'      => 'AuthorizationChannel',
            'CauseStatus'               => '0',
            'GcmRegistrationId'         => 'GcmRegistrationId',
            'Msisdn'                    => 'Msisdn',
            'NotifyUrl'                 => 'NotifyUrl',
            'OperatorCode'              => 1,
            'OrderCompleteUrl'          => 'OrderCompleteUrl',
            'OrderCreateDate'           => '2020-04-07T12:51:15.616Z',
            'OrderDescription'          => 'OrderDescription',
            'OrderFailureUrl'           => 'OrderFailureUrl',
            'OrderId'                   => 'OrderId',
            'OrderRejectedErrorMessage' => 'OrderRejectedErrorMessage',
            'OrderStatus'               => OrderStatus::ORDER_PAYED,
            'PartnerTransactionId'      => 'PartnerTransactionId',
            'PaymentPointId'            => 'PaymentPointId',
            'Product'                   => $this->getProduct('Product'),
            'SmsCode'                   => 'SmsCode',
            'TransactionId'             => 'TransactionId',
            'orangeTokenStatus'         => 'orangeTokenStatus',
            'redirectOnTop'             => true,
        ];
    }

    /**
     * @param $name
     *
     * @return array
     */
    public function getProductDefinition($name)
    {
        return [
            'Name'          => $name,
            'PaymentPoints' => [
                'PaymentPoint' => [
                    $this->getPaymentPoint('Payment point 1'),
                    $this->getPaymentPoint('Payment point 2'),
                    $this->getPaymentPoint('Payment point 3'),
                ]
            ],
            'Price'        => $this->getPriceDefinition(),
        ];
    }
}
