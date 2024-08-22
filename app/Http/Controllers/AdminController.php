<?php

namespace App\Http\Controllers;

use App\Http\Service\Admin\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $admin_service;

    public function __construct(AdminService $admin_service)
    {
        $this->admin_service = $admin_service;
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
        //
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

    public function table_timekeeping_list_teacher(Request $request)
    {
        $searchDate = $request->input('search_attendance');
        $data = $this->admin_service->getAttendancesAllTeacher($searchDate);

        
        return view('admin.table_timekeeping_admin',$data);
    }

    


}
