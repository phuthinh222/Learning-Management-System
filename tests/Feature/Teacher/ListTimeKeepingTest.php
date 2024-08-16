<?php

namespace Tests\Feature\Teacher;

use App\Models\Attendance;
use App\Models\AttendanceTeacher;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListTimeKeepingTest extends TestCase
{
   
    public function createAttendance ()
    {
       return Attendance::create([
            'date' => Carbon::now()->toDateString(),
            'time_check_in' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->format('H:i:s'),
            'time_check_out' => '00:00:00',
        ]);
    }

    public function createAttendanceTeacher ($id_teacher , $id_attendance)
    {
       return  AttendanceTeacher::create([
            'id_teacher' => $id_teacher,
            'id_attendance' => $id_attendance,
        ]);
    }

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
        $user = User::factory()->create([
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');
       
        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id,$attendance->id);

        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(200);
        $response->assertViewIs('teachers.timekeeping');

        $response->assertViewHas('teacher', $user->userable);
        $response->assertViewHas('attendance', $attendance);
    }


    #[Test]
    public function authenticated_user_role_teacher_checkin(): void
    {
        $user=$this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('teacher.checkin_teacher'), $user);
        $response->assertStatus(302);
        $response->assertRedirect(route('teacher.listTimeKeeping'));

        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id,$attendance->id);
        
        $this->assertDatabaseHas('attendances', [
            'date' => $attendance->date,
            'time_check_in' => $attendance->time_check_in,
            'time_check_out' => '00:00:00',
        ]);
  
        $this->assertDatabaseHas('attendance_teachers', [
            'id_teacher' => $user->id,
            'id_attendance' => $attendance->id,
        ]);
    }

    #[Test]
    public function authenticated_user_role_teacher_checkout(): void
    {
        
        $user=$this->createUser()->assignRole('Teacher');
        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id,$attendance->id);
        $response = $this->getTestWithAuth(route('teacher.checkout_teacher'), $user);
        $response->assertStatus(302);
        $response->assertRedirect(route('teacher.listTimeKeeping'));
        $attendance->refresh();
        $this->assertNotNull($attendance->time_check_out);
        $this->assertNotNull($attendance->total_hours);
        $this->assertNotNull($attendance->status);
        
    }

}
