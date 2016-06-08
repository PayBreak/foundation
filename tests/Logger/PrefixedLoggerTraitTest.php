<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Logger;

use PayBreak\Foundation\Logger\PrefixedLoggerTrait;
use Psr\Log\LogLevel;

/**
 * Psr Logger Trait Test
 *
 * @author WN, SL
 * @package Tests\Logger
 */
class PrefixedLoggerTraitTest extends \PHPUnit_Framework_TestCase
{
    use PrefixedLoggerTrait;

    private $logger;

    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    protected function getLogger()
    {
        return $this->logger;
    }

    /**
     * Get the log message prefix/tag
     *
     * @author SL
     * @return string
     */
    protected function getLogPrefix()
    {
        return 'PFX: ';
    }

    public function testLogEmergency()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::EMERGENCY, 'PFX: 123', []);

        $this->assertNull($this->logEmergency('123'));
    }

    public function testLogAlert()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ALERT, 'PFX: 123', []);

        $this->assertNull($this->logAlert('123'));
    }

    public function testLogCritical()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::CRITICAL, 'PFX: 123', []);

        $this->assertNull($this->logCritical('123'));
    }

    public function testLogError()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ERROR, 'PFX: 123', []);

        $this->assertNull($this->logError('123'));
    }

    public function testLogWarning()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::WARNING, 'PFX: 123', []);

        $this->assertNull($this->logWarning('123'));
    }

    public function testLogNotice()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::NOTICE, 'PFX: 123', []);

        $this->assertNull($this->logNotice('123'));
    }

    public function testLogInfo()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::INFO, 'PFX: 123', []);

        $this->assertNull($this->logInfo('123'));
    }

    public function testLogDebug()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::DEBUG, 'PFX: 123', []);

        $this->assertNull($this->logDebug('123'));
    }
}
