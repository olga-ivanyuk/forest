<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
//        Category::factory(10)->create();
        $profiles = Profile::all();
        $tags = Tag::all();

        Category::factory(10)
            ->has(Post::factory(10)
                ->for($profiles->random())
                ->hasAttached($tags->random(5)))
            ->create();
    }
}
