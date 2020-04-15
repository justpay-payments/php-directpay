<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\Enum\PaymentType;
use DigitalVirgo\DirectPay\Model\PaymentPoint;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

class PaymentPointTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreatePaymentPoint()
    {

        $paymentPoint = $this->getPaymentPoint('Description');

        $DOMElement = $paymentPoint->toDomElement();
        $this->assertNodeValue('false', 'CustomPrice', $DOMElement);
        $this->assertNodeValue('Description', 'Description', $DOMElement);
        $this->assertNodeValue('LargeAccount', 'LargeAccount', $DOMElement);
        $this->assertNodeValue('PaymentPointId', 'PaymentPointId', $DOMElement);
        $this->assertNodeValue(PaymentType::RWD, 'PaymentType', $DOMElement);
        $this->assertNodeValue('Prefix', 'Prefix', $DOMElement);
        $this->assertNodeValue('Provider', 'Provider', $DOMElement);
        $this->assertNodeValue('12,30', 'Gross', $DOMElement);
        $this->assertNodeCount(1, 'Price', $DOMElement);

        $paymentPointDef = $this->getPaymentPointDefinition('Description');
        $paymentPointDef['Price'] = $this->getPriceDefinition();
        $paymentPoint = new PaymentPoint($paymentPointDef);
        $DOMElement = $paymentPoint->toDomElement();
        $this->assertNodeCount(1, 'Price', $DOMElement);
    }

    public function testCreatePaymentPointWithBadType()
    {
        $paymentPointDef = $this->getPaymentPointDefinition('Description');
        $paymentPointDef['PaymentType'] = 'fakeType';
        $this->expectException('InvalidArgumentException');
        $paymentPoint = new PaymentPoint($paymentPointDef);
    }
}
