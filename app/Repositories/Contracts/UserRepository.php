<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface UserRepository extends RepositoryInterface
{
    public function getAll();
    
    public function searchToLogin($searchString);

    public function getUsersByRoles(array $roles, $searchString);

    public function createUser(array $data);
}
