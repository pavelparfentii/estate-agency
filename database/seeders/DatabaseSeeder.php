<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Termwind\Components\Li;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
//        Listing::factory(20)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Test1 User1',
            'email' => 'test1@example.com',

        ]);

        Listing::factory(10)->create([
            'user_id'=>1
        ]);

        Listing::factory(10)->create([
            'user_id'=>2
        ]);
    }
}
