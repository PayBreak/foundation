<?php

namespace Tests\Decision\Condition;

use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Condition\AbstractCondition;
use PayBreak\Foundation\Decision\Condition\ConditionInterface;
use PayBreak\Foundation\Decision\ProcessingException;
use PayBreak\Foundation\Exception;

/**
 * Abstract Condition Test
 *
 * @author WN
 * @package Tests\Decision\Condition
 */
class AbstractConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_EQUAL,
                'value'     => ['value' => 2, 'type' => Value::TYPE_INT],
                'risk'     => 0.6,
            ]
        );

        $this->assertInstanceOf('\PayBreak\Foundation\Decision\Condition\ConditionInterface', $entity);
    }

    public function testValues()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_EQUAL,
                'value'     => Value::make(['value' => 2, 'type' => Value::TYPE_INT]),
                'risk'     => 0.6,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_EQUAL, $entity->getCondition());
        $this->assertSame(2, $entity->getValue()->getValue());
        $this->assertSame(0.6, $entity->getRisk());
    }

    public function testEmptyConditionValidation()
    {
        $this->setExpectedException(Exception::class, 'ConditionInterface component is required.');

        AbstractCondition::make(
            [
                'value'     => ['value' => 2, 'type' => Value::TYPE_INT],
                'risk'     => 0.6,
            ]
        );
    }

    public function testWrongConditionValidation()
    {
        $this->setExpectedException(
            ProcessingException::class,
            'Unavailable condition type.'
        );

        AbstractCondition::make(
            [
                'condition' => 99,
                'value'     => ['value' => 2, 'type' => Value::TYPE_INT],
                'risk'     => 0.6,
            ]
        );
    }

    public function testEmptyScoreValidation()
    {
        $this->setExpectedException(Exception::class, 'Risk component is required.');

        AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_EQUAL,
                'value'     => ['value' => 2, 'type' => Value::TYPE_INT],
            ]
        );
    }

    public function testTypeAsString()
    {
        $this->assertSame('equal', AbstractCondition::typeAsString(ConditionInterface::CONDITION_EQUAL));
    }

    public function testTypeAsStringNonExisting()
    {
        $this->setExpectedException(ProcessingException::class, 'Invalid condition type [-23]');

        AbstractCondition::typeAsString(-23);
    }

    /**
     * @author EB
     */
    public function testConditionNotEqualCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_NOT_EQUAL,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_NOT_EQUAL, $entity->getCondition());
        $this->assertSame(5, $entity->getValue()->getValue());
        $this->assertSame(0.4, $entity->getRisk());
    }

    /**
     * @author EB
     */
    public function testConditionLessThanCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_LESS_THAN,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_LESS_THAN, $entity->getCondition());
    }

    /**
     * @author EB
     */
    public function testConditionLessThanOrEqualToCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_LESS_THAN_OR_EQUAL_TO,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_LESS_THAN_OR_EQUAL_TO, $entity->getCondition());
    }

    /**
     * @author EB
     */
    public function testConditionGreaterThanOrEqualToCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_GREATER_THAN_OR_EQUAL_TO,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_GREATER_THAN_OR_EQUAL_TO, $entity->getCondition());
    }

    /**
     * @author EB
     */
    public function testConditionIfEmptyCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_IF_EMPTY,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_IF_EMPTY, $entity->getCondition());
    }

    /**
     * @author EB
     */
    public function testConditionIfNotExistsCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_IF_NOT_EXISTS,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_IF_NOT_EXISTS, $entity->getCondition());
    }

    /**
     * @author EB
     */
    public function testConditionIsDefaultCondition()
    {
        $entity = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_IS_DEFAULT,
                'value'     => Value::make(['value' => 5, 'type' => Value::TYPE_INT]),
                'risk'     => 0.4,
            ]
        );

        $this->assertSame(ConditionInterface::CONDITION_IS_DEFAULT, $entity->getCondition());
    }
}
