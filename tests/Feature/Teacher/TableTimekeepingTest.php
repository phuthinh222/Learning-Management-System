<?php

namespace Tests\Feature\Teacher;

use App\Models\Attendance;
use App\Models\AttendanceTeacher;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TableTimekeepingTest extends TestCase
{
    protected function setupAttendanceForMonth($user, $month, $year, $daysWithAttendance)
    {
        $today = Carbon::now()->timezone('Asia/Ho_Chi_Minh')->day;

        for ($i = 1; $i <= $daysWithAttendance; $i++) {
            $date = Carbon::create($year, $month, $i)->toDateString();
            $attendance = Attendance::create([
                'date' => $date,
                'time_check_in' => '08:00:00',
                'time_check_out' => '17:00:00',
                'total_hours' => 8,
            ]);

            AttendanceTeacher::create([
                'id_attendance' => $attendance->id,
                'id_teacher' => $user->id,
            ]);
        }

        return $today;
    }

    protected function assertTimekeepingResponse($response, $month, $year, $daysInMonth, $daysWithAttendance, $today)
    {
        $response->assertStatus(200);
        $response->assertSee($month . '/' . $year);

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $response->assertSee($i);

            if ($i <= $daysWithAttendance) {
                $response->assertSee('8');
            } elseif ($i < $today) {
                $response->assertSee('N');
            } else {
                $response->assertSee('');
            }
        }
    }
    #[Test]
    public function user_not_login_user_not_see_view_table_timekeeping()
    {
        $response = $this->getTest(route('teacher.table_timekeeping'));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }
    #[Test]
    public function authenticated_user_role_student_not_table_timekeeping_teacher(): void
    {
        $user = $this->createUser()->assignRole('Student');
        $response = $this->getTestWithAuth(route('teacher.table_timekeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_role_admin_not_table_timekeeping_teacher(): void
    {
        $user = $this->createUser()->assignRole('Admin');
        $response = $this->getTestWithAuth(route('teacher.table_timekeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function test_timekeeping_for_current_month_when_no_search_date_provided()
    {
        $user = User::factory()->create(['userable_type' => Teacher::class])->assignRole('Teacher');

        $currentDate = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $month = $currentDate->month;
        $year = $currentDate->year;
        $daysInMonth = $currentDate->daysInMonth;
        $today = $currentDate->day;

        $this->setupAttendanceForMonth($user, $month, $year, 10);

        $response = $this->actingAs($user)->get(route('teacher.table_timekeeping'));

        $this->assertTimekeepingResponse($response, $month, $year, $daysInMonth, 10, $today);
    }
    #[Test]
    public function test_timekeeping_with_search_date()
    {
        $user = User::factory()->create(['userable_type' => Teacher::class])->assignRole('Teacher');
        $searchDate = '08/2024';

        list($month, $year) = explode('/', $searchDate);
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $today = Carbon::now()->timezone('Asia/Ho_Chi_Minh')->day;

        $this->setupAttendanceForMonth($user, $month, $year, 10);

        $response = $this->actingAs($user)->get(route('teacher.table_timekeeping', ['searchDate' => $searchDate]));

        $this->assertTimekeepingResponse($response, $month, $year, $daysInMonth, 10, $today);
    }



}
