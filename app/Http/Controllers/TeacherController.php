<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\TeacherService;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    protected $teacher_service;


    public function __construct(TeacherService $teacher_service)
    {
        $this->teacher_service = $teacher_service;
    }
    public function index()
    {
        $teacher = Auth::user();
        return view('teachers.index', compact('teacher'));
    }
    public function edit(string $id)
    {

        $user = $this->teacher_service->getId($id);
        $teacher = $user->userable;
        $experiences = $teacher->experiences;
        $certificates = $teacher->certificates;
        return view('teachers.edit', compact('user', 'teacher', 'experiences', 'certificates'));
    }
    public function update(Request $request, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $user = $this->teacher_service->update($request->all(), $request->user_id);
            DB::commit();
            if ($user) {
                flash()->success('Bạn đã cập nhật thành công');
                return redirect()->route('teacher.index');
            } else {
                flash()->error('Đã xảy ra lỗi khi cập nhật thông tin giáo viên. Vui lòng thử lại sau.');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            flash()->error('Đã xảy ra lỗi khi cập nhật giáo viên. Vui lòng thử lại sau.');
            return redirect()->back();
        }
    }
    public function listTimeKeeping(Request $request)
    {

        $searchDate = $request->input('search_attendance');
        $teacher = $this->teacher_service->getTeacherByAuth();
        $attendance = $this->teacher_service->getCheckinStatus();


        if ($searchDate) {
            list($month, $year) = explode('/', $searchDate);
            $listAttandance = $this->teacher_service->getListAttendances(Auth::user()->id, (int) $month, (int) $year);
        } else {
            $listAttandance = $this->teacher_service->getListAttendances(Auth::user()->id, Carbon::now()->month, Carbon::now()->year);
        }

        return view('teachers.timekeeping', [
            'teacher' => $teacher,
            'attendance' => $attendance,
            'listAttandance' => $listAttandance->appends(['search_attendance' => $searchDate]),
        ]);
    }
}
