<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'title' => $this->faker->sentence,
                'slug' => $this->faker->slug,
                'image' => $this->faker->imageUrl(),
                'description' => $this->faker->paragraph,
                'meta_description' => $this->faker->sentence,
                'url' => $this->faker->url,
                'category_id' => Category::all()->random()->id,
                'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            ];
    }
}
