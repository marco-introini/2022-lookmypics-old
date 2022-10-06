<?php

namespace App\Models;

use App\Enums\AcceptanceStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'accepted' => AcceptanceStatus::class,
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class,'album_id');
    }

    private function generateUrl(): string
    {
        $url = $this->image;
        if (! stristr($url, 'https')) {
            $url = config('photoacceptance.base_url').'/storage/'.$this->image;
        }

        return $url;
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->generateUrl(),
        );
    }

}