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
}
