<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\User\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function listUsers()
    {
        $perPage = 10;

        $users = $this->userService->getUserAnotherRoleAdmin($perPage);

        $roleTranslations = [
            'Admin' => 'Quản trị viên',
            'Teacher' => 'Giáo viên',
            'Student' => 'Học sinh',
            'Employee' => 'Nhân viên'
        ];
        return view('users.list_user', compact('users', 'roleTranslations'));
    }
}
