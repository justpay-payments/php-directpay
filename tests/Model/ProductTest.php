<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Tests\TestCase;

class ProductTest extends TestCase
{
    public function testCreateProduct()
    {
        $product = $this->getProduct('Product1');
        $DOMElement = $product->toDomElement();
        $this->assertNodeValue('Product1', 'Name', $DOMElement);
        $this->assertNodeCount(4, 'Price', $DOMElement);
        $this->assertNodeCount(3, 'PaymentPoint', $DOMElement);
    }
}
