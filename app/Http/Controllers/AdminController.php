<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\JawabanGanda;
use App\Models\SoalKuisioner;
use App\Models\Unsur;
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

}
