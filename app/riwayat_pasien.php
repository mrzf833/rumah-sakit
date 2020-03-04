<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riwayat_pasien extends Model
{
    protected $fillable = ['id','id_pasien','id_dokter','id_status_pengobatan','diagnosa_penyakit','id_rawat_inap'];
    
    public function pasiens(){
        return $this->belongsTo(pasien::class,'id_pasien');
    }

    public function dokters(){
        return $this->belongsTo(dokter::class,'id_dokter');
    }

    public function status_pengobatans(){
        return $this->belongsTo(status_pengobatan::class,'id_status_pengobatan');
    }

    public function rawat_inaps(){
        return $this->belongsTo(rawat_inap::class,'id_rawat_inap');
    }
}
