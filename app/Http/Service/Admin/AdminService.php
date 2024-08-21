<?php

namespace App\Http\Service\Admin;

use App\Models\Teacher;
use App\Models\User;
use App\Repositories\Contracts\AttendancesRepository;
use Carbon\Carbon;


class AdminService
{
    protected $attendance_repository;



    public function __construct(AttendancesRepository $attendance_repository)
    {
        $this->attendance_repository = $attendance_repository;
    }


    public function getAttendancesAllTeacher($searchDate)
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
        // Create list day 
        $dates = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::create($year, $month, $i)->format('Y-m-d');
        }
    
        $employees = User::where('userable_type', Teacher::class)->get();
        $attendances = $this->attendance_repository->getAttendancesAllTeacher($month, $year);
    
        $workingDays = [];
    
        foreach ($employees as $employee) {
            $employeeName = $employee->name;
            $position = $employee->userable->position;
    
            
            $workingDays[$employeeName] = [
                'position' => $position,
                'totalWorkingHours' => 0,
                'totalDaysOff' => 0,
            ];
    
            foreach ($dates as $date) {
                $dateToCheck = Carbon::parse($date);
    
                if ($dateToCheck->lt($currentDate)) {
                    $workingDays[$employeeName][$date] = 'N';
                    $workingDays[$employeeName]["totalDaysOff"]++;
                } else {
                    $workingDays[$employeeName][$date] = '';
                }
            }
        }
    
        foreach ($attendances as $attendance) {
            $teacherName = $attendance->teacher_name;
            $date = Carbon::parse($attendance->date)->format('Y-m-d');
    
            if (isset($workingDays[$teacherName])) {
                $workingDays[$teacherName][$date] = $attendance->total_hours;
                $workingDays[$teacherName]["totalWorkingHours"] += $attendance->total_hours;
                $workingDays[$teacherName]["totalDaysOff"]--;    
            }
        }
    
        return [
            'daysInMonth' => $daysInMonth,
            'month' => $month,
            'year' => $year,
            'workingDays' => $workingDays,
        ];
    }
    

}




