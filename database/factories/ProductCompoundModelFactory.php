<?php

namespace Database\Factories;

use App\Models\ActiveIngredientModel;
use App\Models\ProductCompoundModel;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductCompoundModel>
 */
class ProductCompoundModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'active_compound_id' => ActiveIngredientModel::factory(),
            'product_id' => ProductModel::factory(),
            'concentration_value' => fake()->randomFloat(2, 0.1, 100),
            'concentration_unit' => fake()->randomElement(['mg/ml', 'g/l', 'µg/ml']),
            'base_amount' => fake()->randomFloat(2, 0.1, 1000),
        ];
    }
}
