<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()
        ->count(10)
        ->create();

        Admin::factory()->count(5)->create();
        // Create a specific admin with a custom email
        if (!Admin::where('email', 'brij@gmail.com')->exists()) {
            // If the email doesn't exist, create a new admin
            Admin::factory()->create([
                'email' => 'brij@gmail.com',
            ]);
        }

        // Admin::created([
        //     'name' => 'admin',
        //     'email' => 'brij@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
