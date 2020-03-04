<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perawat extends Model
{
    protected $fillable = ['id','nama','id_dokter','id_jenis_kelamin'];
    
    public function rawat_inaps(){
        return $this->hasMany(rawat_inap::class,'id_perawat');
    }

    public function dokters(){
        return $this->belongsTo(dokter::class,'id_dokter');
    }

    public function jenis_kelamins(){
        return $this->belongsTo(jenis_kelamin::class,'id_jenis_kelamin');
    }
}
