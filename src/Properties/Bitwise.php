<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Properties;

use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Exceptions\ValidationException;

/**
 * Bitwise
 *
 * @author WN
 * @package PayBreak\Foundation\Properties
 */
class Bitwise
{
    private $value;

    /**
     * Bitwise constructor
     *
     * @author WN
     * @param int $value
     */
    public function __construct($value = 0)
    {
        $this->value = $value;
    }

    /**
     * @author WN
     * @param int $value
     * @return Bitwise
     */
    public static function make($value = 0)
    {
        return new self($value);
    }

    /**
     * @author WN
     * @param array $data
     * @return Bitwise
     */
    public static function makeFromArray(array $data)
    {
        return self::make(array_sum($data));
    }

    /**
     * @author WN
     * @return int
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @author WN
     * @param int $value
     * @return bool
     */
    public function contains($value)
    {
        return ($this->value & $value) == $value;
    }

    /**
     * @author WN
     * @param int $value
     * @return int
     */
    public function apply($value)
    {
        return $this->value = $this->value | $value;
    }

    /**
     * Remove values from a number
     *
     * @author WN
     * @param int $value
     * @return int
     */
    public function remove($value)
    {
        return $this->value = $this->value & ~$value;
    }

    /**
     * @author WN
     * @param int $value
     * @return bool
     */
    public static function isSimpleBitwise($value)
    {
        if ($value == 0) {
            return true;
        }

        $log = log($value, 2);

        return ($log - round($log)) == 0;
    }

    /**
     * @author WN
     * @param int $value
     * @return int
     * @throws Exception
     */
    public static function validateSimpleBitwise($value)
    {
        if (!self::isSimpleBitwise($value)) {
            throw new ValidationException('Value is not simple bitwise');
        }

        return (int) $value;
    }

    /**
     * @author WN
     * @return array
     */
    public function explode()
    {
        return self::explodeValue($this->value);
    }

    /**
     * @author WN
     * @param int $value
     * @return array
     */
    public static function explodeValue($value)
    {
        $rtn = [];

        while ($value > 0) {
            $x = pow(2, floor(log($value, 2)));

            $rtn[] = (int) $x;

            $value -= $x;
        }

        return array_reverse($rtn); // more scientific would be without reversing
    }
}
