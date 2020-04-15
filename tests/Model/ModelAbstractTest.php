<?php

namespace DigitalVirgo\DirectPay\Tests\Model;

use DigitalVirgo\DirectPay\Model\ModelAbstract;
use DigitalVirgo\DirectPay\Tests\TestCase;
use Exception;

/**
 * Class ModelAbstractTest
 *
 * @todo nested object from xml
 */
class ModelAbstractTest extends TestCase
{
    public function testCreateBasicObject()
    {
        $obj = new TestObject(
            [
                'name' => 'name',
            ]
        );
        $xml = $obj->toXml();
        $this->assertContains('<Name>name</Name>', $xml);
        $DOMElement = $obj->toDomElement();
        $this->assertNodeCount(1, 'Name', $DOMElement);
        $this->assertNodeValue('name', 'Name', $DOMElement);
    }

    /**
     * @throws Exception
     */
    public function testCreateWithSetter()
    {
        $obj = new TestObject(
            [
                'name' => 'name',
                'fieldWithSetter' => 'testValue'
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('testValue', 'FieldWithSetter', $DOMElement);
        $obj = new TestObject(
            [
                'name' => 'second name',
                'FieldWithSetter' => 'testSecondValue'
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('testSecondValue', 'FieldWithSetter', $DOMElement);
    }

    public function testCreateWithoutSetter()
    {
        $obj = new TestObject(
            [
                'name' => 'name',
                'fieldWithGetter' => 'testValue'
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('testValue', 'FieldWithGetter', $DOMElement);
        $obj = new TestObject(
            [
                'name' => 'second name',
                'fieldWithGetter' => 'testSecondValue'
            ]
        );
        $DOMElement = $obj->toDomElement();
        $this->assertNodeValue('testSecondValue', 'FieldWithGetter', $DOMElement);
    }

    public function testCreateWithoutValidProperty()
    {
        $obj = new TestObject(
            [
                'name' => 'name',
                'fakeProperty' => 'value'
            ]
        );
        $this->assertInstanceOf(TestObject::class, $obj);
        ModelAbstract::$ignoreUdefinedProperties = false;
        $this->expectException('InvalidArgumentException');
        $obj = new TestObject(
            [
                'name' => 'name',
                'fakeProperty' => 'value'
            ]
        );
    }

    public function testThrowExceptionWhenRequiredFieldisMissing()
    {
        $this->expectException('InvalidArgumentException');
        $obj = new TestObject();
    }

    public function testThrowExceptionWhenEmptyGetDomMap()
    {
        $this->expectException('InvalidArgumentException');
        $obj = new TestObjectWithEmptyGetDomMap(
            [
                'first' => 'first',

            ]
        );
        $obj->toDomElement();
    }

    public function testThrowExceptionWhenBadGetDomMap()
    {
        $this->expectException('InvalidArgumentException');
        $obj = new TestObjectWithBadGetDomMap(
            [
                'first' => 'first',

            ]
        );
        $obj->toDomElement();
    }

    public function testThrowExceptionWhenInvalidPropertyInGetDomMap()
    {
        $this->expectException('InvalidArgumentException');
        $obj = new TestObjectWithInvalidPropertyInGetDomMap(
            [
                'first' => 'first',
            ]
        );
        $obj->toDomElement();
    }

    public function testThrowExceptionWhenPropertyNotExist()
    {
        ModelAbstract::$ignoreUdefinedProperties = false;
        $this->expectException('InvalidArgumentException');
        $obj = new TestObject(
            [
                'FakeProperty' => 'value',
            ]
        );
    }


    public function testCreateFromXml()
    {
        /** @var TestObject $object */
        $object = TestObject::fromXml($this->getTestObjectXml());
        $this->assertEquals('FieldWithGetterValue', $object->getFieldWithGetter());
        $this->assertEquals('FieldWithGetterSetterValue', $object->getFieldWithGetterSetter());
    }


    protected function getTestObjectXml()
    {
        return <<<xml
<TestObject>
    <Name>NameValue</Name>
    <FieldWithSetter>FieldWithSetterValue</FieldWithSetter>
    <FieldWithGetter>FieldWithGetterValue</FieldWithGetter>
    <FieldWithGetterSetter>FieldWithGetterSetterValue</FieldWithGetterSetter>
</TestObject>
xml;
    }
}


class TestObject extends ModelAbstract
{
    protected $name;

    protected $fieldWithSetter;

    protected $fieldWithGetter;

    protected $fieldWithGetterSetter;

    /**
     * @param mixed $fieldWithSetter
     */
    public function setFieldWithSetter($fieldWithSetter)
    {
        $this->fieldWithSetter = $fieldWithSetter;
    }

    /**
     * @return mixed
     */
    public function getFieldWithGetter()
    {
        return $this->fieldWithGetter;
    }

    /**
     * @return mixed
     */
    public function getFieldWithGetterSetter()
    {
        return $this->fieldWithGetterSetter;
    }

    /**
     * @param mixed $fieldWithGetterSetter
     */
    public function setFieldWithGetterSetter($fieldWithGetterSetter)
    {
        $this->fieldWithGetterSetter = $fieldWithGetterSetter;
    }

    /**
     * @inheritDoc
     */
    public static function getDomMap()
    {
        return [
            'TestObject' => [
                'Name' => 'name',
                'FieldWithSetter' => 'fieldWithSetter',
                'FieldWithGetter' => 'fieldWithGetter',
                'FieldWithGetterSetter' => 'fieldWithGetterSetter',
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [
            'name',
        ];
    }
}

class TestObjectWithEmptyGetDomMap extends ModelAbstract
{
    /**
     * @inheritDoc
     */
    public static function getDomMap()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredFields()
    {
        return [];
    }
}

class TestObjectWithBadGetDomMap extends ModelAbstract
{
    protected $first;

    protected $second;
    /**
     * @inheritDoc
     */
    public static function getDomMap()
    {
        return [
            'First' => 'first',
            'Second' => 'second',
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

class TestObjectWithInvalidPropertyInGetDomMap extends ModelAbstract
{
    protected $first;

    /**
     * @inheritDoc
     */
    public static function getDomMap()
    {
        return [
            'Object' => [
                'First' => 'first',
                'Second' => 'second',
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
