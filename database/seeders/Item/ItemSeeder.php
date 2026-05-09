<?php

namespace Database\Seeders\Item;

use App\Models\ItemModel;
use App\Models\ProductModel;
use App\Models\StorageModel;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        if (ProductModel::count() === 0) {
            ProductModel::factory()->count(5)->create();
        }

        if (StorageModel::count() === 0) {
            StorageModel::factory()->count(5)->create();
        }

        ItemModel::factory()
            ->count(20)
            ->state(fn() => [
                'product_id' => ProductModel::inRandomOrder()->value('id'),
                'storage_id' => StorageModel::inRandomOrder()->value('id'),
            ])
            ->create();
    }
}

