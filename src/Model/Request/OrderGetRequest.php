<?php

namespace DigitalVirgo\DirectPay\Model\Request;

/**
 * Class OrderGetRequest
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class OrderGetRequest extends RequestAbstract
{

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $partnerTransactionId;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return OrderGetRequest
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerTransactionId()
    {
        return $this->partnerTransactionId;
    }

    /**
     * @param string $partnerTransactionId
     *
     * @return OrderGetRequest
     */
    public function setPartnerTransactionId($partnerTransactionId)
    {
        $this->partnerTransactionId = $partnerTransactionId;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        $parentMap = parent::getDomMap()[0];

        return [
            'OrderGetRequest' => array_merge(
                $parentMap,
                [
                    'OrderId' => 'orderId',
                    'PartnerTransactionId' => 'partnerTransactionId',
                ]
            ),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [];
    }
}
