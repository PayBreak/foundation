<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Traits;

use PayBreak\Foundation\Exceptions\InvalidArgumentException;
use PayBreak\Foundation\Traits\ArrayAccessTrait;

/**
 * ArrayAccessTrait Test
 *
 * @author WN
 */
class IndexedArrayAccessTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testOffsetSet()
    {
        $array = new IndexedArrayAccess([]);

        $array->offsetSet(0, 'a');
        $array[] = 'b';

        $this->assertSame('a', $array[0]);
        $this->assertSame('b', $array[1]);
    }

    public function testOffsetSetString()
    {
        $array = new IndexedArrayAccess([]);

        $this->setExpectedException(InvalidArgumentException::class);

        $array['aa'] = 'b';
    }
}

class IndexedArrayAccess implements \ArrayAccess
{
    use ArrayAccessTrait;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function offsetValidate($offset)
    {
        if (!is_integer($offset) && $offset != '') {
            throw new InvalidArgumentException('Offset must be integer type.');
        }
    }

    protected function valueValidate($value)
    {
        return true;
    }
}
