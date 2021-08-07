<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\User;
use App\Models\role;
use DataTables;

class AdminArtists extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Artists = Artist::get();

        if($request->ajax()){
            $allData = DataTables::of($Artists)
                        ->addIndexColumn()
                        ->addColumn('Picture', function ($Artists) { 
                            $url= asset('Images/'.$Artists->artistPic);
                            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" style="width:100%" />';
                                })
                        ->addColumn('action',function($Artists){
                            $btn = '<a href="javascript:void(0)"
                                        data-toggle="tooltip" 
                                        data-id="'.$Artists->idArtist.'" 
                                        data-original-title="Edit"  class="edit btn btn btn-outline-primary btn-sm ml-3 mt-3 editArtist">
                                       <i class="far fa-edit"></i>
                                    </a>'  ;   
                            $btn .= '<a href="javascript:void(0)"
                                data-toggle="tooltip" 
                                data-id="'.$Artists->idArtist.'" 
                                data-original-title="Delete"  class="delete btn btn-outline-danger btn-sm ml-3 mt-3 btn-light deleteArtist">
                                <i class="far fa-trash-alt"></i>
                            </a>'  ;   

                            return $btn;
                        })
                        
                        ->rawColumns(['action','Picture'])
                        ->make(true);

                        return $allData;
        }

        return view('Admin.Admin_Artist.index',compact('Artists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
      //  $Role = role::all()->where('idRole',2);
        //dd($Role);
      //  return view('Admin.Admin_Artist.create')->with('Role',$Role[1]->roleName);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       


        $request->validate([
            'fullName' => 'required | required ',
            'userName' => 'required | required ',
            'artistName' => 'required | required ',
            'email' => 'required | required | email',
            'Bio' => 'required | required ',
            'artistPic' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

          if($request->file('artistPic')){

            $image = $request->file('artistPic');


            $ImageName = time() . '-' . $request->fullName . '-' . $image->guessClientExtension();  

        
            $destinationPath = public_path('/Images');

            $image->move($destinationPath,$ImageName);
          }

     Artist::updateOrCreate(
        [
            'idArtist' => $request->idArtist
        ],

        [
            'fullName' => $request->fullName,
            'userName' => $request->userName,
            'artistName' => $request->artistName,
            'email' => $request->email,
            'Bio' => $request->Bio,
            'artistPic' => $ImageName,
        ]);


        /*User::updateOrCreate([
            [
                'email' => $request->email
            ],
            'name' => $request->fullName,
            'email' => $request->email,
            'role_id' => 2,
            'password' =>  Hash::make($request->password),
        ]);*/



        return response()->json(['success' => 'Artist Added Successfully']);

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
        $Artist = Artist::find($idArtist);

        return response()->json($Artist);
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
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idArtist)
    {

        $success = Artist::find($idArtist)->delete();

        return response()->json(['success'=> $success]);
    }
}
