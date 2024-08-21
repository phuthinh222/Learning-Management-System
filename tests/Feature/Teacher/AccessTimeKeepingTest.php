<?php

namespace Tests\Feature\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AccessTimeKeepingTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function unauth_user_can_not_access_timekeeping()
    {
        $user = $this->createUser()->assignRole(['Student', 'Admin']);
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(403);
    }
    /** @test */
    public function unverify_teacher_can_not_access_timekeeping()
    {
        $teacher = Teacher::factory()->create(['status' => 0]);
        $user = User::factory()->create(['userable_id' => $teacher->id, 'userable_type' => Teacher::class])->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(302)->assertRedirect();
    }
    /** @test */
    public function verify_teacher_can_access_timekeeping()
    {
        $teacher = Teacher::factory()->create(['status' => 1]);
        $user = User::factory()->create(['userable_id' => $teacher->id, 'userable_type' => Teacher::class])->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(200)->assertViewIs('teachers.timekeeping');
    }
}
