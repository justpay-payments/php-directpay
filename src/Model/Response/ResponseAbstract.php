<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\ModelAbstract;

/**
 * Class ResponseAbstract
 * @package DigitalVirgo\DirectPay\Model\Response
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 */
abstract class ResponseAbstract extends ModelAbstract
{

    /**
     * @var string enum
     */
    protected $_error;

    /**
     * @var string
     */
    protected $_errorDescription;

    /**
     * @return string
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * @param string $error
     * @return ResponseAbstract
     */
    public function setError($error)
    {
        $this->_error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->_errorDescription;
    }

    /**
     * @param string $errorDescription
     * @return ResponseAbstract
     */
    public function setErrorDescription($errorDescription)
    {
        $this->_errorDescription = $errorDescription;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected function _getDomMap()
    {
        return [
            [
                'Error' => 'error',
                'ErrorDescription' => 'errorDescription',
            ]
        ];
    }

}