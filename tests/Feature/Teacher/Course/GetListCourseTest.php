<?php

namespace Tests\Feature\Teacher\Course;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetListCourseTest extends TestCase
{
    #[Test]
    public function teacher_can_get_list_courses(): void
    {
        $teacher = Teacher::factory()->create();
        $course = Course::factory()->create([
            'id_teacher' => $teacher->id
        ]);
        $response = $this->actingAs($this->getTeacherId())->get(route('courses.index', ['teacher' => $teacher->id]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($course->title);
        $response->assertViewIs('teachers.courses.index');
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }
}
