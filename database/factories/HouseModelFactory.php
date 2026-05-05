<?php

namespace Database\Factories;

use App\Models\HouseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HouseModel>
 */
class HouseModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'public_id' => fake()->unique()->uuid(),
            'owner_id' => User::factory(),
            'name' => fake()->word(),
        ];
    }
}
