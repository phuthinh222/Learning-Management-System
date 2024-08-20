<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateInformationRequest;
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
        return view('students.index');
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
    public function update(UpdateInformationRequest $request, string $id)
    {
      
        $this->studentService->update_information($request->all(),$id);
        flash()
        ->options([
            'timeout' => 3000, 
            'position' => 'top-center',
        ])
        ->success('Cập nhật thông tin thành công');
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
