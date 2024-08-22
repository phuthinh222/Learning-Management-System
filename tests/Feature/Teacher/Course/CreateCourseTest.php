<?php

namespace Tests\Feature\Teacher\Course;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCourseTest extends TestCase
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
    public function teacher_can_see_view_created_course(): void
    {
        $response = $this->actingAs($this->getTeacherId())->get($this->getViewCreateCourse($this->teacher));
        $response->assertViewIs('teachers.courses.create');
        $response->assertStatus(200);
    }
    #[Test]
    public function teacher_cannot_see_create_course_view_when_not_logged_in(): void
    {
        $response = $this->get($this->getViewCreateCourse($this->teacher));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_can_create_new_course(): void
    {
        $response = $this->actingAs($this->getTeacherId())->post(route('courses.store', ['teacher' => $this->teacher]), $this->course->toArray());
        $this->assertDatabaseHas('courses', $this->course->toArray());
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_create_if_field_title_is_empty(): void
    {
        $response = $this->actingAs($this->getTeacherId())->post(route('courses.store', ['teacher' => $this->teacher]), ['title' => '']);
        $response->assertSessionHasErrors('title');
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_create_if_field_description_is_empty(): void
    {
        $response = $this->actingAs($this->getTeacherId())->post(route('courses.store', ['teacher' => $this->teacher]), ['description' => '']);
        $response->assertSessionHasErrors('description');
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_cannot_create_if_field_photo_is_empty(): void
    {
        $response = $this->actingAs($this->getTeacherId())->post(route('courses.store', ['teacher' => $this->teacher]), ['photoCourse' => '', 'title' => '123', 'description' => 'hello']);
        $response->assertSessionHasErrors('photoCourse');
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
    public function getViewCreateCourse($teacher)
    {
        return route('courses.create', ['teacher' => $teacher]);
    }
}
