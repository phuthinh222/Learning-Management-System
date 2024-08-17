<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Service\Authentication\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function register(RegisterRequest $request)
    {
        $user = $this->register_service->register($request);

        if(!$user) {
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->error(__('auth.register.failed'));
            return redirect()->route('register');
        }
        return redirect()->route('email_verify', $user->id);
    }

    public function verifyEmail($id, Request $request)
    {
        $user = $this->register_service->find($id);
        
        return view('Authentication.email_verify', compact('user'));
    }

    public function verifyToken($id, Request $request)
    {
        $result = $this->register_service->verifyEmail($id, $request->email_verify_token);
        if($result === TRUE) {
            Auth::logout();
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->success(__('auth.verify_successfull'));
            return redirect()->route('login');
        }
        
        return redirect()->back()->with([
            'failed_verify' => __('email.faile_verify'),
            'user' => $result
        ]);
    }
}