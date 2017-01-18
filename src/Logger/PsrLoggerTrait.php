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

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Psr Logger Trait
 *
 * @author WN
 * @package PayBreak\Foundation\Logger
 */
trait PsrLoggerTrait
{
    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    abstract protected function getLogger();

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logEmergency($message, array $context = [])
    {
        return $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logAlert($message, array $context = array())
    {
        return $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logCritical($message, array $context = array())
    {
        return $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logError($message, array $context = array())
    {
        return $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logWarning($message, array $context = array())
    {
        return $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logNotice($message, array $context = array())
    {
        return $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logInfo($message, array $context = array())
    {
        return $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * @author WN
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function logDebug($message, array $context = array())
    {
        return $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @author WN
     * @param string $level
     * @param string $message
     * @param array $context
     * @return null
     */
    protected function log($level, $message, $context)
    {
        if ($this->getLogger() instanceof LoggerInterface) {
            $this->getLogger()->log($level, $message, $context);
        }

        return null;
    }
}
