<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\User;
use App\Models\role;


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
        //dd($Artists);

        return view('Admin.Admin_Artist.index',['Artists' => $Artists]);


        /* AJAX TEST :  */

        /*if ($request->ajax()) {
                    $Artists = Artist::all();
                    return datatables()->of($Artists)
                        ->addColumn('Actions', function ($row) {
                            $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                            $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
                            return $html;
                        })->toJson();
                }
        
                return view('customers.index');
            }*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $Role = role::all()->where('idRole',2);
        //dd($Role);
        return view('Admin.Admin_Artist.create')->with('Role',$Role[1]->roleName);
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

        $Role = role::all()->where('idRole',2);

        $ImageName = time() . '-' . $request->fullName . '-' . $request->artistPic->guessClientExtension();  

        $request->artistPic->move(public_path('images'),$ImageName);        

        //dd($ImageName);

        //dd($request->all());
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'userName' => 'required | string | max:255',
            'artistName' => 'required | string | max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'Bio' => 'required',
            'password' => ['required', 'string', 'min:8'],
        ]);
        $Artists = Artist::create([
            'fullName' => $request->input('fullName'),
            'userName' => $request->input('userName'),
            'artistName' => $request->input('artistName'),
            'email' => $request->input('email'),
            'Bio' => $request->input('Bio'),

            'artistPic' => $ImageName,

        ]);

        $User = User::create([
            'name' => $request->input('fullName'),
            'email' => $request->input('email'),
            'role_id' => $Role[1]->idRole,
            'password' =>  Hash::make($request->input('password')),
        ]);
        

        return redirect('/admin/Artists');

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
    public function edit($idArtist)
    {
        $Role = role::all()->where('idRole',2);


        $Artist=Artist::where('idArtist',$idArtist)->first();
        //dd($Artist);
        return view('Admin.Admin_Artist.edit')
                ->with([
                    'artist'=>$Artist,
                    'Role' =>$Role[1]->roleName,
                ]);
                // artist as  $Artist

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idArtist)
    {
        Artist::pluck('email')[0];
        $email = Artist::where('idArtist',$idArtist)->get();
//
        $Artist=Artist::where('idArtist',$idArtist)->update([
            'fullName' => $request->input('fullName'),
            'userName' => $request->input('userName'),
            'artistName' => $request->input('artistName'),
            'email' => $request->input('email'),
            'Bio' => $request->input('Bio'),

            
        ]);

        
        //dd(strcmp(Artist::pluck('email')[0],$email));
        
        /*
        $User = User::where(strcmp(Artist::pluck('email')[0],$email))->update([
            'name' => $request->input('fullName'),
            'email' => $request->input('email'),
            'password' =>  Hash::make($request->input('password'))
        ]);*/

        return redirect('/admin/Artists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idArtist)
    {
        //dd($idArtist);
        $success= Artist::where('idArtist',$idArtist)->delete();
        //dd($success);
        return redirect('/admin/Artists');
    }
}
