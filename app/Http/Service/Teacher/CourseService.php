<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\CourseRepository;

class CourseService
{
    protected $course_repository;
    public function __construct(CourseRepository $course_repository)
    {
        $this->course_repository = $course_repository;
    }
    public function create($data)
    {
        return $this->course_repository->create($data);
    }
    public function delete($id)
    {
        return $this->course_repository->delete($id);
    }
    public function getId($id)
    {
        return $this->course_repository->find($id);
    }
}
