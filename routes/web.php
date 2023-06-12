<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RespondenController;
use App\Models\JawabanGanda;
use App\Models\JawabanUser;
use App\Models\SoalKuisioner;
use App\Models\Survei;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('test', function () {
    return view('responden.landing-page');
});

Route::get('/', function () {
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Start
// 1. Pengaturan Akun
Route::get('pengaturan-akun', [AdminController::class, 'pengaturan_akun']);

Route::post('pengaturan-akun/store-akun', [AdminController::class, 'store_operator']);

Route::post('pengaturan-akun/update-akun/{id}', [AdminController::class, 'update_operator']);

Route::get('daftar-unit', [AdminController::class, 'daftar_unit']);

// 2. Unsur
Route::post('master-komponen/tambah-unsur', [AdminController::class, 'store_unsur']);

Route::post('master-komponen/update-unsur/{id}', [AdminController::class, 'update_unsur']);

// 3. Jawaban
Route::post('master-komponen/tambah-jawaban', [AdminController::class, 'store_jawaban']);

// 4. Soal Kuisioner
Route::post('master-komponen/tambah-soal-kuisioner', [AdminController::class, 'store_soal_kuisioner']);

// Admin End


// Admin & Operator Start
// 1. Master Komponen
Route::get('master-komponen', [OperatorController::class, 'master_komponen']);

// Admin & Operator End


// Operator Start
// Tambah dan update profil
Route::get('profil-unit', [OperatorController::class, 'profil_unit']);

Route::post('profil-unit/store', [OperatorController::class, 'store_profil_unit']);

Route::post('profil-unit/update/{id}', [OperatorController::class, 'update_profil_unit']);

// Tambah dan edit layanan
Route::post('profil-unit/layanan/store', [OperatorController::class, 'store_jenis_layanan']);

Route::post('profil-unit/layanan/update/{id}', [OperatorController::class, 'update_jenis_layanan']);

// Operator End

// Responden Start

Route::get('kuisioner', [RespondenController::class, 'form_survey']);

Route::post('/store-responden', [RespondenController::class, 'storeResponden']);

Route::post('/store-survei', [RespondenController::class, 'storeSurvei']);

Route::post('/get-layanan', [RespondenController::class, 'getLayanan']);

// Responden End