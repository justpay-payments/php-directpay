<?php

namespace DigitalVirgo\DirectPay\Model;

/**
 * Class AuthorizationRequirements
 *
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
class AuthorizationRequirements extends ModelAbstract
{
    /**
     * @var string
     */
    protected $smsLargeAccount;

    /**
     * @var string
     */
    protected $smsTextMessage;

    /**
     * @return string
     */
    public function getSmsLargeAccount()
    {
        return $this->smsLargeAccount;
    }

    /**
     * @param string $smsLargeAccount
     */
    public function setSmsLargeAccount($smsLargeAccount)
    {
        $this->smsLargeAccount = $smsLargeAccount;
    }

    /**
     * @return string
     */
    public function getSmsTextMessage()
    {
        return $this->smsTextMessage;
    }

    /**
     * @param string $smsTextMessage
     */
    public function setSmsTextMessage($smsTextMessage)
    {
        $this->smsTextMessage = $smsTextMessage;
    }

    /**
     * @inheritDoc
     */
    protected static function getDomMap()
    {
        return [
            'AuthorizationRequirements' => [
                'SmsLargeAccount' => 'smsLargeAccount',
                'SmsTextMessage' => 'smsTextMessage',
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
