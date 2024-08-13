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

    public function update($data,$id);

}
