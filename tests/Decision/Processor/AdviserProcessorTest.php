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
use PayBreak\Foundation\Decision\Adviser;
use PayBreak\Foundation\Decision\Condition\ConditionInterface;
use PayBreak\Foundation\Decision\DataSourceInterface;
use PayBreak\Foundation\Decision\DataSources;
use PayBreak\Foundation\Decision\Processor\AdviserProcessor;
use PayBreak\Foundation\Decision\Processor\RuleProcessor;
use PayBreak\Foundation\Decision\Rule;
use PayBreak\Foundation\Decision\Condition\AbstractCondition;
use PayBreak\Foundation\Data\Value;

/**
 * Adviser Processor Test
 *
 * @author EB
 * @package Tests\Decision\Processor
 */
class AdviserProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author EB
     */
    public function testConstruct()
    {
        $mockRuleProcessor = $this->getMock('PayBreak\Foundation\Decision\Processor\RuleProcessorInterface');
        $adviserProcessor = new AdviserProcessor($mockRuleProcessor);
        $this->assertInstanceOf('PayBreak\Foundation\Decision\Processor\AdviserProcessor', $adviserProcessor);
    }

    public function testProcess()
    {
        $adviserType = 'COM';
        $adviserName = 'Test Adviser';

        $condition = AbstractCondition::make(
            [
                'condition' => ConditionInterface::CONDITION_EQUAL,
                'value'     => ['value' => 2, 'type' => Value::TYPE_INT],
                'risk'     => 0.6,
            ]
        );

        $rules = new Rule();
        $rules->setSource('testSource')
            ->setField('testField')
            ->setDescription('Test Rule')
            ->setActive(Rule::ACTIVE)
            ->setType(Value::TYPE_INT)
            ->setConditions([$condition]);

        $adviser = new Adviser();
        $adviser->setType($adviserType)->setName($adviserName)->setRules([$rules]);

        $source = new DataSources();
        $source->addDataSource(new DummyDataSource());

        $ruleProcessor = new RuleProcessor();
        $processor = new AdviserProcessor($ruleProcessor);

        $advice = $processor->process($adviser, $source);

        $this->assertInstanceOf('PayBreak\Foundation\Decision\Advice', $advice);
        $this->assertEquals($adviserType, $advice->getAdviserType());
        $this->assertEquals($adviserName, $advice->getAdviserName());
    }

}

class DummyDataSource implements DataSourceInterface
{
    public function getDataSourceName()
    {
        return 'testSource';
    }

    public function toArray($recursively = false)
    {
        // TODO: Implement toArray() method.
    }

    public function testField()
    {
        return Value::make(['type' => Value::VALUE_INT, 'value' => 6]);
    }
}
