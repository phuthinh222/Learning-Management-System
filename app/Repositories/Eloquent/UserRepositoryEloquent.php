<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
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
    
    public function getAll()
    {
        return $this->model->paginate(10);
    }

    public function search($search_string)
    {
        $user = $this->model->where('user_name', '=', $search_string)
        ->orWhere('email_address', '=', $search_string)
        ->orWhere('phone_number', '=', $search_string)
        ->first();
        return $user;
    }
}
