<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Decision;

use PayBreak\Foundation\AbstractEntity;
use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Condition\AbstractCondition;
use PayBreak\Foundation\Decision\Condition\ConditionInterface;

/**
 * RuleAdvice
 *
 * @author WN
 * @method $this setRule(Rule $rule)
 * @method Rule|null getRule()
 * @method $this setValue(Value $value)
 * @method Value|null getValue()
 * @method $this setRisk(float $risk)
 * @method float|null getRisk()
 * @method $this setCondition(ConditionInterface $condition)
 * @method ConditionInterface|null getCondition()
 * @method $this addExceptions(string $exception)
 * @method $this setExceptions(array $exception)
 * @method array getExceptions()
 * @method $this addMeta(string $exception)
 * @method $this setMeta(array $exception)
 * @method array getMeta()
 * @package PayBreak\Foundation\Decision
 */
class RuleAdvice extends AbstractEntity
{
    protected $properties = [
        'rule' => Rule::class,
        'value' => Value::class,
        'risk' => self::TYPE_FLOAT,
        'condition' => AbstractCondition::class,
        'exceptions' => self::TYPE_ARRAY,
        'meta' => self::TYPE_ARRAY,
    ];
}
