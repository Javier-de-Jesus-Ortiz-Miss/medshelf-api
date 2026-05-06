<?php

namespace Database\Seeders\Consumption;

use App\Models\ConsumptionModel;
use App\Models\ItemModel;
use Illuminate\Database\Seeder;

class ConsumptionSeeder extends Seeder
{
    public function run(): void
    {
        if (ItemModel::count() === 0) {
            ItemModel::factory()->count(5)->create();
        }

        ConsumptionModel::factory()
            ->count(30)
            ->state(fn() => ['item_id' => ItemModel::inRandomOrder()->value('id')])
            ->create();
    }
}

