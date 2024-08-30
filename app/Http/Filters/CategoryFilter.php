<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends AbstractFilter
{
    protected array $keys = [
        'id',
        'created_at_from',
        'created_at_to',
        'title',
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
}
