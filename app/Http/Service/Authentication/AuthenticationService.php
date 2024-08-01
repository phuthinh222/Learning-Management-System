<?php

namespace App\Http\Service\Authentication;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationService 
{
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function login($request)
    {
        $user = $this->user_repository->search($request->user_name);
        if ($user !== null) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->email_verify_token == NULL) {
                    Auth::login($user);
                    return $user;
                }
                
                Session::flash('login_error', __('auth.rerify_login'));
                return FALSE;
            } 

            Session::flash('login_error', __('auth.password'));
            return FALSE;
        }
        
        Session::flash('login_error', __('auth.failed'));
        return NULL;
        
    }

    public function loginWithGoogle() 
    { 
        try {
            $user = Socialite::driver('Google')->user();
            $user_to_login = $this->user_repository->search($user->email);
            if ($user_to_login !== NULL) {
                Auth::login($user_to_login);
                return TRUE;
            }
            $new_user = [
                'user_name' =>  explode('@' ,$user->email)[0],
                'password' => Hash::make('123456'),
                'name' => $user->name,
                'email_address' => $user->email,
                'google_id' => $user->id,
                'date_of_birth' => NULL,
                'address' => NULL,
                'phone_number' => NULL,
            ];
            $user_to_login = $this->user_repository->create($new_user);
            Auth::login($user_to_login);
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
    public function logout()
    {
        Auth::logout();
    }
}