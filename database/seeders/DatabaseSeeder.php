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
            AdminSeeder::class,
            CategorieSeeder::class,
            TagSeeder::class,
        ]);

        Admin::factory()->count(5)->create();
        // Create a specific admin with a custom email
        Admin::factory()->create([
            'email' => 'brij@gmail.com',
        ]);
    }
}
