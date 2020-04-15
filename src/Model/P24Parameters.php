<?php

namespace DigitalVirgo\DirectPay\Model;

/**
 * Class P24Parameters
 *
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class P24Parameters extends ModelAbstract
{
    /**
     * @var string
     */
    protected $crc;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var string
     */
    protected $notifyUrl;

    /**
     * @return string
     */
    public function getCrc()
    {
        return $this->crc;
    }

    /**
     * @param string $crc
     */
    public function setCrc($crc)
    {
        $this->crc = $crc;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @inheritDoc
     */
    protected static function getDomMap()
    {
        return [
            'P24Parameters' => [
                'Crc' => 'crc',
                'Email' => 'email',
                'MerchantId' => 'merchantId',
                'NotifyUrl' => 'notifyUrl',
            ]
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
