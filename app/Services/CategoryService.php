<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public static function create(array $data)
    {
        return Category::query()
            ->create($data);
    }

    public static function update(array $data, $category)
    {
        $category->update($data);

        return $category;
    }
}
