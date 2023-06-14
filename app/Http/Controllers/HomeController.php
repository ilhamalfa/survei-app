<?php

namespace App\Http\Controllers;

use App\Models\JawabanUser;
use App\Models\Layanan;
use App\Models\Responden;
use App\Models\SoalKuisioner;
use App\Models\Survei;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $respondens = Responden::has('survei')->get();
        $units = Unit::has('layanan')->get();
        $layanans = Layanan::all();
        $jawabanUsers = JawabanUser::all();
        $soals = SoalKuisioner::all();

        // dd($soals);
        
        $ranking = array();
        $hasil_responden = array();

        $i = 0;

        foreach($units as $unit){
            $jml_responden[$unit->nama_unit] = 0;

            foreach($respondens as $responden){
                if($responden->survei->unit->nama_unit == $unit->nama_unit){
                    $jml_responden[$unit->nama_unit] += 1 ;
                }
            }

            $hasil_responden[$i] = [
                'unit' => $unit->nama_unit,
                'jumlah_responden' => $jml_responden[$unit->nama_unit],
                'jumlah_responden_persen' => ($jml_responden[$unit->nama_unit] / count($respondens) * 100),
            ];
            
            for($a = 1; $a <= 9; $a++){
                $jawabans[$unit->nama_unit][$a] = 0.0;
                $hasilAkhir[$unit->nama_unit][$a] = 0.0;
                $jml_survei[$unit->id] = 0;
                $NRR[$unit->nama_unit] = 0.0;
            }

            $i++;
        }

        foreach($jawabanUsers as $jwb){
            $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] = $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] + $jwb->jawabanGanda->bobot;
        
            $jml_jwb[$jwb->survei->unit_id] = count(Survei::where('unit_id', $jwb->survei->unit_id)->get());
            // dd($jml_jwb);
            $hasilAkhir[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] = $jawabans[$jwb->survei->unit->nama_unit][$jwb->soal_kuisioners_id] / $jml_jwb[$jwb->survei->unit_id];
            // dd(array_sum($hasilAkhir[$jwb->survei->unit->nama_unit]));
            $NRR[$jwb->survei->unit->nama_unit] =  array_sum($hasilAkhir[$jwb->survei->unit->nama_unit])/count(SoalKuisioner::all());
        }
        // dd($hasilAkhir);

        $x = 0;

        foreach ($units as $unit) {
            $ranking[$x] = [
                'unit' => $unit->nama_unit,
                'ikm' => $NRR[$unit->nama_unit] * 25,
                'nrr_total' => $NRR[$unit->nama_unit]
            ];

            $y = 0;

            foreach($soals as $soal){
                $ranking[$x]['NRR'.$y] = $hasilAkhir[$unit->nama_unit][$soal->id];
                $y++;
            }

            $x++;
        }

        // dd($ranking);

        $sorted_respondens = collect($hasil_responden)->sortByDesc('jumlah_responden');
        $sorted_rankings = collect($ranking)->sortByDesc('ikm');
        
        // dd($sorted_rankings);

        // dd($sorted_ranking);
        return view('dashboard', [
            'jml_responden' => count($respondens),
            'jml_unit' => count($units),
            'jml_layanan' => count($layanans),
            'sorted_respondens' => $sorted_respondens,
            'units' => $units,
            'hasil_akhir' => $hasilAkhir,
            'NRR' => $NRR,
            'sorted_rankings' => $sorted_rankings
        ]);
    }
}
