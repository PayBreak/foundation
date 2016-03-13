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
use PayBreak\Foundation\Decision\ProcessingException;
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
        return $this->__call('getValue', []);
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
        return $this->__call('getRisk', []);
    }

    /**
     * @param float $risk
     * @return $this
     */
    public function setRisk($risk)
    {
        return $this->__call('setRisk', [Risk::normalize($risk)]);
    }

    /**
     * @param bool $recursively
     * @return array
     */
    public function toArray($recursively = false)
    {
        $ar = parent::toArray(true);

        $ar['condition'] = $this->getCondition();

        return $ar;
    }

    /**
     * @param array $components
     * @return ConditionInterface
     * @throws Exception
     */
    public static function make(array $components)
    {
        if (!array_key_exists('condition', $components)) {

            throw new Exception('ConditionInterface component is required.');
        }

        $entity = self::initializeCondition($components['condition']);

        if (!array_key_exists('risk', $components)) {

            throw new Exception('Risk component is required.');
        }

        $entity->setRisk($components['risk']);

        if (array_key_exists('value', $components)) {

            if (is_array($components['value'])) {
                $components['value'] = Value::make($components['value']);
            }

            $entity->setValue($components['value']);
        }

        return $entity;
    }

    /**
     * @param $condition
     * @return ConditionInterface
     * @throws ProcessingException
     */
    private static function initializeCondition($condition)
    {
        if (!in_array($condition, AbstractCondition::availableTypes())) {

            throw new ProcessingException('Unavailable condition type.');
        }

        switch ($condition) {
            case ConditionInterface::CONDITION_EQUAL:
                return new EqualCondition();
            case ConditionInterface::CONDITION_NOT_EQUAL:
                return new NotEqualCondition();
            case ConditionInterface::CONDITION_LESS_THAN:
                return new LessThanCondition();
            case ConditionInterface::CONDITION_GREATER_THAN:
                return new GreaterThanCondition();
            case ConditionInterface::CONDITION_LESS_THAN_OR_EQUAL_TO:
                return new LessThanOrEqualCondition();
            case ConditionInterface::CONDITION_GREATER_THAN_OR_EQUAL_TO:
                return new GreaterThanOrEqualCondition();
            case ConditionInterface::CONDITION_IF_EMPTY:
                return new IfEmptyCondition();
            case ConditionInterface::CONDITION_IF_NOT_EXISTS:
                return new IfNotExistsCondition();
            case ConditionInterface::CONDITION_IS_DEFAULT:
                return new IsDefaultCondition();
        }

        throw new ProcessingException('Unsupported condition type.');
    }

    /**
     * @param \PayBreak\Foundation\Data\Value $value
     * @return bool
     * @throws ProcessingException
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

            throw new ProcessingException('Values types are different. Unable to compare.');
        }

        throw new ProcessingException('Internal value not set. Could not perform any checks.');
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
     * @throws ProcessingException
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
            throw new ProcessingException('Invalid condition type [' . $type . ']');
        }

        return $ar[$type];
    }
}
