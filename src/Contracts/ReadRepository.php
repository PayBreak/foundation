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

use PayBreak\Foundation\Exceptions\NotFoundException;
use PayBreak\Foundation\Exceptions\RepositoryException;

/**
 * Read Repository Interface
 *
 * Naming convention findBy[field_name]($value)
 *
 * @author  WN
 * @package PayBreak\Foundation
 */
interface ReadRepository
{
    /**
     * Read Entity
     *
     * @author WN
     * @param int|string $id
     * @return Persistable
     * @throws NotFoundException if Entity is not found
     * @throws RepositoryException for any other case
     */
    public function read($id);
}
