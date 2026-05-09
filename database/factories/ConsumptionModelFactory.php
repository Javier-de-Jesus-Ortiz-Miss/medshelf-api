<?php

namespace Database\Factories;

use App\Models\ConsumptionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConsumptionModel>
 */
class ConsumptionModelFactory extends Factory
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
            'item_id' => fake()->numberBetween(1, 100),
            'amount' => fake()->numberBetween(1, 10),
            'consumed_at' => fake()->dateTimeThisYear(),
        ];
    }
}
