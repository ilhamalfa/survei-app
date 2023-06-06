<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    // 1. Start (Profil Unit)

    public function profil_unit(){
        if(Auth::user()->role == 'operator'){
            $data = User::find(Auth::user()->id);

            return view('operator.profil-unit', [
                'data' => $data
            ]);
            // dd($data);
        }else{
            return redirect('daftar-unit');
        }
    }

    public function store_profil_unit(Request $request){
        $validate = $request->validate([
            'foto_kepala_unit' => 'required|image',
            'nama_unit' => 'required',
            'nomor_telp_unit' => 'required|unique:units',
            'email_unit' => 'required|unique:units',
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

    // End (Profil Unit)
}
