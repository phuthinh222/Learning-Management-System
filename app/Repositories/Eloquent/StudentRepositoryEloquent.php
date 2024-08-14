<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StudentRepository;

use App\Validators\StudentValidator;

/**
 * Class StudentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class StudentRepositoryEloquent extends BaseRepository implements StudentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    
}
