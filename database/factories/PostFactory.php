<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Profile;
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
    public function definition(): array
    {
        return [
            'title' =>  fake()->realTextBetween(7,100),
            'content' =>    fake()-> realTextBetween(200, 700),
            'published_at' =>   fake()-> dateTime(),
            'profile_id' => Profile::query()->first()->id,
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'image_path' => fake()-> imageUrl,
            'status' => fake()-> numberBetween(1,3),
            'views' =>  fake()->numberBetween(100,1000),
        ];
    }
}
