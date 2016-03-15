<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Decision;

/**
 * Data Sources
 *
 * @author WN
 * @package PayBreak\Foundation\Decision
 */
class DataSources
{
    private $data = [];

    /**
     * @param DataSourceInterface $dataSource
     * @return $this
     */
    public function addDataSource(DataSourceInterface $dataSource)
    {
        $this->data[$dataSource->getDataSourceName()] = $dataSource;
        return $this;
    }

    /**
     * @param string $name
     * @return DataSourceInterface
     * @throws ProcessingException
     */
    public function getDataSource($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw new ProcessingException('Missing data source [' . $name . ']');
    }
}
