<?php

namespace DigitalVirgo\DirectPay\Model;

use InvalidArgumentException;

/**
 * Class PaymentPoints
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class PaymentPoints extends ModelAbstract
{

    /**
     * @var PaymentPoint[]
     */
    protected $paymentPoint;

    /**
     * @return PaymentPoint[]
     */
    public function getPaymentPoint()
    {
        return $this->paymentPoint;
    }

    /**
     * @param PaymentPoint[]|PaymentPoint $paymentPoint
     *
     * @throws InvalidArgumentException
     *
     * @return PaymentPoints
     */
    public function setPaymentPoint($paymentPoint)
    {
        if (!is_array($paymentPoint) || array_key_exists('PaymentPointId', $paymentPoint)) {
            $paymentPoint = [$paymentPoint];
        }

        $paymentPoint = array_map(
            static function ($paymentPointData) {
                if ($paymentPointData instanceof PaymentPoint) {
                    return $paymentPointData;
                }
                if (is_array($paymentPointData)) {
                    return new PaymentPoint($paymentPointData);
                }
                throw new InvalidArgumentException('Invalid PaymentPoint definition. Expected PaymentPoint or array');
            },
            $paymentPoint
        );

        $this->paymentPoint = $paymentPoint;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            'PaymentPoints' => [
                'PaymentPoint' => 'paymentPoint'
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'paymentPoint',
        ];
    }
}
