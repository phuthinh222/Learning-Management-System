<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salaryRecipe = \App\Models\SalaryRecipe::factory()->create();

        return [
            'user_name' => $this->faker->userName,
            'password' => bcrypt('password'), // You can use bcrypt or any other hashing method
            'name' => $this->faker->name,
            'email_address' => $this->faker->unique()->safeEmail,
            'google_id' => $this->faker->optional()->uuid,
            'date_of_birth' => $this->faker->optional()->date(),
            'address' => $this->faker->optional()->address,
            'phone_number' => $this->faker->optional()->phoneNumber,
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'email_verify_token' => $this->faker->optional()->regexify('[A-Za-z0-9]{15}'), // Shorter token
            'id_salary_recipe' => $salaryRecipe->id, // Default value for this column
            'userable_id' => $this->faker->optional()->randomNumber(),
            'userable_type' => $this->faker->optional()->word,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
