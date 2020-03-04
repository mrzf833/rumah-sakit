<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    protected $fillable = ['id','nama','alamat','no_hp','id_jenis_kelamin'];

    public function riwayat_pasiens(){
        return $this->hasMany(riwayat_pasien::class,'id_pasien');
    }

    public function jenis_kelamins(){
        return $this->belongsTo(jenis_kelamin::class,'id_jenis_kelamin');
    }
}
