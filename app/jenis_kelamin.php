<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_kelamin extends Model
{
    protected $fillable = ['id','jns_kelamin'];

    public function pasiens(){
        return $this->hasMany(pasien::class, 'id_jenis_kelamin');
    }

    public function perawats(){
        return $this->hasMany(perawat::class,'id_jenis_kelamin');
    }

    public function dokters(){
        return $this->hasMany(dokter::class,'id_jenis_kelamin');
    }
}
