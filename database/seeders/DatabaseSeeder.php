<?php

namespace Database\Seeders;

use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\PharmaceuticalForm\PharmaceuticalFormSeeder;
use Database\Seeders\Product\ActiveIngredientsSeeder;
use Database\Seeders\Product\ProductSeeder;
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
            ActiveIngredientsSeeder::class,
            PharmaceuticalFormSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
