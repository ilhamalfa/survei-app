<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JawabanGanda;
use App\Models\JawabanUser;
use App\Models\Kuisioner;
use App\Models\Layanan;
use App\Models\Responden;
use App\Models\Survei;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function form_survey(){
        $units = Unit::all();

        return view('responden.survey', [
            'units' => $units
        ]);
    }

    public function getLayanan(Request $request){
        $id_unit = $request->id_unit;

        $datas = Layanan::where('unit_id', $id_unit)->get();

        foreach($datas as $data) {
            echo "<option value='$data->id'>$data->nama_layanan</option>";
        }
    }

    public function storeResponden(Request $request){
        // dd($request);
        $validate = $request->validate([
            'nama' => 'required',
            'usia' => 'required', 
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'nomor_telp' => 'required',
        ]);
        
        $insert = Responden::create($validate);
        
        $datas = Kuisioner::where('layanan_id', $request->layanan_id)->get();

        $responden = Responden::find($insert->id);

        return view('responden.form-survey', [
            'unit_id' => $request->unit_id,
            'layanan_id' => $request->layanan_id,
            'datas' => $datas,
            'responden' => $responden
        ]);
        // dd($datas);
    }

    public function storeSurvei(Request $request){
        // dd($request->soal[0]);
        $insert = Survei::create([
            'kritik_saran' => $request->kritik_saran,
            'responden_id' => $request->responden_id,
            'unit_id' => $request->unit_id,
            'layanan_id' => $request->layanan_id,
            'tanggal' => Carbon::now()
        ]);

        $jadi = 0.0;
        $i = 1;
        foreach($request->jawaban as $jawaban){
            $hasil = JawabanGanda::find($jawaban);

            $jadi = $jadi + $hasil->bobot;

            JawabanUser::create([
                'survei_id' => $insert->id,
                'soal_kuisioners_id' => $i,
                'jawaban_ganda_id' => $jawaban
            ]);

            $i++;
        }

        $insert->update([
            'nilai' => round($jadi/count($request->jawaban), 2)
        ]);

        return redirect('/');
        // dd($request);
    }
}
