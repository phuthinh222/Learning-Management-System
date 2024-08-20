<?php 

namespace App\Http\Service\Authentication;

use App\Jobs\SendEmailVerifycation;
use App\Repositories\Contracts\StudentRepository;
use App\Repositories\Contracts\TeacherRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterService 
{
    protected $user_repository;
    protected $teacher_repository;
    protected $student_repository;

    public function __construct(
            UserRepository $user_repository, 
            TeacherRepository $teacher_repository, 
            StudentRepository $student_repository
        ) 
    {
        $this->user_repository = $user_repository;
        $this->teacher_repository = $teacher_repository;
        $this->student_repository = $student_repository;
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
        try {
            DB::beginTransaction();
            $user = $this->user_repository->create($data);
            $this->assignUserType($user, $request->account_type);
            DB::commit();
            Auth::login($user);
            SendEmailVerifycation::dispatch($user);
            return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            return FALSE;
        }
    }

    function verifyEmail($id, $token) 
    {
        $user = $this->user_repository->find($id);
        if ($user->email_verify_token === $token) {
            $data = [
                'email_verified_at' => now(),
                'email_verify_token' => NULL,
            ];
            $this->user_repository->update($data, $id);
            Auth::logout();
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
            $account_type = $this->teacher_repository->create([]);
        }

        if($account_type === 'is_student') {
            $user->assignRole('Student');
            $account_type = $this->student_repository->create([]);
        }

        $data = [
            'userable_id' => $account_type->id,
            'userable_type' => $account_type::class
        ];

        $this->user_repository->update($data, $user->id);
    }

    public function find($id) 
    {
        return $this->user_repository->find($id);
    }

    public function resendEmailVerification()
    {
        try {
            SendEmailVerifycation::dispatch(Auth::user());
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
}