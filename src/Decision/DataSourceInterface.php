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

use PayBreak\Foundation\Contracts\Entity;

/**
 * Data Source Interface
 *
 * @author WN
 * @package PayBreak\Foundation\Decision
 */
interface DataSourceInterface extends Entity
{
    /**
     * @return string
     */
    public function getDataSourceName();
}
