<?php

namespace App\Traits\Models\Traits;

use App\Http\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $className = 'App\\Http\\Filters\\' . class_basename($this) . 'Filter';

        if (!class_exists($className)) {
            throw new \Exception("Filter class {$className} not found.");
        }

        return (new $className())->apply($builder, $data);
    }
}
