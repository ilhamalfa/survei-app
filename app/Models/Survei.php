<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function responden(){
        return $this->belongsTo(Responden::class);
    }

    public function layanan(){
        return $this->belongsTo(Layanan::class);
    }

    public function jawabanUser(){
        return $this->hasMany(JawabanUser::class);
    }
}
