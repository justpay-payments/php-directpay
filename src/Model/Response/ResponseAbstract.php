<?php

namespace DigitalVirgo\DirectPay\Model\Response;

use DigitalVirgo\DirectPay\Model\Enum\ErrorType;
use DigitalVirgo\DirectPay\Model\ModelAbstract;

/**
 * Class ResponseAbstract
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
abstract class ResponseAbstract extends ModelAbstract
{

    /**
     * @var string enum
     */
    protected $error;

    /**
     * @var string
     */
    protected $errorDescription;


    public function isError()
    {
        return !empty($this->error);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return ResponseAbstract
     */
    public function setError($error)
    {
        $validTypes = "'".implode("','", ErrorType::getAllOptions())."'";
        if (!in_array($error, ErrorType::getAllOptions(), true)) {
            throw new \InvalidArgumentException("Error type '$error' is not valid. Valid types: [$validTypes]");
        }
        $this->error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * @param string $errorDescription
     *
     * @return ResponseAbstract
     */
    public function setErrorDescription($errorDescription)
    {
        $this->errorDescription = $errorDescription;
        return $this;
    }

    /**
     * @return array xml DOM map
     */
    protected static function getDomMap()
    {
        return [
            [
                'Error' => 'error',
                'ErrorDescription' => 'errorDescription',
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public  function getRequiredFields()
    {
        return [];
    }
}
