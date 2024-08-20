<?php

namespace Tests\Feature\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ListInactiveTeacherTest extends TestCase
{
    use DatabaseTransactions;
    public function searchRoute()
    {
        return route('teacher.search');
    }
    /** @test */
    public function unauth_user_can_not_access_list()
    {
        $user = $this->createUser()->assignRole(['student','teacher']);
        $response = $this->getTestWithAuth(route('teacher.inactive'), $user);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    /** @test */
    public function unauth_user_can_not_search()
    {
        $user = $this->createUser()->assignRole(['student','teacher']);
        $response = $this->getTestWithAuth(route('teacher.search'), $user);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    /** @test */
    public function guest_user_can_not_access_list()
    {
        $response = $this->getTest(route('teacher.inactive'));
        $response->assertStatus(Response::HTTP_FOUND)->assertRedirect('login');
    }
    /** @test */
    public function auth_user_can_search_if_exists()
    {
        $user = $this->createUser()->assignRole('Admin');
        $this->actingAs($user);
        $user1 = User::factory()->create();
        $teacher = Teacher::create([
            'id_certificate' => null,
            'id_experience' => null,
            'department' => 'class',
            'position' => 'developer',
            'status' => 0,
        ]);
        $user1->assignRole('Teacher');
        $user1->update([
            'userable_id' => $teacher->id,
            'userable_type' => Teacher::class,
        ]);
        $response = $this->json('GET',$this->searchRoute(),[
            'page' => '1',
            'search' => $user1->email,
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.inactive_teacher')
                ->assertSee($user1->email);
    }
}
