<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Decision;

use PayBreak\Foundation\AbstractEntity;

/**
 * Adviser
 *
 * @author WN
 * @method $this setType(string $type)
 * @method string|null getType()
 * @method $this setName(string $name)
 * @method string|null getName()
 * @method $this setRules(array $rules)
 * @method $this addRules(Rule $rules)
 * @method Rule[]|null getRules()

 * @package PayBreak\Foundation\Decision
 */
class Adviser extends AbstractEntity
{
    protected $properties = [
        'type'  => self::TYPE_STRING,
        'name' => self::TYPE_STRING,
        'rules' => 'PayBreak\Foundation\Decision\Rule[]',
    ];
}
