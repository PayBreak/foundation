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

use PayBreak\Foundation\Decision\Risk;

/**
 * Risk Test
 *
 * @author WN
 * @package Tests\Decision
 */
class RiskTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalize()
    {
        $this->assertSame(1.0, Risk::normalize(1.0));
        $this->assertSame(0.0, Risk::normalize(0.0));
        $this->assertSame(1.0, Risk::normalize(3.0));
        $this->assertSame(0.5, Risk::normalize(0.5));
        $this->assertSame(0.78, Risk::normalize(0.78));
    }

    public function testSetRisk()
    {
        $entity = new Risk();

        $this->assertSame(1.0, $entity->setRisk(1.0)->getRisk());
        $this->assertSame(0.0, $entity->setRisk(0.0)->getRisk());
        $this->assertSame(1.0, $entity->setRisk(3.0)->getRisk());
        $this->assertSame(0.5, $entity->setRisk(0.5)->getRisk());
        $this->assertSame(0.78, $entity->setRisk(0.78)->getRisk());
    }

    public function testSetWrongType()
    {
        $entity = new Risk();

        $this->setExpectedException(\InvalidArgumentException::class, 'Risk must be numeric.');

        $entity->setRisk('www');
    }
}
