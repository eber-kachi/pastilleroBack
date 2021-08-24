<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    //    relacion de uno a muchos
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
