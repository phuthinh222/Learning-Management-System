<?php

namespace App\Http\Service\Teacher;

use Carbon\Carbon;
use App\Repositories\Contracts\TeacherRepository;
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
    public function __construct(TeacherRepository $teacher_repository, UserRepository $user_repository, AttendancesRepository $attendance_repository, AttendanceTeachersRepository $attendance_teacher_repository)
    {
        $this->teacher_repository = $teacher_repository;
        $this->user_repository = $user_repository;
        $this->attendance_repository = $attendance_repository;
        $this->attendance_teacher_repository = $attendance_teacher_repository;
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
        $total_hours = $timeCheckIn->diffInHours($timeCheckOut) + round($timeCheckIn->diffInMinutes($timeCheckOut) / 60, 2);
        if ($total_hours >= 8) {
            $total_hours = 8;
        }
        $attendance->total_hours = $total_hours;
        if ($total_hours < 4) {
            $hoursMissing = round(4 - $total_hours, 2);
            $attendance->status = "Chưa đủ nửa công thiếu {$hoursMissing} giờ";
        } else if ($total_hours >= 4 && $total_hours < 8) {
            $hoursMissing = round(8 - $total_hours, 2);
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
}
