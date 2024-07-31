<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Service\Authentication\AuthenticationService;

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

    public function loginStore(LoginRequest $request) 
    {
        $request->flashOnly('user_name');
        $result = $this->auth_service->login($request);
        if ($result === NULL) {
            return redirect()->back();
        } elseif ($result === FALSE) {
            return redirect()->back();
        } 
    
        return redirect()->route('dashboard');
        
    }

    public function logout() 
    {
        $this->auth_service->logout();
        return redirect()->route('login');
    }
}
