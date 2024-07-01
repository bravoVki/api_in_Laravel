<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Singer>
 */
class SingerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female', 'others']),
            'address' => fake()->address(),
            'first_release_year' => fake()->date(),
            'no_of_albums_released' => fake()->numberBetween(1, 10),
        ];
    }
}
