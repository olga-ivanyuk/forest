<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentFilter extends AbstractFilter
{
    protected array $keys = [
        'id',
        'created_at_from',
        'created_at_to',
        'content',
        'profile_name',
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

    protected function content(Builder $builder, $value)
    {
        $builder->where('content', 'ilike', "%$value%");
    }

    protected function profileName(Builder $builder, $value)
    {
        $builder->whereRelation('profile', 'name', 'ilike', "%$value%");
    }
}
