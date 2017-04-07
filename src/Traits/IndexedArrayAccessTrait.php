<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Traits;

use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Exceptions\InvalidArgumentException;

/**
 * Array Access Trait
 *
 * @author WN
 */
trait IndexedArrayAccessTrait
{
    use ArrayAccessTrait {
        ArrayAccessTrait::offsetSet as orgOffsetSet;
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @author WN
     * @param mixed $offset
     * @param mixed $value
     * @throws Exception
     */
    public function offsetSet($offset, $value)
    {
        if (!is_integer($offset) && $offset != '') {
            throw new InvalidArgumentException('Offset must be integer type.');
        }

        $this->orgOffsetSet($offset, $value);
    }
}
