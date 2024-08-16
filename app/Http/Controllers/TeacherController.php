<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\TeacherService;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view('teachers.index');
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
        // $user = User::find($request->user_id);
        // if ($user->user_name == $request->user_name) {
        //     $user->update($request->all());
        //     $teacher->update($request->all());
        //     if ($user) {
        //         flash()->success('Bạn đã cập nhật thành công');
        //         return redirect()->route('teacher.index');
        //     } else {
        //         flash()->warning('Cập nhật thông tin bị lỗi');
        //         return redirect()->route('teacher.edit', ['teacher' => $request->user_id]);
        //     }
        // } else {
        //     flash()->warning('Cập nhật thông tin bị lỗi');
        //     return redirect()->route('teacher.edit', ['teacher' => $request->user_id]);
        // }
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
}
