<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\User;


class AdminArtists extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Artists = Artist::all();
        dd($Artists);

        //return view('Admin.Admin_Artist.index',['Artists' => $Artists]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Admin_Artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Artists = new Artist();

        $request->validate([
            'fullName' => 'required | string | max:255',
            'userName' => 'required | string | max:255',
            'artistName' => 'required | string | max:255',
            'email' => 'required | email |unique:artists | max:255',
            'bio' => 'required | email',

        ]);


        $Artists = Artist::create([
            'fullName' => $request->input('fullName'),
            'userName' => $request->input('userName'),
            'artistName' => $request->input('artistName'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
        ]);

        return redirect('/Artists');


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
        $Artist=Artist::find($id);
        dd($Artist);
        //return view('Admin.Admin_Artist.edit')->with('Artist',$Artist); // Artist as  $Artist

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
        $Artist=Artist::where('id',$id)->update([
            'fullName' => $request->input('fullName'),
            'userName' => $request->input('userName'),
            'artistName' => $request->input('artistName'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
        ]);

        return redirect('/Artists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Artist=Artist::find($id);
        dd($id);
        $Artist->delete();

        //return redirect('/Artists');
    }
}
