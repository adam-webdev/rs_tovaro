<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{
    public function index()
    {
        $obat = ObatModel::get();
        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.create');
    }


    public function store(Request $request)
    {

        $add_pasien = new ObatModel();
        $add_pasien->nama_obat = $request->nama_obat;
        $add_pasien->kemasan = $request->kemasan;
        $add_pasien->harga = $request->harga;
        $add_pasien->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('obat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obat = ObatModel::findOrFail($id);
        return view('obat.detail', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obat = ObatModel::findOrFail($id);
        return view('obat.edit', compact('obat'));
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

        $edit_pasien = ObatModel::findOrFail($id);
        $edit_pasien->nama_obat = $request->nama_obat;
        $edit_pasien->kemasan = $request->kemasan;
        $edit_pasien->harga = $request->harga;
        $edit_pasien->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('obat.index');
    }

    public function delete($id)
    {
        $obat = ObatModel::findOrFail($id);
        $obat->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('obat.index');
    }
}
