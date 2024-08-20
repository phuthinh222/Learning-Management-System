<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\TeacherInformationRequest;
use App\Http\Service\Teacher\TeacherService;
use App\Models\Attendance;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('update', $user)) {
            $teacher = $user->userable;
            $experiences = $teacher->experiences;
            $certificates = $teacher->certificates;
            return view('teachers.edit', compact('user', 'teacher', 'experiences', 'certificates'));
        } else {
            flash()->error('Đã xảy ra lỗi .Vui lòng thử lại sau.');
            return redirect()->back();
        }
    }

    public function update(TeacherInformationRequest $request, Teacher $teacher)
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

    public function listInactiveTeacher()
    {
        return view('teachers.inactive');
    }


    public function table_timekeeping(Request $request)
    {

        $searchDate = $request->input('search_attendance');
        $data = $this->teacher_service->getTableDayAttendances(Auth::user()->id, $searchDate);

        return view('teachers.table_timekeeping', $data);
    }



    public function listCertificatesOfTeacher($id)
    {
        return response()->json([
            'certificates' => $this->teacher_service->find($id)->certificates,
        ], Response::HTTP_OK);
    }

    public function listExperiencesOfTeacher($id)
    {
        return response()->json([
            'experiences' => $this->teacher_service->find($id)->experiences,
        ], Response::HTTP_OK);
    }

    public function confirmTeacherInformation($id, Request $request)
    {
        try {
            DB::beginTransaction();
            DB::commit();
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->success(__('teacher.confirmations.confirm_successfull'));
            return redirect()->route('teacher.inactive');
        } catch (\Throwable $th) {
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->error(__('teacher.confirmations.confirm_failed'));
            return redirect()->route('teacher.inactive');
        }
    }

}
