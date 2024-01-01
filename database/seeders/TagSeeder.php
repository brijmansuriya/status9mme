<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()
            ->count(5)
            ->create();
    }
}
