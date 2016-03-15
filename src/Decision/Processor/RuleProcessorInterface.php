<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Decision\Processor;

use PayBreak\Foundation\Data\Value;
use PayBreak\Foundation\Decision\Risk;
use PayBreak\Foundation\Decision\Rule;
use PayBreak\Foundation\Decision\RuleAdvice;

/**
 * Rule Processor Interface
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Processor
 */
interface RuleProcessorInterface
{
    /**
     * @author WN
     * @param Rule $rule
     * @param Value $value
     * @param float $noMatchRisk
     * @return RuleAdvice
     */
    public function process(Rule $rule, Value $value, $noMatchRisk = Risk::MAXIMUM_RISK);
}
