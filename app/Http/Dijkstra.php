<?php

namespace App\Http;

class Dijkstra
{
  protected $graph;
  protected $distances;
  // protected $totalJarak;
  protected $previous;
  protected $startNode;
  protected $unvisitedNodes;

  public function __construct($graph)
  {
    $this->graph = $graph;
  }

  public function shortestPath($startNode, $endNode)
  {
    $this->startNode = $startNode;
    $this->distances = [];
    $this->previous = [];
    $this->unvisitedNodes = $this->graph;

    foreach ($this->graph as $node => $neighbors) {

      $this->distances[$node] = INF;
      $this->previous[$node] = null;
    }

    $this->distances[$startNode] = 0;

    while ($this->unvisitedNodes) {
      $closestNode = $this->getClosestNode();
      // ddd($endNode);

      if ($closestNode === $endNode) {

        return $this->getPath($endNode);
      }

      foreach ($this->graph[$closestNode] as $neighbor => $distance) {
        $distanceToNeighbor = $this->distances[$closestNode] + $distance;

        if ($distanceToNeighbor < $this->distances[$neighbor]) {
          $this->distances[$neighbor] = $distanceToNeighbor;
          $this->previous[$neighbor] = $closestNode;
        }
      }
      // $totalDistance = 0;
      // // ddd($this->distances);

      // foreach ($this->distances as $value) {
      //   if ($value !== INF) {
      //     $this->totalJarak += $value;
      //   }
      // }

      // $this->totalJarak = $totalDistance;
      unset($this->unvisitedNodes[$closestNode]);
    }

    return null; // No path found
  }

  protected function getClosestNode()
  {

    $minDistance = INF;
    $closestNode = null;
    foreach ($this->unvisitedNodes as $node => $distance) {
      if ($this->distances[$node] < $minDistance) {
        $minDistance = $this->distances[$node];
        $closestNode = $node;
      }
    }

    return $closestNode;
  }

  protected function getPath($endNode)
  {

    $path = [];
    while ($endNode !== $this->startNode) {
      $path[] = $endNode;
      $endNode = $this->previous[$endNode];
    }
    $path[] = $this->startNode;
    $totalJarak = $this->distances[$path[0]];

    return [array_reverse($path), $totalJarak];
  }
}

// Contoh penggunaan:
// $graph = [
//     'A' => ['B' => 1, 'C' => 4],
//     'B' => ['A' => 1, 'C' => 2, 'D' => 5],
//     'C' => ['A' => 4, 'B' => 2, 'D' => 1],
//     'D' => ['B' => 5, 'C' => 1]
// ];

// $dijkstra = new Dijkstra($graph);
// $startNode = 'A';
// $endNode = 'D';

// $result = $dijkstra->shortestPath($startNode, $endNode);
// if ($result) {
//     echo "Jarak terpendek dari $startNode ke $endNode adalah " . implode(' -> ', $result) . "\n";
// } else {
//     echo "Tidak ada jalan yang tersedia dari $startNode ke $endNode.\n";
// }