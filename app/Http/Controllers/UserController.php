<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserInformationRequest;
use Illuminate\Http\Request;
use App\Http\Service\User\UserService;

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

    public function getSubjectsForFilter()
    {
        $subjects = $this->userService->getAllSubjectForUserFilter();
        return response()->json(['data' => $subjects]);
    }


    public function store(UserInformationRequest $request)
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
    public function destroy($id)
    {
        $this->userService->destroy($id);  
        flash()
        ->options([
            'timeout' => 3000, 
            'position' => 'top-center',
        ])
        ->success('Xóa thông tin thành công');
        return redirect()->back();
    }

}
