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




        // Hasil akhir adalah matriks jarak terpendek antara semua kota



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
        // ddd($dataGraph);
        // $dijkstra = new Dijkstra($dataWisata, "jakarta", "purwakarta");
        // $dijkstra = new Dijkstra($dataGraph, $request->awal, $request->tujuan);
        // $hasilPerhitungan = $dijkstra->call_dijkstra();
        // ddd($hasilPerhitungan);


        // echo "path yang harus dilewati : " . implode(", ", $hasilPerhitungan['path']) . "\n";
        // echo '<br>';
        // echo "total cost : ";
        // echo (int)$hasilPerhitungan['cost'];

        Alert::success('Selesai', 'Rute tercepat berhasil ditemukan');
        return view('rute.hasil', compact('floydwarshall', 'nodeNames', 'numNodes', 'graphmatrice', 'dataGraph', 'indexAwal', 'indexTujuan',  'awal', 'tujuan', 'hasilPerhitungan'));
        // Alert::error('Gagal', 'Posisi dan tujuan harus diisi. silahkan pilih lokasi terlebih dahulu');
        // return redirect()->route('rute.index');
    }
}
