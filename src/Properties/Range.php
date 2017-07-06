<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Properties;

use PayBreak\Foundation\AbstractEntity;

/**
 * Range
 *
 * @author WN
 * @method int|float getMin()
 * @method int|float getMax()
 */
class Range extends AbstractEntity
{
    protected $properties = [
        'min' => self::TYPE_NUMERIC,
        'max' => self::TYPE_NUMERIC,
    ];

    public function __construct()
    {
        parent::setMin(0);
        parent::setMax(0);
    }

    /**
     * @author WN
     * @param float|int $min
     * @return $this
     */
    public function setMin($min)
    {
        parent::setMin($min);
        $this->normalise();
        return $this;
    }

    /**
     * @author WN
     * @param float|int $max
     * @return $this
     */
    public function setMax($max)
    {
        parent::setMax($max);
        $this->normalise();
        return $this;
    }

    /**
     * @author WN
     */
    private function normalise()
    {
        if ($this->getMin() > $this->getMax()) {

            $ar = $this->toArray();

            parent::setMin($ar['max']);
            parent::setMax($ar['min']);
        }
    }
}
