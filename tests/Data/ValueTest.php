<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Value;

use PayBreak\Foundation\Data\Value;

/**
 * Value Test
 *
 * @author WN
 * @package Tests\Value
 */
class ValueTest extends \PHPUnit_Framework_TestCase
{
    public function testAvailableTypes()
    {
        $this->assertInternalType('array', Value::availableTypes());
        $this->assertCount(8, Value::availableTypes());
    }

    public function testAvailableDefaultTypes()
    {
        $this->assertInternalType('array', Value::availableDefaultValues());
        $this->assertCount(6, Value::availableDefaultValues());
    }
}
