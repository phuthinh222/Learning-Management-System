<?php 

namespace App\Http\Service\Teacher;
use App\Repositories\Contracts\AttendancesRepository;
use App\Repositories\Contracts\AttendanceTeachersRepository;
use Auth;
use Carbon\Carbon;



class TeacherService 
{

    protected $attendance_repository;
    protected $attendance_teacher_repository;

    public function __construct(AttendancesRepository $attendance_repository , AttendanceTeachersRepository $attendance_teacher_repository) 
    {
        $this->attendance_repository = $attendance_repository;
        $this->attendance_teacher_repository = $attendance_teacher_repository;
    }

    public function checkin()
    {
        $data_checkin = [
            'date' =>Carbon::now()->toDateString(),
            'time_check_in' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->format('H:i:s'),
            'time_check_out' => '00:00:00',
        ];
        $id_attendance = $this->attendance_repository->create($data_checkin);
        $data_checkin_teacher = [
            'id_teacher' =>Auth::user()->id,
            'id_attendance' => $id_attendance->id,
        ];
        $this->attendance_teacher_repository->create($data_checkin_teacher);

        
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
            $hoursMissing = round(4 - $total_hours , 2);
            $attendance->status = "Chưa đủ nửa công thiếu {$hoursMissing} giờ";
        } else if($total_hours >= 4 && $total_hours < 8 ) {
            $hoursMissing = round(8 - $total_hours , 2);
            $attendance->status = "Chưa đủ ngày công thiếu {$hoursMissing} giờ";
        }else{
            $attendance->status = "Đủ ngày công";
        }
        $attendance->save();  
        
    }
    public function getCheckinStatus()
    {
        return $this->attendance_repository->getCheckinStatus();
    }

    public function getTeacherByAuth(){
        return Auth::user()->userable;
    }

}