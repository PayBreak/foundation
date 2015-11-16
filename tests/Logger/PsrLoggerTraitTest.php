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

use Psr\Log\LogLevel;
use PayBreak\Foundation\Logger\PsrLoggerTrait;

/**
 * Psr Logger Trait Test
 *
 * @author WN
 * @package Tests\Logger
 */
class PsrLoggerTraitTest extends \PHPUnit_Framework_TestCase
{
    use PsrLoggerTrait;

    private $logger;

    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    protected function getLogger()
    {
        return $this->logger;
    }

    public function testLogEmergency()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::EMERGENCY, '123', []);

        $this->assertNull($this->logEmergency('123'));
    }

    public function testLogAlert()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ALERT, '123', []);

        $this->assertNull($this->logAlert('123'));
    }

    public function testLogCritical()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::CRITICAL, '123', []);

        $this->assertNull($this->logCritical('123'));
    }

    public function testLogError()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ERROR, '123', []);

        $this->assertNull($this->logError('123'));
    }

    public function testLogWarning()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::WARNING, '123', []);

        $this->assertNull($this->logWarning('123'));
    }

    public function testLogNotice()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::NOTICE, '123', []);

        $this->assertNull($this->logNotice('123'));
    }

    public function testLogInfo()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::INFO, '123', []);

        $this->assertNull($this->logInfo('123'));
    }

    public function testLogDebug()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::DEBUG, '123', []);

        $this->assertNull($this->logDebug('123'));
    }
}
