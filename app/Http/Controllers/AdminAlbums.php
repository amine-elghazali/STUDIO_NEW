<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;

class AdminAlbums extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Albums = Album::all();
        //$Artist = Artist::get()->where('$Albums->id_Artist','Artist->idArtist')->pluck('fullName');
        //dd($Albums);

        //dd($Albums);

        return view('Admin.Admin_Album.index',[
                'albums' => $Albums,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Artists = Artist::all();
        //dd($Artists);
        return view('Admin.Admin_Album.create')->with('Artists',$Artists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Albums = new Album();
        
        
        $ImageName = time() . '-' . $request->fullName . '-' . $request->albumPic->guessClientExtension();  

        $request->albumPic->move(public_path('images'),$ImageName);

        
        $request->validate([
            'id_Artist' => 'required',
            'albumName' => ['required', 'string', 'max:255', 'unique:albums'],
            'Bio' => 'required | string | max:255',
            'albumDate' => 'required | date',
        ]);


        $Albums = Album::create([
            'id_Artist' => $request->input('id_Artist'),
            'albumName' => $request->input('albumName'),
            'Bio' => $request->input('Bio'),
            'albumDate' => $request->input('albumDate'),

            'albumPic' => $ImageName,

        ]);
        
        return redirect('admin/Albums'); 

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
    public function edit($idAlbum)
    {
        $Artists = Artist::all();
        $Album=Album::where('idAlbum',$idAlbum)->first();
        //dd($Album);
        return view('Admin.Admin_Album.edit')
                ->with([
                    'album' => $Album,
                    'Artists' => $Artists,
                ]); // Album as  $Album
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $idAlbum)
    {

        //dd($request->input('id_Artist'));

        $request->validate([
            'id_Artist' => 'required',
            'albumName' => ['required', 'string', 'max:255'],
            'Bio' => 'required | string | max:255',
            'albumDate' => 'required | date',
        ]);

        $Album=Album::where('idAlbum',$idAlbum)->update([
            'id_Artist' => $request->input('id_Artist'),
            'albumName' => $request->input('albumName'),
            'Bio' => $request->input('Bio'),
            'albumDate' => $request->input('albumDate'),

            'albumtPic' => $request->file('albumtPic'),

        ]);
        
        return redirect('admin/Albums'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAlbum)
    {
        //dd($idAlbum);
        $Album=Album::where('idAlbum',$idAlbum)->delete();
        

        return redirect('admin/Albums');
    }
}
