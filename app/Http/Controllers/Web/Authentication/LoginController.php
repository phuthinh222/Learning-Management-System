<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Service\Authentication\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $auth_service;

    public function __construct(AuthenticationService $auth_service) 
    {
        $this->auth_service = $auth_service;
    }

    public function index()
    {
        return view('Authentication.login');
    }

    public function login(LoginRequest $request) 
    {
        $request->flashOnly('user_name');
        $result = $this->auth_service->login($request);
        if ($result === NULL) {
            return redirect()->route('login')->with('login_error_username', __('auth.not_found'));
        } 
    
        if (!$result) {
            return redirect()->route('login')->with('login_error_password', __('auth.failed')); 
        }
        
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)  
    {  
        Auth::logout();  
        
        $request->session()->invalidate();  
        $request->session()->regenerateToken();  
    
        return redirect('/')->with('message', 'Successfully logged out.');  
    } 
}
