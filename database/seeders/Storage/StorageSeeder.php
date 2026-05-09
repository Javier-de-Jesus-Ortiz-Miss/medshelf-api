<?php

namespace Database\Seeders\Storage;

use App\Models\PlaceModel;
use App\Models\StorageModel;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    public function run(): void
    {
        if (PlaceModel::count() === 0) {
            PlaceModel::factory()->create();
        }

        StorageModel::factory()
            ->count(6)
            ->state(fn() => ['place_id' => PlaceModel::inRandomOrder()->value('id')])
            ->create();
    }
}

