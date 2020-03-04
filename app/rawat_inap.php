<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rawat_inap extends Model
{
    protected $fillable = ['id','no_kamar','id_perawat'];

    public function riwayat_pasiens(){
        return $this->hasMany(riwayat_pasien::class,'id_rawat_inap');
    }

    public function perawats(){
        return $this->belongsTo(perawat::class,'id_perawat');
    } 
}
