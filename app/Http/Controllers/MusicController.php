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
        $beatPath = request()->beat->getClientOriginalName();

        request()->beat->move(public_path('storage/beat_donations'), $beatPath);


        /* Assigns to Database */  
        $beat = new Music();
        $beat->beatPath = $beatPath;
        $beat->title = $beatTitle;
        $beat->artist = $beatArtist;
        $beat->album = 'Donation';
        $beat->created_at = time();
        $beat->updated_at = time();
        $beat->save();

        return back()
            ->with('success','You have successfully uploaded a beat.');
    }
}
