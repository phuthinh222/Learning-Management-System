<?php

namespace Tests\Feature\Teacher\Course;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCourseTest extends TestCase
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
    public function teacher_can_view_update_course(): void
    {
        $response = $this->actingAs($this->getTeacherId())->get(route('courses.edit', ['teacher' => $this->teacher, 'course' => $this->course]));
        $response->assertViewIs('teachers.courses.edit');
        $response->assertStatus(200);
    }
    #[Test]
    public function teacher_cannot_view_update_course_when_not_logged_in(): void
    {
        $response = $this->get(route('courses.edit', ['teacher' => $this->teacher, 'course' => $this->course]));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_view_update_course_when_not_teacher(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create(['id_teacher' => $student->id]);
        $response = $this->actingAs($this->getStudentId())->get(route('courses.edit', ['teacher' => $student, 'course' => $course]));
        $response->assertStatus(403);
    }
    #[Test]
    public function teacher_can_update_course(): void
    {
        $response = $this->actingAs($this->getTeacherId())->put(route('courses.update', ['teacher' => $this->teacher, 'course' => $this->course]), $this->course->toArray());
        $this->assertDatabaseHas('courses', $this->course->toArray());
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_update_course_if_field_title_is_empty(): void
    {
        $response = $this->actingAs($this->getTeacherId())->put(route('courses.update', ['teacher' => $this->teacher, 'course' => $this->course]), ['title' => '']);
        $response->assertSessionHasErrors('title');
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_update_course_if_field_description_is_empty(): void
    {
        $response = $this->actingAs($this->getTeacherId())->put(route('courses.update', ['teacher' => $this->teacher, 'course' => $this->course]), ['description' => '']);
        $response->assertSessionHasErrors('description');
        $response->assertStatus(302);
    }
    public function getTeacherId()
    {
        $teacher = Teacher::factory()->create();
        $user = User::factory()->create([
            'userable_id' => $teacher->id,
            'userable_type' => Teacher::class
        ])->assignRole('Teacher');
        return $user;
    }
    public function getStudentId()
    {
        $student = Student::factory()->create();
        $user = User::factory()->create([
            'userable_id' => $student->id,
            'userable_type' => Student::class
        ])->assignRole('Student');
        return $user;
    }
}
