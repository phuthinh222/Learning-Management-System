<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CourseRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface CourseRepository extends RepositoryInterface
{
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function delete($id);
}
