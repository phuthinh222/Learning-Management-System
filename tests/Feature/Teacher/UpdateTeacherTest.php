<?php

namespace Tests\Feature\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateTeacherTest extends TestCase
{
    #[Test]
    public function authenticated_user_can_updated_information(): void
    {
        $teacher = Teacher::factory()->create();
        // $dataTeacher = Teacher::factory()->create()->toArray();
        // $dataUser = User::factory()->create([
        //     'userable_id' => $teacher->id,
        //     'userable_type' => Teacher::class,
        // ]);
        $data = [
            'user' => [
                'name' => 'Test User',
                'email_address' => 'testuser@example.com',
                'phone_number' => '0123456789',
                'date_of_birth' => '1990-01-01',
                'address' => '123 Main St',
            ],
            'teacher' => [
                'position' => 'Test',
                'department' => 'CNTT'
            ]
        ];
        $response = $this->actingAs($this->getTeacherId())->put(route('teacher.update', ['teacher' => $teacher->id]), $data);
        $this->assertDatabaseHas('users', $data['user']);
        $this->assertDatabaseHas('teachers', $data['teacher']);
        $response->assertStatus(Response::HTTP_OK);
    }

    #[Test]
    public function user_can_not_updated_information_when_not_logged_in(): void
    {
        $teacher = Teacher::factory()->create();
        $data = User::factory()->create()->toArray();
        $response = $this->put($this->getRouteUpdate($teacher), $data);
        $response->assertRedirect(route('login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    #[Test]
    public function user_can_not_updated_information_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $data = User::factory()->create()->toArray();
        $response = $this->actingAs($this->getStudentId())->put($this->getRouteUpdate($teacher), $data);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    #[Test]
    public function user_can_not_updated_information_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $data = User::factory()->create()->toArray();
        $response = $this->actingAs($this->getAdminId())->put($this->getRouteUpdate($teacher), $data);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getTeacherId()
    {
        $teacher = Teacher::factory()->create();
        $user = User::factory()->create([
            'userable_id' => $teacher->id,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');
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
    public function getRouteUpdate(Teacher $teacher)
    {
        return route('teacher.update', ['teacher' => $teacher->id]);
    }
}
