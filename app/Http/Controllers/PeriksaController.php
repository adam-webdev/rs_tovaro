<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\PeriksaModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksa = PeriksaModel::with('daftapoli')->get();
        return view('periksa.index', compact('periksa'));
    }

    public function create()
    {
        $daftarpoli = DaftarPoliModel::all();
        return view('periksa.create', compact('daftarpoli'));
    }


    public function store(Request $request)
    {

        $add_periksa = new PeriksaModel();
        $add_periksa->daftarpoli_id = $request->daftarpoli_id;
        $add_periksa->tgl_periksa = $request->tgl_periksa;
        $add_periksa->catatan = $request->catatan;
        $add_periksa->biaya_periksa = $request->biaya_periksa;
        $add_periksa->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('periksa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periksa = PeriksaModel::findOrFail($id);
        return view('periksa.detail', compact('periksa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periksa = PeriksaModel::findOrFail($id);
        return view('periksa.edit', compact('periksa'));
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

        $edit_periksa = PeriksaModel::findOrFail($id);
        $edit_periksa->daftarpoli_id = $request->daftarpoli_id;
        $edit_periksa->tgl_periksa = $request->tgl_periksa;
        $edit_periksa->catatan = $request->catatan;
        $edit_periksa->biaya_periksa = $request->biaya_periksa;
        $edit_periksa->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('periksa.index');
    }

    public function delete($id)
    {
        $periksa = PeriksaModel::findOrFail($id);
        $periksa->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('periksa.index');
    }
}
