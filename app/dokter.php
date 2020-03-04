<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    protected $fillable = ['id','nama','id_tipe_dokter','id_jenis_kelamin'];

    public function perawats(){
        return $this->hasMany(perawat::class, 'id_dokter');
    }

    public function riwayat_pasiens(){
        return $this->hasMany(riwayat_pasien::class, 'id_dokter');
    }

    public function tipe_dokters(){
        return $this->belongsTo(tipe_dokter::class, 'id_tipe_dokter');
    }

    public function jenis_kelamins(){
        return $this->belongsTo(jenis_kelamin::class, 'id_jenis_kelamin');
    }
}
