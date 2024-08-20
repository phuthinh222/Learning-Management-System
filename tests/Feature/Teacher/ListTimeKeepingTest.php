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
    protected function getExpectedAttendances($userId, $month, $year)
    {
        return Attendance::join('attendance_teachers', 'attendances.id', '=', 'attendance_teachers.id_attendance')
            ->where('attendance_teachers.id_teacher', $userId)
            ->whereMonth('attendances.date', $month)
            ->whereYear('attendances.date', $year)
            ->select('attendances.date', 'attendances.time_check_in', 'attendances.time_check_out', 'attendances.total_hours', 'attendances.status')
            ->paginate(10);
    }

    protected function createAttendance()
    {
        return Attendance::create([
            'date' => Carbon::now()->toDateString(),
            'time_check_in' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->format('H:i:s'),
            'time_check_out' => '00:00:00',
        ]);
    }

    protected function createAttendanceTeacher($id_teacher, $id_attendance)
    {
        return AttendanceTeacher::create([
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
        $user = $this->createUser()->assignRole('Student');
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
        $this->createAttendanceTeacher($user->id, $attendance->id);

        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping'), $user);
        $response->assertStatus(200);
        $response->assertViewIs('teachers.timekeeping');

        $expectedAttendances =  $this->getExpectedAttendances($user->id,  Carbon::now()->month, Carbon::now()->year);;
        if ($expectedAttendances->count() === 0) 
        {
             $response->assertSee('Không có dữ liệu');
        }
        else  if ($expectedAttendances->count() > 0)
        {
            $response->assertSee(Carbon::parse($attendance->date)->format('d/m/Y'));
            $response->assertSee($attendance->time_check_in);
            $response->assertSee($attendance->time_check_out);
            $response->assertSee($attendance->total_hours);
            $response->assertSee($attendance->status);
        }
        $response->assertViewHas('teacher', $user->userable);
        $response->assertViewHas('attendance', $attendance);
    }

    #[Test]
    public function authenticated_user_can_see_no_data_message_when_no_attendance_data(): void
    {
        
        $user = User::factory()->create([
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

       
        $searchDate = '08/2024';

        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping', ['search_attendance' => $searchDate]), $user);

        
        $response->assertStatus(200);
        $response->assertViewIs('teachers.timekeeping');

        $response->assertSee('Không có dữ liệu');
    }

    #[Test]
    public function authenticated_user_can_see_attendance_data(): void
    {
        
        $user = User::factory()->create([
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');
  
        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id, $attendance->id);
        
        $searchDate = '08/2024'; 

        $response = $this->getTestWithAuth(route('teacher.listTimeKeeping', ['search_attendance' => $searchDate]), $user);

        $response->assertStatus(200);
        $response->assertViewIs('teachers.timekeeping');
        
        $response->assertSee(Carbon::parse($attendance->date)->format('d/m/Y'));
        $response->assertSee($attendance->time_check_in);
        $response->assertSee($attendance->time_check_out);
        $response->assertSee($attendance->total_hours);
        $response->assertSee($attendance->status);
    }



    #[Test]
    public function authenticated_user_role_teacher_checkin(): void
    {
        $user = $this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('teacher.checkin_teacher'), $user);
        $response->assertStatus(302);
        $response->assertRedirect(route('teacher.listTimeKeeping'));

        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id, $attendance->id);

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

        $user = $this->createUser()->assignRole('Teacher');
        $attendance = $this->createAttendance();
        $this->createAttendanceTeacher($user->id, $attendance->id);
        $response = $this->getTestWithAuth(route('teacher.checkout_teacher'), $user);
        $response->assertStatus(302);
        $response->assertRedirect(route('teacher.listTimeKeeping'));
        $attendance->refresh();
        $this->assertNotNull($attendance->time_check_out);
        $this->assertNotNull($attendance->total_hours);
        $this->assertNotNull($attendance->status);

    }

}
