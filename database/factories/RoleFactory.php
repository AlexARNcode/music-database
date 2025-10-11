<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                RoleEnum::ADMIN->value,
                RoleEnum::EDITOR->value,
                RoleEnum::VIEWER->value,
            ]),
        ];
    }

    public function admin()
    {
        return $this->state(fn() => ['name' => RoleEnum::ADMIN->value]);
    }

    public function editor()
    {
        return $this->state(fn() => ['name' => RoleEnum::EDITOR->value]);
    }

    public function viewer()
    {
        return $this->state(fn() => ['name' => RoleEnum::VIEWER->value]);
    }
}
