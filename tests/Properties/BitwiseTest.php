<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Logger;

use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Properties\Bitwise;

/**
 * Bitwise Test
 *
 * @author WN
 * @package Tests\Logger
 */
class BitwiseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(Bitwise::class, new Bitwise());
        $this->assertInstanceOf(Bitwise::class, new Bitwise(2));
    }

    public function testMake()
    {
        $this->assertInstanceOf(Bitwise::class, Bitwise::make());
        $this->assertInstanceOf(Bitwise::class, Bitwise::make(2));
        $this->assertInstanceOf(Bitwise::class, Bitwise::make(64));
        $this->assertInstanceOf(Bitwise::class, Bitwise::make(13));
    }

    public function testGet()
    {
        $property = new Bitwise();
        $this->assertSame(0, $property->get());

        $property = new Bitwise(8);
        $this->assertSame(8, $property->get());

        $property = new Bitwise(13);
        $this->assertSame(13, $property->get());
    }

    public function testContains()
    {
        $property = new Bitwise(8);
        $this->assertTrue($property->contains(8));

        $property = new Bitwise(13);
        $this->assertTrue($property->contains(8));
        $this->assertTrue($property->contains(4));
        $this->assertTrue($property->contains(1));
        $this->assertTrue($property->contains(5));
    }

    public function testNotContains()
    {
        $property = new Bitwise(8);
        $this->assertFalse($property->contains(2));

        $property = new Bitwise(13);
        $this->assertFalse($property->contains(3));
    }

    public function testApply()
    {
        $property = new Bitwise(8);
        $this->assertSame(9, $property->apply(1));
        $this->assertSame(9, $property->apply(1));

        $property = new Bitwise();
        $this->assertSame(1, $property->apply(1));
        $this->assertSame(23, $property->apply(22));
        $this->assertSame(23, $property->apply(16));
    }

    public function testRemove()
    {
        $property = new Bitwise(13);
        $this->assertSame(9, $property->remove(4));
        $this->assertSame(9, $property->remove(4));
        $this->assertSame(9, $property->remove(2));
        $this->assertSame(8, $property->remove(1));

        $property = Bitwise::make(10);
        $this->assertSame(10, $property->remove(4));
        $this->assertSame(2, $property->remove(12));
        $this->assertSame(0, $property->remove(2));
    }

    public function testIsSimpleBitwise()
    {
        $this->assertTrue(Bitwise::isSimpleBitwise(2));
        $this->assertTrue(Bitwise::isSimpleBitwise(4));
        $this->assertFalse(Bitwise::isSimpleBitwise(5));
        $this->assertFalse(Bitwise::isSimpleBitwise(9));
        $this->assertTrue(Bitwise::isSimpleBitwise(0));
    }

    public function testValidateSimpleBitwise()
    {
        $this->assertSame(8, Bitwise::validateSimpleBitwise(8));

        $this->setExpectedException(Exception::class);
        Bitwise::validateSimpleBitwise(9);
    }

    public function testExplode()
    {
        $property = new Bitwise(13);
        $this->assertSame([1, 4, 8], $property->explode());

        $property = new Bitwise(32);
        $this->assertSame([32], $property->explode());
    }

    public function testExplodeValue()
    {
        $this->assertSame([1, 4, 8], Bitwise::explodeValue(13));

        $this->assertSame([32], Bitwise::explodeValue(32));
    }
}
