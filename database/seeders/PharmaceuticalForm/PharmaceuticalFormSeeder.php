<?php

namespace Database\Seeders\PharmaceuticalForm;

use App\Models\PharmaceuticalFormModel;
use Illuminate\Database\Seeder;

class PharmaceuticalFormSeeder extends Seeder
{
    public function run(): void
    {
        PharmaceuticalFormModel::factory()->createMany([
            ['name' => 'Tablet', 'consumption_type' => 'Discrete'],
            ['name' => 'Capsule', 'consumption_type' => 'Discrete'],
            ['name' => 'Syrup', 'consumption_type' => 'Continuous'],
            ['name' => 'pre-filled-injection', 'consumption_type' => 'Discrete'],
            ['name' => 'Injectable', 'consumption_type' => 'Discrete'],
            ['name' => 'Cream', 'consumption_type' => 'Applicable'],
            ['name' => 'Drops', 'consumption_type' => 'Discrete'],
            ['name' => 'Suppositories', 'consumption_type' => 'Discrete'],
            ['name' => 'Suspension', 'consumption_type' => 'Continuous'],
            ['name' => 'Solution', 'consumption_type' => 'Continuous'],
            ['name' => 'Ointment', 'consumption_type' => 'Applicable'],
            ['name' => 'Gel', 'consumption_type' => 'Applicable'],
        ]);
    }
}