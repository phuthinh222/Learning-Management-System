<?php

namespace Tests;

use App\Models\Employees;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    protected function createUser()
    {
        $user = User::factory()->create([]);
        $user->password = Hash::make('ValidPassword');
        $user->save();
        return $user;
    }
    //Create the user with roles
    protected function createTeacherUser()
    {
        try {
            DB::beginTransaction();
            $teacher = Teacher::factory()->create([]);
            $user = $this->createUser();
            $user->assignRole('Teacher');
            $data = [
                'userable_type' => $teacher::class,
                'userable_id' => $teacher->id,
            ];
            $user->update($data);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
    }

    protected function createStudentUser()
    {
        try {
            DB::beginTransaction();
            $stdent = Student::factory()->create([]);
            $user = $this->createUser();
            $user->assignRole('Student');
            $data = [
                'userable_type' => $stdent::class,
                'userable_id' => $stdent->id,
            ];
            $user->update($data);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    protected function createEmployeeUser()
    {
        try {
            DB::beginTransaction();
            $employee = Employees::factory()->create([]);
            $user = $this->createUser();
            $user->assignRole('Employee');
            $data = [
                'userable_type' => $employee::class,
                'userable_id' => $employee->id,
            ];
            $user->update($data);
            DB::commit();   
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    //Test without auth user
    protected function getTest($url)
    {
        return $this->get($url);
    }
    protected function putTest($url, $data)
    {
        return $this->put($url, $data);
    }

    protected function getTestWithAuthNotURL($user)
    {
        return $this->actingAs($user);
    }

    protected function postTest($url, $data)
    {
        return $this->post($url, $data);
    }
    //Get Test with Auth and Role user
    protected function getTestWithAuth($url, $user)
    {
        return $this->actingAs($user)->get($url);
    }

    //Post Test with Auth and Role user
    
    protected function postTestWithAuth($url, $user, $data)
    {
        return $this->actingAs($user)->post($url, $data);
    }

    protected function putTestWithAuth($url, $user, $data)
    {
        return $this->actingAs($user)->put($url, $data);
    }
    protected function findUserToTest($email_address)
    {
        return User::Where('email_address', $email_address)->first();
    }
}
