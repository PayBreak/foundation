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
 * If Not Exists Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class IfNotExistsCondition extends AbstractCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_IF_NOT_EXISTS;
    }

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     * @throws \PayBreak\Foundation\Exception
     */
    public function checkCondition(Value $value)
    {
        if ($value->getType() == Value::VALUE_NON_EXISTS) {

            return true;
        }

        return false;
    }
}
