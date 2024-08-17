<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\User\UserService;
use App\Http\Requests\User\StoreUserRequest;

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


    public function store(StoreUserRequest $request)
    {
        try {
            
            $user = $this->userService->createUser($request);
            flash()
            ->options([
                'timeout' => 3000, 
                'position' => 'top-center',
            ])
            ->success('Cập nhật thông tin thành công');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi tạo tài khoản: ' . $e->getMessage());
        }
    }
}
