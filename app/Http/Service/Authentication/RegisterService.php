<?php 

namespace App\Http\Service\Authentication;

use App\Jobs\SendEmailVerifycation;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterService 
{
    protected $user_repository;

    public function __construct(UserRepositoryInterface $user_repository) 
    {
        $this->user_repository = $user_repository;
    }
     
    public function register($request) 
    {
        $data = [
            'user_name' => $request->user_name,
            'password' =>  Hash::make($request->password),
            'name' => $request->name,
            'email_address' => $request->email_address,
            'google_id' => NULL,
            'email_verify_token' => $this->randString(6),
            'date_of_birth' => NULL,
            'address' => NULL,
            'phone_number' => NULL,
        ];
        $user = $this->user_repository->create($data);
        $user = $this->assignUserType($user, $request->account_type);
        
        SendEmailVerifycation::dispatch($user);
        return $user;
    }

    function verifyEmail($id, $token) 
    {
        $user = $this->user_repository->find($id);
        if ($user->email_verify_token === $token) {
            $user->email_verified_at = now();
            $user->email_verify_token = NULL;
            $user->save();
            return TRUE;
        }

        return $user;
    }
    //This function will generate a random 6 characters string Token in range A-Z and 0-9 
    function randString($length) 
    {
        $str = '';
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        
        return $str;
    }

    public function assignUserType($user, $account_type) 
    {
        if($account_type === 'is_teacher') {
            $user->assignRole('Teacher');
            $account_type = Teacher::create();
        }

        if($account_type === 'is_student') {
            $user->assignRole('Student');
            $account_type = Student::create();
        }

        $data = [
            'userable_id' => $account_type->id,
            'userable_type' => $account_type::class
        ];

        $user = $this->user_repository->update($user->id, $data);

        return $user;
    }

    public function find($id) 
    {
        return $this->user_repository->find($id);
    }
}