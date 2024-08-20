<?php

namespace App\Http\Service\Authentication;

use App\Models\Teacher;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $user = $this->user_repository->searchToLogin($request->user_name);
        if ($user !== null) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->email_verify_token == NULL) {
                    Auth::login($user);
                    return $user;
                }
                
                return FALSE;
            } 

            return FALSE;
        }
        
        return NULL;
    }

    public function loginWithGoogle() 
    { 
        $user = Socialite::driver('Google')->user();
        $user_to_login = $this->user_repository->searchToLogin($user->email);
        if ($user_to_login !== NULL) {
            Auth::login($user_to_login);
            return TRUE;
        }

        $new_user = [
            'user_name' =>  explode('@' ,$user->email)[0],
            'password' => Hash::make('Password01'),
            'name' => $user->name,
            'email_address' => $user->email,
            'google_id' => $user->id,
            'date_of_birth' => NULL,
            'address' => NULL,
            'phone_number' => NULL,
        ];

        try {
            DB::beginTransaction();
            $user_to_login = $this->user_repository->create($new_user);
            $this->assignRole($user_to_login, 'Teacher');
            Auth::login($user_to_login);
            DB::commit();
            return TRUE;
        } catch (\Throwable $th) {
            DB::rollBack();
            return FALSE;
        }
    }
    public function logout()
    {
        Auth::logout();
    }

    public function assignRole($user, $role) 
    {
        $user->assignRole($role);
        $account_type = Teacher::create();
        $data = [
            'userable_id' => $account_type->id,
            'userable_type' => $account_type::class
        ];
        $this->user_repository->update($data, $user->id);
    }
}