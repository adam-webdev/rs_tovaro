<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\DokterModel;
use App\Models\JadwalPeriksaModel;
use App\Models\PoliModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
{

    public function index()
    {
        $dokter = DokterModel::with('poli')->get();
        return view('dokter.index', compact('dokter'));
    }

    public function create()
    {
        $poli = PoliModel::all();
        return view('dokter.create', compact('poli'));
    }


    public function store(Request $request)
    {
        $user_dokter = new User();
        $user_dokter->name = $request->nama;
        $user_dokter->email = $request->email;
        $user_dokter->jenis_kelamin = $request->jenis_kelamin;
        $user_dokter->password = Hash::make($request->password);
        $user_dokter->assignRole("Dokter");
        $user_dokter->save();
        $add_dokter = new DokterModel();
        $add_dokter->nama = $request->nama;
        $add_dokter->alamat = $request->alamat;
        $add_dokter->no_hp = $request->no_hp;
        $add_dokter->poli_id = $request->poli_id;
        $add_dokter->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('dokter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokter = DokterModel::findOrFail($id);
        return view('dokter.detail', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function daftarperiksapasien()
    {
        $id_dokter = DokterModel::select("id")->where('nama', Auth::user()->name)->pluck("id");
        $daftarpasien = JadwalPeriksaModel::select('id')->where('dokter_id', $id_dokter)->pluck('id');
        $daftarpoli = DaftarPoliModel::with(['pasien', 'jadwalperiksa'])->whereIn('jadwalperiksa_id', $daftarpasien)->get();
        return view('dokter.periksapasien', compact('daftarpoli'));
    }
    public function edit($id)
    {
        $poli = PoliModel::all();
        $dokter = DokterModel::findOrFail($id);
        return view('dokter.edit', compact('dokter', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $edit_dokter = DokterModel::findOrFail($id);
        $edit_dokter->nama = $request->nama;
        $edit_dokter->alamat = $request->alamat;
        $edit_dokter->no_hp = $request->no_hp;
        $edit_dokter->poli_id = $request->poli_id;
        $edit_dokter->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('dokter.index');
    }

    public function delete($id)
    {
        $dokter = DokterModel::findOrFail($id);
        $dokter->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('dokter.index');
    }
}
