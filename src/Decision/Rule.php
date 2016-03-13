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
use PayBreak\Foundation\Decision\Condition\ConditionInterface;

/**
 * Rule
 *
 * @author WN
 *
 * @method $this setSource(string $source)
 * @method string|null getSource()
 * @method $this setField(string $field)
 * @method string|null getField()
 * @method $this setDescription(string $description)
 * @method string|null getDescription()
 * @method $this setActive(int $active)
 * @method int|null getActive()
 * @method $this setType(int $type)
 * @method int|null getType()
 * @method $this setConditions(array $conditions)
 * @method $this addConditions(ConditionInterface $conditions)
 * @method ConditionInterface[]|null getConditions()
 *
 * @package PayBreak\Foundation\Decision
 */
class Rule extends AbstractEntity
{
    const INACTIVE = 0;
    const COLD = 1;
    const ACTIVE = 2;

    protected $properties = [
        'source'        => self::TYPE_STRING,
        'field'         => self::TYPE_STRING,
        'description'   => self::TYPE_STRING,
        'active'        => self::TYPE_INT,
        'type'          => self::TYPE_INT,
        'conditions'    => 'PayBreak\Foundation\Decision\Condition\AbstractCondition[]',
    ];

    /**
     * @author WN
     * @return array
     */
    public static function activeStates()
    {
        return [
            self::INACTIVE,
            self::COLD,
            self::ACTIVE,
        ];
    }
}
