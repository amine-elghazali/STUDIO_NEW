<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

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
        dd($Albums);

        //return view('Admin.Admin_Album.index',['Albums' => $Albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Admin_Album.create');
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

        $request->validate([
            'id_Artist' => 'required',
            'albumName' => 'required | string | max:255',
            'Bio' => 'required | string | max:255',
            'albumDate' => 'required | Date',
        ]);


        $Albums = Album::create([
            'id_Artist' => $request->input('id_Artist'),
            'albumName' => $request->input('albumName'),
            'Bio' => $request->input('Bio'),
            'albumDate' => $request->input('albumDate'),
        ]);

        return redirect('/Albums');

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
    public function edit($id)
    {
        $Album=Album::find($id);
        dd($Album);
        //return view('Album.Admin_Album.edit')->with('Album',$Album); // Album as  $Album
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
        $Album=Album::where('id',$id)->update([
            'id_Artist' => $request->input('id_Artist'),
            'albumName' => $request->input('albumName'),
            'Bio' => $request->input('Bio'),
            'albumDate' => $request->input('albumDate'),
        ]);

        return redirect('/Albums');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Album=Album::find($id);
        dd($id);
        $Album->delete();

        //return redirect('/Albums');
    }
}
