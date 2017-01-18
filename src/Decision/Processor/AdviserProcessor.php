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
use PayBreak\Foundation\Decision\Advice;
use PayBreak\Foundation\Decision\Adviser;
use PayBreak\Foundation\Decision\DataSources;
use PayBreak\Foundation\Decision\ProcessingException;
use PayBreak\Foundation\Decision\Risk;
use PayBreak\Foundation\Decision\Rule;

/**
 * Adviser Processor
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Processor
 */
class AdviserProcessor implements AdviserProcessorInterface
{
    private $ruleProcessor;

    public function __construct(RuleProcessorInterface $ruleProcessor)
    {
        $this->ruleProcessor = $ruleProcessor;
    }

    /**
     * @author WN
     * @param Adviser $adviser
     * @param DataSources $dataSources
     * @param float $defaultRisk
     * @return Advice
     */
    public function process(Adviser $adviser, DataSources $dataSources, $defaultRisk = Risk::MINIMUM_RISK)
    {
        $advice = Advice::make(['adviser_type' => $adviser->getType(), 'adviser_name' => $adviser->getName()]);
        $risk = [];

        foreach ($adviser->getRules() as $rule) {
            if ($rule->getActive() != Rule::INACTIVE) {
                $risk = $this->processRule($rule, $advice, $dataSources, $risk);
            }
        }

        if (count($risk) == 0) {
            $risk[] = $defaultRisk;
        }

        $advice->setRisk(Risk::normalize(max($risk)));

        $advice->setMeta(['processor' => 'Standard processor', 'time' => date('c')]);

        return $advice;
    }

    /**
     * @author WN
     * @param Rule $rule
     * @param Advice $advice
     * @param DataSources $dataSources
     * @param array $risk
     * @return array
     */
    private function processRule(Rule $rule, Advice $advice, DataSources $dataSources, array $risk)
    {
        try {
            $ruleAdvice = $this->ruleProcessor->process($rule, $this->fetchValue($dataSources, $rule));
            if ($rule->getActive() == Rule::ACTIVE) {
                $risk[] = $ruleAdvice->getRisk();
            }
            $advice->addAdvices($ruleAdvice);
        } catch (ProcessingException $e) {
            $advice->addExceptions('Processing rule [' . $rule->getDescription() . '] issue:' . $e->getMessage());
        }

        return $risk;
    }

    /**
     * @author WN
     * @param DataSources $dataSources
     * @param Rule $rule
     * @return Value
     * @throws ProcessingException
     */
    private function fetchValue(DataSources $dataSources, Rule $rule)
    {
        $source = $dataSources->getDataSource($rule->getSource());

        if (!method_exists($source, $rule->getField())) {
            throw new ProcessingException(
                'Field [' . $rule->getField() . '] not exists in source [' . $rule->getSource() . ']'
            );
        }

        $value = $source->{$rule->getField()}();

        if (! $value instanceof Value) {
            throw new ProcessingException(
                'Field [' . $rule->getField() . '] in source [' . $rule->getSource() . '] must be Value type'
            );
        }

        return $value;
    }
}
