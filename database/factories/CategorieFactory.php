<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{

    public $model = Categorie::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            // 'image' => $this->faker->imageUrl(),
            'status' => '1',
            'slug' => Str::slug($this->faker->word),
        ];


    }
}
