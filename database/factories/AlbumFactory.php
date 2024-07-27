<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name'      => fake()->word(),
            'year'      => fake()->year(),
            'label'     => fake()->word(10),
            'producer'  => fake()->firstName() . ' ' . fake()->lastName(),
            'image'     => fake()->image(),
        ];
    }

}
