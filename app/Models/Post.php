<?php

namespace App\Models;

use App\Traits\BootedTrait;
use App\Traits\Models\Traits\HasFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

//#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory, SoftDeletes, BootedTrait, HasFilter;

    protected $guarded = false;
    protected $table = 'posts';
    protected $withCount = ['likedProfiles'];

    protected $casts = [
        'old_attributes' => 'array',
        'new_attributes' => 'array',
        'changed_at' => 'datetime',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

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

//    public function comments(): MorphMany
//    {
//        return $this->morphMany(Comment::class, 'commentable');
//    }

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

    public function getFormattedAtAttribute(): string
    {
        return Carbon::create($this->attributes['created_at'])->format('Y-m-d H:i:s');
    }

    public function getPublishedAtAttribute(): string
    {
        return Carbon::create($this->attributes['published_at'])->format('Y-m-d H:i:s');
    }

    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }

    public function getIsLikedAttribute(): bool
    {
        if (auth()->check()) {
            return $this->likedProfiles->contains(auth()->user()->profile);
        }

        return false; // або повернути інший дефолтний стан

    }
}
