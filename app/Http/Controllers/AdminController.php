<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\JawabanGanda;
use App\Models\JawabanUser;
use App\Models\SoalKuisioner;
use App\Models\Survei;
use App\Models\Unit;
use App\Models\Unsur;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 1. Start (Pengaturan Akun)
    public function pengaturan_akun(){
        $datas = User::where('role', '!=', 'admin')->get();
        
        return view('admin.pengaturan-akun', [
            'datas' => $datas
        ]);
    }

    public function store_operator(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'nomor_telp' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $validate['role'] = 'operator';
        $validate['password'] = Hash::make($request->password);

        User::create($validate);

        return redirect()->back();
    }

    public function update_operator($id, Request $request){
        $data = User::find($id);

        if(isset($request->password)){
            if($request->no_telp == $data->no_telp || $request->email == $data->email || $request->username == $data->username){
                $validate = $request->validate([
                    'name' => 'required',
                    'nomor_telp' => 'required',
                    'email' => 'required|email',
                    'username' => 'required',
                    'password' => 'required|min:8|confirmed'
                ]);
            }else{
                $validate = $request->validate([
                    'name' => 'required',
                    'nomor_telp' => 'required|unique:users',
                    'email' => 'required|unique:users|email',
                    'username' => 'required|unique:users',
                    'password' => 'required|min:8|confirmed'
                ]);
            }
            $validate['password'] = Hash::make($request->password);
        }else{
            if($request->no_telp == $data->no_telp || $request->email == $data->email || $request->username == $data->username){
                $validate = $request->validate([
                    'name' => 'required',
                    'nomor_telp' => 'required',
                    'email' => 'required|email',
                    'username' => 'required',
                ]);
            }else{
                $validate = $request->validate([
                    'name' => 'required',
                    'nomor_telp' => 'required|unique:users',
                    'email' => 'required|unique:users|email',
                    'username' => 'required|unique:users',
                ]);
            }
        }

        $data->update($validate);

        return redirect()->back();
    }

    // 1. End (Pengaturan Akun)

    // 2. Start (Unsur)

    public function store_unsur(Request $request){
        $validate = $request->validate([
            'unsur_skm' => 'required'
        ]);

        Unsur::create($validate);

        return redirect()->back();
    }

    public function update_unsur($id, Request $request){
        $data = Unsur::find($id);

        $validate = $request->validate([
            'unsur_skm' => 'required'
        ]);

        $data->update($validate);

        return redirect()->back();
    }

    // 2. End (Unsur)

    // 3. Start Jawaban 

    public function store_jawaban(Request $request){
        // dd($request->jawaban[0]);
        $validate1 = $request->validate([
            'jenis_jawaban' => 'required'
        ]);

        for($i = 0; $i < count($request->jawaban); $i++){
            $validate2 = $request->validate([
                'jawaban' => 'required',
                'bobot' => 'required'
            ]);
        }

        $insert = Jawaban::create($validate1);

        for($i = 0; $i < count($request->jawaban); $i++){
            JawabanGanda::create([
                'jawaban' => $request->jawaban[$i],
                'bobot' => $request->bobot[$i],
                'jawaban_id' => $insert->id
            ]);
        }
        // dd($insert->id);
        
        return redirect()->back();
    }

    // 3. End Jawaban

    // 4. Start Soal Kuisioner

    public function store_soal_kuisioner(Request $request){
        $validate = $request->validate([
            'pertanyaan' => 'required',
            'unsur_id' => 'required'
        ]);

        // dd($request);

        SoalKuisioner::create($validate);

        return redirect()->back();
    }

    // 4. End Soal Kuisioner

    public function data_survei_unit(){
        $units = Unit::all();
        
        return view('admin.laporan-responden', [
            'units' => $units
        ]);
    }

    public function data_survei_responden($id){
        $unit = Unit::find($id);
        $surveis = Survei::where('unit_id', $id)->get();
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

    public function data_survei_perbulan($id){
        $unit = Unit::find($id);
        $surveis = Survei::where('unit_id', $id)->get();
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
            $jml_resp = count(Survei::where('unit_id', $id)->whereMonth('tanggal', $bulan)->get());
            
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
            'unit' => $unit,
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
