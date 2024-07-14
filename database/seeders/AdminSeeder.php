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
        $addAdminArray = [
            'brij@gmail.com',
            'mansuriyabri@gmail.com',
        ];
        // if (!Admin::whereIn('email', $addAdminArray)->exists()) {
        //     // If the email doesn't exist, create a new admin
        //     Admin::factory()->create([
        //         'email' => 'brij@gmail.com',
        //     ]);
        // }

        // Check for existing emails and filter out those that already exist
        $existingEmails = Admin::whereIn('email', $addAdminArray)->pluck('email')->toArray();
        $newEmails = array_diff($addAdminArray, $existingEmails);

        // Prepare the data to be inserted
        $newAdmins = array_map(function ($email) {
            return ['email' => $email,'password' => bcrypt('12345678'),'name' => 'admin', 'created_at' => now(), 'updated_at' => now()];
        }, $newEmails);

        // Insert new admins if there are any
        if (!empty($newAdmins)) {
            DB::table('admins')->insert($newAdmins);
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
