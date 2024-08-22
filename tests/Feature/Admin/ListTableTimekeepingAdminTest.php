<?php

namespace Tests\Feature\Admin;

use App\Models\Attendance;
use App\Models\AttendanceTeacher;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListTableTimekeepingAdminTest extends TestCase
{
    use DatabaseTransactions;
    protected function setupAttendanceForMonth($user, $month, $year, $daysWithAttendance)
    {
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
    }
    protected function assertAttendanceForTeacher($response, $teacher, $month, $year, $daysWithAttendance)
    {
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $today = Carbon::now()->timezone('Asia/Ho_Chi_Minh')->day;

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
    public function test_show_table_timekeeping_admin_with_teacher_fail(): void
    {
        $user = $this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth(route('admin.table_timekeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function test_show_table_timekeeping_admin_with_student_fail(): void
    {
        $user = $this->createUser()->assignRole('Student');
        $response = $this->getTestWithAuth(route('admin.table_timekeeping'), $user);
        $response->assertStatus(403);
    }

    #[Test]
    public function test_show_table_timekeeping_admin_with_employee_fail(): void
    {
        $user = $this->createUser()->assignRole('Employee');
        $response = $this->getTestWithAuth(route('admin.table_timekeeping'), $user);
        $response->assertStatus(403);
    }


    #[Test]
    public function test_get_attendances_for_all_teachers_current_month_no_search_date()
    {
        $teacher1 = Teacher::factory()->create();
        $user1 = User::factory()->create([
            'userable_id' => $teacher1->id,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

        $teacher2 = Teacher::factory()->create();
        $user2 = User::factory()->create([
            'userable_id' => $teacher2->id,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

        $admin = $this->createUser()->assignRole('Admin');

        $currentDate = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $month = $currentDate->month;
        $year = $currentDate->year;

        $this->setupAttendanceForMonth($user1, $month, $year, 10);
        $this->setupAttendanceForMonth($user2, $month, $year, 5);

        $response = $this->actingAs($admin)->get(route('admin.table_timekeeping'));

        $response->assertStatus(200);
        $response->assertSee($month . '/' . $year);

        $this->assertAttendanceForTeacher($response, $teacher1, $month, $year, 10);
        $this->assertAttendanceForTeacher($response, $teacher2, $month, $year, 5);
    }

    #[Test]
    public function test_get_attendances_for_all_teachers_with_search_date()
    {
        $teacher1 = Teacher::factory()->create();
        $user1 = User::factory()->create([
            'userable_id' => $teacher1->id,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

        $teacher2 = Teacher::factory()->create();
        $user2 = User::factory()->create([
            'userable_id' => $teacher2->id,
            'userable_type' => Teacher::class,
        ])->assignRole('Teacher');

        $admin = $this->createUser()->assignRole('Admin');

        $searchDate = '08/2024';
        list($month, $year) = explode('/', $searchDate);

        $this->setupAttendanceForMonth($user1, $month, $year, 10);
        $this->setupAttendanceForMonth($user2, $month, $year, 5);

        $response = $this->actingAs($admin)->get(route('admin.table_timekeeping', ['searchDate' => $searchDate]));

        $response->assertStatus(200);
        $response->assertSee($searchDate);

        $this->assertAttendanceForTeacher($response, $teacher1, $month, $year, 10);
        $this->assertAttendanceForTeacher($response, $teacher2, $month, $year, 5);
    }


}
