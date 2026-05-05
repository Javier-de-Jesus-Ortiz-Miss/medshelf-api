<?php

namespace Database\Seeders\Product;

use App\Models\ActiveCompoundModel;
use Illuminate\Database\Seeder;

class ActiveCompoundsSeeder extends Seeder
{
    public function run(): void
    {
        ActiveCompoundModel::factory()->count(10)->create();
    }
}
