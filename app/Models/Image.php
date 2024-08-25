<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'images';

//    public function imageable(): MorphTo
//    {
//       return $this->morphTo();
//    }

    public function imageable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
    }
}
