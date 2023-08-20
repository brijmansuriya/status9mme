<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            // 'image' => $this->faker->imageUrl(),
            'status' => '1',
            'slug'=> Str::slug($this->faker->word),
        ];
        $model->addMediaFromRequest($this->faker->imageUrl())->toMediaCollection('category/category-image');

    }
}
