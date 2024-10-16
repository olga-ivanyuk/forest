<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class PostService
{
    /**
     * @throws \Exception
     */
    public static function create(array $data)
    {
        unset($data['post']['image']);
        try {
            DB::beginTransaction();
            $post = Post::query()->create($data['post']);
            $tagIds = TagService::getOrCreateTags(explode(',', $data['tags']));
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('Failed to create post', [
                'error' => $exception->getMessage(),
                'data' => $data,
            ]);

            throw new \Exception('An error occurred while creating the post. Please try again.');
        }

        return $post;
    }

    public static function update(array $data, Post $post): Post
    {
        $post->update($data);

        return $post;
    }

    public static function delete(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        return $post->delete();
    }
}
