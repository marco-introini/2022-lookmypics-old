<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{

    protected $guarded = [];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class,'album_id');
    }

}