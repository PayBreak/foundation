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

use PayBreak\Foundation\Properties\Range;

/**
 * Range Test
 *
 * @author WN
 * @package Tests\Logger
 */
class RangeTest extends \PHPUnit_Framework_TestCase
{
    public function testSet()
    {
        $obj = Range::make([]);

        $obj->setMax(5);
        $obj->setMin(4);

        $this->assertSame(5, $obj->getMax());
        $this->assertSame(4, $obj->getMin());

        $obj->setMax(5);
        $obj->setMin(6);

        $this->assertSame(6, $obj->getMax());
        $this->assertSame(5, $obj->getMin());
    }
}
