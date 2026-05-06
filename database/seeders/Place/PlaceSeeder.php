<?php

namespace Database\Seeders\Place;

use App\Models\HouseModel;
use App\Models\PlaceModel;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        if (HouseModel::count() === 0) {
            HouseModel::factory()->create();
        }

        PlaceModel::factory()
            ->count(6)
            ->state(fn() => ['house_id' => HouseModel::inRandomOrder()->value('id')])
            ->create();
    }
}

