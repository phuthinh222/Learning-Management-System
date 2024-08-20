<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\TeacherRepository;

class TeacherService
{
    protected $teacher_repository;

    public function __construct(TeacherRepository $teacher_repository)
    {   
        $this->teacher_repository = $teacher_repository;
    }
    public function searchInactiveTeacher($search)
    {
        return $this->teacher_repository->getTeacherBySearchString($search);
    }
}
