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

/**
 * Array Access Trait
 *
 * @author WN
 * @package PayBreak\Foundation\Traits
 */
trait ArrayAccessTrait
{
    private $data = [];

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @author WN
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @author WN
     * @param mixed $offset
     * @return mixed
     * @throws Exception
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data[$offset];
        }

        throw new Exception('Offset not found!');
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @author WN
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($offset == '' && !is_numeric($offset)) {
            $offset = count($this->data);
        }
        $this->data[$offset] = $value;
    }

    /**
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @author WN
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}
