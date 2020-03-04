<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_pengobatan extends Model
{
    protected $fillable = ['id','status'];

    public function riwayat_pasiens(){
        return $this->hasMany(riwayat_pasien::class,'id_status_pengobatan');
    }
}
