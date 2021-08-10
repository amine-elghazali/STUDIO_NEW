<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class   AdminController extends Controller
{
    public function index(){
        return view('dashboard.admin.index');
    }

    public function profile(){

        $user = User::find(auth::user()->idUser);

        return response()->json([
            'user' => $user,
        ]);    
    }

    public function settings(){
        return view('dashboard.admin.settings');
    }
}
