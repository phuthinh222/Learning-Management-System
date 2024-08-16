<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AttendancesRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface AttendancesRepository extends RepositoryInterface
{
    /**
    * Save a new entity in repository
    *
    * @param array $attributes
    *
    * @return mixed
    *
    */
    public function create(array $data);

    public function getCheckinStatus();
}
