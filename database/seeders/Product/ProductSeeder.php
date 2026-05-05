<?php

namespace Database\Seeders\Product;

use App\Models\ProductModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        ProductModel::factory()->count(10)->create();
    }
}

