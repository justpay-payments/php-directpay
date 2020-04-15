<?php

namespace DigitalVirgo\DirectPay\Model;

use DateTimeInterface;
use DigitalVirgo\DirectPay\Exception\BadResponse;
use DigitalVirgo\DirectPay\Model\Response\ResponseAbstract;
use DOMDocument;
use DOMElement;
use InvalidArgumentException;
use SimpleXMLElement;

/**
 * Abstract class for model providing xml serialization/deserialization
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 * @author Paweł Chuchmała <pawel.chuchmala@digitalvirgo.pl>
 */
abstract class ModelAbstract
{
    public static $ignoreUdefinedProperties = true;

    /**
     * ModelAbstract constructor.
     *
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    final public function __construct($params = array())
    {
        if (!empty($params)) {
            $this->setData($params);
        }
        $this->validateObject();
    }

    /**
     * Set class data using setters methods
     *
     * @param array $params
     */
    public function setData(array $params)
    {
        foreach ($params as $name => $value) {
            $name = lcfirst($name);
            $method = 'set'.ucfirst($name);
            if (method_exists($this, $method)) {
                $this->$method($value);
                continue;
            }
            if (property_exists($this, $name)) {
                $this->$name = $value;
                continue;
            }
            if (!self::$ignoreUdefinedProperties) {
                throw new InvalidArgumentException("Property '$name' not exist in class '".get_class($this)."'");
            }
        }
    }

    /**
     * Return array structure od DOM document
     *
     * @return array
     */
    abstract protected static function getDomMap();

    /**
     * Convert object into DOMElement based on getDomMap method
     *
     * @return DOMElement
     *
     * @throws InvalidArgumentException
     */
    public function toDomElement()
    {
        $map = static::getDomMap();

        if (count($map) !== 1) {
            throw new InvalidArgumentException('getDomMap must return single element array!');
        }

        $dom = new DOMDocument();

        $rootName = array_keys($map)[0];
        $root = $dom->createElement($rootName);

        $rootElements = reset($map);

        foreach ($rootElements as $name => $field) {
            $element = null;
            $getterMethod = 'get'.ucfirst($name);
            $getterIsMethod = 'is'.ucfirst($name);
            if (!(property_exists($this, $field) || method_exists($this, $getterMethod))) {
                throw new InvalidArgumentException("Property '$field', or method '$getterMethod' or '$getterIsMethod' not exist");
            }

            if (method_exists($this, $getterMethod)) {
                $element = $this->$getterMethod();
            } elseif (method_exists($this, $getterIsMethod)) {
                $element = $this->$getterIsMethod();
            } else {
                $element = $this->$field;
            }
            if (null === $element) {
                continue;
            }
            if ($element instanceof self) {
                $root->appendChild($dom->importNode($element->toDomElement(), true));
                continue;
            }
            if ($element instanceof DateTimeInterface) {
                $root->appendChild($dom->createElement($name, $element->format("Y-m-d\TH:i:s.u\Z")));
                continue;
            }
            if (is_bool($element)) {
                $value = 'false';
                if (true === $element) {
                    $value = 'true';
                }
                $root->appendChild($dom->createElement($name, $value));
            }
            if (is_array($element)) {
                foreach ($element as $value) {
                    if ($value instanceof self) {
                        $root->appendChild($dom->importNode($value->toDomElement(), true));
                        continue;
                    }
                }
                continue;
            }
            //should be simple element
            $field = $dom->createElement($name, htmlspecialchars($element));
            $root->appendChild($field);
        }

        return $root;
    }

    /**
     * Convert object info XML string
     *
     * @return string xml
     */
    public function toXml()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;
        $xml->appendChild($xml->importNode($this->toDomElement(), true));

        return $xml->saveXML();
    }

    /**
     * Create object from xml string
     *
     * @param SimpleXMLElement|string $xml
     *
     * @return static
     */
    public static function fromXml($xml)
    {
        if (is_string($xml)) {
            try {
                $xml = new SimpleXMLElement($xml);
            } catch (\Exception $e) {
                throw new BadResponse($e->getMessage(), $e->getCode(), $e);
            }
        }

        $map = static::getDomMap();
        $map = reset($map);

        // cast xml to array
        $asArray = json_decode(json_encode((array) $xml), 1);

        return new static($asArray);
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function validateObject()
    {
        foreach ($this->getRequiredFields() as $field) {
            if (null === $this->$field) {
                throw new InvalidArgumentException("Missing field '$field' in constructor of '".get_class($this)."'");
            }
        }
    }

    /**
     * @return string[]
     */
    abstract protected function getRequiredFields();
}
