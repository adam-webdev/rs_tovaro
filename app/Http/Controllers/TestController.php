<?php

namespace App\Http\Controllers;

use App\Http\FloydWarshall;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $graphmatrice = array(
            array(0, 0, 0, 0, 5, 12),
            array(15, 0, 9, 0, 0, 0),
            array(0, 0, 0, 5, 0, 0),
            array(0, 2, 0, 0, 0, 0),
            array(0, 0, 10, 0, 0, 4),
            array(0, 0, 17, 20, 0, 0)
        );
        $nodenames = array("a", "b", "c", "d", "e", "f");

        $floydwarshall = new FloydWarshall($graphmatrice, $nodenames);

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
        $shortestPath = $floydwarshall->getPath(0, 2);

        print("Shortest path from a to c is: ");
        foreach ($shortestPath as $value) {
            printf("%s ", $nodenames[$value]);
        }
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
}
