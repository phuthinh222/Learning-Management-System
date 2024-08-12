<?php

namespace Tests\Feature\Authentication;

use App\Mail\VerifycationEmail;
use App\Models\Roles;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    protected function getTestUrl()
    {
        return route('register');
    }

    protected function getPostUrl()
    {
        return route('register_store');
    }
    /** @test */
    public function guest_user_can_access_register_page()
    {
        $response = $this->getTest($this->getTestUrl());
        $response->assertStatus(Response::HTTP_OK)
        ->assertViewIs('Authentication.register');
    }

    /** @test */
    public function auth_user_can_not_access_register_page()
    {
        $user = $this->createUser();
        $response = $this->getTestWithAuth($this->getTestUrl(), $user);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function guest_user_can_not_register_send_invalid_name()
    {
        $data = [
            //Name not constain special or numeric characters
            'name' => 'Invalid Name 1',
            'email_address' => 'Validemail@example.com',
            'user_name' => 'ValidUserName',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name' => __('validation.custom.name.regex')]);
    }

    /** @test */
    public function guest_user_can_not_register_not_send_name()
    {
        $data = [
            'email_address' => 'Validemail@example.com',
            'user_name' => "ValidUsername",
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name' => __('validation.custom.name.required')]);
    }

    /** @test */
    public function guest_user_can_not_register_send_invalid_email()
    {
        $data = [
            'name' => 'Valid Name',
            //Valid email must not contain @
            'email_address' => 'Invalidemail',
            'user_name' => 'ValidUserName',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['email_address' => __('validation.custom.email_address.regex')]);
    }

    /** @test */
    public function guest_user_can_not_register_not_send_email()
    {
        $data = [
            'name' => 'Valid Name',
            'user_name' => 'ValidUserName',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['email_address' => __('validation.custom.email_address.required')]);
    }

    /** @test */
    public function guest_user_can_not_register_send_invalid_user_name()
    {
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            //Valid username must not contain ~ character
            'user_name' => '~InvalidUserName',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['user_name' => __('validation.custom.user_name_register.regex')]);
    }

    /** @test */
    public function guest_user_can_not_register_send_not_send_user_name()
    {
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['user_name' => __('validation.custom.user_name_register.required')]);
    }

    /** @test */
    public function guest_user_can_not_register_send_invalid_password()
    {
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'user_name' => 'ValidUsername',
            // Valid password must contain at least 6 characters and at least 1 UPPERCASE, 1 numeric character
            'password' => 'abcd',
            'password_confirmation' => 'abcd'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['password' => __('validation.custom.password.regex')]);
    }

    /** @test */
    public function guest_user_can_not_register_not_send_password()
    {
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'user_name' => 'ValidUsername',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['password' => __('validation.custom.password.required')]);
    }

    /** @test */
    public function guest_user_can_not_register_send_wrong_confirm_password()
    {
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'user_name' => 'ValidUsername',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'abcd'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function guest_user_can_not_register_send_exist_user_name()
    {
        $user = $this->createUser();
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'user_name' => $user->user_name,
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['user_name' => __('validation.custom.user_name_register.unique')]);
    }

    /** @test */
    public function guest_user_can_register_send_valid_information()
    {
        Role::create(['name' => 'Teacher']);
        Mail::fake();
        $data = [
            'name' => 'Valid Name',
            'email_address' => 'Validemail@example.com',
            'user_name' => 'ValidUsername',
            'password' => 'ValidPassword123',
            'password_confirmation' => 'ValidPassword123',
            'account_type' => 'is_teacher'
        ];
        $response = $this->postTest($this->getPostUrl(), $data);
        $user = $this->findUserToTest($data['email_address']);
        
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertRedirect(route('email_verify', $user->id));

        Mail::assertSent(VerifycationEmail::class, function($email) use ($user) {
            return $email->hasTo($user->email_address);
        });
    }

    /** @test */
    public function guest_user_can_register_send_wrong_verify_token()
    {
        $user = $this->createUser();
        $data = [
            'email_verify_token' => 'WrongVerifyToken',
        ];
        $response = $this->postTest(route('email_verify_store', $user->id), $data);

        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHas(['failed_verify' => __('email.faile_verify')]);
    }
    
     /** @test */
     public function guest_user_can_register_send_valid_verify_token()
     {
        $user = $this->createUser();
        $data = [
            'email_verify_token' => $user->email_verify_token,
        ];
        $response = $this->postTest(route('email_verify_store', $user->id), $data);

        $response->assertStatus(Response::HTTP_FOUND)
        ->assertRedirect(route('login'));
     }
     
}
