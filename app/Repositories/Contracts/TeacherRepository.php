<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeacherRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface TeacherRepository extends RepositoryInterface
{
    public function getTeacherBySearchString($search);
    //
}
