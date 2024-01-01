<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksaModel;
use App\Models\ObatModel;
use App\Models\PeriksaModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetailPeriksaController extends Controller
{
    public function index()
    {
        $detailperiksa = DetailPeriksaModel::get();
        return view('detailperiksa.index', compact('detailperiksa'));
    }

    public function create()
    {
        $obat = ObatModel::all();
        $periksa = PeriksaModel::all();
        return view('detailperiksa.create', compact('obat', 'periksa'));
    }


    public function store(Request $request)
    {

        $add_detailperiksa = new DetailPeriksaModel();
        $add_detailperiksa->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('detailperiksa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailperiksa = DetailPeriksaModel::findOrFail($id);
        return view('detailperiksa.detail', compact('detailperiksa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obat = ObatModel::all();
        $periksa = PeriksaModel::all();
        $detailperiksa = DetailPeriksaModel::findOrFail($id);
        return view('detailperiksa.edit', compact('detailperiksa', 'obat', 'periksa'));
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

        $edit_detailperiksa = DetailPeriksaModel::findOrFail($id);
        $edit_detailperiksa->periksa_id = $request->periksa_id;
        $edit_detailperiksa->obat_id = $request->obat_id;
        $edit_detailperiksa->save();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('detailperiksa.index');
    }

    public function delete($id)
    {
        $detailperiksa = DetailPeriksaModel::findOrFail($id);
        $detailperiksa->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('detailperiksa.index');
    }
}
