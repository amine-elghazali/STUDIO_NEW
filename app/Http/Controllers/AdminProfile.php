<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Role;


class AdminProfile extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(auth::user()->idUser);
        //dd($user);
            $id = $user->role_id;
            $roleName = Role::where('idRole',$id)->pluck('roleName');
            //dd($user);
        if($request->ajax()){ 
            
            return response()->json([
                                'user'=>$user,
                                'roleName'=>$roleName
                            ]);
            }

        return view('Admin.Admin_Profile.index',compact('user','roleName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required | required ',
            'email' => 'required | required | email',
            'password' => ['required','min:8','string',],   // must be at least 8 characters in length
            'confirmpass' => 'required|same:password|min:8'
        ]);


        /* 
            
            'password' => [

                        'required',

                        'string',

                        'min:6',

                    'max:12',             // must be at least 8 characters in length

                    ],

                'confirm_password' => 'required|same:password|min:6'

        */ 

        User::update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ])->where('idUser',auth::user()->id);
    
    
            /*User::updateOrCreate([
                [
                    'email' => $request->email
                ],
                'name' => $request->fullName,
                'email' => $request->email,
                'role_id' => 2,
                'password' =>  Hash::make($request->password),
            ]);*/
    
    
            return response()->json(['success' => 'User updated Successfully']);

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
        //
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
        //

        $request->validate([
            'name' => 'required | required ',
            'email' => 'required | required | email',
            'password' => ['required','min:8','string',],   // must be at least 8 characters in length
            'confirmpass' => 'required|same:password|min:8'
        ]);


        /* 
            
            'password' => [

                        'required',

                        'string',

                        'min:6',

                    'max:12',             // must be at least 8 characters in length

                    ],

                'confirm_password' => 'required|same:password|min:6'

        */ 

        User::update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ])->where('idUser',auth::user()->id);
    
    
            /*User::updateOrCreate([
                [
                    'email' => $request->email
                ],
                'name' => $request->fullName,
                'email' => $request->email,
                'role_id' => 2,
                'password' =>  Hash::make($request->password),
            ]);*/
    
    
            return response()->json(['success' => 'User updated Successfully']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
