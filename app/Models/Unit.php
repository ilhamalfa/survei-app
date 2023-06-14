<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function survei(){
        return $this->hasMany(Survei::class);
    }

    public function layanan(){
        return $this->hasMany(Layanan::class);
    }
}
