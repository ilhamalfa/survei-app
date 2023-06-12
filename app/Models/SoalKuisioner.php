<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKuisioner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function unsur(){
        return $this->belongsTo(Unsur::class);
    }

    public function kuisioner(){
        return $this->hasMany(Kuisioner::class);
    }

    public function jawabanUser(){
        return $this->hasMany(JawabanUser::class);
    }
}
