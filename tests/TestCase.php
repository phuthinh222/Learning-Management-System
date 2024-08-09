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

    protected function getTest($url)
    {
        return $this->get($url);
    }

    protected function getTestWithAuth($url, $user)
    {
        return $this->actingAs($user)->get($url);
    }

    protected function postTest($url, $data)
    {
        return $this->post($url, $data);
    }

    protected function findUserToTest($email_address)
    {
        return User::where('email_address', $email_address)->first();
    }

    
}
