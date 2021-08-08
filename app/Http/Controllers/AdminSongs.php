<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use DataTables;

class AdminSongs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Songs = Song::all();
        $Artists= Artist::all();
        $Albums= Album::all();

        if($request->ajax()){
            $allData = DataTables::of($Songs)
                        ->addIndexColumn()
                        ->addColumn('Picture', function ($Songs) { 
                            $url= asset('Images/'.$Songs->songPic);
                            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" style="width:100%" />';
                                })
                        ->addColumn('Artist', function ($Songs) { 
                            $Artist= Artist::where('idArtist',$Songs->id_Artist)->value('fullName');
                            return $Artist;
                                })
                        ->addColumn('Album', function ($Songs) { 
                            $Album= Album::where('idAlbum',$Songs->id_Album)->value('albumName');
                            return $Album;
                                })
                        ->addColumn('action',function($Songs){
                            $btn = '<a href="javascript:void(0)"
                                        data-toggle="tooltip" 
                                        data-id="'.$Songs->idSong.'" 
                                        data-original-title="Edit"  data-mdb-ripple-color="dark" class="edit btn btn-outline-primary shadow btn-rounded editSong">
                                        <i class="far fa-edit"></i>
                                    </a>'  ;   
                            $btn .= '<a href="javascript:void(0)"
                                        data-toggle="tooltip" 
                                        data-id="'.$Songs->idSong.'" 
                                        data-original-title="Delete"  data-mdb-ripple-color="dark" class="delete btn btn-outline-danger shadow btn-rounded m-3 deleteSong">
                                        <i class="far fa-trash-alt"></i>
                                    </a>'  ;

                            return $btn;
                        })
                        ->addColumn('details',function($Songs){
                            $btnDetails =  '<a href="javascript:void(0)"
                                            data-toggle="tooltip" 
                                            data-id="'.$Songs->idSong.'" 
                                            data-original-title="Edit" data-mdb-ripple-color="dark" class="edit btn btn-outline-primary ml-3 mt-3 shadow detailSong">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </a>'  ;   
                            return $btnDetails;
                        })
                        
                        ->rawColumns(['action','Picture','Artist','Album','details'])
                        ->make(true);

                        return $allData;
        }

        return view('Admin.Admin_Song.index',compact('Songs','Albums','Artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'id_Album' => 'required',
            'id_Artist' => 'required',
            'name' => 'required | string | max:255',
            'Bio' => 'required | string | max:255',
            'songFile' => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac' ,
            'songPic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'songDate' => 'required | Date',
        ]);
        
        /* Song Pic */

        $ImageName = time() . '-' . $request->fullName . '-' . $request->songPic->guessClientExtension();  

        $request->songPic->move(public_path('images'),$ImageName);

        /* Song AUDIO */


        $audioName = time() . '-' . $request->fullName . '-' . $request->songFile->guessClientExtension(); 

        $size = $request->songFile->getSize();

        $path = $request->songFile->move(public_path('musics'),$audioName);

        //dd($path);

/*
        $songFile = $request->file('songFile');

        $fileName = $request->file('songFile')->getClientOriginalName();

        $location = public_path('musics/'.$fileName);
*/
        $Songs = Song::updateOrCreate(
          
            [
            'id_Artist' => $request->id_Artist,
            'id_Album' => $request->id_Album,

            'name' => $request->name,
            'Bio' => $request->Bio,
            
            'songFile' => $audioName,
            'fullName' => $request->file('songFile')->getClientOriginalName(),
            'extension' => $request->file('songFile')->getClientOriginalExtension(),
            'size'=> $size,
            'path' => $path,
            
            'songDate' => $request->songDate,

            'songPic' => $ImageName,
        ]);

        return response()->json(['success' => 'Song Added Successfully']);

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

        $Song = Song::find($idSong);
       
        return response()->json($Song);
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
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSong)
    {
        
        $success=Song::find($idSong)->delete();
        
        return response()->json(['success'=> $success]);
    }

    
    public function getOneSong($idSong){
        $songDetail = Song::find($idSong);

        return response()->json($songDetail);
    }

}
