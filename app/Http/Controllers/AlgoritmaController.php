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
        $dataGraph = Graph::select('awal', 'tujuan', 'jarak')->get();
        $dataGraph = $dataGraph->toArray();
        // ddd($dataGraph);
        $dataWisata = [
            ["jakarta", "bekasi", 18],
            ["jakarta", "bogor", 10.3],
            ["bogor", "cianjur", 22],
            ["bogor", "depok", 9],
            ["tangerang", "bekasi", 49],
            ["cianjur", "sukabumi", 5],
            ["purwakarta", "jakarta", 5.5],
            ["sukabumi", "bekasi", 5.5],
            ["cianjur", "bandung", 29],
            ["cianjur", "purwakarta", 4.9],
            ["depok", "bekasi", 20],
            ["bekasi", "tangerang", 4.2],
            ["jakarta", "tangerang", 10],
            ["jakarta", "bandung", 140],
            ["bekasi", "karawang", 40],
            ["karawang", "cikampek", 2.2],
            ["cikampek", "bekasi", 60],
            ["cikampek", "purwakarta", 80],
            ["purwakarta", "bandung", 80],
            ["bandung", "tangerang", 230],
            ["karawang", "jakarta", 90],
        ];

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

        foreach ($dataGraph as $row) {
            $start = array_search($row["awal"], $nodeNames);
            $end = array_search($row["tujuan"], $nodeNames);
            $graphmatrice[$start][$end] = $row["jarak"];
        }

        // for ($i = 0; $i < $numNodes; $i++) {
        //     for ($j = 0; $j < $numNodes; $j++) {
        //         echo $graphmatrice[$i][$j] . " ";
        //     }
        //     echo "\n";
        //     echo '<br>';
        // }
        // ddd($nodeNames);
        // $nodenames = array("a", "b", "c", "d", "e", "f");

        $floydwarshall = new FloydWarshall($graphmatrice, $nodeNames);

        function printDistances(Floydwarshall $floydwarshall)
        {

            $nodenames = $floydwarshall->getNodeNames();
            $nodes = $floydwarshall->getNodes();
            $distances = $floydwarshall->getDistances();



            print("Distances\n");
            if (!empty($nodenames)) {
                printf("%2s", "");
                for ($n = 0; $n < $nodes; $n++) {
                    printf("%2s ", $nodenames[$n]);
                }
            }
            print("\n");
            echo '<br>';
            for ($i = 0; $i < $nodes; $i++) {
                if (!empty($nodenames)) {
                    printf("%s ", $nodenames[$i]);
                }
                for ($j = 0; $j < $nodes; $j++) {
                    printf("%2d ", $distances[$i][$j]);
                }
                echo '<br>';
                // print("\n");
            }
            print("\n");
            echo '<br>';
        }

        function printPredecessors(FloydWarshall $floydwarshall)
        {

            $nodenames = $floydwarshall->getNodeNames();
            $nodes = $floydwarshall->getNodes();
            $predecessors = $floydwarshall->getPredecessors();
            print("Predecessors\n");
            if (!empty($nodenames)) {
                printf("%1s", "");
                for ($n = 0; $n < $nodes; $n++) {
                    printf("%2s", $nodenames[$n]);
                }
            }
            echo '<br>';

            print("\n");
            for ($i = 0; $i < $nodes; $i++) {
                if (!empty($nodenames)) {
                    printf("%s", $nodenames[$i]);
                }
                for ($j = 0; $j < $nodes; $j++) {
                    printf("%2d", $predecessors[$i][$j]);
                }
                print("\n");
                echo '<br>';
            }
            print("\n");
            echo '<br>';
        }

        printDistances($floydwarshall);
        printPredecessors($floydwarshall);

        // Get shortest path from a to c
        $shortestPath = $floydwarshall->getPath(0, 7);

        print("Shortest path from a to c is: ");
        foreach ($shortestPath as $value) {
            printf("%s ", $nodeNames[$value]);
        }
        // // Print the resulting $graphmatrice
        // for ($i = 0; $i < $numNodes; $i++) {
        //     for ($j = 0; $j < $numNodes; $j++) {
        //         echo $graphmatrice[$i][$j] . " ";
        //     }
        //     echo '<br>';
        //     // echo "\n";
        // }



        // Hasil akhir adalah matriks jarak terpendek antara semua kota



        // dijkstra
        // $dataGraph = $dataGraph->toArray();
        // // ddd($dataGraph);
        // if ($request->awal && $request->tujuan) {
        //     // $dijkstra = new Dijkstra($dataWisata, "jakarta", "purwakarta");
        //     $dijkstra = new Dijkstra($dataGraph, $request->awal, $request->tujuan);
        //     $hasilPerhitungan = $dijkstra->call_dijkstra();
        //     ddd($hasilPerhitungan);


        //     echo "path yang harus dilewati : " . implode(", ", $hasilPerhitungan['path']) . "\n";
        //     echo '<br>';
        //     echo "total cost : ";
        //     echo (int)$hasilPerhitungan['cost'];
        //     Alert::success('Selesai', 'Jarak berhasil dihitung');
        //     return redirect()->back();
        // }
        // Alert::error('Gagal', 'Posisi dan tujuan harus diisi. silahkan pilih lokasi terlebih dahulu');
        // return redirect()->route('rute.index');
    }
}
