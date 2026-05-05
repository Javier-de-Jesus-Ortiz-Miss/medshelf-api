<?php

namespace Database\Factories;

use App\Models\ActiveCompoundModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ActiveCompoundModel>
 */
class ActiveCompoundModelFactory extends Factory
{

    public function definition(): array
    {
        return [
            'public_id' => fake()->unique()->uuid(),
            'name' => fake()->word(),
        ];
    }
}
