<?php

namespace Database\Seeders\Tests;

use App\Core\Shared\Domain\Utils;
use App\Models\HouseModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserHouseTestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'public_id' => Utils::generateUUIDV4(),
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        HouseModel::factory()->create([
            'owner_id' => $user->id,
            'name' => 'Casa de prueba',
        ]);
    }
}

