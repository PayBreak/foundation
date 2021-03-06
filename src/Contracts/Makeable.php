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

interface Makeable
{
    /**
     * Make object from array
     *
     * @param array $components
     * @return self
     */
    public static function make(array $components);
}
