<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Start (Pengaturan Akun)
    public function pengaturan_akun(){
        $datas = User::where('role', '!=', 'admin')->get();
        
        return view('pengaturan-akun', [
            'datas' => $datas
        ]);
    }
}
