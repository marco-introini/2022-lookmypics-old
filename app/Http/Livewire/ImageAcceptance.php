<?php

namespace App\Http\Livewire;

use App\Enums\AcceptanceStatus;
use App\Models\Album;
use App\Models\Image;
use Livewire\Component;

class ImageAcceptance extends Component
{
    public ?Album $album;
    public ?Image $image = null;

    public function check(): bool
    {
        if ((is_null($this->album)) || ($this->album->viewer_id !== auth()->id())) {
            return false;
        }
        return true;
    }

    public function render()
    {
        // user can access the album
        if (!$this->check()) {
            abort(401);
        }

        // there are no more images to select
        $count = Image::where('album_id','=',$this->album->id)
            ->where('accepted','LIKE',AcceptanceStatus::NOT_DEFINED->value)
            ->count();

        if ($count===0) {
            return view('livewire.image-acceptance-no-images');
        }

        return view('livewire.image-acceptance');
    }
}