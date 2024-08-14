<?php 

namespace App\Http\Service\Student;
use App\Repositories\Contracts\StudentRepository;


class StudentService 
{

    protected $student_repository;

    public function __construct(StudentRepository $student_repository) 
    {
        $this->student_repository = $student_repository;
    }

    public function update_information($data,$id)
    {
        return $this->student_repository->update($data,$id);
    }
     
}