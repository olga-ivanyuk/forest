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

    public static function getOrCreateTags(array $tagTitles): array
    {
        $tagIds = [];
        foreach ($tagTitles as $tagTitle) {
            if (!empty(trim($tagTitle))) {
                $tag = Tag::query()->firstOrCreate(['title' => $tagTitle]);
                $tagIds[] = $tag->id;
            }
        }

        return $tagIds;
    }
}
