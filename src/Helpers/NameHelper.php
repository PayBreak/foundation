<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Helpers;

/**
 * Name Helper
 *
 * @author WN
 * @package PayBreak\Foundation\Helpers
 */
class NameHelper
{
    /**
     * @author WN
     * @param string $string
     * @return string
     */
    public static function camelToSnake($string)
    {
        $string[0] = strtolower($string[0]);
        return strtolower(preg_replace("/([A-Z])/", "_$1", $string));
    }

    /**
     * @author WN
     * @param string $string
     * @param bool $firstLowercase
     * @return string
     */
    public static function snakeToCamel($string, $firstLowercase = false)
    {
        $rtn = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($string))));

        if ($firstLow) {
            $rtn[0] = strtolower($rtn[0]);
        }

        return $rtn;
    }
}
