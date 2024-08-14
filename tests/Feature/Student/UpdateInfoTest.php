<?php

namespace Tests\Feature\Student;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateInfoTest extends TestCase
{
    #[Test]
    public function user_not_login_user_not_see_view_edit()
    {
        $user = User::factory()->create();
        $response = $this->get(route('student.edit',$user->id));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    #[Test]
    public function authenticated_user_role_teacher_not_see_view_student(): void
    {
       
        $user = User::factory()->create()->assignRole('Teacher');
        $this->actingAs($user);
        $response = $this->get(route('student.edit',$user->id));
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_admin_not_see_view_student(): void
    {
       
        $user = User::factory()->create()->assignRole('Admin');
        $this->actingAs($user);
        $response = $this->get(route('student.edit',$user->id));
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_student_id_not_exist(): void
    {
       
        $user = User::factory()->create()->assignRole('Student');
        $this->actingAs($user);
        $user_id = -1;
        $dataUpdate = [
            'name' => 'ten_moi',
            'phone_number' => '0333333',
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ];
        $response = $this->put(route('student.update', $user_id), $dataUpdate);
        $response->assertStatus(404);
       
       
    }

    
    #[Test]
    public function authenticated_user_role_student_can_see_view_edit_profile(): void
    {
       
        $user = User::factory()->create()->assignRole('Student');
        $this->actingAs($user);
        $response = $this->get(route('student.edit',$user->id));
        $response->assertStatus(200);
        $response->assertViewIs('students.update_information');
        $response->assertSee($user->name);
        $response->assertSee($user->user_name);
        $response->assertSee($user->email_address);
        $response->assertSee($user->address);
        $response->assertSee($user->phone_number);
        $response->assertSee($user->date_of_birth);
       
    }




    #[Test]
    public function authenticated_user_role_student_can_update_profile(): void
    {
        $user = User::factory()->create()->assignRole('Student');
        $this->actingAs($user);
        $dataUpdate = [
            'name' => 'ten_moi',
            'phone_number' => '0333333',
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ];
        $response = $this->put(route('student.update', $user->id), $dataUpdate);
        $response->assertStatus(302);
        $response->assertRedirect(route('student.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'ten_moi',
            'phone_number' => '0333333',
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ]);
    }

}
