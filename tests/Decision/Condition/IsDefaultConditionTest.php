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
}
