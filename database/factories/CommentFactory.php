<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()-> realTextBetween(200, 700),
            'profile_id' => Profile::query()->inRandomOrder()->first()->id,
            'post_id' => Post::query()->inRandomOrder()->first()->id,
        ];
    }
}
