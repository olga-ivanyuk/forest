<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'permissions';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role_users');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'permission_role_users');
    }

    public static function getPermissionForAction(string $action)
    {
        return self::query()->where('action', $action)->value('name');
    }
}
