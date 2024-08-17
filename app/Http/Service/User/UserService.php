<?php 

namespace App\Http\Service\User;

use App\Repositories\Contracts\SubjectRepository;
use App\Repositories\Contracts\UserRepository;


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
}