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

use PayBreak\Foundation\Decision\Condition\ConditionInterface;
use PayBreak\Foundation\Decision\Condition\IfNotExistsCondition;
use PayBreak\Foundation\Data\Value;

/**
 * If Not Exists Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class IfNotExistsConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new IfNotExistsCondition();
        $this->assertSame(ConditionInterface::CONDITION_IF_NOT_EXISTS, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new IfNotExistsCondition();

        $this->assertTrue($entity->checkCondition(Value::make(['type' => Value::VALUE_NON_EXISTS])));
    }
}
