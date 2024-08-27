<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'logs';

//    public function post(): BelongsTo
//    {
//        return $this->belongsTo(Post::class);
//    }
}
