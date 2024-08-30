<?php

namespace App\Models;

use App\Http\Filters\PostFilter;
use App\Observers\PostObserver;
use App\Traits\BootedTrait;
use App\Traits\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

//#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory, SoftDeletes, BootedTrait, HasFilter;

    protected $guarded = false;
    protected $table = 'posts';

    protected $casts = [
        'old_attributes' => 'array',
        'new_attributes' => 'array',
        'changed_at' => 'datetime',
    ];

//    public function comments(): HasMany
//    {
//        return $this->hasMany(Comment::class);
//    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

//    public function likedByProfiles(): BelongsToMany
//    {
//        return $this->belongsToMany(Profile::class, 'post_profile_likes', 'post_id', 'profile_id');
//    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likedProfiles(): morphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

//    public function logs(): HasMany
//    {
//        return $this->hasMany(Log::class);
//    }
}
