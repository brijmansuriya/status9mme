<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppMenuLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_menu_links')->insert([
            [
                'name' => 'about_us',
                'show_name' => 'About Us',
                'for' => 'user',
                'type' => 'ckeditor',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'terms_and_conditions',
                'show_name' => 'Terms And Conditions',
                'for' => 'user',
                'type' => 'ckeditor',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'privacy_policy',
                'show_name' => 'Privacy Policy',
                'for' => 'user',
                'type' => 'ckeditor',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
