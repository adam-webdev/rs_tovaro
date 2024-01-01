<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\DetailPeriksaModel;
use App\Models\DokterModel;
use App\Models\JadwalPeriksaModel;
use App\Models\ObatModel;
use App\Models\PeriksaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PeriksaController extends Controller
{
    public function index()
    {
        // $daftarpoli = DokterModel::find(Auth::user()->name);
        $id_dokter = DokterModel::select("id")->where('nama', Auth::user()->name)->pluck("id");
        if ($id_dokter) {
            // $id_dokter = DokterModel::select("id")->where('nama', Auth::user()->name)->pluck("id");
            $daftarpasien = JadwalPeriksaModel::select('id')->where('dokter_id', $id_dokter)->pluck('id');
            $daftarpoli_id = DaftarPoliModel::select('id')->whereIn('jadwalperiksa_id', $daftarpasien)->pluck('id');
            // ddd($daftarpoli_id);
            $periksa = PeriksaModel::with('daftarpoli.pasien')->whereIn('daftarpoli_id', $daftarpoli_id)->get();
            $periksa_id = [];
            foreach ($periksa as $p) {
                $periksa_id[] = $p->id;
            }
            $detail_periksa = DetailPeriksaModel::with(['obat', 'periksa'])->whereIn('periksa_id', $periksa_id)->get();
            return view('periksa.index', compact('periksa'));
        } else {

            $periksa = [];
            $detail_periksa = [];
            return view('periksa.index', compact('periksa', 'detail_periksa'));
        }
    }

    public function create()
    {
        $daftarpoli = DaftarPoliModel::all();
        return view('periksa.create', compact('daftarpoli'));
    }
    public function periksa($id)
    {
        $daftarpoli = DaftarPoliModel::with('pasien')->where('id', $id)->first();
        // ddd($daftarpoli);
        $obat = ObatModel::all();
        return view('periksa.create', compact('daftarpoli', 'obat'));
    }


    public function store(Request $request)
    {

        $obat = $request->input('obat_id', []);
        $harga_obat = ObatModel::select('harga')->whereIn('id', $obat)->sum('harga');
        $biaya_dokter = 150000;
        $biaya_periksa = $harga_obat + $biaya_dokter;

        $add_periksa = new PeriksaModel();
        $add_periksa->daftarpoli_id = $request->daftarpoli_id;
        $add_periksa->tgl_periksa = $request->tgl_periksa;
        $add_periksa->catatan = $request->catatan;
        $add_periksa->biaya_periksa = $biaya_periksa;
        $add_periksa->save();

        foreach ($obat as $index => $value) {
            $detail_periksa[] = [
                "periksa_id" => $add_periksa->id,
                "obat_id" => $obat[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }

        DB::table('detail_periksas')->insert($detail_periksa);
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
        $obat = ObatModel::all();
        $detail_periksa = DetailPeriksaModel::where('periksa_id', $id)->get();
        $periksa = PeriksaModel::with('daftarpoli.pasien')->where('id', $id)->first();
        // ddd($periksa);
        return view('periksa.edit', compact('periksa', 'obat', 'detail_periksa'));
    }
    public function rincian($id)
    {
        $detail_periksa = DetailPeriksaModel::with('obat')->where('periksa_id', $id)->get();
        $periksa = PeriksaModel::with('daftarpoli.pasien')->where('id', $id)->first();
        // ddd($periksa);
        return view('periksa.rincian', compact('periksa', 'detail_periksa'));
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
        $obat = $request->input('obat_id', []);
        $harga_obat = ObatModel::select('harga')->whereIn('id', $obat)->sum('harga');
        $biaya_dokter = 150000;
        $biaya_periksa = $harga_obat + $biaya_dokter;
        DB::beginTransaction();
        DetailPeriksaModel::where('periksa_id', $id)->delete();

        $edit_periksa = PeriksaModel::findOrFail($id);
        $edit_periksa->daftarpoli_id = $edit_periksa->daftarpoli_id;
        $edit_periksa->tgl_periksa = $edit_periksa->tgl_periksa;
        $edit_periksa->catatan = $request->catatan;
        $edit_periksa->biaya_periksa = $biaya_periksa;
        $edit_periksa->save();

        foreach ($obat as $index => $value) {
            $detail_periksa[] = [
                "periksa_id" => $id,
                "obat_id" => $obat[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }
        $ok = DB::table('detail_periksas')->insert($detail_periksa);
        // ddd($detail_periksa);
        if (!$ok) {
            DB::rollBack();
            Alert::error('Gagal', 'Data gagal diubah!');
            return redirect()->route('periksa.index');;
        }
        DB::commit();
        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('periksa.index');;
    }

    public function delete($id)
    {
        $periksa = PeriksaModel::findOrFail($id);
        $periksa->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('periksa.index');
    }
}
