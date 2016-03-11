<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Test\Helpers;

use PayBreak\Foundation\Helpers\NameHelper;

/**
 * Name Helper Test
 *
 * @author WN
 * @package Test\Helpers
 */
class NameHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testCamelToSnake()
    {
        $this->assertSame('xx_ya', NameHelper::camelToSnake('XxYa'));
    }

    public function testSnakeToCamel()
    {
        $this->assertSame('XxYa', NameHelper::snakeToCamel('xx_ya'));
        $this->assertSame('xxYa', NameHelper::snakeToCamel('xx_ya', true));
    }
}
