<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\JawabanUser;
use App\Models\Kuisioner;
use App\Models\Layanan;
use App\Models\SoalKuisioner;
use App\Models\Survei;
use App\Models\Unit;
use App\Models\Unsur;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    // 1. Start (Profil Unit)

    public function profil_unit(){
        if(Auth::user()->role == 'operator'){
            $data = User::find(Auth::user()->id);

            if($data->unit != NULL){
                $datas = Layanan::where('unit_id', $data->unit->id)->get();
                // dd($datas);
                return view('operator.profil-unit', [
                    'data' => $data,
                    'datas' => $datas
                ]);
            }else{
                return view('operator.profil-unit', [
                    'data' => $data
                ]);
            }
            // dd($data);
        }else{
            return redirect('daftar-unit');
        }
    }

    public function store_profil_unit(Request $request){
        $validate = $request->validate([
            'foto_kepala_unit' => 'required|image',
            'nama_unit' => 'required|unique:units',
            'nomor_telp_unit' => 'required|unique:units',
            'email_unit' => 'required|unique:units',
            'penanggung_jawab_layanan' => 'required',
            'alamat' => 'required'
        ]);

        $extension = $request->file('foto_kepala_unit')->extension();
        $nama_gambar = $request->nama_unit . '-' . now()->timestamp. '.' . $extension;
        $validate['foto_kepala_unit'] = $request->file('foto_kepala_unit')->storeAs('Foto Kepala Unit', $nama_gambar);

        Unit::create($validate);

        $data = Unit::where('nomor_telp_unit', $request->nomor_telp_unit)->first();

        $operator = User::find(Auth::user()->id);
        
        $operator->update([
            'unit_id' => $data->id
        ]);

        return redirect()->back();
    }

    public function update_profil_unit($id, Request $request){
        $data = Unit::find($id);

        if(isset($request->foto_kepala_unit)){
            if($request->no_telp_unit == $data->no_telp_unit || $request->email_unit == $data->email_unit || $request->nama_unit == $data->nama_unit){
                $validate = $request->validate([
                    'foto_kepala_unit' => 'required|image',
                    'nama_unit' => 'required',
                    'nomor_telp_unit' => 'required',
                    'email_unit' => 'required',
                    'penanggung_jawab_layanan' => 'required',
                    'alamat' => 'required'
                ]);
            }else{
                $validate = $request->validate([
                    'foto_kepala_unit' => 'required|image',
                    'nama_unit' => 'required|unique:units',
                    'nomor_telp_unit' => 'required|unique:units',
                    'email_unit' => 'required|unique:units',
                    'penanggung_jawab_layanan' => 'required',
                    'alamat' => 'required'
                ]);
            }

            if(is_file('storage/' . $data->foto_kepala_unit)){
                unlink('storage/' . $data->foto_kepala_unit);
            }

            $extension = $request->file('foto_kepala_unit')->extension();
            $nama_gambar = $request->nama_unit . '-' . now()->timestamp. '.' . $extension;
            $validate['foto_kepala_unit'] = $request->file('foto_kepala_unit')->storeAs('Foto Kepala Unit', $nama_gambar);
        }else{
            if($request->no_telp_unit == $data->no_telp_unit || $request->email_unit == $data->email_unit || $request->nama_unit == $data->nama_unit){
                $validate = $request->validate([
                    'nama_unit' => 'required',
                    'nomor_telp_unit' => 'required',
                    'email_unit' => 'required',
                    'penanggung_jawab_layanan' => 'required',
                    'alamat' => 'required'
                ]);
            }else{
                $validate = $request->validate([
                    'nama_unit' => 'required|unique:units',
                    'nomor_telp_unit' => 'required|unique:units',
                    'email_unit' => 'required|unique:units',
                    'penanggung_jawab_layanan' => 'required',
                    'alamat' => 'required'
                ]);
            }
        }

        $data->update($validate);

        return redirect()->back();
    }

    // End (Profil Unit)

    // Layanan
    public function store_jenis_layanan(Request $request){
        $validate = $request->validate([
            'nama_layanan' => 'required',
            'unit_id' => 'required'
        ]);

        $insert = Layanan::create($validate);

        $datas = SoalKuisioner::where('is_default', true)->get();
        $bobot = round(1 / count($datas), 2);

        // dd(round(1 / count($datas), 2));
        foreach($datas as $data){
            if($data->id == 1 || $data->id == 5){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 1,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 2){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 2,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 3){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 3,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 4){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 4,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 6){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 5,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 7 || $data->id == 8){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 6,
                    'layanan_id' => $insert->id 
                ]);
            }else if($data->id == 9){
                Kuisioner::create([
                    'bobot' => $bobot,
                    'soal_kuisioners_id' => $data->id,
                    'jawaban_id' => 7,
                    'layanan_id' => $insert->id 
                ]);
            }
        }

        return redirect()->back();
    }

    public function update_jenis_layanan($id, Request $request){
        $data = Layanan::find($id);

        $validate = $request->validate([
            'nama_layanan' => 'required',
            'unit_id' => 'required'
        ]);

        $data->update($validate);

        return redirect()->back();
    }

    // End Layanan


    // End Komponen Master
    public function master_komponen(){
        $jawabans = Jawaban::all();
        $unsurs = Unsur::all();
        $kuisioners = SoalKuisioner::all();

        return view('operator.master-komponen', [
            'jawabans' => $jawabans,
            'unsurs' => $unsurs,
            'kuisioners' => $kuisioners
        ]);
    }
    // End Komponen Master

    public function menu_survei(){
        if(Auth::user()->role == 'admin'){
            return redirect('data-survei/daftar-unit');
        }

        $unit = Unit::find(Auth::user()->unit_id);
        $surveis = Survei::where('unit_id', Auth::user()->unit_id)->get();
        $soal = SoalKuisioner::all();
        // $jawabanusers = JawabanUser::whereRelation('survei','unit_id',Auth::user()->unit_id)->get();
        $hasilJawaban = array();

        $i = 0;
        $a = 0;

        for($b = 0; $b < 9; $b++){
            $jumlahNilai[$b] = 0.0;
            $NRR[$b] = 0.0;
            $NRR_Tertimbang[$b] = 0.0;
        }

        foreach($surveis as $survei){
            $jawabans = JawabanUser::where('survei_id', $survei->id)->get();

            foreach($jawabans as $jawaban){
                $hasilJawaban[$i][$a] = $jawaban->jawabanGanda->bobot;
                $jumlahNilai[$a] += $hasilJawaban[$i][$a];
                $NRR[$a] = $jumlahNilai[$a]/count($surveis);
                $NRR_Tertimbang[$a] = $NRR[$a]/count($soal);
                $a++;

                if($a == 9){
                    $a = 0;
                }
            }
            // dd($jawabans->jawabanGanda->bobot);
            $i++;
        }

        // dd($hasilJawaban);

        if(array_sum($NRR_Tertimbang) * 25 >= 25.00 && array_sum($NRR_Tertimbang) * 25 <= 64.99){
            $mutu = 'D';
            $kinerja = 'Tidak Baik';
        }else if(array_sum($NRR_Tertimbang) * 25 >= 65.00 && array_sum($NRR_Tertimbang) * 25 <= 76.60){
            $mutu = 'C';
            $kinerja = 'Kurang Baik';
        }else if(array_sum($NRR_Tertimbang) * 25 >= 76.61 && array_sum($NRR_Tertimbang) * 25 <= 88.30){
            $mutu = 'B';
            $kinerja = 'Baik';
        }else if(array_sum($NRR_Tertimbang) * 25 >= 88.31 && array_sum($NRR_Tertimbang) * 25 <= 100.00){
            $mutu = 'A';
            $kinerja = 'Sangat Baik';
        }

        // dd(array_sum($NRR_Tertimbang));
        return view('operator.menu-hasil-survei', [
            'unit' => $unit,
            'jawabans' => $hasilJawaban,
            'jumlahNilai' => $jumlahNilai,
            'jumlah_soal' => count($soal),
            'NRRs' => $NRR,
            'NRR_Tertimbang' => $NRR_Tertimbang,
            'jml_NRR' => array_sum($NRR_Tertimbang),
            'mutu' => $mutu,
            'kinerja' => $kinerja
        ]);
    }

    public function perbulan(){
        $unit = Unit::find(Auth::user()->unit_id);
        $surveis = Survei::where('unit_id', Auth::user()->unit_id)->get();
        $hasil = array();
        $hasil1 = array();
        $unsurs = Unsur::all();

        $i = 0;
        $a = 0;

        for($z = 1; $z <= 12; $z++){
            $months[$z] = DateTime::createFromFormat('!m', $z)->format('F');

            $skm_unit[$z] = 0.0;
            $nilai_skm[$z] = 0.0;
            $jumlah_responden[$z] = 0.0;

            for($x = 0; $x < 9; $x++){
                $hasil_perbulan[$z][$x] = 0.0;
                $hasil_perbulan1[$x][$z] = 0.0;
                $jumlah_perbulan[$x] = 0.0;
            }
        }

        // dd(date("n", strtotime('m')));
        $this_month = date("n", strtotime('m'));

        foreach($surveis as $survei){
            $bulan = date('n', strtotime($survei->tanggal));
            $jawabans = JawabanUser::where('survei_id', $survei->id)->get();
            $jml_resp = count(Survei::where('unit_id', Auth::user()->unit_id)->whereMonth('tanggal', $bulan)->get());
            
            foreach($jawabans as $jawaban){

                $hasil[$i][$a] = $jawaban->jawabanGanda->bobot;
                $hasil_perbulan[$bulan][$a] += $hasil[$i][$a]/$jml_resp;

                $skm_unit[$bulan] = array_sum($hasil_perbulan[$bulan]) / 9;
                $nilai_skm[$bulan] = $skm_unit[$bulan] * 25;

                $hasil1[$a][$bulan] = $jawaban->jawabanGanda->bobot;
                $hasil_perbulan1[$a][$bulan] += $hasil[$i][$a]/$jml_resp;
                $jumlah_perbulan[$a] = array_sum($hasil_perbulan1[$a])/$this_month;

                $a++;

                if($a == 9){
                    $a = 0;
                }
            }
            
            $jumlah_responden[$bulan] += 1;
            $i++;
            // dd(date('n', strtotime($survei->tanggal)));
            // if()
        }

        // dd($total_skm);

        $a = 0;
        $i = 0;
        
        $total_skm = array_sum($skm_unit)/$this_month;
        $total_nilai_skm = (array_sum($skm_unit)*25)/$this_month;
        $total_responden = array_sum($jumlah_responden);

        // dd($hasil, $hasil_perbulan, $jumlah_perbulan);

        return view('operator.menu-hasil-perbulan', [
            'unit' =>$unit,
            'unsurs' => $unsurs,
            'bulans' => $months,
            'hasil_perbulan' => $hasil_perbulan,
            'skm_units' =>$skm_unit,
            'nilai_skm' => $nilai_skm,
            'jumlah_responden' => $jumlah_responden,
            'jml_perbulan' => $jumlah_perbulan,
            'total_skm' => $total_skm,
            'total_nilai_skm' => $total_nilai_skm,
            'total_responden' => $total_responden
        ]); 
    }
}
