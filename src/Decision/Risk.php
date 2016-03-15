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
 * Risk
 *
 * @author WN
 * @method float|null getRisk()
 * @method $this setMeta(array $meta)
 * @method array getMeta()
 * @method $this setAdviserName(string $adviserName)
 * @method string|null getAdviserName()
 * @method $this setAdviserCode(string $adviserCode)
 * @method string|null getAdviserCode()
 * @package PayBreak\Foundation\Decision
 */
class Risk extends AbstractEntity
{
    const MAXIMUM_RISK = 1.0;
    const UNDERWRITER_RISK = 0.5;
    const MINIMUM_RISK = 0.0;

    protected $properties = [
        'risk' => self::TYPE_FLOAT,
        'meta' => self::TYPE_ARRAY,
        'adviser_name' => self::TYPE_STRING,
        'adviser_code' => self::TYPE_STRING,
    ];

    /**
     * Set Risk
     *
     * @author WN
     * @param float $risk <0,1>
     * @return $this
     */
    public function setRisk($risk)
    {
        if (!is_numeric($risk)) {

            throw new \InvalidArgumentException('Risk must be numeric.');
        }

        $this->__call('setRisk', [self::normalize($risk)]);
        return $this;
    }

    /**
     * Normalize Risk - make sure that risk will be in bound
     *
     * @author WN
     * @param $risk
     * @return float <0,1>
     */
    public static function normalize($risk)
    {
        return (float) max(min($risk, self::MAXIMUM_RISK), self::MINIMUM_RISK);
    }
}
