<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Kuisioner;
use App\Models\Layanan;
use App\Models\SoalKuisioner;
use App\Models\Unit;
use App\Models\Unsur;
use App\Models\User;
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
}
