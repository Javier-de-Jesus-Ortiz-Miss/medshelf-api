<?php

namespace Database\Seeders\Auth;

use App\Core\Shared\Domain\Utils;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'public_id' => Utils::generateUUIDV4(),
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '12345',
        ]);

        User::factory()
            ->count(5)
            ->state(fn() => ['public_id' => Utils::generateUUIDV4()])
            ->create();
    }
}

