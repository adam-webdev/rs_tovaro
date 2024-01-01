<?php

namespace App\Http\Controllers;

use App\Models\PoliModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PoliController extends Controller
{
    public function index()
    {
        $poli = PoliModel::get();
        return view('poli.index', compact('poli'));
    }

    public function create()
    {
        $poli = PoliModel::all();
        return view('poli.create', compact('poli'));
    }


    public function store(Request $request)
    {

        $add_poli = new PoliModel();
        $add_poli->nama_poli = $request->nama_poli;
        $add_poli->keterangan = $request->keterangan;
        $add_poli->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('poli.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poli = PoliModel::findOrFail($id);
        return view('poli.detail', compact('poli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poli = PoliModel::findOrFail($id);
        return view('poli.edit', compact('poli'));
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

        $edit_poli = PoliModel::findOrFail($id);
        $edit_poli->nama_poli = $request->nama_poli;
        $edit_poli->keterangan = $request->keterangan;
        $edit_poli->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('poli.index');
    }

    public function delete($id)
    {
        $poli = PoliModel::findOrFail($id);
        $poli->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('poli.index');
    }
}
