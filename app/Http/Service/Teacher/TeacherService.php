<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\TeacherRepository;
use Carbon\Carbon;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\AttendancesRepository;
use App\Repositories\Contracts\AttendanceTeachersRepository;
use Illuminate\Support\Facades\Auth;

class TeacherService
{
    protected $teacher_repository;
    protected $user_repository;
    protected $attendance_repository;
    protected $attendance_teacher_repository;    
    const CONFIRMED = 1;
    const UNCONFIRMED = 0;

        
    public function __construct(TeacherRepository $teacher_repository, UserRepository $user_repository, AttendancesRepository $attendance_repository, AttendanceTeachersRepository $attendance_teacher_repository)
    {
        $this->teacher_repository = $teacher_repository;
        $this->user_repository = $user_repository;
        $this->attendance_repository = $attendance_repository;
        $this->attendance_teacher_repository = $attendance_teacher_repository;
    }
    public function searchInactiveTeacher($search)
    {
        return $this->teacher_repository->getTeacherBySearchString($search);
    }
    public function getId($id)
    {
        return $this->user_repository->find($id);
    }
    public function update(array $attributes, $id)
    {
        $user = $this->user_repository->find($id);
        if ($user->user_name == $attributes['user_name'] && $user->email_address == $attributes['email_address']) {
            $user = $this->user_repository->updateUser($attributes, $id);
            $teacher = $user->userable;
            $attributes['status'] = self::UNCONFIRMED;
            $teacher->update($attributes);
            return true;
        } else {
            return false;
        }
    }

    public function checkin()
    {

        if (!$this->attendance_repository->getCheckinStatus()) {
            $data_checkin = [
                'date' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->toDateString(),
                'time_check_in' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->format('H:i:s'),
                'time_check_out' => '00:00:00',
            ];
            $id_attendance = $this->attendance_repository->create($data_checkin);
            $data_checkin_teacher = [
                'id_teacher' => Auth::user()->id,
                'id_attendance' => $id_attendance->id,
            ];
            $this->attendance_teacher_repository->create($data_checkin_teacher);
        } else {
            return true;
        }
    }
    public function checkout()
    {
        $attendance = $this->attendance_repository->getCheckinStatus();
        $attendance->time_check_out = Carbon::now()->timezone('Asia/Ho_Chi_Minh')->format('H:i:s');
        $timeCheckIn = Carbon::parse($attendance->time_check_in);
        $timeCheckOut = Carbon::parse($attendance->time_check_out);
        $total_hours = $timeCheckIn->diffInHours($timeCheckOut) + round($timeCheckIn->diffInMinutes($timeCheckOut) / 60, 1);
        if ($total_hours >= 8) {
            $total_hours = 8;
        }
        $attendance->total_hours = $total_hours;
        if ($total_hours < 4) {
            $hoursMissing = round(4 - $total_hours, 1);
            $attendance->status = "Chưa đủ nửa công thiếu {$hoursMissing} giờ";
        } else if ($total_hours >= 4 && $total_hours < 8) {
            $hoursMissing = round(8 - $total_hours, 1);
            $attendance->status = "Chưa đủ ngày công thiếu {$hoursMissing} giờ";
        } else {
            $attendance->status = "Đủ ngày công";
        }
        $attendance->save();
    }
    public function getCheckinStatus()
    {
        return $this->attendance_repository->getCheckinStatus();
    }

    public function getTeacherByAuth()
    {
        return Auth::user()->userable;
    }
    public function getListAttendances($user_id, $month, $year)
    {
        return $this->attendance_repository->getListAttendances($user_id, $month, $year);
    }


    public function getTableDayAttendances($user_id, $searchDate = null)
    {
        
        if ($searchDate) {
            list($month, $year) = explode('/', $searchDate);
            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        } else {
            $currentDate = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
            $month = $currentDate->month;
            $year = $currentDate->year;
            $daysInMonth = $currentDate->daysInMonth;
        }
        $currentDate = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $dates = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::create($year, $month, $i)->format('Y-m-d');
        }
        $attendances = $this->attendance_repository->getListDayAttendances($user_id, $month, $year);
        $workingDays = [];
        $totalWorkingHours = 0;
        $totalDaysOff = 0;

        foreach ($dates as $date) {
            $dateToCheck = Carbon::parse($date);
    
            if (isset($attendances[$date])) {
                $workingDays[$date] = $attendances[$date]->total_hours;
                $totalWorkingHours += $attendances[$date]->total_hours;
            } else {
                if ($dateToCheck->lt($currentDate)) {
                    $workingDays[$date] = 'N';
                    $totalDaysOff++;
                } else {
                    $workingDays[$date] = '';
                }
            }
        }
        return [
            'daysInMonth' => $daysInMonth,
            'month' => $month,
            'year' => $year,
            'workingDays' => $workingDays,
            'totalWorkingHours' => $totalWorkingHours,
            'totalDaysOff' => $totalDaysOff
        ];
    }
    public function find($id)
    {
        return $this->teacher_repository->find($id);
    }


    public function confirmTeacherInformation($id)
    {
        try {
            $attributes['status'] = self::CONFIRMED;
            return $this->teacher_repository->update($attributes, $id);
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
}
