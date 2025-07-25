<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      

        // Call other seeders
        $this->call([
                        RolesSeeder::class,
                        UserSeeder::class,
                        GerencySeeder::class,
                    ]);
    }
}
