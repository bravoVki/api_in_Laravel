<?php

namespace Database\Factories;

use App\Models\Singer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
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
            'title' => fake()->name(),
            'singer_id' => Singer::factory(),
            'album_name' => fake()->sentence(),
            'genre' => fake()->randomElement(['rock', 'pop', 'jazz', 'classic', 'rnb'])
        ];
    }
}
