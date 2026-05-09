<?php

namespace Database\Factories;

use App\Models\PlaceModel;
use App\Models\StorageModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StorageModel>
 */
class StorageModelFactory extends Factory
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
            'place_id' => PlaceModel::factory(),
            'name' => fake()->word(),
        ];
    }
}
