<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\PaymentPoints;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

class PaymentPointsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreatePaymentPointsFromObject()
    {
        $paymentPoint1 = $this->getPaymentPoint('pp1');
        $paymentPoint2 = $this->getPaymentPoint('pp2');
        $paymentPoints = new PaymentPoints(
            [
                'PaymentPoint' => [
                    $paymentPoint1,
                    $paymentPoint2,
                ],
            ]
        );

        $DOMElement = $paymentPoints->toDomElement();
        $this->assertNodeCount(2, 'PaymentPoint', $DOMElement);
    }

    public function testCreatePaymentPointsFromArray()
    {
        $paymentPoint1 = $this->getPaymentPointDefinition('pp1');
        $paymentPoint2 = $this->getPaymentPointDefinition('pp2');
        $paymentPoints = new PaymentPoints(
            [
                'PaymentPoint' => [
                    $paymentPoint1,
                    $paymentPoint2,
                ],
            ]
        );

        $DOMElement = $paymentPoints->toDomElement();
        $this->assertNodeCount(2, 'PaymentPoint', $DOMElement);
    }

    public function testCreateWithOnePaymentPoint()
    {
        $paymentPoint1 = $this->getPaymentPointDefinition('pp1');
        $paymentPoints = new PaymentPoints(
            [
                'PaymentPoint' => $paymentPoint1,
            ]
        );

        $DOMElement = $paymentPoints->toDomElement();
        $this->assertNodeCount(1, 'PaymentPoint', $DOMElement);
    }

    public function testCreateWithInvalidPaymentPoint()
    {
        $product = $this->getProduct('product 1');
        $this->expectException('InvalidArgumentException');
        $paymentPoints = new PaymentPoints(
            [
                'PaymentPoint' => $product,
            ]
        );
    }
}
