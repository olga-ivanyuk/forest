<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public static function create(array $data)
    {
        return Tag::query()
            ->create($data);
    }

    public static function update(array $data, $tag)
    {
        $tag->update($data);

        return $tag;
    }
}
