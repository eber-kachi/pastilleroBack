<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    //    relacion de uno a muchos
    public function members()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
