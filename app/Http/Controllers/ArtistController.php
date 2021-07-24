<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(){
        return view('dashboard.artist.index');
    }

    public function profile(){
        return view('dashboard.artist.profile');
    }

    public function settings(){
        return view('dashboard.artist.settings');
    }
}
