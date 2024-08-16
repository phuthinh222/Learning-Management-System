<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\TeacherService;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherService $teacher)
    {
        $this->teacher = $teacher;
    }
    public function index()
    {
        $teacher = Auth::user();
        return view('teachers.index', compact('teacher'));
    }
    public function edit(string $id)
    {
        $user = $this->teacher->getId($id);
        $teacher = $user->userable;
        $experiences = $teacher->experiences;
        $certificates = $teacher->certificates;
        return view('teachers.edit', compact('user', 'teacher', 'experiences', 'certificates'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $this->teacher->update($request->all(), $request->user_id);
            DB::commit();
            flash()->success('Bạn đã cập nhật thành công');
            return redirect()->route('teacher.index');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }



    public function  listTimeKeeping()
    {
        $teacher = $this->teacher->getTeacherByAuth();
        $attendance = $this->teacher->getCheckinStatus();
        return view('teachers.timekeeping', compact('teacher', 'attendance'));
    }
}
