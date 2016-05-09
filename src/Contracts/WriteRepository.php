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

use PayBreak\Foundation\Exceptions\RepositoryException;

/**
 * Write Repository Interface
 *
 * @author  WN
 * @package PayBreak\Foundation
 */
interface WriteRepository
{
    /**
     * Write Entity
     *
     * Returned RecordableEntity will have unique index value
     *
     * @author WN
     * @param Persistable $entity
     * @return Persistable
     * @throws RepositoryException
     */
    public function write(Persistable $entity);
}
