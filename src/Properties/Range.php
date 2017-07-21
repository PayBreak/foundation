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
use PayBreak\Foundation\Exception;
use PayBreak\Foundation\Exceptions\InvalidArgumentException;

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

    /**
     * @author WN
     * @param float|int $min
     * @return $this
     */
    public function setMin($min)
    {
        parent::setMin($min);
        $this->validateRange();
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
        $this->validateRange();
        return $this;
    }

    /**
     * @author WN
     * @param Range $range
     * @return $this
     * @throws Exception
     */
    public function intersect(Range $range)
    {
        try {
            $this->setMin(max($this->getMin(), $range->getMin()));
            $this->setMax(min($this->getMax(), $range->getMax()));
        } catch (InvalidArgumentException $e) {
            throw new Exception('Cannot find a common part of ranges');
        }

        return $this;
    }

    /**
     * @author WN
     * @throws InvalidArgumentException
     */
    private function validateRange()
    {
        if ($this->getMin() !== null &&
            $this->getMax() !== null &&
            $this->getMin() > $this->getMax()
        ) {
            throw new InvalidArgumentException(
                'Invalid range values: min:[' . $this->getMin() . '] max:[' . $this->getMax() . ']'
            );
        }
    }
}
