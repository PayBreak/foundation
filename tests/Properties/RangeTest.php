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
use PayBreak\Foundation\Exceptions\InvalidArgumentException;
use PayBreak\Foundation\Properties\Range;

/**
 * Range Test
 *
 * @author WN
 */
class RangeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetRange()
    {
        $obj = Range::make([]);

        $obj->setMax(5);
        $obj->setMin(4);

        $this->assertSame(5, $obj->getMax());
        $this->assertSame(4, $obj->getMin());
    }

    public function testSetWrongRange()
    {
        $obj = Range::make([]);

        $obj->setMax(7);

        $this->setExpectedException(InvalidArgumentException::class, 'Invalid range values');
        $obj->setMin(10);
    }

    public function testIntersect()
    {
        $obj1 = Range::make([]);
        $obj2 = Range::make([]);

        $obj1->setMax(7);
        $obj1->setMin(4);

        $obj2->setMax(6);
        $obj2->setMin(1);

        $obj1->intersect($obj2);

        $this->assertSame(6, $obj1->getMax());
        $this->assertSame(4, $obj1->getMin());
    }

    public function testIntersectWrong()
    {
        $obj1 = Range::make([]);
        $obj2 = Range::make([]);

        $obj1->setMax(7);
        $obj1->setMin(4);

        $obj2->setMax(3);
        $obj2->setMin(1);

        $this->setExpectedException(Exception::class, 'Cannot find a common part of ranges');

        $obj1->intersect($obj2);
    }
}
