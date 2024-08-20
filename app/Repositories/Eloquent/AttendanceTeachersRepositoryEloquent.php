<?php

namespace App\Repositories\Eloquent;

use App\Models\AttendanceTeacher;
use App\Repositories\Contracts\AttendanceTeachersRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AttendanceTeachersRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AttendanceTeachersRepositoryEloquent extends BaseRepository implements AttendanceTeachersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AttendanceTeacher::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
