<?php

namespace Tests\Feature\Teacher\Course;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCourseTest extends TestCase
{
    #[Test]
    public function teacher_can_see_view_created_course(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($this->getTeacherId())->get(route('courses.create', ['teacher' => $teacher]));
        dd($response);
        $response->assertViewIs('teacher.courses.create');
        $response->assertStatus(200);
    }
    #[Test]
    public function teacher_cannot_see_create_course_view_when_not_logged_in(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($this->getTeacherId())->get(route('courses.create', ['teacher' => $teacher]));
        dd($response);
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    #[Test]
    public function teacher_can_create_new_course(): void
    {
        $teacher = Teacher::factory()->create();
        $course = Course::factory()->create(
            ['id_teacher' => $teacher->id]
        )->toArray();
        $response = $this->actingAs($this->getTeacherId())->post(route('courses.store', ['teacher' => $teacher]), $course);
        $this->assertDatabaseHas('courses', $course);
        $response->assertRedirect(route('courses.index', ['teacher' => $teacher]));
        $response->assertStatus(302);
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }
}
