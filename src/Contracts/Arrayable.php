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
 * Arrayable Interface
 *
 * @author WN
 * @package PayBreak\Foundation\Contracts
 */
interface Arrayable
{
    /**
     * To Array
     *
     * An array representation of object
     *
     * @param bool $recursively If set to `true` then toArray(true) will be called on each `Arrayable` property
     * @return array
     */
    public function toArray($recursively = false);
}
