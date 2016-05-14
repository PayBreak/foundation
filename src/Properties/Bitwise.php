<?php

namespace PayBreak\Foundation\Properties;

use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Exceptions\ValidationException;

/**
 * Bitwise
 *
 * @author WN
 * @package PayBreak\Foundation\Properties
 */
class Bitwise // implements Property
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
     * @return int
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @author WN
     * @param int $value
     * @return int
     */
    public function contains($value)
    {
        return $this->value & $value;
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
     * @author WN
     * @param int $value
     * @return int
     */
    public function remove($value)
    {
        if ($this->contains($value)) {

            return $this->value = $this->value - $value;
        }

        return $this->value;
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

            $rtn[] = $x;

            $value -= $x;
        }

        return array_reverse($rtn); // more scientific would be without reversing
    }
}
