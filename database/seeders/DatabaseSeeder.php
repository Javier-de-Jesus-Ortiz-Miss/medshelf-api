<?php

namespace Database\Seeders;

use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\Consumption\ConsumptionSeeder;
use Database\Seeders\House\HouseSeeder;
use Database\Seeders\Item\ItemSeeder;
use Database\Seeders\Place\PlaceSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Storage\StorageSeeder;
use Database\Seeders\Tests\UserHouseTestSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HouseSeeder::class,
            PlaceSeeder::class,
            StorageSeeder::class,
            ProductSeeder::class,
            ItemSeeder::class,
            ConsumptionSeeder::class,
            UserHouseTestSeeder::class,
        ]);
    }
}
