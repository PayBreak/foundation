<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Contracts;

/**
 * APM Service
 *
 * @author SL, WN
 * @package PayBreak\Foundation\Contracts
 */
interface ApmService
{
    /**
     * Add attributes to Transaction
     *
     * @param array $params
     * @return bool
     */
    public function transactionAttributes(array $params);

    /**
     * Record an exception
     *
     * @param \Exception $e
     * @return bool
     */
    public function exception(\Exception $e);

    /**
     * Record a custom event with attributes
     *
     * @param string $name
     * @param array $attributes
     * @return bool
     */
    public function customEvent($name, array $attributes);

    /**
     * Mark Transaction as background job
     *
     * @return bool
     */
    public function backgroundTransaction();
}
