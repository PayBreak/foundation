<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Decision\Processor;

use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Processor\RuleProcessor;
use PayBreak\Foundation\Decision\Rule;
use PayBreak\Foundation\Decision\RuleAdvice;

/**
 * Rule Processor Test
 *
 * @author WN
 * @package Tests\Decision\Processor
 */
class RuleProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessMatch()
    {
        $rule = Rule::make([
            'conditions' => [
                [
                    'condition' => 8,
                    'value' => [
                        'type' => Value::VALUE_INT,
                        'value' => 5,
                    ],
                    'risk' => 0.66,
                ],
            ],
        ]);

        $value = Value::make(['type' => Value::VALUE_INT, 'value' => 6]);
        $processor = new RuleProcessor();

        $advice = $processor->process($rule, $value);
        $this->assertInstanceOf(RuleAdvice::class, $advice);
        $this->assertSame(0.66, $advice->getRisk());
        $this->assertInstanceOf(Value::class, $advice->getValue());
    }

    public function testProcessNoMatch()
    {
        $rule = Rule::make([
            'conditions' => [
                [
                    'condition' => 8,
                    'value' => [
                        'type' => Value::VALUE_INT,
                        'value' => 5,
                    ],
                    'risk' => 0.66,
                ],
            ],
        ]);

        $value = Value::make(['type' => Value::VALUE_INT, 'value' => 4]);
        $processor = new RuleProcessor();

        $advice = $processor->process($rule, $value);
        $this->assertInstanceOf(RuleAdvice::class, $advice);
        $this->assertSame(1.0, $advice->getRisk());
    }

    public function testProcessNoMatchDefault()
    {
        $rule = Rule::make([
            'conditions' => [
                [
                    'condition' => 8,
                    'value' => [
                        'type' => Value::VALUE_INT,
                        'value' => 5,
                    ],
                    'risk' => 0.66,
                ],
            ],
        ]);

        $value = Value::make(['type' => Value::VALUE_INT, 'value' => 4]);
        $processor = new RuleProcessor();

        $advice = $processor->process($rule, $value, 0.44);
        $this->assertInstanceOf(RuleAdvice::class, $advice);
        $this->assertSame(0.44, $advice->getRisk());
    }

    public function testProcessException()
    {
        $rule = Rule::make([
            'conditions' => [
                [
                    'condition' => 8,
                    'value' => [
                        'type' => Value::VALUE_INT,
                        'value' => 5,
                    ],
                    'risk' => 0.66,
                ],
            ],
        ]);

        $value = Value::make(['type' => Value::VALUE_STRING, 'value' => 4]);
        $processor = new RuleProcessor();

        $advice = $processor->process($rule, $value, 0.44);
        $this->assertInstanceOf(RuleAdvice::class, $advice);
        $this->assertSame(0.44, $advice->getRisk());
        $this->assertCount(1, $advice->getExceptions());
    }
}
