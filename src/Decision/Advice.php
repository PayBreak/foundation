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

/**
 * Advice
 *
 * @author WN
 * @method $this setAdviserType(string $adviserType)
 * @method string|null getAdviserType()
 * @method $this setAdviserName(string $adviserName)
 * @method string|null getAdviserName()
 * @method $this setRisk(float $risk)
 * @method float|null getRisk()
 * @method $this setAdvices(array $advices)
 * @method $this addAdvices(RuleAdvice $advices)
 * @method RuleAdvice[] getAdvices()
 * @method $this addExceptions(string $exception)
 * @method $this setExceptions(array $exception)
 * @method array getExceptions()
 * @method $this setMeta(array $meta)
 * @method array getMeta()
 * @package PayBreak\Foundation\Decision
 */
class Advice extends AbstractEntity
{
    protected $properties = [
        'adviser_type' => self::TYPE_STRING,
        'adviser_name' => self::TYPE_STRING,
        'risk' => self::TYPE_FLOAT,
        'advices' => 'PayBreak\Foundation\Decision\RuleAdvice[]',
        'exceptions' => self::TYPE_ARRAY,
        'meta' => self::TYPE_ARRAY,
    ];
}
