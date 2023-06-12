<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanGanda extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jawabanUser(){
        return $this->hasMany(JawabanUser::class);
    }
}
