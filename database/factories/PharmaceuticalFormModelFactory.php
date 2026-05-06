<?php

namespace Database\Factories;

use App\Models\PharmaceuticalFormModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PharmaceuticalFormModel>
 */
class PharmaceuticalFormModelFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'consumption_type' => fake()->randomElement(['discrete', 'continuous']),
        ];
    }
}