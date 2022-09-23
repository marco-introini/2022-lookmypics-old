<?php

namespace App\Jobs;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Log;

class MultiUploadAlbumJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Album $album)
    {
    }

    public function handle()
    {
        Log::info("Adding multiple images in album ".$this->album->name);

        foreach (Storage::disk('upload')->files() as $file){
            Log::info('File found: '.$file);
            $newFileName = uniqid(). '.' .File::extension($file);
            Storage::disk('public')->put(
                'images/'.$newFileName,
                Storage::disk('upload')->get($file));
            Storage::disk('upload')->delete($file);
            $imageName = pathinfo($file,PATHINFO_FILENAME);
            Image::create([
               "name" => $imageName,
                "description" => " TO DO",
                "album_id" => $this->album->id,
                "image_file_name" => $file,
                "image" => 'images/'.$newFileName,
            ])->save();
        }

        Log::info("Job done for album ".$this->album->name);
    }
}