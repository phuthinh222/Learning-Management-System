<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Service\Authentication\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $register_service;

    public function __construct(RegisterService $register_service)
    {
       $this->register_service = $register_service;
    }
    public function index()
    {
        return view('Authentication.register');
    }

    public function registerStore(RegisterRequest $request)
    {
        $user = $this->register_service->register($request);
        return redirect()->route('email_verify', $user->id);
    }

    public function showVerify($id, Request $request)
    {
        $user = $this->register_service->find($id);
        return view('Authentication.email_verify', compact('user'));
    }

    public function emailVerifyStore($id, Request $request)
    {
        $result = $this->register_service->verifyEmail($id, $request->email_verify_token);
        if($result === TRUE) {
            return redirect()->route('login')->with('register_successfull', __('auth.verify_successfull'));
        }
        
        return redirect()->back()->with([
            'failed_verify' => __('email.faile_verify'),
            'user' => $result
        ]);
    }
}