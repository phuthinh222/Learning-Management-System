<?php

namespace App\Repositories\Eloquent;

use App\Models\Attendance;
use Auth;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AttendancesRepository;

use App\Validators\AttendancesValidator;

/**
 * Class AttendancesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AttendancesRepositoryEloquent extends BaseRepository implements AttendancesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attendance::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCheckinStatus()
    {
        $userId = Auth::user()->id;
        $today = Carbon::now()->timezone('Asia/Ho_Chi_Minh')->toDateString();

        $highestId = Attendance::join('attendance_teachers', 'attendances.id', '=', 'attendance_teachers.id_attendance')
            ->where('attendance_teachers.id_teacher', $userId)
            ->whereDate('attendances.date', $today)
            ->max('attendances.id');



        if ($highestId) {

            $attendance = Attendance::find($highestId);
            return $attendance;
        }

        return false;
    }
    public function getListAttendances($user_id, $month, $year)
    {
        return Attendance::join('attendance_teachers', 'attendances.id', '=', 'attendance_teachers.id_attendance')
            ->where('attendance_teachers.id_teacher', $user_id)
            ->whereMonth('attendances.date', $month)
            ->whereYear('attendances.date', $year)
            ->select('attendances.date', 'attendances.time_check_in', 'attendances.time_check_out', 'attendances.total_hours', 'attendances.status')
            ->paginate(10);
    }
    public function getListDayAttendances($user_id, $month, $year)
    {
        return Attendance::join('attendance_teachers', 'attendances.id', '=', 'attendance_teachers.id_attendance')
            ->where('attendance_teachers.id_teacher',$user_id)
            ->whereMonth('attendances.date', $month)
            ->whereYear('attendances.date', $year)
            ->select('attendances.date', 'attendances.time_check_in', 'attendances.time_check_out', 'attendances.total_hours', 'attendances.status')
            ->get()
            ->keyBy('date');
    }


}
