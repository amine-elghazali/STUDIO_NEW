<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $primaryKey = 'idRole';
    protected $fillable = ['roleName'];

    public function Permission (){
        return $this->belongsToMany(Permission::class);
    }

    public function User (){
        return $this->belongsTo(User::class);
    }
}
