<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;

class CreateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user and assign the "Admin" role
        $adminUser = $this->createUserWithRole('Admin');

        // Authenticate as the admin user
        $this->actingAs($adminUser);
    }

    #[Test]
    public function it_requires_a_valid_name()
    {
        // Test with invalid name format
        $response = $this->post(route('users.store'), [
            'name' => 'Invalid123',
        ]);
        $response->assertSessionHasErrors('name');

        // Test with valid name format
        $response = $this->post(route('users.store'), [
            'name' => 'Nguyễn Văn A',
        ]);
        $response->assertSessionDoesntHaveErrors('name');
    }

    #[Test]
    public function it_requires_a_valid_username()
    {
        // Test with invalid username format
        $response = $this->post(route('users.store'), [
            'user_name' => 'ab',
        ]);
        $response->assertSessionHasErrors('user_name');

        // Test with valid username format
        $response = $this->post(route('users.store'), [
            'user_name' => 'valid_username_123!',
        ]);
        $response->assertSessionDoesntHaveErrors('user_name');

        // Test unique constraint
        $user = User::factory()->create(['user_name' => 'unique_user']);
        $response = $this->post(route('users.store'), [
            'user_name' => 'unique_user',
        ]);
        $response->assertSessionHasErrors('user_name');
    }

    #[Test]
    public function it_requires_a_strong_password()
    {
        // Test with invalid password format
        $response = $this->post(route('users.store'), [
            'password' => 'weak',
        ]);
        $response->assertSessionHasErrors('password');

        // Test with valid password format
        $response = $this->post(route('users.store'), [
            'password' => 'StrongPass1!',
        ]);
        $response->assertSessionDoesntHaveErrors('password');
    }

    #[Test]
    public function it_requires_a_valid_email_address()
    {
        // Test with invalid email format
        $response = $this->post(route('users.store'), [
            'email_address' => 'invalid-email',
        ]);
        $response->assertSessionHasErrors('email_address');

        // Test with valid email format
        $response = $this->post(route('users.store'), [
            'email_address' => 'valid.email@example.com',
        ]);
        $response->assertSessionDoesntHaveErrors('email_address');

        // Test unique constraint
        $user = User::factory()->create(['email_address' => 'unique@example.com']);
        $response = $this->post(route('users.store'), [
            'email_address' => 'unique@example.com',
        ]);
        $response->assertSessionHasErrors('email_address');
    }

    #[Test]
    public function it_requires_a_valid_phone_number()
    {
        // Test with invalid phone number
        $response = $this->post(route('users.store'), [
            'phone_number' => '12345',
        ]);
        $response->assertSessionHasErrors('phone_number');

        // Test with valid phone number
        $response = $this->post(route('users.store'), [
            'phone_number' => '0901234567',
        ]);
        $response->assertSessionDoesntHaveErrors('phone_number');

        // Test unique constraint
        $user = User::factory()->create(['phone_number' => '0901234567']);
        $response = $this->post(route('users.store'), [
            'phone_number' => '0901234567',
        ]);
        $response->assertSessionHasErrors('phone_number');
    }

    #[Test]
    public function it_requires_a_valid_date_of_birth()
    {
        // Test with invalid date (younger than 18)
        $response = $this->post(route('users.store'), [
            'date_of_birth' => now()->subYears(17)->format('Y-m-d'),
        ]);
        $response->assertSessionHasErrors('date_of_birth');

        // Test with valid date
        $response = $this->post(route('users.store'), [
            'date_of_birth' => now()->subYears(20)->format('Y-m-d'),
        ]);
        $response->assertSessionDoesntHaveErrors('date_of_birth');

        // Test with invalid date (older than 70)
        $response = $this->post(route('users.store'), [
            'date_of_birth' => now()->subYears(71)->format('Y-m-d'),
        ]);
        $response->assertSessionHasErrors('date_of_birth');
    }

    #[Test]
    public function it_requires_an_address()
    {
        // Test with empty address
        $response = $this->post(route('users.store'), [
            'address' => '',
        ]);
        $response->assertSessionHasErrors('address');

        // Test with valid address
        $response = $this->post(route('users.store'), [
            'address' => '123 Main St, City, Country',
        ]);
        $response->assertSessionDoesntHaveErrors('address');
    }

    private function createUserWithRole(string $role): User
    {
        $user = User::factory()->create();
        $roleInstance = Role::findOrCreate($role); // Creates or finds the role
        $user->assignRole($roleInstance); // Assigns the role to the user

        return $user;
    }
}