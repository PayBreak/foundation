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
use PayBreak\Foundation\Decision\Condition\LessThanOrEqualCondition;

/**
 * Less Than Or Equal Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class LessThanOrEqualConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new LessThanOrEqualCondition();
        $this->assertSame(ConditionInterface::CONDITION_LESS_THAN_OR_EQUAL_TO, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new LessThanOrEqualCondition();
        $entity->setValue(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT]));

        $this->assertTrue($entity->checkCondition(Value::make(['value' => 1.9, 'type' => Value::VALUE_FLOAT])));
        $this->assertTrue($entity->checkCondition(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT])));
    }
}
