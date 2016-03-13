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

use PayBreak\Foundation\Contracts\Entity;
use PayBreak\Foundation\Data\Value;

/**
 * Interface Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
interface ConditionInterface extends Entity
{
    /*
     * Bitwise...
     */
    const CONDITION_NOT = 1;
    const CONDITION_EQUAL = 2;
    const CONDITION_LESS_THAN = 4;
    const CONDITION_GREATER_THAN = 8;

    const CONDITION_NOT_EQUAL = 3;
    const CONDITION_LESS_THAN_OR_EQUAL_TO = 6;
    const CONDITION_GREATER_THAN_OR_EQUAL_TO = 10;

    const CONDITION_IF_EMPTY = 16;
    const CONDITION_IF_NOT_EXISTS = 33;
    const CONDITION_IS_DEFAULT = 64;

    /**
     * @return int
     */
    public function getCondition();

    /**
     * @return Value
     */
    public function getValue();

    /**
     * @param Value $value
     * @return $this
     */
    public function setValue(Value $value);

    /**
     * @return float
     */
    public function getRisk();

    /**
     * @param float $risk
     * @return $this
     */
    public function setRisk($risk);

    /**
     * Test Value against Condition
     *
     * @param Value $value
     * @return bool
     * @throws \PayBreak\Foundation\Decision\ProcessingException
     */
    public function checkCondition(Value $value);

    /**
     * All Available ConditionInterface Types
     *
     * @return array
     */
    public static function availableTypes();
}
