<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Data;

use PayBreak\Foundation\AbstractEntity;

/**
 * Class Value
 *
 * @author WN
 * @method $this setValue(mixed $value)
 * @method mixed getValue()
 * @method $this setType(int $type)
 * @method int|null getType()
 * @package PayBreak\Foundation\Data
 */
class Value extends AbstractEntity
{
    const VALUE_EXPECTED = 1;
    const VALUE_BOOL = 3;
    const VALUE_INT = 5;
    const VALUE_STRING = 9;
    const VALUE_FLOAT = 133;
    const VALUE_ARRAY = 257;

    const VALUE_NON_EXISTS = 16;
    const VALUE_EMPTY = 32;
    const VALUE_DEFAULT = 64;

    const DEFAULT_NULL = 1;
    const DEFAULT_OUT_OF_BOUNDS = 2;
    const DEFAULT_NOT_DERIVABLE = 4;
    const DEFAULT_NOT_GIVEN = 8;
    const DEFAULT_NOT_ASKED = 16;
    const DEFAULT_NOT_PERMITTED = 32;

    protected $properties = [
        'value',
        'type' => self::TYPE_INT,
    ];

    /**
     * Get Available Value Types
     *
     * @author WN
     * @return array
     */
    public static function availableTypes()
    {
        return [
            self::VALUE_INT,
            self::VALUE_STRING,
            self::VALUE_BOOL,
            self::VALUE_FLOAT,
            self::VALUE_DEFAULT,
            self::VALUE_NON_EXISTS,
            self::VALUE_EMPTY,
            self::VALUE_ARRAY,
        ];
    }

    /**
     * Get Available Default Values
     *
     * @author WN
     * @return array
     */
    public static function availableDefaultValues()
    {
        return [
            self::DEFAULT_NULL,
            self::DEFAULT_OUT_OF_BOUNDS,
            self::DEFAULT_NOT_DERIVABLE,
            self::DEFAULT_NOT_GIVEN,
            self::DEFAULT_NOT_ASKED,
            self::DEFAULT_NOT_PERMITTED,
        ];
    }
}
