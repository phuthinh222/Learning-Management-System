<?php

namespace Database\Factories;

use App\Models\Roles;
use App\Models\SalaryRecipe;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        $salaryRecipe = SalaryRecipe::factory()->create();
        $prefix = $this->faker->randomElement(['032', '033', '034', '035', '036', '037', '038', '039', '052', '056', '058', '070', '076', '077', '078', '079', '083', '084', '085', '081', '082', '086', '088', '089', '090', '091', '092', '093', '094', '096', '097', '098', '099']);
        return [
            'user_name' => $this->faker->unique()->userName(),
            'password' => bcrypt('password'), // You can use bcrypt or any other hashing method
            'name' => $this->faker->name,
            'email_address' => $this->faker->unique()->safeEmail,
            'google_id' => $this->faker->optional()->uuid,
            'date_of_birth' => $this->faker->optional()->date(),
            'address' => $this->faker->optional()->address,
            'phone_number' => $prefix. $this->faker->numerify('#######'),
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'email_verify_token' => NULL, 
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
