<?php

namespace App\Http\Controllers;

use App\Models\Graph;
use App\Models\Wisata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graph = Graph::all();
        return view('graph.index', compact('graph'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wisata = Wisata::all();
        return view('graph.create', compact('wisata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'awal' => 'required',
            'tujuan' => 'required',
            'jarak' => 'required',
            'waktu' => 'required',
        ]);


        $new_graph = new Graph();
        $new_graph->awal = $request->awal;
        $new_graph->tujuan = $request->tujuan;
        $new_graph->jarak = $request->jarak;
        $new_graph->waktu = $request->waktu;
        $new_graph->save();
        Alert::success('Berhasil', 'Data Berhasil ditambahkan.');
        return redirect()->route('graph.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $graph = Graph::findOrFail($id);
        return view('graph.show', compact('graph'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wisata = Wisata::all();
        $graph = Graph::findOrFail($id);
        return view('graph.edit', compact('graph', 'wisata'));
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
        $request->validate([
            'awal' => 'required',
            'tujuan' => 'required',
            'jarak' => 'required',
            'waktu' => 'required',
        ]);

        $edit_graph = Graph::findOrFail($id);
        $edit_graph->awal = $request->awal;
        $edit_graph->tujuan = $request->tujuan;
        $edit_graph->jarak = $request->jarak;
        $edit_graph->waktu = $request->waktu;
        $edit_graph->save();
        Alert::success('Berhasil', 'Data Berhasil diubah.');
        return redirect()->route('graph.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $graph = Graph::findOrFail($id);
        $graph->delete();
        Alert::success('Berhasil', 'Data Berhasil dihapus.');
        return redirect()->route('graph.index');
    }
}
