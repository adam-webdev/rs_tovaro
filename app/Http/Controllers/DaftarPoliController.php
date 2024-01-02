<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\JadwalPeriksaModel;
use App\Models\PasienModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $daftarpoli = DaftarPoliModel::with('pasien', 'jadwalperiksa')->get();
        return view('daftarpoli.index', compact('daftarpoli'));
    }

    public function create()
    {
        $pasien = PasienModel::all();
        $jadwalperiksa = JadwalPeriksaModel::all();
        return view('daftarpoli.create', compact('pasien', 'jadwalperiksa'));
    }

    public function polipasien()
    {
        $jadwalperiksa = JadwalPeriksaModel::with('dokter.poli')->get();
        return view('polipasien', compact('jadwalperiksa'));
    }
    public function polipasiensimpan(Request $request)
    {
        $cek_nik = PasienModel::where('no_ktp', $request->no_ktp)->first();
        if ($cek_nik != null) {
            $pasien_id = $cek_nik->id;
        } else {
            Alert::error("Oopss...", "Data Pasien tidak ditemukan");
            return redirect()->route('daftarpolipasien');
        }
        $dayNow = now()->toDateString();
        $noAntrianTerakhir = DaftarPoliModel::whereDate('created_at', $dayNow)->max('no_antrian') + 1;
        $jadwal = DaftarPoliModel::with("jadwalperiksa.dokter.poli")->where("pasien_id", $cek_nik->id)->first();
        // ddd($jadwal);
        $add_daftarpoli = new DaftarPoliModel();
        $add_daftarpoli->keluhan = $request->keluhan;
        $add_daftarpoli->no_antrian = $noAntrianTerakhir;
        $add_daftarpoli->jadwalperiksa_id = $request->jadwalperiksa_id;
        $add_daftarpoli->pasien_id = $pasien_id;
        // ddd($add_daftarpoli);
        $add_daftarpoli->save();
        Alert::success('Sukses', 'Pendaftaran berhasil');
        return view('sukses', compact("add_daftarpoli", "cek_nik", "jadwal"));
    }

    public function store(Request $request)
    {
        $dayNow = now()->toDateString();
        $noAntrianTerakhir = DaftarPoliModel::whereDate('created_at', $dayNow)->max('no_antrian') + 1;
        $add_daftarpoli = new DaftarPoliModel();
        $add_daftarpoli->keluhan = $request->keluhan;
        $add_daftarpoli->no_antrian = $noAntrianTerakhir;
        $add_daftarpoli->jadwalperiksa_id = $request->jadwalperiksa_id;
        $add_daftarpoli->pasien_id = $request->pasien_id;
        $add_daftarpoli->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('daftarpoli.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daftarpoli = DaftarPoliModel::findOrFail($id);
        return view('daftarpoli.detail', compact('daftarpoli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = PasienModel::all();
        $jadwalperiksa = JadwalPeriksaModel::all();
        $daftarpoli = DaftarPoliModel::findOrFail($id);
        return view('daftarpoli.edit', compact('daftarpoli', 'pasien', 'jadwalperiksa'));
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

        $edit_daftarpoli = DaftarPoliModel::findOrFail($id);
        $edit_daftarpoli->pasien_id = $request->pasien_id;
        $edit_daftarpoli->jadwalperiksa_id = $request->jadwalperiksa_id;
        $edit_daftarpoli->keluhan = $request->keluhan;
        $edit_daftarpoli->no_antrian = $request->no_antrian;
        $edit_daftarpoli->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('daftarpoli.index');
    }

    public function delete($id)
    {
        $daftarpoli = DaftarPoliModel::findOrFail($id);
        $daftarpoli->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('daftarpoli.index');
    }
}