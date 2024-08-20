<?php

namespace Tests\Feature\Teacher\Experience;

use App\Models\Experience;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteExperienceTest extends TestCase
{
    #[Test]
    public function user_can_delete_experience(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getTeacherId())->delete($this->getRouteDestroy($teacher, $experience));
        $response->assertStatus(200);
    }
    #[Test]
    public function user_can_not_delete_experience_when_not_logged_in(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->delete($this->getRouteDestroy($teacher, $experience));
        $response->assertRedirect(route('login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }
    #[Test]
    public function user_can_not_delete_experience_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getStudendId())->delete($this->getRouteDestroy($teacher, $experience));
        $response->assertStatus(403);
    }
    #[Test]
    public function user_can_not_delete_experience_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getAdminId())->delete($this->getRouteDestroy($teacher, $experience));
        $response->assertStatus(403);
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }
    public function getStudendId()
    {
        $user = User::factory()->create()->assignRole('Student');
        return $user;
    }
    public function getAdminId()
    {
        $user = User::factory()->create()->assignRole('Admin');
        return $user;
    }
    public function getRouteDestroy(Teacher $teacher, Experience $experience)
    {
        return route('experiences.destroy', [
            'teacher' => $teacher->id,
            'experience' => $experience->id,
        ]);
    }
}
