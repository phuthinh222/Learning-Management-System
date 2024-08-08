<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\ParallelTesting;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected function testUrlPage()
    {
        return route('login');
    }

    protected function testUrlStore()
    {
        return route('login_store');
    }
    /** @test */
    public function guest_user_can_access_to_login_page(): void
    {
        $response = $this->getTest($this->testUrlPage());
        $response->assertViewIs('Authentication.login')
        ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function auth_user_cannot_access_to_login_page(): void
    {
        $user = $this->createUser();
       
        $response = $this->getTestWithAuth($this->testUrlPage(), $user);
    
        $response->assertRedirect(route('dashboard'))
        ->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function guest_user_can_login_page(): void
    {
        $user = $this->createUser();
        $data = [
            'user_name' => $user->user_name,
            'password' => 'ValidPassword'
        ];
        
        $response = $this->postTest($this->testUrlStore(), $data);
        
        $response->assertRedirect(route('dashboard'))
        ->assertStatus(302);
    }

      /** @test */
    public function guest_user_cannot_login_page_send_wrong_user_name(): void
    {
        $user = $this->createUser();

        $data = [
            'user_name' => 'WrongUserName',
            'password' => $user->password
        ];
        
        $response = $this->postTest($this->testUrlStore(), $data);
        
        $response->assertSessionHas([
        'login_error_username' => __('auth.failed')
        ])
        ->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function guest_user_cannot_login_page_send_invalid_user_name(): void
    {
        $user = $this->createUser();

        $data = [
            'user_name' => '123@@@AAAA',
            'password' => $user->password
        ];
        
        $response = $this->postTest($this->testUrlStore(), $data);
        
        $response->assertSessionHasErrors([
        'user_name' => __('validation.custom.user_name.regex')
        ])
        ->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function guest_user_cannot_login_page_send_wrong_password(): void
    {
        $user = $this->createUser();

        $data = [
            'user_name' => $user->user_name,
            'password' => 'wrong password'
        ];
        
        $response = $this->postTest($this->testUrlStore(), $data);
        
        $response->assertSessionHas([
        'login_error_password' => __('auth.password')
        ])
        ->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function guest_user_cannot_login_page_email_not_verified(): void
    {
        $user = $this->createUser();
        $user->email_verify_token = 'AAAAAA';
        $user->save();
        $data = [
            'user_name' => $user->user_name,
            'password' => 'ValidPassword'
        ];
        
        $response = $this->postTest($this->testUrlStore(), $data);
        
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHas(['login_error_verify' => __('auth.rerify_login')]);
    }
}
