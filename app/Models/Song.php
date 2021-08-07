<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Song extends Model
{
    use HasFactory;

    protected $primaryKey = 'idSong';

    protected $fillable = ['id_Album','id_Artist','name','Bio','songDate','songFile','fullName','path','extension','size','songPic'];

    public function Album (){
        return $this->belongsTo(Album::class);
    }

    public function Artist (){
        return $this->belongsTo(Artist::class);
    }
}
