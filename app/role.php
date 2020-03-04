<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class role extends Model
{
    protected $fillable = ['id','nama'];

    public function users(){
        return $this->hasMany(User::class,'id_role');
    }
}
