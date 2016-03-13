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
 * Equal Condition
 *
 * @author WN
 * @method $this setValue(Value $value)
 * @method Value|null getValue()
 * @method $this setRisk($risk)
 * @method float|null getRisk()
 * @package PayBreak\Foundation\Decision\Condition
 */
class EqualCondition extends AbstractCondition implements ConditionInterface
{
    /**
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_EQUAL;
    }

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     */
    public function checkCondition(Value $value)
    {
        if ($this->compareType($value) && $value->getValue() == $this->getValue()->getValue()) {

            return true;
        }

        return false;
    }
}
