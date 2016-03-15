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
use PayBreak\Foundation\Decision\Condition\IfEmptyCondition;

/**
 * If Empty Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class IfEmptyConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new IfEmptyCondition();
        $this->assertSame(ConditionInterface::CONDITION_IF_EMPTY, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new IfEmptyCondition();

        $this->assertTrue($entity->checkCondition(Value::make(['type' => Value::VALUE_EMPTY])));
    }

    /**
     * @author EB
     */
    public function testForFalse()
    {
        $entity = new IfEmptyCondition();

        $this->assertFalse(
            $entity->checkCondition(Value::make(['value' => 'Test', 'type' => Value::VALUE_STRING]))
        );
    }
}
