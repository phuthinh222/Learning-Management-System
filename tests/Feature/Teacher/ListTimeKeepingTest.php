<?php

namespace Tests\Feature\Teacher;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListTimeKeepingTest extends TestCase
{
    #[Test]
    public function user_not_login_user_not_see_view_list_timekeeping()
    {
        $response = $this->getTest(route('teacher.listTimeKeeping'));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }


    #[Test]
    public function authenticated_user_role_student_not_list_timekeeping_teacher(): void
    {
        $user=$this->createUser()->assignRole('Student');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_admin_not_list_timekeeping_teacher(): void
    {
        $user = $this->createUser()->assignRole('Admin');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_teacher_see_view_timekeeping(): void
    {
        $user=$this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(200);
        $response->assertViewIs('teachers.timekeeping');
    }
}
