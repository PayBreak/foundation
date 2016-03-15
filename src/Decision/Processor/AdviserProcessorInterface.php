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

use PayBreak\Foundation\Decision\Adviser;
use PayBreak\Foundation\Decision\DataSources;

/**
 * Adviser Processor Interface
 *
 * @author WN
 * @package PayBreak\Foundation\Decision\Processor
 */
interface AdviserProcessorInterface
{
    /**
     * @author WN
     * @param Adviser $adviser
     * @param DataSources $dataSources
     * @return Advice
     */
    public function process(Adviser $adviser, DataSources $dataSources);
}
