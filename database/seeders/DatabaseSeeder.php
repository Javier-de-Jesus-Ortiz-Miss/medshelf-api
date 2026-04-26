<?php

namespace Database\Seeders;

use App\Core\Shared\Domain\Utils;
use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'public_id' => Utils::generateUUIDV4(),
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => '12345',
        ]);
    }
}
