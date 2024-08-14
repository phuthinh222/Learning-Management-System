<?php 

namespace App\Http\Service\User;
use App\Repositories\Contracts\UserRepository;


class UserService 
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserAnotherRoleAdmin($perPage = 10)
    {
        return $this->userRepository->getUsersByRoles(['Teacher', 'Student', 'Employee']);
    }
}