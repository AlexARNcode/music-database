<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'images/default/Tycho1.jpg',
            'images/default/Tycho2.png',
            'images/default/Tycho3.jpg',
            'images/default/Tycho4.jpg'
        ];

        return [
            'artist_id' => Artist::inRandomOrder()->first()?->id ?? Artist::factory(),
            'name'      => fake()->word(),
            'year'      => fake()->year(),
            'label'     => fake()->word(10),
            'producer'  => fake()->firstName() . ' ' . fake()->lastName(),
            'image'     => $images[array_rand($images)]
        ];
    }
}
