<?php

namespace DigitalVirgo\DirectPay\Tests\Model\Request;

use DigitalVirgo\DirectPay\Model\Enum\PaymentType;
use DigitalVirgo\DirectPay\Model\Product;
use DigitalVirgo\DirectPay\Model\Request\PaymentPointInfoRequest;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

class PaymentPointInfoRequestTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreatePaymentPointInfoRequest()
    {
        $request = new PaymentPointInfoRequest(
            [
                'Login'       => 'Login',
                'Password'    => 'Password',
                'PaymentType' => PaymentType::RWD,
                'Product'     => new Product($this->getProductDefinition('Product1')),
                'Provider'    => 'Provider',
            ]
        );
        $DOMElement = $request->toDomElement();
        $this->assertNodeValue('Login', 'Login', $DOMElement);
        $this->assertNodeValue(PaymentType::RWD, 'PaymentType', $DOMElement);
        $this->assertNodeValue('Provider', 'Provider', $DOMElement);
        $this->assertNodeCount(1, 'Product', $DOMElement);
        $request = new PaymentPointInfoRequest(
            [
                'Login'       => 'Login',
                'Password'    => 'Password',
                'PaymentType' => PaymentType::RWD,
                'Product'     => $this->getProductDefinition('Product1'),
                'Provider'    => 'Provider',
            ]
        );
        $this->assertNodeCount(1, 'Product', $DOMElement);
    }
}
