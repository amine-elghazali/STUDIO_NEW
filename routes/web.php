<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([ 'prefix' => 'admin', 'middleware' => ['isAdmin','auth','PreventBackHistory']],function(){

    Route::get('/dashboard' ,[App\Http\Controllers\AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/profile' ,[App\Http\Controllers\AdminController::class,'profile'])->name('admin.profile');
    Route::get('/settings' ,[App\Http\Controllers\AdminController::class,'settings'])->name('admin.settings');


        Route::resource('/Artists',App\Http\Controllers\AdminArtists::class);
        Route::resource('/Albums', App\Http\Controllers\AdminAlbums::class);
        Route::resource('/Songs', App\Http\Controllers\AdminSongs::class);
        Route::get('/Songs/{idSong}/details',[App\Controllers\AdminSongs::class,'getOneSong']);

});


Route::group([ 'prefix' => 'artist', 'middleware' => ['isArtist','auth','PreventBackHistory']],function(){

    Route::get('dashboard' ,[App\Http\Controllers\ArtistController::class,'index'])->name('artist.dashboard');
    Route::get('profile' ,[App\Http\Controllers\ArtistController::class,'profile'])->name('artist.profile');
    Route::get('settings' ,[App\Http\Controllers\ArtistController::class,'settings'])->name('artist.settings');

});



