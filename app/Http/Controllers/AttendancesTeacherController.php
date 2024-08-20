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
        if($this->teacherService->checkin())
        {
            flash()
            ->options([
                'timeout' => 3000, 
                'position' => 'top-center',
            ])
            ->error('Không thể  tiếp tục vào ca');
        }
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
