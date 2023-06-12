<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jawabanGanda(){
        return $this->belongsTo(JawabanGanda::class, 'jawaban_ganda_id');
    }

    public function SoalKuisioner(){
        return $this->belongsTo(SoalKuisioner::class, 'soal_kuisioner_id');
    }

    public function survei(){
        return $this->belongsTo(Survei::class);
    }
}
