<?php

namespace Database\Seeders\House;

use App\Core\Shared\Domain\Utils;
use App\Models\HouseModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            User::factory()
                ->state(fn() => ['public_id' => Utils::generateUUIDV4()])
                ->create();
        }

        HouseModel::factory()
            ->count(3)
            ->state(fn() => ['owner_id' => User::inRandomOrder()->value('id')])
            ->create();
    }
}

