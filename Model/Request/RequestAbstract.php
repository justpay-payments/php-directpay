<?php

namespace DigitalVirgo\DirectPay\Model\Request;

use DigitalVirgo\DirectPay\Model\ModelAbstract;

class RequestAbstract extends ModelAbstract
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




}