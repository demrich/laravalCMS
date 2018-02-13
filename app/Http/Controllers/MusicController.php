<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Music;

class MusicController extends Controller
{
    public function beatDonation() 
    {
        return view('beatdonation');
    }

    public function uploadBeatDonation(Request $request) 
    {
        request()->validate([
            'beat' => 'required',
            'title' => 'required', 
            'artist' => 'required',
        ]);

        $beatTitle = $request['title'];
        $beatArtist = $request['artist'];
        $beatAlbum = $request['album'];
        $beatPath = time().'.'.request()->beat->getClientOriginalExtension();

        request()->beat->move(public_path('storage/beat_donations'), $beatPath);


        /* Assigns to Database */  
        $beat = new Music();
        $beat->beatPath = $beatPath;
        $beat->title = $beatTitle;
        $beat->artist = $beatArtist;
        $beat->album = $beatAlbum;
        $beat->created_at = time();
        $beat->updated_at = time();
        $beat->save();

        return back()
            ->with('success','You have successfully uploaded a beat.');
    }
}
