<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\Product;

/**
 * Class PaymentPointInfoResponse
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class PaymentPointInfoResponse extends ResponseAbstract
{

    /**
     * @var Product
     */
    protected $product;

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return PaymentPointInfoResponse
     */
    public function setProduct($product)
    {
        if (is_array($product)) {
            $product = new Product($product);
        }

        $this->product = $product;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = ResponseAbstract::getDomMap()[0];

        return [
            'PaymentPointInfoResponse' => array_merge(
                $parentMap,
                [
                    'Product'      => 'product',
                ]
            ),
        ];
    }

}
