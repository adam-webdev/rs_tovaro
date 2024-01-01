<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\DokterModel;
use App\Models\JadwalPeriksaModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalperiksa = jadwalPeriksaModel::with('dokter')->get();
        return view('jadwalperiksa.index', compact('jadwalperiksa'));
    }

    public function create()
    {
        $dokter = DokterModel::all();
        return view('jadwalperiksa.create', compact('dokter'));
    }


    public function store(Request $request)
    {

        // ddd($request->all());
        $add_jadwalperiksa = new jadwalPeriksaModel();
        $add_jadwalperiksa->dokter_id = $request->dokter_id;
        $add_jadwalperiksa->hari = $request->hari;
        $add_jadwalperiksa->jam_mulai = $request->jam_mulai;
        $add_jadwalperiksa->jam_selesai = $request->jam_selesai;
        $add_jadwalperiksa->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('jadwalperiksa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalperiksa = jadwalPeriksaModel::findOrFail($id);
        return view('jadwalperiksa.detail', compact('jadwalperiksa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokter = DokterModel::all();
        $jadwalperiksa = JadwalPeriksaModel::findOrFail($id);
        return view('jadwalperiksa.edit', compact('jadwalperiksa', 'dokter'));
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

        $edit_jadwalperiksa = jadwalPeriksaModel::findOrFail($id);
        $edit_jadwalperiksa->dokter_id = $request->dokter_id;
        $edit_jadwalperiksa->hari = $request->hari;
        $edit_jadwalperiksa->jam_mulai = $request->jam_mulai;
        $edit_jadwalperiksa->jam_selesai = $request->jam_selesai;
        $edit_jadwalperiksa->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('jadwalperiksa.index');
    }

    public function delete($id)
    {
        $jadwalperiksa = jadwalPeriksaModel::findOrFail($id);
        $jadwalperiksa->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('jadwalperiksa.index');
    }
}
