<?php

namespace App\Repositories\Eloquent;

use App\Models\Subject;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SubjectRepository;

/**
 * Class SubjectRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class SubjectRepositoryEloquent extends BaseRepository implements SubjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subject::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
