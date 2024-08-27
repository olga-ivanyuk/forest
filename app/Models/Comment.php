<?php

namespace App\Models;

use App\Traits\BootedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes, BootedTrait;

    protected $guarded = false;
    protected $table = 'comments';

//    public function post(): BelongsTo
//    {
//        return $this->belongsTo(Post::class);
//    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function parent(): BelongsTo
    {
      return $this->belongsTo(self::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function category()
    {
        return $this->post->category();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function likes(): MorphMany
    {
      return $this->morphMany(Comment::class, 'likeable');
    }

}
