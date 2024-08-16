<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AttendanceTeachersRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface AttendanceTeachersRepository extends RepositoryInterface
{   /**
    * Save a new entity in repository
    *
    * @param array $attributes
    *
    * @return mixed
    *
    */
    public function create(array $data);
}
