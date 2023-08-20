<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // AppSeeder::class,
            // AppMenuLinkSeeder::class,
            UserSeeder::class,
            // AdminSeeder::class,
            // CategorySeeder::class,
            // PostSeeder::class,
            // TagSeeder::class,
        ]);
    }
}
