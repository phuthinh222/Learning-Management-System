<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
  

    /** @test */
    public function authenticated_user_role_student_not_delete_user(): void
    {
        $user = $this->createUser()->assignRole('Student');
        $deleteResponse = $this->delete(route('users.destroy', $user->id));
        $deleteResponse->assertRedirect(route('login'));
    }
    /** @test */
    public function authenticated_user_role_teacher_not_delete_user(): void
    {
        $user = $this->createUser()->assignRole('Teacher');
        $deleteResponse = $this->delete(route('users.destroy', $user->id));
        $deleteResponse->assertRedirect(route('login'));
    }

    /** @test */
    public function it_shows_delete_confirmation_modal_and_deletes_user()
    {

        $user = $this->createUser()->assignRole('Admin');
        $response = $this->getTestWithAuth(route('user.listuser'), $user);
        $response->assertStatus(200);
        $response->assertSee($user->name);
        $deleteResponse = $this->delete(route('users.destroy', $user->id));
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $deleteResponse->assertRedirect(route('user.listuser'));
    }
    /** @test */
    public function it_returns_404_when_deleting_non_existent_user()
    {
        $user = $this->createUser()->assignRole('Admin');
        $this->getTestWithAuth(route('user.listuser'), $user);
        $nonExistentUserId = 999999;
        $deleteResponse = $this->delete(route('users.destroy', $nonExistentUserId));
        $deleteResponse->assertStatus(404);
    }
}
