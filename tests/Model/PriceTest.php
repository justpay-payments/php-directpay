<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\Price;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

class PriceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreatePrice()
    {
        $price = new Price($this->getPriceDefinition());

        $DOMElement = $price->toDomElement();
        $this->assertNodeValue('PLN', 'Currency', $DOMElement);
        $this->assertNodeValue('12,30', 'Gross', $DOMElement);
        $this->assertNodeValue('10,00', 'Net', $DOMElement);
        $this->assertNodeValue('2,30', 'Tax', $DOMElement);
        $this->assertNodeValue('23', 'TaxRate', $DOMElement);
    }
}
