<?php

namespace Tests\Feature\Teacher\Experience;

use App\Models\Experience;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateExperienceTest extends TestCase
{
    #[Test]
    public function user_can_see_view_updated_experience(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getTeacherId())->get($this->getEditView($teacher, $experience));

        $response->assertStatus(Response::HTTP_OK);
    }
    #[Test]
    public function user_can_not_see_view_experience_when_not_log_in(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->get($this->getEditView($teacher, $experience));

        $response->assertRedirect(route('login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }
    #[Test]
    public function user_can_not_see_view_experience_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getStudendId())->get($this->getEditView($teacher, $experience));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    #[Test]
    public function user_can_not_see_view_experience_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getAdminId())->get($this->getEditView($teacher, $experience));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    #[Test]
    public function user_can_update_experience(): void
    {
        $teacher = Teacher::factory()->create();
        $experience = Experience::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $data = [
            'company' => 'Updated company',
            'position' => 'Updated position',
            'year' => 2
        ];
        $response = $this->actingAs($this->getTeacherId())->put($this->getUpdateRoute($teacher, $experience), $data);

        $this->assertDatabaseHas('experiences', $data);
        $response->assertStatus(Response::HTTP_OK);
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
    public function getEditView(Teacher $teacher, Experience $experience)
    {
        return route('experiences.edit', [
            'teacher' => $teacher->id,
            'experience' => $experience->id,
        ]);
    }
    public function getUpdateRoute(Teacher $teacher, Experience $experience)
    {
        return route('experiences.update', [
            'teacher' => $teacher->id,
            'experience' => $experience->id,
        ]);
    }
}
