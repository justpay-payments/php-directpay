<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\ModelAbstract;

/**
 * Class RequestAbstract
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
abstract class RequestAbstract extends ModelAbstract
{

    /**
     * Contain authorization login
     *
     * @var string
     */
    protected $login;

    /**
     * Contain authorization password
     *
     * @var string
     */
    protected $password;

    /**
     * Contain authorization token
     *
     * @var string
     */
    protected $partnerToken;

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return RequestAbstract
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return RequestAbstract
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerToken()
    {
        return $this->partnerToken;
    }

    /**
     * @param string $partnerToken
     *
     * @return RequestAbstract
     */
    public function setPartnerToken($partnerToken)
    {
        $this->partnerToken = $partnerToken;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            [
                'Login'        => 'login',
                'Password'     => 'password',
                'PartnerToken' => 'partnerToken',
            ]
        ];
    }
}
