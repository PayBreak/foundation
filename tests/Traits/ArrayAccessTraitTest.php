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

use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Traits\ArrayAccessTrait;

/**
 * ArrayAccessTrait Test
 *
 * @author WN
 * @package Tests\Traits
 */
class ArrayAccessTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testOffsetExists()
    {
        $array = new ArrayAccess([1, 2, 3]);

        $this->assertTrue($array->offsetExists(1));
        $this->assertTrue($array->offsetExists(2));
        $this->assertFalse($array->offsetExists(5));
    }

    public function testOffsetGet()
    {
        $array = new ArrayAccess([1 => 'a', 2 => 'b', 3 => 'c']);

        $this->assertSame('a', $array->offsetGet(1));
        $this->assertSame('b', $array[2]);
        $this->assertSame('c', $array[3]);
    }

    public function testOffsetGetNonExisting()
    {
        $array = new ArrayAccess([1 => 'a', 2 => 'b', 3 => 'c']);

        $this->setExpectedException(Exception::class);

        $array->offsetGet(44);
    }

    public function testOffsetSet()
    {
        $array = new ArrayAccess([]);

        $array->offsetSet(0, 'a');
        $array[] = 'b';

        $this->assertSame('a', $array[0]);
        $this->assertSame('b', $array[1]);
    }

    public function testOffsetUnset()
    {
        $array = new ArrayAccess([1, 2, 3]);

        $array->offsetUnset(0);

        $this->assertFalse($array->offsetExists(0));
    }
}

class ArrayAccess implements \ArrayAccess
{
    use ArrayAccessTrait;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
