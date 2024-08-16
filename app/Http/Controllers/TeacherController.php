<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherInformationRequest;
use App\Http\Service\Teacher\TeacherService;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService){
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
        $teacher =  User::find($id);
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


    public function  listTimeKeeping()
    {
        $teacher = $this->teacherService->getTeacherByAuth();
        $attendance =$this->teacherService->getCheckinStatus();
        return view('teachers.timekeeping', compact('teacher', 'attendance'));
    }
   

}
