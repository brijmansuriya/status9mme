<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class TagFactory extends Factory
{

    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'status' => '1',
            'slug' => Str::slug($this->faker->word),
        ];
    }
}
