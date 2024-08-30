<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProfileFilter extends AbstractFilter
{
    protected array $keys = [
        'id',
        'created_at_from',
        'created_at_to',
        'name',
        'user_name',
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

    protected function name(Builder $builder, $value)
    {
        $builder->where('name', 'ilike', "%$value%");
    }

    protected function userName(Builder $builder, $value)
    {
        $builder->whereRelation('user', 'name', 'ilike', "%$value%");
    }
}
