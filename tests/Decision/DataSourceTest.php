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

use PayBreak\Foundation\Decision\DataSourceInterface;
use PayBreak\Foundation\Decision\DataSources;

/**
 * Data Source Test
 *
 * @author WN
 * @package Tests\Decision
 */
class DataSourceTest extends \PHPUnit_Framework_TestCase
{
    public function testAddDataSource()
    {
        $mock = $this->getMock(DataSourceInterface::class);

        $mock->method('getDataSourceName')->willReturn('xxx');

        $entity = new DataSources();

        $this->assertInstanceOf(DataSources::class, $entity->addDataSource($mock));
    }

    public function testGetDataSource()
    {
        $mock = $this->getMock(DataSourceInterface::class);

        $mock->method('getDataSourceName')->willReturn('xxx');

        $entity = new DataSources();

        $entity->addDataSource($mock);

        $this->assertInstanceOf(DataSourceInterface::class, $entity->getDataSource('xxx'));
    }

    public function testGetDataSourceFail()
    {
        $mock = $this->getMock(DataSourceInterface::class);

        $mock->method('getDataSourceName')->willReturn('xxx');

        $entity = new DataSources();

        $entity->addDataSource($mock);

        $this->setExpectedException('PayBreak\Foundation\Decision\ProcessingException', 'Missing data source [yy]');

        $entity->getDataSource('yy');
    }
}
