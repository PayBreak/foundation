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
use PayBreak\Foundation\Decision\Condition\NotEqualCondition;

/**
 * Not Equal Condition Test
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class NotEqualConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new NotEqualCondition();
        $this->assertSame(ConditionInterface::CONDITION_NOT_EQUAL, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new NotEqualCondition();
        $entity->setValue(Value::make(['value' => 2, 'type' => Value::VALUE_INT]));

        $this->assertTrue($entity->checkCondition(Value::make(['value' => 1, 'type' => Value::VALUE_INT])));
    }
}
