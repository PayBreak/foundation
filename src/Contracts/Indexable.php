<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation\Contracts;

/**
 * Indexable Interface
 *
 * @author  WN
 * @package PayBreak\Foundation
 */
interface Indexable extends Entity
{
    /**
     * Entity Identifier
     *
     * @author WN
     * @return int|string|null
     */
    public function getId();

    /**
     * @author WN
     * @param int|string $id
     * @return $this
     */
    public function setId($id);
}
