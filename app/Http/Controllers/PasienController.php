<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = PasienModel::get();
        return view('pasien.index', compact('pasien'));
    }

    public function create()
    {

        $pasien = PasienModel::all();
        return view('pasien.create', compact('pasien', 'no_rm'));
    }


    public function store(Request $request)
    {

        $add_pasien = new PasienModel();
        $add_pasien->nama = $request->nama;
        $add_pasien->alamat = $request->alamat;
        $add_pasien->no_ktp = $request->no_ktp;
        $add_pasien->no_hp = $request->no_hp;
        $add_pasien->no_rm = $request->no_rm;
        $add_pasien->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('pasien.index');
    }
    public function store_user(Request $request)
    {
        $no_rm = PasienModel::no_rm();

        $add_pasien = new PasienModel();
        $add_pasien->nama = $request->nama;
        $add_pasien->alamat = $request->alamat;
        $add_pasien->no_ktp = $request->no_ktp;
        $add_pasien->no_hp = $request->no_hp;
        $add_pasien->no_rm = $no_rm;
        $add_pasien->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('daftarpolipasien');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = PasienModel::findOrFail($id);
        return view('pasien.detail', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = PasienModel::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
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

        $edit_pasien = PasienModel::findOrFail($id);
        $edit_pasien->nama = $request->nama;
        $edit_pasien->alamat = $request->alamat;
        $edit_pasien->no_ktp = $request->no_ktp;
        $edit_pasien->no_hp = $request->no_hp;
        $edit_pasien->no_rm = $request->no_rm;
        $edit_pasien->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('pasien.index');
    }

    public function delete($id)
    {
        $pasien = PasienModel::findOrFail($id);
        $pasien->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('pasien.index');
    }
}
