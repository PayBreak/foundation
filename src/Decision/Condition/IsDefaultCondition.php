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
use PayBreak\Foundation\Exception;

/**
 * Is Default Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
class IsDefaultCondition extends AbstractCondition implements ConditionInterface
{
    /**
     * @author WN
     * @return int
     */
    public function getCondition()
    {
        return self::CONDITION_IS_DEFAULT;
    }

    /**
     * Test Value against Condition
     *
     * @author WN
     * @param Value $value
     * @return bool
     * @throws \PayBreak\Foundation\Exception
     */
    public function checkCondition(Value $value)
    {
        if ($this->getValue() instanceof Value) {

            if ($value->getType() != Value::VALUE_DEFAULT) {

                throw new Exception('Value is not default type');
            }

            if ($value->getValue() == $this->getValue()->getValue()) {

                return true;
            }

            return false;
        }

        throw new Exception('Internal value not set. Could not perform any checks.');
    }
}
