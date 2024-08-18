<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'major' => $this->faker->word(),
            'level' => $this->faker->word(),
            'school' => $this->faker->word(),
            'photo' => UploadedFile::fake()->image('certificate' . '.jpg')
        ];
    }
}
