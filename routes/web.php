<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Start
// 1. Pengaturan Akun
Route::get('pengaturan-akun', [AdminController::class, 'pengaturan_akun']);

Route::post('pengaturan-akun/store-akun', [AdminController::class, 'store_operator']);

Route::post('pengaturan-akun/update-akun/{id}', [AdminController::class, 'update_operator']);

Route::get('daftar-unit', [AdminController::class, 'daftar_unit']);

// Admin End

// Operator Start

Route::get('profil-unit', [OperatorController::class, 'profil_unit']);

Route::post('profil-unit/store', [OperatorController::class, 'store_profil_unit']);

// Operator End