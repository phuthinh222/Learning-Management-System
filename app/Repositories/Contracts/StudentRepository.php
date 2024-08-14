<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StudentRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface StudentRepository extends RepositoryInterface
{
 /**
     * Update a student entity by id
     *
     * @param array $data
     * @param int   $id
     *
     * @return mixed
     */
    public function update(array $data, $id);
}
