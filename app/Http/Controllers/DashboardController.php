<?php

namespace App\Http\Controllers;
use App\Models\Album;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $album = Album::where('viewer_id','=',auth()->id())->get()->first();

        return view('dashboard',[
            'album' => $album,
        ]);
    }
}