<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter extends AbstractFilter
{
    protected array $keys = [
        'id',
        'created_at_from',
        'created_at_to',
        'title',
        'description',
        'content',
        'published_at_from',
        'published_at_to',
        'views',
        'status',
        'profile_name',
        'category_title',
    ];

    protected function id(Builder $builder, $value)
    {
        $builder->where('id', $value);
    }

    protected function createdAtFrom(Builder $builder, $value)
    {
        $builder->where('created_at', '>=', $value);
    }

    protected function createdAtTo(Builder $builder, $value)
    {
        $builder->where('created_at', '<=', $value);
    }

    protected function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%");
    }

    protected function description(Builder $builder, $value)
    {
        $builder->where('description', 'ilike', "%$value%");
    }

    protected function content(Builder $builder, $value)
    {
        $builder->where('content', 'ilike', "%$value%");
    }

    protected function publishedAtFrom(Builder $builder, $value)
    {
        $builder->where('published_at', '>=', $value);
    }

    protected function publishedAtTo(Builder $builder, $value)
    {
        $builder->where('published_at', '<=', $value);
    }

    protected function views(Builder $builder, $value)
    {
        $builder->where('views', $value);
    }

    protected function status(Builder $builder, $value)
    {
        $builder->where('status', $value);
    }

    protected function profileName(Builder $builder, $value)
    {
        $builder->whereRelation('profile', 'name', 'ilike', "%$value%");
    }

    protected function categoryTitle(Builder $builder, $value)
    {
        $builder->whereHas('category', function ($query) use ($value) {
            $query->where('title', 'ilike', "%$value%");
        });
    }
}
