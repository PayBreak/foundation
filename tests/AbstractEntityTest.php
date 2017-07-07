<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests;

use PayBreak\Foundation\AbstractEntity;

/**
 * Abstract Entity Test
 *
 * @author WN
 * @package Tests
 */
class AbstractEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('PayBreak\Foundation\AbstractEntity', $entity);
        $this->assertInstanceOf('PayBreak\Foundation\Contracts\Entity', $entity);
    }

    public function testMake()
    {
        $this->assertInstanceOf('PayBreak\Foundation\AbstractEntity', DummyEntity::make([]));
        $this->assertInstanceOf('PayBreak\Foundation\Contracts\Entity', DummyEntity::make([]));
    }

    public function testToArray()
    {
        $this->assertInternalType('array', DummyEntity::make([])->toArray());
    }

    public function testSetId()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setTestField(2));
    }

    public function testGetId()
    {
        $entity = new DummyEntity();

        $entity->setTestField(2);

        $this->assertSame(2, $entity->getTestField());
    }

    public function testGetNull()
    {
        $entity = new DummyEntity();

        $this->assertNull($entity->getTestField());
    }

    public function testToString()
    {
        $entity = new DummyEntity();

        $this->assertInternalType('string', '' . $entity);
    }

    public function testToStringIsJSON()
    {
        $entity = new DummyEntity();

        $this->assertStringStartsWith('[', '' . $entity);
        $this->assertStringEndsWith(']', '' . $entity);

        $entity->setField('xde');

        $this->assertStringStartsWith('{', '' . $entity);
        $this->assertStringEndsWith('}', '' . $entity);
    }

    public function testToArrayData()
    {
        $entity = DummyEntity::make([
            'test_field' => 2,
            'field'      => DummyEntity::make([]),
            'one'        => [],
        ]);

        $this->assertInternalType('array', $entity->toArray());
        $this->assertArrayHasKey('field', $entity->toArray());
        $this->assertArrayHasKey('test_field', $entity->toArray());
        $this->assertInternalType('array', $entity->toArray(true)['field']);
        $this->assertInternalType('int', $entity->toArray()['test_field']);
    }

    public function testSetNonExistingProperty()
    {
        $this->setExpectedException(
            '\RunTimeException',
            'Call to undefined method PayBreak\Foundation\AbstractEntity::setNonExisting()'
        );

        $entity = new DummyEntity();
        $entity->setNonExisting();
    }

    public function testMissingArgumentOnSet()
    {
        $this->setExpectedException(
            '\RunTimeException',
            'Missing argument on method PayBreak\Foundation\AbstractEntity::set_field() call'
        );

        $entity = new DummyEntity();
        $entity->setField();
    }

    public function testGetNonExistingProperty()
    {
        $this->setExpectedException(
            '\RunTimeException',
            'Call to undefined method PayBreak\Foundation\AbstractEntity::getNonExisting()'
        );

        $entity = new DummyEntity();
        $entity->getNonExisting();
    }

    public function testIntProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setTwo(2));
    }

    public function testInvalidIntProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException',
            'Expected value to be type of [int] type [string] was given'
        );

        $entity->setTwo('str');
    }

    public function testGetIntProperty()
    {
        $entity = new DummyEntity();
        $entity->setTwo(0);

        $this->assertSame(0, $entity->getTwo());
    }

    public function testStringProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setThree('str'));
    }

    public function testGetStringProperty()
    {
        $entity = new DummyEntity();
        $entity->setThree('str');

        $this->assertSame('str', $entity->getThree());
    }

    public function testInvalidStringProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setThree(1);
    }

    public function testBoolProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setFour(true));
    }

    public function testInvalidBoolProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setFour('true');
    }

    public function testGetBoolProperty()
    {
        $entity = new DummyEntity();
        $entity->setFour(true);

        $this->assertSame(true, $entity->getFour());
    }

    public function testFloatProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setFive(5.5));
    }

    public function testInvalidFloatProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setFive('true');
    }

    public function testGetFloatProperty()
    {
        $entity = new DummyEntity();
        $entity->setFive(5.5);

        $this->assertSame(5.5, $entity->getFive());
    }

    public function testNumericProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setSix(5.5));
        $this->assertInstanceOf('Tests\DummyEntity', $entity->setSix(5));
    }

    public function testInvalidNumericProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setSix('true');
    }

    public function testGetNumericProperty()
    {
        $entity = new DummyEntity();
        $entity->setSix(5.0);

        $this->assertSame(5.0, $entity->getSix());

        $entity->setSix(5);

        $this->assertSame(5, $entity->getSix());
    }

    public function testArrayProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setOne([]));
    }

    public function testInvalidArrayProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setOne('str');
    }

    public function testGetArrayProperty()
    {
        $entity = new DummyEntity();
        $entity->setOne([]);

        $this->assertSame([], $entity->getOne());
    }

    public function testSetGetNull()
    {
        $entity = DummyEntity::make([]);

        $this->assertNull($entity->getTwo());

        $entity->setFour(null);

        $this->assertNull($entity->getFour());
    }

    public function testObjectProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setObj($entity));
    }

    public function testInvalidObjectProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('PayBreak\Foundation\Exceptions\InvalidArgumentException');

        $entity->setObj('str');
    }

    public function testNonExistingClassProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('PayBreak\Foundation\Exception');

        $entity->setObjTwo($entity);
    }

    public function testMakeMakableProperty()
    {
        $entity = DummyEntity::make([
            'obj' => [
                'field' => 'xxxxx',
                'one'   => [],
            ]
        ]);

        $this->assertInstanceOf('PayBreak\Foundation\AbstractEntity', $entity->getObj());
    }

    public function testArrayOfObjects()
    {
        $entity = DummyEntity::make([
            'obj_arr' => [
                [
                    'field' => 123,
                ],
                [
                    'field' => 234,
                ]
            ]
        ]);

        $this->assertInternalType('array', $entity->getObjArr());
        $this->assertCount(2, $entity->getObjArr());
        $this->assertInstanceOf(DummyEntity::class, $entity->getObjArr()[0]);
    }

    public function testAdd()
    {
        $entity = new DummyEntity();

        $entity->addObjArr(DummyEntity::make([]));
        $entity->addObjArr(null);

        $this->assertInternalType('array', $entity->getObjArr());
        $this->assertCount(1, $entity->getObjArr());
        $this->assertInstanceOf(DummyEntity::class, $entity->getObjArr()[0]);
    }

    public function testAddWrong()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exceptions\InvalidArgumentException',
            'Expected value to be object of [Tests\DummyEntity] type stdClass] was given'
        );

        $entity->addObjArr(new \stdClass());
    }

    public function testAddOnDifferentType()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'PayBreak\Foundation\Exception',
            'Can not use addProperty on non object array property'
        );

        $entity->addTwo(123);
    }

    public function testInterfaceAcceptance()
    {
        $entity = new DummyInterfaceAcceptor();

        $entity->setInterface(new ExtendingInterface());

        $this->assertInstanceOf(ExtendingInterface::class, $entity->getInterface());
    }

    public function testInterfaceAcceptanceMultiple()
    {
        $entity = new DummyInterfaceAcceptor();

        $entity->addMultipleInterfaces(new ExtendingInterface());
        $entity->addMultipleInterfaces(new ExtendingInterfaceTwo());

        $this->assertInstanceOf(ExtendingInterface::class, $entity->getMultipleInterfaces()[0]);
        $this->assertInstanceOf(ExtendingInterfaceTwo::class, $entity->getMultipleInterfaces()[1]);
    }
}

/**
 * @method $this setOne(array $one)
 * @method array|null getOne()
 * @method $this setTwo(int $two)
 * @method int|null getTwo()
 * @method $this setThree(string $three)
 * @method string|null getThree()
 * @method $this setFour(bool $four)
 * @method bool|null getFour()
 * @method $this setFive(float $five)
 * @method float|null getFive()
 * @method $this setObj(DummyEntity $obj)
 * @method DummyEntity|null getObj()
 * @method $this setArrObj(array $ar)
 * @method $this addObjArr(DummyEntity $obj)
 * @method DummyEntity[]|null getObjArr()
 * @method $this setSix(float|int $five)
 * @method float|int|null getSix()
 */
class DummyEntity extends AbstractEntity
{
    protected $properties = [
        'field',
        'test_field',
        'one' => self::TYPE_ARRAY,
        'two' => self::TYPE_INT,
        'three' => self::TYPE_STRING,
        'four' => self::TYPE_BOOL,
        'five' => self::TYPE_FLOAT,
        'obj' => 'Tests\DummyEntity',
        'obj_two' => 'Tests\DummyEntitySecond',
        'obj_arr' => 'Tests\DummyEntity[]',
        'six' => self::TYPE_NUMERIC,
    ];
}

/**
 * @method $this setInterface(DummyInterface $interface)
 * @method DummyInterface|null getInterface()
 * @method $this setMultipleInterfaces(DummyInterface $interface)
 * @method $this addMultipleInterfaces(DummyInterface $interface)
 * @method DummyInterface[]|null getMultipleInterfaces()
 */
class DummyInterfaceAcceptor extends AbstractEntity
{
    protected $properties = [
        'interface' => 'Tests\DummyInterface',
        'multiple_interfaces' => 'Tests\DummyInterface[]'
    ];
}

interface DummyInterface
{
}

class ExtendingInterface implements DummyInterface
{
}

class ExtendingInterfaceTwo implements DummyInterface
{
}
