<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Decision;

use PayBreak\Foundation\Decision\Rule;

/**
 * Rule Test
 *
 * @author WN
 * @package Tests\Decision
 */
class RuleTest extends \PHPUnit_Framework_TestCase
{
    public function testActiveStates()
    {
        $this->assertInternalType('array', Rule::activeStates());
        $this->assertCount(3, Rule::activeStates());
    }
}
