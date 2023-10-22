<?php

namespace App\Http\Controllers;

use App\Http\Dijkstra;
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

        // dijkstra2
        // $g = new Dijkstra2();
        // foreach ($dataGraph as $data) {
        //     $source = $data['awal'];
        //     $destination = $data['tujuan'];
        //     $weight = $data['jarak'];
        //     $g->addedge($source, $destination, $weight);
        // }
        // list($distances, $prev) = $g->paths_from($awal);
        // $path = $g->paths_to($prev, $tujuan, $distances);



        // Dijkstra3

        // $dataWisata = [
        //     ["jakarta", "bekasi", 18],
        //     ["jakarta", "bogor", 10],
        //     ["bogor", "cianjur", 22],
        //     ["bogor", "depok", 9],
        //     ["tangerang", "bekasi", 49],
        //     ["cianjur", "sukabumi", 5],
        //     ["purwakarta", "sukabumi", 55],
        //     ["cianjur", "bandung", 29],
        //     ["cianjur", "purwakarta", 49],
        //     ["depok", "bekasi", 20],
        //     ["bekasi", "tangerang", 40],
        //     ["jakarta", "tangerang", 10],
        //     ["jakarta", "bandung", 140],
        //     ["bekasi", "karawang", 40],
        //     ["karawang", "cikampek", 20],
        //     ["cikampek", "bekasi", 60],
        //     ["cikampek", "purwakarta", 80],
        //     ["purwakarta", "bandung", 80],
        //     ["bandung", "tangerang", 230],
        //     ["karawang", "jakarta", 90],
        // ];

        $graph = [];

        // Membuat daftar simpul (node) yang ada dalam data wisata
        $nodes = [];

        foreach ($dataGraph as $data) {
            $source = $data['awal'];
            // $source = $data[0];
            $destination = $data['tujuan'];
            // $destination = $data[1];
            if (!in_array($source, $nodes)) {
                $nodes[] = $source;
            }
            if (!in_array($destination, $nodes)) {
                $nodes[] = $destination;
            }
        }

        // Menginisialisasi grafik dengan label simpul sebagai kunci dan array kosong sebagai nilai
        foreach ($nodes as $node) {
            $graph[$node] = [];
        }
        // ddd($graphDijkstra);

        // Mengisi grafik dengan jarak antar simpul
        foreach ($dataGraph as $data) {

            // $source = $data[0];
            $source = $data['awal'];
            // $destination = $data[1];
            $destination = $data['tujuan'];
            // $distance = $data[2];
            $distance = $data['jarak'];

            // ddd(!isset($graph[$source]));
            if (!isset($graph[$source])) {
                $graph[$source] = [];
            }

            $graph[$source][$destination] = $distance;
            // ddd($destination);

            // Memeriksa apakah ada rute balik dari destination ke source
            if (!isset($graph[$destination])) {
                $graph[$destination] = [];
            }

            // $graph[$source][$destination] = $distance;

            // $graph[$destination][$source] = $distance; // Grafik tidak berarah, tambahkan arah sebaliknya
        }
        // ddd($graph);
        // ddd($graph);
        // Contoh penggunaan algoritma Dijkstra:
        $dijkstra = new Dijkstra($graph);
        $startNode = $request->awal;
        $endNode = $request->tujuan;

        // $startNode = 'jakarta';
        // $endNode = 'bandung';

        $path = $dijkstra->shortestPath($startNode, $endNode);
        // ddd($path);

        // if ($result) {
        //     echo "Jarak terpendek dari $startNode ke $endNode adalah " . implode(' -> ', $result) . "\n";
        // } else {
        //     echo "Tidak ada jalan yang tersedia dari $startNode ke $endNode.\n";
        // }


        Alert::success('Selesai', 'Rute tercepat berhasil ditemukan');
        return view('rute.hasil', compact('floydwarshall', 'nodeNames', 'numNodes', 'graphmatrice', 'dataGraph', 'indexAwal', 'indexTujuan',  'awal', 'tujuan', 'path'));
    }
}
