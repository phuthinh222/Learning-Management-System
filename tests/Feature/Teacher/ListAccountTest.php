<?php

namespace Tests\Feature\Teacher;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ListAccountTest extends TestCase
{
    /**
     * A basic feature test example.
     * #[Test]
     */

    public function test_show_teachers_list_with_admin_success(): void
    {
        $user = $this->createUserWithRole('Admin');

        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));

        $response->assertStatus(200);
    }

    public function test_show_teachers_list_with_random_role_other_admin_fail(): void
    {
        $roles = ['Teacher', 'Student', 'Employee'];

        $randomRole = $roles[array_rand($roles)];

        $user = $this->createUserWithRole($randomRole);

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
