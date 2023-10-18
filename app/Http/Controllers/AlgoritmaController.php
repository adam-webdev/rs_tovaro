<?php

namespace App\Http\Controllers;

// use App\Http\Dijkstra;
use App\Http\Dijkstra2;
use App\Http\FloydWarshall;
use App\Models\Graph;
use App\Models\Wisata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlgoritmaController extends Controller
{
    public function index()
    {
        $wisata = Wisata::all();
        return view('rute.hitung', compact('wisata'));
    }
    public function store(Request $request)
    {

        if (!$request->awal && !$request->tujuan) {
            Alert::error('Gagal', 'Posisi awal dan tujuan harus diisi!.');
            return redirect()->back();
        }
        $graphExist = Graph::where('awal', $request->awal)->exists();
        if (!$graphExist) {
            Alert::error('Gagal', 'Jalur tidak tersedia, Silahkan pilih yang lain');
            return redirect()->back();
        }


        // ddd($graph);
        $dataGraph = Graph::select('awal', 'tujuan', 'jarak')->get();
        $dataGraph = $dataGraph->toArray();
        // ddd($dataGraph);

        // Floydwarshall

        // Menyimpan node names unik dalam sebuah array
        $nodeNames = array();
        foreach ($dataGraph as $row) {
            if (!in_array($row["awal"], $nodeNames)) {
                $nodeNames[] = $row["awal"];
            }
            if (!in_array($row["tujuan"], $nodeNames)) {
                $nodeNames[] = $row["tujuan"];
            }
        }
        $numNodes = count($nodeNames);
        $graphmatrice = array_fill(0, $numNodes, array_fill(0, $numNodes, 0));

        // mengisi matrix path dengan jarak yang ada
        foreach ($dataGraph as $row) {
            $start = array_search($row["awal"], $nodeNames);
            $end = array_search($row["tujuan"], $nodeNames);
            $graphmatrice[$start][$end] = $row["jarak"];
        }

        // rute yang dihitung
        $awal = $request->awal;
        $tujuan = $request->tujuan;
        $indexAwal = array_search($awal, $nodeNames);
        $indexTujuan = array_search($tujuan, $nodeNames);
        $floydwarshall = new FloydWarshall($graphmatrice, $nodeNames);

        // dijkstra
        $g = new Dijkstra2();
        foreach ($dataGraph as $data) {
            $source = $data['awal'];
            $destination = $data['tujuan'];
            $weight = $data['jarak'];
            $g->addedge($source, $destination, $weight);
        }
        list($distances, $prev) = $g->paths_from($awal);
        $path = $g->paths_to($prev, $tujuan, $distances);

        Alert::success('Selesai', 'Rute tercepat berhasil ditemukan');
        return view('rute.hasil', compact('floydwarshall', 'nodeNames', 'numNodes', 'graphmatrice', 'dataGraph', 'indexAwal', 'indexTujuan',  'awal', 'tujuan', 'path'));
    }
}
