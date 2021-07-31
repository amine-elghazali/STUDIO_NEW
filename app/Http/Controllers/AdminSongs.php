<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;


class AdminSongs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Songs = Song::all();
        //dd($Songs);

        return view('Admin.Admin_Song.index',['songs' => $Songs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Admin_Song.create')
                ->with([
                    'Artists' => Artist::all(),
                    'Albums' => Album::all()
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Songs = new Song();


/*
        $request->validate([
            'id_Album ' => 'required',
            'id_Artist ' => 'required',
            'name' => 'required | string | max:255',
            'Bio' => 'required | string | max:255',
            //'songFile' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac' ,
            //'file' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac' ,
            //'fullName' => 'required | string | max:255',
            //'path' => 'required | string',
            //'extension' => 'required | string',
            //'size' => 'required | float',
            'songDate' => 'required | Date',
        ]);*/
        

        //dd($request);
        /*if( $request->hasFile('file')){
            $Songs = Song::create([
                'id_Album' => $request->input('id_Album'),
                'id_Artist' => $request->input('id_Artist'),
                'name' => $request->input('name'),
                'Bio' => $request->input('Bio'),
                
                'fullName' => $request->file('file')->getClientOriginalName(),
                'extension' => $request->file('songFile')->getClientOriginalExtension(),
                'size' => $request->file('songFile')->getSize(),
                //'path' => url('/storage/upload/files/audio'.'fullName';)
                //'file' => $request->file('songFile'),

            ]);
        }*/
       // dd($request->input('id_Album'));
      //  dd($Songs);

        $songFile = $request->file('songFile');

        $fileName = $request->file('songFile')->getClientOriginalName();

        $location = public_path('Musics/'.$fileName);

        $Songs = Song::create([

            'id_Artist' => $request->input('id_Artist'),
            'id_Album' => $request->input('id_Album'),

            'name' => $request->input('name'),
            'Bio' => $request->input('Bio'),
            
            'songFile' => $request->file('songFile'),
            'fullName' => $request->file('songFile')->getClientOriginalName(),
            'extension' => $request->file('songFile')->getClientOriginalExtension(),
            'size'=> $request->file('songFile')->getSize(),
            'path' => $request->file('songFile')->store($location),
            
            //$audioFile => $request->file('songFile'),
            //'fullName' => $audioFile->getClientOriginalName(),
            //'extension' => $audioFile->getClientOriginalExtension(),
            //'size' => $audioFile->getSize(),

            //'fullName' => $request->input('fullName'),

            //'path' => $request->input('path'),
            //'extension' => $request->input('extension'),
            //'size' => $request->input('size'),
            'songDate' => $request->input('songDate'),
        ]);
          dd($Songs);
        //return redirect('/Songs');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idSong)
    {

        $Song = Song::where('idSong',$idSong)->first();
       
        //dd($Song);

        return view('Admin.Admin_Song.edit')->with('Song',$Song); // Song as  $Song
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'id_Album ' => 'required',
            'id_Artist ' => 'required',
            'name' => 'required | string | max:255',
            'Bio' => 'required | string | max:255',
        ]);

        $Song=Song::where('idSong',$idSong)->update([
            
            'id_Artist' => $request->input('id_Artist'),
            'id_Album' => $request->input('id_Album'),

            'name' => $request->input('name'),
            'Bio' => $request->input('Bio'),
        ]);

        return redirect('/Songs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSong)
    {
        //dd($idSong);
        $success=Song::where('idSong',$idSong)->delete();
        //dd($success);
        return redirect('/admin/Songs');
    }
}
