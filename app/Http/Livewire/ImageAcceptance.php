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
        if (Image::where('album_id','=',$this->album->id)
            ->where('accepted','LIKE',AcceptanceStatus::NOT_DEFINED->value)
            ->count() === 0)
        {
            return view('livewire.image-acceptance-no-images');
        }

        $this->image = Image::where('album_id','=',$this->album->id)
            ->where('accepted','LIKE',AcceptanceStatus::NOT_DEFINED->value)
            ->first();

        return view('livewire.image-acceptance');
    }

    public function accept()
    {
        $this->image->accepted = AcceptanceStatus::ACCEPTED->value;
        $this->image->save();
    }

    public function reject()
    {
        $this->image->accepted = AcceptanceStatus::REJECTED->value;
        $this->image->save();
    }

}