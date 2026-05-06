<?php

namespace Database\Factories;

use App\Models\ActiveIngredientModel;
use App\Models\ProductCompoundModel;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductModel>
 */
class ProductModelFactory extends Factory
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
            'name' => fake()->word(),
            'presentation' => fake()->randomElement(['tablet', 'syrup', 'injection']),
            'consume_type' => fake()->randomElement(['DISCRETE', 'CONTINUOUS']),
            'sales_unit_value' => fake()->randomFloat(2, 0.1, 100),
            'sales_unit' => fake()->randomElement(['mg', 'ml', 'g']),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (ProductModel $product) {
            ProductCompoundModel::factory()->count(3)->create([
                'product_id' => $product->id,
                'active_compound_id' => ActiveIngredientModel::factory(),
                'concentration_value' => fake()->randomFloat(2, 0.1, 100),
                'concentration_unit' => fake()->randomElement(['mg/ml', 'g/l', 'µg/ml']),
                'base_amount' => fake()->randomFloat(2, 0.1, 1000),
            ]);
        });
    }
}
