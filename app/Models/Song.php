<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Song extends Model
{
    use HasFactory;

    protected $fillable = ['name','bio','songDate','fullName','path','ex','size'];

    public function Album (){
        return $this->belongsTo(Album::class);
    }

    public function Artist (){
        return $this->belongsTo(Artist::class);
    }
}
