<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RespondenController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [RespondenController::class, 'landingPage']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Start
Route::middleware(['auth', 'user-access:admin'])->group(function () {
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

    // Menu Survei
    Route::get('data-survei/daftar-unit', [AdminController::class, 'data_survei_unit']);

    // Menu Survei
    Route::get('data-survei/laporan-kuisioner/{id}', [AdminController::class, 'data_survei_responden']);
});
// Admin End


// Admin & Operator Start
Route::middleware(['auth', 'user-access:admin, operator'])->group(function () {
    // 1. Master Komponen
    Route::get('master-komponen', [OperatorController::class, 'master_komponen']);
    
    // Menu Survei
    Route::get('data-survei/laporan-kuisioner', [OperatorController::class, 'menu_survei']);

    Route::get('data-survei/laporan-perbulan', [OperatorController::class, 'perbulan']);

    // Profil Unit
    Route::get('profil-unit', [OperatorController::class, 'profil_unit']);
});
// Admin & Operator End


// Operator Start
Route::middleware(['auth', 'user-access:operator'])->group(function () {
    // Tambah dan update profil
    Route::post('profil-unit/store', [OperatorController::class, 'store_profil_unit']);

    Route::post('profil-unit/update/{id}', [OperatorController::class, 'update_profil_unit']);

    // Tambah dan edit layanan
    Route::post('profil-unit/layanan/store', [OperatorController::class, 'store_jenis_layanan']);

    Route::post('profil-unit/layanan/update/{id}', [OperatorController::class, 'update_jenis_layanan']);
});
// Operator End

// Responden Start

Route::get('kuisioner', [RespondenController::class, 'form_survey']);

Route::post('/store-responden', [RespondenController::class, 'storeResponden']);

Route::post('/store-survei', [RespondenController::class, 'storeSurvei']);

Route::post('/get-layanan', [RespondenController::class, 'getLayanan']);

// Responden End