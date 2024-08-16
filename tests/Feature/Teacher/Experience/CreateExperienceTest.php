<?php

namespace Tests\Feature\Teacher\Experience;

use App\Models\Experience;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateExperienceTest extends TestCase
{
    #[Test]
    public function user_can_created_experience(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ])->toArray();
        $response = $this->actingAs($this->getTeacherId())->post(route('experiences.store', ['teacher' => $teacher->id]), $experience);
        $this->assertDatabaseHas('experiences', $experience);
        $response->assertStatus(200);
    }

    #[Test]
    public function user_cannot_create_experience_when_not_logged_in(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->get($this->getRouteCreate($teacher));
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function user_cannot_create_experience_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($this->getStudentId())
            ->get($this->getRouteCreate($teacher));
        $response->assertStatus(403);
    }
    #[Test]
    public function user_cannot_create_experience_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($this->getAdminId())
            ->get($this->getRouteCreate($teacher));
        $response->assertStatus(403);
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }

    public function getStudentId()
    {
        $user = User::factory()->create()->assignRole('Student');
        return $user;
    }
    public function getAdminId()
    {
        $user = User::factory()->create()->assignRole('Admin');
        return $user;
    }
    public function getRouteCreate(Teacher $teacher)
    {
        return route('experiences.create', ['teacher' => $teacher->id]);
    }
}
