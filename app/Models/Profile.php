<?php

namespace App\Models;

use App\Traits\BootedTrait;
use App\Traits\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes, BootedTrait, HasFilter;

    protected $guarded = false;
    protected $table = 'profiles';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

//    public function likedByProfiles(): BelongsToMany
//    {
//        return $this->belongsToMany(Profile::class, 'post_profile_likes', 'profile_id', 'post_id');
//    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function likedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likable');
    }
}
