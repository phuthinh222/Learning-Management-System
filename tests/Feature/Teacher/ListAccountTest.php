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

    public function test_the_application_returns_a_successful_response_for_teacher_index(): void
    {
        $user = User::factory()->create();
        $role = Role::findOrCreate('Admin'); 
        $user->assignRole($role);
        
        $this->actingAs($user);
        $response = $this->get(route('teacher.inactive'));
        
        $response->assertStatus(200);
    }
}
