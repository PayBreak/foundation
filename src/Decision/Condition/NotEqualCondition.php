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
 * Not Equal Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class NotEqualCondition extends EqualCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_NOT_EQUAL;
    }

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     */
    public function checkCondition(Value $value)
    {
        return !parent::checkCondition($value);
    }
}
