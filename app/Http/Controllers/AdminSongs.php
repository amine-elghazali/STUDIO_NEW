<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

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
        dd($Songs);

        //return view('Admin.Admin_Song.index',['Songs' => $Songs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Admin_Song.create');
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

        $request->validate([
            'id_Album ' => 'required',
            'id_Artist ' => 'required',
            'name' => 'required | string | max:255',
            'Bio' => 'required | string | max:255',
            'fullName' => 'required | string | max:255',
            'path' => 'required | string',
            'extension' => 'required | string',
            'size' => 'required | float',
            'songDate' => 'required | Date',
        ]);


        $Songs = Song::create([
            'id_Album' => $request->input('id_Album'),
            'id_Artist' => $request->input('id_Artist'),
            'name' => $request->input('name'),
            'fullName' => $request->input('fullName'),
            'path' => $request->input('path'),
            'extension' => $request->input('extension'),
            'size' => $request->input('size'),
            'songDate' => $request->input('songDate'),
        ]);

        return redirect('/Songs');


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
        $Song=Song::find($id);
        dd($Song);
        //return view('Song.Admin_Song.edit')->with('Song',$Song); // Song as  $Song
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
        $Song=Song::where('id',$id)->update([
            'id_Album' => $request->input('id_Album'),
            'id_Artist' => $request->input('id_Artist'),
            'name' => $request->input('name'),
            'fullName' => $request->input('fullName'),
            'path' => $request->input('path'),
            'extension' => $request->input('extension'),
            'size' => $request->input('size'),
            'songDate' => $request->input('songDate'),
        ]);

        return redirect('/Songs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Song=Song::find($id);
        //dd($id);
        $success = $Song->delete();
        dd($success);
        //return redirect('/Songs');
    }
}
