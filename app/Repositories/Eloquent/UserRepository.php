<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    
    public function __construct(User $model)
    {
        $this->model = $model;
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