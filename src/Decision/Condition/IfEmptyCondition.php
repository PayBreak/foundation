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

/**
 * If Empty Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class IfEmptyCondition extends AbstractCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_IF_EMPTY;
    }

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     * @throws \PayBreak\Foundation\Decision\ProcessingException
     */
    public function checkCondition(Value $value)
    {
        if ($value->getType() == Value::VALUE_EMPTY) {

            return true;
        }

        return false;
    }
}
