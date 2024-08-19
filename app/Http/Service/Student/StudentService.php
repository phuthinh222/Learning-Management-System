<?php 

namespace App\Http\Service\Student;
use App\Repositories\Contracts\StudentRepository;
use App\Repositories\Contracts\UserRepository;


class StudentService 
{

    protected $user_repository;

    public function __construct(UserRepository $user_repository) 
    {
        $this->user_repository = $user_repository;
    }

    public function update_information($data,$id)
    {
        return $this->user_repository->update($data,$id);
    }
     
}