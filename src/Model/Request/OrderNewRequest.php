<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\Order;

/**
 * Class OrderNewRequest
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderNewRequest extends RequestAbstract
{
    /**
     * @var string
     */
    protected $clientUID;

    /**
     * @var string
     */
    protected $customerToken;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order|array $order
     *
     * @return OrderNewRequest
     */
    public function setOrder($order)
    {
        if (is_array($order)) {
            $order = new Order($order);
        }

        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientUID()
    {
        return $this->clientUID;
    }

    /**
     * @param string $clientUID
     */
    public function setClientUID($clientUID)
    {
        $this->clientUID = $clientUID;
    }

    /**
     * @return string
     */
    public function getCustomerToken()
    {
        return $this->customerToken;
    }

    /**
     * @param string $customerToken
     */
    public function setCustomerToken($customerToken)
    {
        $this->customerToken = $customerToken;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = parent::getDomMap()[0];

        return [
            'OrderNewRequest' => array_merge(
                $parentMap,
                [
                    'ClientUID' => 'clientUID',
                    'CustomerToken' => 'customerToken',
                    'Order' => 'order'
                ]
            ),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'order',
        ];
    }
}
