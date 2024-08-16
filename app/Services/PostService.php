<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public static function create(array $data)
    {
        return Post::query()
            ->create($data);
    }

    public static function update(array $data, Post $post): Post
    {
        $post->update($data);

        return $post;
    }
}
