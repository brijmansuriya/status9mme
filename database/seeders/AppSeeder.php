<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->insert([
            [
                'app_label' => 'iOS App',
                'app_type' => 'ios',
                'app_version' => 0,
                'force_updates' => 0,
                'maintenance_mode' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_label' => 'Android App',
                'app_type' => 'android',
                'app_version' => 0,
                'force_updates' => 0,
                'maintenance_mode' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}