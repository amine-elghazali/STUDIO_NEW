<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;
use DataTables;


class AdminAlbums extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Albums = Album::get();
        
        $Artists = Artist::all();

        if($request->ajax()){
            $allData = DataTables::of($Albums)
                        ->addIndexColumn()
                        ->addColumn('Picture', function ($Albums) { 
                            $url= asset('Images/'.$Albums->albumPic);
                            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" style="width:100%" />';
                                })
                        ->addColumn('Artist', function ($Albums) { 
                            $Artist= Artist::where('idArtist',$Albums->id_Artist)->value('fullName');
                            return $Artist;
                                })
                        ->addColumn('action',function($Albums){
                            $btn = '<a href="javascript:void(0)"
                                        data-toggle="tooltip" 
                                        data-id="'.$Albums->idAlbum.'" 
                                        data-original-title="Edit"  class="edit btn btn-outline-primary btn-sm ml-3 mt-3 editAlbum">
                                        <i class="far fa-edit"></i>
                                    </a>'  ;   
                            $btn .= '<a href="javascript:void(0)"
                                        data-toggle="tooltip" 
                                        data-id="'.$Albums->idAlbum.'" 
                                        data-original-title="Delete"  class="delete btn btn-outline-danger btn-sm ml-3 mt-3 deleteAlbum">
                                        <i class="far fa-trash-alt"></i>
                                    </a>'  ;   

                            return $btn;
                        })
                        
                        ->rawColumns(['action','Picture','Artist'])
                        ->make(true);

                        return $allData;
        }

        return view('Admin.Admin_Album.index',compact('Albums','Artists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      /*  $Artists = Artist::all();
        //dd($Artists);
        return view('Admin.Admin_Album.create')->with('Artists',$Artists);*/
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
            'id_Artist' => 'required',
            'albumName' => ['required', 'string', 'max:255'],
            'Bio' => 'required | string | max:255',
            'albumDate' => 'required | date',
            'albumPic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $image = $request->file('albumPic');


        $ImageName = time() . '-' . $request->albumName . '-' . $image->guessClientExtension();  

  
        $destinationPath = public_path('/Images');

        $image->move($destinationPath,$ImageName);



        $Albums = Album::updateOrCreate(
            [
                'idAlbum' => $request->idAlbum
            ],
            [
            'id_Artist' => $request->id_Artist,
            'albumName' => $request->albumName,
            'Bio' => $request->Bio,
            'albumDate' => $request->albumDate,

            'albumPic' => $ImageName,

        ]);
        
        return response()->json(['success' => 'Album Added Successfully']);


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
        $Album = Album::find($idAlbum);

        return response()->json($Album);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAlbum)
    {
        $success = Album::find($idAlbum)->delete();

        return response()->json(['success'=> $success]);
    }
}
