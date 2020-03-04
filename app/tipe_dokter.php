<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipe_dokter extends Model
{
    protected $fillable = ['id','tp_dokter'];

    public function dokters(){
        return $this->hasMany(dokter::class,'id_tipe_dokter');
    }
}
