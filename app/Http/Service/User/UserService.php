<?php 

namespace App\Http\Service\User;

use App\Repositories\Contracts\SubjectRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService 
{

    protected $userRepository;
    protected $subjectRepository;

    public function __construct(UserRepository $userRepository, SubjectRepository $subjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function getUsersNotAdmin($request)
    {
        $roles = ['Teacher', 'Student', 'Employee'];
        
        return $this->userRepository->getUsersByRoles($roles, $request);
    }

    public function getAllSubjectForUserFilter()
    {
        return $this->subjectRepository->all();
    }

    public function findSubject($request)
    {
        if ($request->detail !== NULL){
            return $this->subjectRepository->find($request->detail);
        }
        
        return $this->subjectRepository->all();
    }
    public function createUser($request)
    {
        $data = [
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email_address' => $request->email_address,
            'google_id' => NULL,
            'email_verify_token' => $this->randString(6),
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email_verified_at' => now(),
        ];

        $user = $this->userRepository->create($data);

        $this->assignUserRole($user, $request->role);

        return $user;
    }

    private function assignUserRole($user, $role)
    {
        if (in_array($role, ['student', 'teacher', 'employee'])) {
            $user->assignRole($role);
        } else {
            throw new \Exception("Invalid role type");
        }
    }

    private function randString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}