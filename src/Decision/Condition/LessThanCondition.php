<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Decision\Condition;

use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\ProcessingException;

/**
 * Less Than Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class LessThanCondition extends AbstractCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_LESS_THAN;
    }

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     * @throws ProcessingException
     */
    public function checkCondition(Value $value)
    {
        if ($this->compareType($value) === false) {
            return false;
        }

        if (!in_array($value->getType(), [Value::VALUE_INT, Value::VALUE_FLOAT])) {
            throw new ProcessingException('This condition can be performed only over int and float types.');
        }

        if ($value->getValue() < $this->getValue()->getValue()) {
            return true;
        }

        return false;
    }
}
