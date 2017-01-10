<?php

namespace DigitalVirgo\DirectPay\Model;

abstract class ModelAbstract
{
    public function __construct($params = array())
    {
        if (!empty($params)) {
            $this->setData($params);
        }
    }

    public function setData($params)
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

    protected abstract function getDomMap();

    public function toDomElement()
    {
        $map = $this->getDomMap();

        if (count($map) != 1) {
            throw new \Exception('getDomMap must return single element array!');
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

    public function toXml()
    {
        $xml = new \DOMDocument();
        $xml->appendChild($xml->importNode($this->toDomElement(), true));

        return $xml->saveXML();
    }

    public function fromXml($xml)
    {
        if (is_string($xml)) {
            $xml = new \SimpleXMLElement($xml);
        }

        $map = $this->getDomMap();
        $map = reset($map);

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
