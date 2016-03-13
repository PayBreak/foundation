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
 * Less Than Or Equal Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class LessThanOrEqualCondition extends LessThanCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_LESS_THAN_OR_EQUAL_TO;
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
        return (parent::checkCondition($value) || $value->getValue() == $this->getValue()->getValue());
    }
}
