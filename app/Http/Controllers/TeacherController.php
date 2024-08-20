<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher_service;

    public function __construct(TeacherService $teacher_service)
    {
        $this->teacher_service = $teacher_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function edit()
    {
        return view('teachers.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listInactiveTeacher(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search', '');

            $users = $this->teacher_service->searchInactiveTeacher($search);

            $hasUsers = !$users->isEmpty();
            $message = 'Không tìm thấy tài khoản';

            return response()->json([
                'list' => $hasUsers ? view('admin.partials.list_accounts', compact('users'))->render() : view('admin.partials.list_accounts', compact('message'))->render(),
                'paginate' => view('admin.partials.paginate', compact('users'))->render()
            ]);
        }
        $users = $this->teacher_service->searchInactiveTeacher('');
        return view('admin.inactive_teacher', compact('users'));
    }
}