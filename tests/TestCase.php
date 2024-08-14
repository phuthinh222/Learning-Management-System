<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
        $user = $this->createUser();
        $user->assignRole('Teacher');
        return $user;
    }

    protected function createStudentUser()
    {
        $user = $this->createUser();
        $user->assignRole('Student');
        return $user;
    }

    protected function createEmployeeUser()
    {
        $user = $this->createUser();
        $user->assignRole('Employee');
        return $user;
    }
    //Test without auth user
    protected function getTest($url)
    {
        return $this->get($url);
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
        return User::where('email_address', $email_address)->first();
    }

    
}
