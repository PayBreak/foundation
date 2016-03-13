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
 * Class GreaterThanOrEqualCondition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class GreaterThanOrEqualCondition extends GreaterThanCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_GREATER_THAN_OR_EQUAL_TO;
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
        return (parent::checkCondition($value) || $value->getValue() == $this->getValue()->getValue());
    }
}
