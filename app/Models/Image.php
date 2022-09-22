<?php

namespace App\Models;

use App\Enums\AcceptanceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{

    protected $guarded = [];

    protected $casts = [
        'accepted' => AcceptanceStatus::class,
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class,'album_id');
    }

}