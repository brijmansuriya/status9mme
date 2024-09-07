<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

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
            AppSeeder::class,
            AppMenuLinkSeeder::class,
            // CategorieSeeder::class,
            // TagSeeder::class,
            AdminSeeder::class,
        ]);

        
    }
}
