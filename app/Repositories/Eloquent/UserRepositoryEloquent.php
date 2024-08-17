<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Hash;

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

    public function searchToLogin($searchString)
    {
        $user = $this->model->where('user_name', '=', $searchString)
            ->orWhere('email_address', '=', $searchString)
            ->first();
        return $user;
    }
    
    public function getUsersByRoles(array $roles, $request, $perPage = 10)
    {
        if (!$request) {
            return $this->model->whereHas('roles', function($query) use ($roles) {
                $query->whereIn('roles.name', $roles);
            })->latest('id')->paginate($perPage);    
        }
        
        if ($request->type){
            $roles = [$request->type];
        }
        return $this->getAllUsersWithSearchString($request->search_string, $roles, $perPage, $request->detail);
    }

    protected function getAllUsersWithSearchString($searchString, $roles, $perPage = 10, $detail = NULL)
    {
        $users = $this->model->where(function ($query) use ($searchString) {
            $query->whereRaw("users.name COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$searchString}%"])
            ->orWhereRaw('remove_accents(users.name) LIKE ?', ["%{$searchString}%"])
            ->orWhere('users.email_address', 'LIKE', "%{$searchString}%")
            ->orWhere('users.phone_number', 'LIKE', "%{$searchString}%")
            ->orWhere('users.user_name', 'LIKE', "%{$searchString}%");
        })->whereHas('roles', function($query) use ($roles) {
            $query->whereIn('roles.name', $roles);
        })
        ->when($roles == ['Teacher'] && $detail, function($query) use ($detail){
            $query->where('subjects.id' ,'=', $detail)
            ->join('subjects', 'users.id', '=', 'subjects.id_teacher');
        })
        ->when($roles == ['Student'] && $detail, function($query) use ($detail) {
            $query->where('subjects.id', '=', $detail)
            ->join('study_fees', 'study_fees.id_student', '=', 'users.userable_id')
            ->join('subjects', 'subjects.id', '=', 'study_fees.id_subject');
        })
        ->when($roles == ['Employee'] && $detail!==NULL, function($query) use($detail){
            $query->join('employees', 'employees.id', '=', 'users.userable_id')
            ->where('employees.status', '=', (int) $detail);
        })
        ->select('users.*')
        ->latest('id')
        ->paginate($perPage);
        return $users;
    }

    public function createUser(array $data)
    {
        return $this->model->create($data);
    }


}
