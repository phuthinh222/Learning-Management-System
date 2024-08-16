<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\User\UserService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function listUsers(Request $request)
    {   
        $request->flash();
        $users = $this->userService->getUsersNotAdmin($request);
        $roleTranslations = [
            'Admin' => 'Quản trị viên',
            'Teacher' => 'Giáo viên',
            'Student' => 'Học sinh',
            'Employee' => 'Nhân viên'
        ];
        return view('users.list_user', compact('users', 'roleTranslations'));
    }

    public function getSubjectsForFilter(Request $request)
    {
        $subjects = $this->userService->getAllSubjectForUserFilter();
        return response()->json(['data' => $subjects]);
    }
}
