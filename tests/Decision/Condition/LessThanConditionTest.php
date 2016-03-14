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
use PayBreak\Foundation\Decision\Condition\LessThanCondition;

/**
 * Less Than Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class LessThanConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new LessThanCondition();
        $this->assertSame(ConditionInterface::CONDITION_LESS_THAN, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new LessThanCondition();
        $entity->setValue(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT]));

        $this->assertTrue($entity->checkCondition(Value::make(['value' => 1.9, 'type' => Value::VALUE_FLOAT])));
    }

    /**
     * @author EB
     */
    public function testForProcessingException()
    {
        $entity = new LessThanCondition();
        $entity->setValue(Value::make(['value' => 'Test', 'type' => Value::VALUE_STRING]));

        $this->setExpectedException(
            'PayBreak\Foundation\Decision\ProcessingException',
            'This condition can be performed only over int and float types.'
        );
        $entity->checkCondition(Value::make(['value' => 'Test', 'type' => Value::VALUE_STRING]));
    }

    /**
     * @author EB
     */
    public function testValuesAreDifferentException()
    {
        $entity = new LessThanCondition();
        $entity->setValue(Value::make(['value' => 'Test', 'type' => Value::VALUE_STRING]));

        $this->setExpectedException(
            'PayBreak\Foundation\Decision\ProcessingException',
            'Values types are different. Unable to compare.'
        );
        $entity->checkCondition(Value::make(['value' => 1, 'type' => Value::VALUE_INT]));
    }
}
