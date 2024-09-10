<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'roles';

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ADMIN_POSTS = 'admin_posts';
    public const ROLE_ADMIN_COMMENTS = 'admin_comments';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function getAccessRules(): array
    {
        return [
            'admin_posts' => '/posts',
            'admin_comments' => '/comments',
//            'admin_articles' => '/articles',
        ];
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
