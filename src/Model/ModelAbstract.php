<?php

namespace DigitalVirgo\DirectPay\Model;

/**
 * Class ModelAbstract
 * @package DigitalVirgo\DirectPay\Model
 *
 * @author Adam Jurek <adam.jurek@digitalvirgo.pl>
 *
 * Abstract class for model providing xml serialization/deserialization
 */
abstract class ModelAbstract
{
    /**
     * ModelAbstract constructor.
     * @param array $params
     */
    public function __construct($params = array())
    {
        if (!empty($params)) {
            $this->setData($params);
        }
    }

    /**
     * Set class data using setters methods
     * @param array $params
     */
    public function setData(array $params)
    {
        foreach ($params as $name => $value) {
            $method = 'set' . ucfirst($name);
            if (method_exists($this, $method)) {
                call_user_func(array($this, $method), $value);
            } else if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * Return array structure od DOM document
     * @return array
     */
    protected abstract function _getDomMap();

    /**
     * Convert object into DOMElement based on _getDomMap method
     *
     * @return \DOMElement
     * @throws \Exception
     */
    public function toDomElement()
    {
        $map = $this->_getDomMap();

        if (count($map) != 1) {
            throw new \Exception('_getDomMap must return single element array!');
        }

        $dom = new \DOMDocument();

        $rootName = array_keys($map)[0];
        $root = $dom->createElement($rootName);

        $rootElements = reset($map);

        foreach ($rootElements as $name => $field) {
            $element = null;

            $getterMethod = 'get' . ucfirst($name);

            // get element content
            if (method_exists($this, $getterMethod)) {
                $element = call_user_func([$this, $getterMethod]);
            } else {
                $element = $this->{"_$field"};
            }

            // check is element is set
            if ($element) {

                //should be DomElement
                if ($element instanceof ModelAbstract) {
                    $root->appendChild($dom->importNode($element->toDomElement(), true));

                //should be simple element
                } else {
                    $field = $dom->createElement($name, $element);
                    $root->appendChild($field);
                }
            }
        }

        return $root;
    }

    /**
     * Convert object info XML string
     * @return string xml
     */
    public function toXml()
    {
        $xml = new \DOMDocument();
        $xml->appendChild($xml->importNode($this->toDomElement(), true));

        return $xml->saveXML();
    }

    /**
     * Set object parameters by xml string
     * @param $xml string
     * @return $this
     */
    public function fromXml($xml)
    {
        if (is_string($xml)) {
            $xml = new \SimpleXMLElement($xml);
        }

        $map = $this->_getDomMap();
        $map = reset($map);

        //cast xml to array
        $xml = json_decode(json_encode((array) $xml), 1);

        foreach ($xml as $property => $value) {

            if (!array_key_exists($property, $map)) {
                 continue;
            }

            $setterMethod = 'set' . ucfirst($map[$property]);

            if ($value instanceof \SimpleXMLElement && $value->count() == 0) {
                $value = (string)$value;
            }

            if (method_exists($this, $setterMethod)) {
                call_user_func([$this, $setterMethod], $value);
            } else {
                $this->{"_$property"} = $value;
            }
        }

        return $this;
    }

}
