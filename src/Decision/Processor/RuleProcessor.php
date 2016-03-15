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
use PayBreak\Foundation\Decision\ProcessingException;
use PayBreak\Foundation\Decision\Risk;
use PayBreak\Foundation\Decision\Rule;
use PayBreak\Foundation\Decision\RuleAdvice;

/**
 * Rule Processor
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Processor
 */
class RuleProcessor implements RuleProcessorInterface
{
    /**
     * @author WN
     * @param Rule $rule
     * @param Value $value
     * @param float $noMatchRisk
     * @return RuleAdvice
     */
    public function process(Rule $rule, Value $value, $noMatchRisk = Risk::MAXIMUM_RISK)
    {
        $advice = RuleAdvice::make(['rule' => $rule, 'value' => $value, 'risk' => $noMatchRisk]);

        foreach ($rule->getConditions() as $condition) {

            try {

                if ($condition->checkCondition($value)) {

                    $advice->setRisk($condition->getRisk());
                    $advice->setCondition($condition);
                    break;
                }

            } catch (ProcessingException $e) {

                $advice->addExceptions('Processing condition [' . $condition->getValue() . ']: ' . $e->getMessage());
            }
        }

        $advice->setMeta(['processor' => 'First match standard rule processor', 'no_match_risk' => $noMatchRisk]);

        return $advice;
    }
}
