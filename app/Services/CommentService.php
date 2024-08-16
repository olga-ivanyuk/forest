<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public static function create(array $data)
    {
        return Comment::query()
            ->create($data);
    }

    public static function update(array $data, $comment)
    {
        $comment->update($data);

        return $comment;
    }
}
