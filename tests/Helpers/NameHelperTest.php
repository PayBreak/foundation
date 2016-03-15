<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Helpers;

use PayBreak\Foundation\Helpers\NameHelper;

/**
 * Name Helper Test
 *
 * @author WN
 * @package Tests\Helpers
 */
class NameHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testCamelToSnake()
    {
        $this->assertSame('xxx_yyy_www', NameHelper::camelToSnake('XxxYyyWww'));
    }

    public function testSnakeToCamel()
    {
        $this->assertSame('XxxYyyWww', NameHelper::snakeToCamel('xxx_yyy_www'));
        $this->assertSame('XxxYyyWww', NameHelper::snakeToCamel('xxx_yYy_www'));
    }

    public function testSnakeToCamelLow()
    {
        $this->assertSame('xxxYyyWww', NameHelper::snakeToCamel('xxx_yyy_www', true));
    }
}
