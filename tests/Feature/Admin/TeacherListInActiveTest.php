<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;

class TeacherListInActiveTest extends TestCase
{

    #[Test]
    public function test_show_teachers_list_with_admin_success(): void
    {
        $user = $this->createUserWithRole('Admin');

        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));
        $response->assertStatus(200);
    }

    #[Test]
    public function test_show_teachers_list_with_teacher_fail(): void
    {
        $user = $this->createUserWithRole('Teacher');

        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));

        $response->assertStatus(403); 
    }

    #[Test]
    public function test_show_teachers_list_with_student_fail(): void
    {
        $user = $this->createUserWithRole('Student');

        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));

        $response->assertStatus(403); 
    }

    #[Test]
    public function test_show_teachers_list_with_employee_fail(): void
    {
        $user = $this->createUserWithRole('Employee');

        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));

        $response->assertStatus(403); 
    }
    private function createUserWithRole(string $role): User
    {
        $user = User::factory()->create();
        $role = Role::findOrCreate($role);
        $user->assignRole($role);

        return $user;
    }

}
