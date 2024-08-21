<?php

namespace Tests\Feature\Teacher;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessTimeKeepingTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function unauth_user_can_not_access_timekeeping()
    {
        $user = $this->createUser()->assignRole('Student');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(403);
    }
    /** @test */
    public function unverify_teacher_can_not_access_timekeeping()
    {
        $user = $this->createUser()->assignRole('Teacher');
        $user->userable_id = 100;
        $user->userable_type = 'App\Models\Teacher';
        $user->save();

        $teacher = Teacher::factory()->create([
            'status'=>0,
            'id' => $user->userable_id,
        ]);
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(302)->assertRedirect();
    }
    /** @test */
    public function verify_teacher_can_access_timekeeping()
    {
        $user = $this->createUser()->assignRole('Teacher');
        $user->userable_id = 100;
        $user->userable_type = 'App\Models\Teacher';
        $user->save();

        $teacher = Teacher::factory()->create([
            'status'=>1,
            'id' => $user->userable_id,
        ]);
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(200)->assertViewIs('teachers.timekeeping');
    }
}
