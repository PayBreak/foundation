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

use PayBreak\Foundation\Traits\IteratorTrait;

/**
 * IteratorTrait Test
 *
 * @author WN
 * @package Tests\Traits
 */
class IteratorTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testCurrent()
    {
        $iterator = new Iterator([1, 2, 3]);

        $this->assertSame(1, $iterator->current());

        $iterator->next();

        $this->assertSame(2, $iterator->current());

        $iterator->rewind();

        $this->assertSame(1, $iterator->current());
    }

    public function testKey()
    {
        $iterator = new Iterator([1, 2, 3]);

        $this->assertSame(0, $iterator->key());

        $iterator->next();

        $this->assertSame(1, $iterator->key());

        $iterator->rewind();

        $this->assertSame(0, $iterator->key());
    }

    public function testValid()
    {
        $iterator = new Iterator([1, 2, 3]);

        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }
}

class Iterator implements \Iterator
{
    use IteratorTrait;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
