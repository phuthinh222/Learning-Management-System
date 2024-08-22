<?php

namespace Tests\Feature\Teacher\Course;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteCourseTest extends TestCase
{
    protected $teacher;
    protected $course;

    protected function setUp(): void
    {
        parent::setUp();
        $this->teacher = $this->getTeacherId()->userable;
        $this->course = Course::factory()->create(['id_teacher' => $this->teacher->id]);
    }
    #[Test]
    public function authenticated_teacher_can_delete_course(): void
    {
        $response = $this->actingAs($this->getTeacherId())->delete($this->getRouteDelete($this->teacher->id, $this->course->id));
        $response->assertStatus(302);
    }

    #[Test]
    public function authenticated_teacher_cannot_delete_course_when_not_logged_in(): void
    {
        $response = $this->delete($this->getRouteDelete($this->teacher->id, $this->course->id));
        $response->assertRedirect(route('login'));
    }
    #[Test]
    public function authenticated_teacher_cannot_delete_when_not_teacher(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create(['id_teacher' => $student->id]);
        $response = $this->actingAs($this->getStudentId())->delete($this->getRouteDelete($student->id, $course->id));
        $response->assertStatus(403);
    }
    public function getTeacherId()
    {
        $teacher = $this->teacher;
        $user = User::factory()->create(
            [
                'userable_id' => $teacher->id,
                'userable_type' => Teacher::class
            ]
        )->assignRole('Teacher');
        return $user;
    }
    public function getStudentId()
    {
        $student = Student::factory()->create();
        $user = User::factory()->create(
            [
                'userable_id' => $student->id,
                'userable_type' => Student::class
            ]
        )->assignRole('Student');
        return $user;
    }
    public function getRouteDelete($id_teacher, $id_course)
    {
        return route('courses.destroy', ['teacher' => $id_teacher, 'course' => $id_course]);
    }
}
