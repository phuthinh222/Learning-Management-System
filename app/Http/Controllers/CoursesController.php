<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\CourseService;
use App\Http\Service\Teacher\TeacherService;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    protected $course_service;
    protected $teacher_service;
    public function __construct(CourseService $course_service, TeacherService $teacher_service)
    {
        $this->course_service = $course_service;
        $this->teacher_service = $teacher_service;
    }
    public function index()
    {
        $teacher = $this->teacher_service->getTeacherByAuth();
        $courses = $teacher->courses;
        $user = $teacher->user;
        return view('teachers.courses.index', compact('user', 'teacher', 'courses'));
    }
    public function create()
    {
        $teacher = $this->teacher_service->getTeacherByAuth();
        $user = $teacher->user;
        return view('teachers.courses.create', compact('user', 'teacher'));
    }
    public function store(Request $request)
    {
        $teacher = $this->teacher_service->getTeacherByAuth();
        $courses = $teacher->courses;
        $this->course_service->create($request->all());
        flash()->success(__('teacher.course.create_success'));
        return redirect()->route('courses.index', compact('teacher', 'courses'));
    }
    public function edit($id_teacher, $id_course)
    {
        $teacher = $this->teacher_service->getTeacherByAuth();
        $courses = $this->course_service->getId($id_course);
        $user = $teacher->user;
        return view('teachers.courses.edit', compact('user', 'teacher', 'courses'));
    }
    // public function update(Request $request, $id_teacher, $id_course)
    public function destroy($id_teacher, $id_course)
    {
        $teacher = $this->teacher_service->getTeacherByAuth();
        $courses = $teacher->courses;
        $this->course_service->delete($id_course);
        flash()->success(__('teacher.course.delete_success'));
        return redirect()->route('courses.index', compact('teacher', 'courses'));
    }
}
