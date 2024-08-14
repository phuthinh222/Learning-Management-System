<?php

namespace Tests\Feature\Student;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateInfoTest extends TestCase
{
    protected function getUrlView($id)
    {
        return route('student.edit',$id);
    }
    protected function getUrlUpdateStudent($id)
    {
        return route('student.update',$id);
    }

    #[Test]
    public function user_not_login_user_not_see_view_edit()
    {
        $user = $this->createUser();
        $response = $this->getTest($this->getUrlView($user->id));;
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    #[Test]
    public function authenticated_user_role_teacher_not_see_view_student(): void
    {
       
       
        $user = $this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth($this->getUrlView($user->id), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_admin_not_see_view_student(): void
    {
        $user = $this->createUser()->assignRole('Admin');
        $response = $this->getTestWithAuth($this->getUrlView($user->id), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_student_id_not_exist(): void
    {
        $user = $this->createUser()->assignRole('Student');
        $this->getTestWithAuthNotURL($user);
        $user_id = -1;
        $dataUpdate = [
            'name' => 'ten_moi',
            'phone_number' => '0333333',
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ];
        $response = $this->putTest($this->getUrlUpdateStudent($user_id),$dataUpdate);
        $response->assertStatus(404);
       
    }

    
    #[Test]
    public function authenticated_user_role_student_can_see_view_edit_profile(): void
    {
       
        $user = $this->createUser()->assignRole('Student');
        $response = $this->getTestWithAuth($this->getUrlView($user->id), $user);
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
        $prefix = fake()->randomElement(['032', '033', '034', '035', '036', '037', '038', '039', '052', '056', '058', '070', '076', '077', '078', '079', '083', '084', '085', '081', '082', '086', '088', '089', '090', '091', '092', '093', '094', '096', '097', '098', '099']);
        $phone_number = $prefix. fake()->unique()->numerify('#######');
        $user = $this->createStudentUser();
        $this->actingAs($user);
        $dataUpdate = [
            'name' => 'ten_moi',
            'phone_number' => $phone_number,
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ];
        $response = $this->putTest($this->getUrlUpdateStudent($user->id),$dataUpdate);
        $response->assertStatus(302);
        $response->assertRedirect(route('student.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'ten_moi',
            'phone_number' => $phone_number,
            'date_of_birth' => '1990-01-01',
            'address' => 'dia_chi_moi'
        ]);
    }

}
