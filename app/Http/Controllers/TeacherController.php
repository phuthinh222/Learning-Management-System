<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherInformationRequest;
use App\Http\Service\Teacher\TeacherService;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Auth::user();
        return view('teachers.index', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = User::find($id);
        $user = $teacher;
        $certificates = Certificate::all();
        $experiences = Experience::all();
        return view('teachers.edit', compact(['teacher', 'user', 'certificates', 'experiences']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherInformationRequest $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listInactiveTeacher()
    {
        return view('teachers.inactive');
    }


    public function listTimeKeeping(Request $request)
    {
        $searchDate = $request->input('search_attendance');
        $teacher = $this->teacherService->getTeacherByAuth();
        $attendance = $this->teacherService->getCheckinStatus();


        if ($searchDate) {
            list($month, $year) = explode('/', $searchDate);
            $listAttandance = $this->teacherService->getListAttendances(Auth::user()->id, (int) $month, (int) $year);
        } else {
            $listAttandance = $this->teacherService->getListAttendances(Auth::user()->id, Carbon::now()->month, Carbon::now()->year);
        }

        return view('teachers.timekeeping', [
            'teacher' => $teacher,
            'attendance' => $attendance,
            'listAttandance' => $listAttandance->appends(['search_attendance' => $searchDate]),
        ]);
    }


}
