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
use PayBreak\Foundation\Decision\Condition\EqualCondition;

/**
 * Class EqualConditionTest
 *
 * @author WN
 * @package Test\Decision\Condition
 */
class EqualConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCondition()
    {
        $entity = new EqualCondition();
        $this->assertSame(ConditionInterface::CONDITION_EQUAL, $entity->getCondition());
    }

    public function testCheckCondition()
    {
        $entity = new EqualCondition();
        $entity->setValue(Value::make(['value' => 2, 'type' => Value::VALUE_INT]));

        $this->assertTrue($entity->checkCondition(Value::make(['value' => 2, 'type' => Value::VALUE_INT])));
    }

    public function testWrongTypeCheckCondition()
    {
        $entity = new EqualCondition();
        $entity->setValue(Value::make(['value' => 2, 'type' => Value::VALUE_INT]));

        $this->setExpectedException('\PayBreak\Foundation\Exception', 'Values types are different. Unable to compare.');

        $entity->checkCondition(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT]));
    }

    public function testMissingValueCheckCondition()
    {
        $entity = new EqualCondition();

        $this->setExpectedException(
            '\PayBreak\Foundation\Exception',
            'Internal value not set. Could not perform any checks.'
        );

        $entity->checkCondition(Value::make(['value' => 2.0, 'type' => Value::VALUE_FLOAT]));
    }
}
