<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\TeacherService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancesTeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService){
        $this->teacherService = $teacherService;
    }
    public function checkin_teacher()
    {   
        $this->teacherService->checkin();
        return redirect()->route('teacher.listTimeKeeping');
    }
    public function checkout_teacher()
    {
        $this->teacherService->checkout();
        return redirect()->route('teacher.listTimeKeeping');
    }

    public function attendance_search(Request $request)
    {
        
    }
    


}
