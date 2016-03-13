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
use PayBreak\Foundation\Decision\Condition\GreaterThanCondition;

/**
 * Class GreaterThanConditionTest
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class GreaterThanConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new GreaterThanCondition();
        $this->assertSame(ConditionInterface::CONDITION_GREATER_THAN, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new GreaterThanCondition();
        $entity->setValue(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT]));

        $this->assertTrue($entity->checkCondition(Value::make(['value' => 2.1, 'type' => Value::VALUE_FLOAT])));
    }
}
