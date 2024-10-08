<?php

namespace App\Models;

use App\Traits\BootedTrait;
use App\Traits\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, BootedTrait, HasFilter;

    protected $guarded = false;
    protected $table = 'categories';

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasManyThrough
    {
      return $this->hasManyThrough(Comment::class, Post::class);
    }
}
