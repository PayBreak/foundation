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
 * Jsonable Interface
 *
 * @author WN
 * @package PayBreak\Foundation\Contracts
 */
interface Jsonable
{
    /**
     * JSON representation of an object
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0);
}
