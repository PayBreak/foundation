<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Test\Decision\Condition;

use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Condition\ConditionInterface;
use PayBreak\Foundation\Decision\Condition\IsDefaultCondition;

/**
 * Is Default Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class IsDefaultConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new IsDefaultCondition();
        $this->assertSame(ConditionInterface::CONDITION_IS_DEFAULT, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new IsDefaultCondition();
        $entity->setValue(Value::make(['value' => Value::DEFAULT_NOT_GIVEN, 'type' => Value::VALUE_DEFAULT]));

        $this->assertTrue(
            $entity->checkCondition(
                Value::make(['value' => Value::DEFAULT_NOT_GIVEN, 'type' => Value::VALUE_DEFAULT])
            )
        );
    }

    /**
     * @author EB
     */
    public function testNoneDefaultTypeException()
    {
        $entity = new IsDefaultCondition();

        $this->setExpectedException(
            'PayBreak\Foundation\Decision\ProcessingException',
            'Internal value not set. Could not perform any checks.'
        );
        $entity->checkCondition(Value::make(['value' => 1, 'type' => Value::VALUE_INT]));
    }

    /**
     * @author EB
     */
    public function testForFalse()
    {
        $entity = new IsDefaultCondition();
        $entity->setValue(Value::make(['value' => Value::DEFAULT_NOT_GIVEN, 'type' => Value::VALUE_DEFAULT]));

        $this->assertFalse(
            $entity->checkCondition(Value::make(['value' => 1, 'type' => Value::VALUE_DEFAULT]))
        );
    }

    /**
     * @author EB
     */
    public function testForValueNotExceptedType()
    {
        $entity = new IsDefaultCondition();
        $entity->setValue(Value::make(['value' => 1, 'type' => Value::VALUE_INT]));

        $this->setExpectedException(
            'PayBreak\Foundation\Decision\ProcessingException',
            'Value is not default type'
        );
        $entity->checkCondition(Value::make(['value' => 1, 'type' => Value::VALUE_INT]));
    }
}
