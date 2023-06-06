<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    // 2. Start (Daftar Unit)

    public function daftar_unit(){

    }

    // 2. End (Daftar Unit)
}
