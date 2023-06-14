<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JawabanGanda;
use App\Models\JawabanUser;
use App\Models\Kuisioner;
use App\Models\Layanan;
use App\Models\Responden;
use App\Models\SoalKuisioner;
use App\Models\Survei;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function landingPage(){
        $units = Unit::has('layanan')->get();
        $jawabanUsers = JawabanUser::all();

        $ranking = array();
        $i = 0;

        foreach($units as $unit){
            for($a = 1; $a <= 9; $a++){
                $jawabans[$unit->nama_unit][$a] = 0.0;
                $hasilAkhir[$unit->nama_unit][$a] = 0.0;
                $jml_survei[$unit->id] = 0;
                $NRR[$unit->nama_unit] = 0.0;
            }
        }

        foreach($jawabanUsers as $jwb){
            $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] += $jwb->jawabanGanda->bobot;
            
            $hasilAkhir[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] = $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] / count(Survei::where('unit_id', $jwb->survei->unit_id)->get());
            
            $NRR[$jwb->survei->unit->nama_unit] =  array_sum($hasilAkhir[$jwb->survei->unit->nama_unit])/count(SoalKuisioner::all());
        }

        // dd($jawabans);

        foreach ($units as $unit) {
            $ranking[$i] = [
                'unit' => $unit->nama_unit,
                'ikm' => $NRR[$unit->nama_unit] * 25,
            ];

            $i++;
        }

        $sorted_rankings = collect($ranking)->sortByDesc('ikm');

        // dd($sorted_rankings);

        return view('responden.landing-page', [
            'sorted_rankings' => $sorted_rankings
        ]);
    }

    public function index(){
        $units = Unit::all();
        $jawabanUsers = JawabanUser::all();
        $jml_soal = count(SoalKuisioner::all());
        // $jml_survei = Survei::all();

        // Inisialisasi
        foreach($units as $unit){
            for($i = 1; $i <= 9; $i++){
                $jawabans[$unit->nama_unit][$i] = 0.0;
                $hasilAkhir[$unit->nama_unit][$i] = 0.0;
                $jml_survei[$unit->id] = 0;
                $NRR[$unit->nama_unit] = 0.0;
            }
        }

        foreach($jawabanUsers as $jwb){
            $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] = $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] + $jwb->jawabanGanda->bobot;
        }

        foreach($jawabanUsers as $jwb){
            // dd(count($jwb));
            $jml_jwb[$jwb->survei->unit_id] = count(Survei::where('unit_id', $jwb->survei->unit_id)->get());
            // dd($jml_jwb);
            $hasilAkhir[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] = $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] / $jml_jwb[$jwb->survei->unit_id];
        }

        foreach($jawabanUsers as $jwb){
            $NRR[$jwb->survei->unit->nama_unit] =  array_sum($hasilAkhir[$jwb->survei->unit->nama_unit])/$jml_soal;
        }

        // dd($hasilAkhir, $NRR);
        
        // dd($hasilAkhir);

        return view('responden.landing-page', [
            'hasil_akhir' => $hasilAkhir,
            'units' => $units,
            'NRR' => $NRR
        ]);
    }

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
