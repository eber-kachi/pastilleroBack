<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    // concatenamos la url de la foto

    /**
     * @param $value
     * @return string
     * muta la db solo en ejecucuion
     */
    protected $appends = ['url_photo'];

    public function getUrlPhotoAttribute()
    {
        if (Str::contains($this->dir_photo, 'http')) {
            return $this->dir_photo;
        } else {
            return asset(Storage::url($this->dir_photo));
        }
    }
    /**
     *
     * cambia la db  cuando pasa por aqui
     */

//    public function setDirPhotoAttribute($value)
//    {
//        $this->attributes['dir_photo'] = Storage::url('file.jpg');
//    }


    //    relacion de uno a muchos
    public function parcels()
    {
        return $this->hasMany('App\Models\Parcel');
    }

//$url = Storage::url('file.jpg');


}
