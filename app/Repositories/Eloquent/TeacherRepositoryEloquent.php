<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TeacherRepository;
use App\Entities\Teacher;
use App\Models\Teacher as ModelsTeacher;
use App\Models\User;

/**
 * Class TeacherRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class TeacherRepositoryEloquent extends BaseRepository implements TeacherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teacher::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getTeacherBySearchString($search)
    {
        $query = User::role('Teacher')
        ->whereHas('userable', function ($query) {
            $query->where('status', 0);
        });

        if (!empty($search)) {
            $query->where( function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('user_name', 'like', '%' . $search . '%')
                    ->orWhere('email_address', 'like', '%' . $search . '%');
            });
        }
        return $query->paginate(10);
    }
}
