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

use PayBreak\Foundation\AbstractEntity;
use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Risk;
use PayBreak\Foundation\Exception;

/**
 * Abstract Condition
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Condition
 */
abstract class AbstractCondition extends AbstractEntity implements ConditionInterface
{
    protected $properties = [
        'risk' => self::TYPE_FLOAT,
        'value' => Value::class,
    ];

    /**
     * @return Value|null
     */
    public function getValue()
    {
        return parent::getValue();
    }

    /**
     * @param Value $value
     * @return $this
     */
    public function setValue(Value $value)
    {
        return parent::setValue($value);
    }

    /**
     * @return float|null
     */
    public function getRisk()
    {
        return parent::getRisk();
    }

    /**
     * @param float $risk
     * @return $this
     */
    public function setRisk($risk)
    {
        return parent::setRisk(Risk::normalize($risk));
    }


    /**
     * @param \PayBreak\Foundation\Data\Value $value
     * @return bool
     * @throws Exception
     */
    protected function compareType(Value $value)
    {
        if (!($value->getType() & Value::VALUE_EXPECTED)) {

            return false;
        }

        if ($this->getValue() instanceof Value) {

            if ($this->getValue()->getType() === $value->getType()) {

                return true;
            }

            throw new Exception('Values types are different. Unable to compare.');
        }

        throw new Exception('Internal value not set. Could not perform any checks.');
    }

    /**
     * All Available ConditionInterface Types
     *
     * @return array
     */
    public static function availableTypes()
    {
        return [
            self::CONDITION_EQUAL,
            self::CONDITION_NOT_EQUAL,
            self::CONDITION_GREATER_THAN,
            self::CONDITION_LESS_THAN,
            self::CONDITION_GREATER_THAN_OR_EQUAL_TO,
            self::CONDITION_LESS_THAN_OR_EQUAL_TO,
            self::CONDITION_IF_EMPTY,
            self::CONDITION_IF_NOT_EXISTS,
            self::CONDITION_IS_DEFAULT,
        ];
    }

    /**
     * @param int $type
     * @return string
     * @throws Exception
     */
    public static function typeAsString($type)
    {
        $ar = [
            self::CONDITION_EQUAL => 'equal',
            self::CONDITION_NOT_EQUAL => 'not equal',
            self::CONDITION_GREATER_THAN => 'greater than',
            self::CONDITION_LESS_THAN => 'less than',
            self::CONDITION_GREATER_THAN_OR_EQUAL_TO => 'grater than or equal to',
            self::CONDITION_LESS_THAN_OR_EQUAL_TO => 'less than or equal to',
            self::CONDITION_IF_EMPTY => 'is empty',
            self::CONDITION_IF_NOT_EXISTS => 'not exists',
            self::CONDITION_IS_DEFAULT => 'is default value',
        ];

        if (!array_key_exists($type, $ar)) {
            throw new Exception('Invalid condition type [' . $type . ']');
        }

        return $ar[$type];
    }
}
