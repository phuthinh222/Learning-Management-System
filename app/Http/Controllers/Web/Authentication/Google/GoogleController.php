<?php

namespace App\Http\Controllers\Web\Authentication\Google;

use App\Http\Controllers\Controller;
use App\Http\Service\Authentication\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    protected $auth_service;

    public function __construct(AuthenticationService $auth_service) 
    {
        $this->auth_service = $auth_service;
    }
    public function index()
    {
        return Socialite::driver('Google')->redirect();
    }

    public function callBack()
    {
        $result = $this->auth_service->loginWithGoogle();
        if ($result) {
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('login');
    }
}
