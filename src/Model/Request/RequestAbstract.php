<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\ModelAbstract;

/**
 * Class RequestAbstract
 * @package DigitalVirgo\DirectPay\Model\Request
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
abstract class RequestAbstract extends ModelAbstract
{
    /**
     * Contain authorization login
     * @var string
     */
    protected $_login;

    /**
     * Contain authorization password
     * @var string
     */
    protected $_password;

    /**
     * Contain authorization token
     * @var string
     */
    protected $_partnerToken;

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param string $login
     * @return RequestAbstract
     */
    public function setLogin($login)
    {
        $this->_login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     * @return RequestAbstract
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerToken()
    {
        return $this->_partnerToken;
    }

    /**
     * @param string $partnerToken
     * @return RequestAbstract
     */
    public function setPartnerToken($partnerToken)
    {
        $this->_partnerToken = $partnerToken;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
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
