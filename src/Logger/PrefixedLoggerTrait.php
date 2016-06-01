<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Logger;

/**
 * PrefixedLoggerTrait
 *
 * @author WN
 * @package PayBreak\Foundation\Logger
 */
trait PrefixedLoggerTrait
{
    use PsrLoggerTrait {
        PsrLoggerTrait::log as parentLog;
    }

    /**
     * @return string
     */
    abstract protected function getPrefix();

    /**
     * @author WN
     * @param string $level
     * @param string $message
     * @param string $context
     * @return null
     */
    protected function log($level, $message, $context)
    {
        return $this->parentLog($level, $this->getPrefix() . $message, $context);
    }
}
