<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\Student2Repository;
use App\Models\Student;

/**
 * Class Student2RepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class Student2RepositoryEloquent extends BaseRepository implements Student2Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Student::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
