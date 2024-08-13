<?php

namespace App\Http\Controllers;

use App\Http\Service\Student\StudentService;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $studentService;

    public function __construct(StudentService $studentService){
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
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
    public function edit(string $id)
    {
        
        return view('students.update_information');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $this->studentService->UpdateInformation($request->all(),$id);
        return redirect()->route('student.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
