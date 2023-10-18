<?php

namespace App\Http;


define('INFINITE', PHP_INT_MAX);

/**
 * The Floyd-Warshall algorithm is a shortest path algorithm for graphs.
 * Copyright 2021 Janne Mikkonen <janne.mikkonen@julmajanne.com>
 * License: https://opensource.org/licenses/MIT
 */
class FloydWarshall
{

  /**
   * Distances array
   * @var array
   */
  private array $__distances = array();
  /**
   * Predecessor array
   * @var array
   */
  private array $__predecessor = array();
  /**
   * Weights array
   * @var array
   */
  private array $__weights = array();
  /**
   * Number of nodes
   * @var int
   */
  private int $__nodes = 0;
  /**
   * Node names array
   * @var array
   */
  private array $__nodenames = array();
  /**
   * Temporary data array
   * @var array
   */
  private array $__temp = array();

  public function __construct(array $graphmatrice, array $nodenames)
  {
    $this->__weights = $graphmatrice;
    $this->__nodes   = count($this->__weights);

    if (!empty($nodenames) && $this->__nodes === count($nodenames)) {
      $this->__nodenames = $nodenames;
    }
    $this->__floydwarshall();
  }

  /**
   * PHP implementation of FloydWarshall algorithm
   */
  private function __floydwarshall(): void
  {
    for ($i = 0; $i < $this->__nodes; $i++) {
      for ($j = 0; $j < $this->__nodes; $j++) {
        if ($i == $j) {
          $this->__distances[$i][$j] = 0;
        } else if ($this->__weights[$i][$j] > 0) {
          $this->__distances[$i][$j] = $this->__weights[$i][$j];
        } else {
          $this->__distances[$i][$j] = INFINITE;
        }
        $this->__predecessor[$i][$j] = $i;
      }
    }

    for ($k = 0; $k < $this->__nodes; $k++) {
      for ($i = 0; $i < $this->__nodes; $i++) {
        for ($j = 0; $j < $this->__nodes; $j++) {
          if ($this->__distances[$i][$j] > ($this->__distances[$i][$k] + $this->__distances[$k][$j])) {
            $this->__distances[$i][$j] = $this->__distances[$i][$k] + $this->__distances[$k][$j];
            $this->__predecessor[$i][$j] = $this->__predecessor[$k][$j];
          }
        }
      }
    }
  }

  // mencari path lokasi dan tujuan
  private function __getPath(int $i, int $j): void
  {
    if ($i != $j) {
      $this->__getPath($i, $this->__predecessor[$i][$j]);
    }
    array_push($this->__temp, $j);
  }
  // menampilkan path jalur
  public function getPath($i, $j): array
  {
    $this->__temp = array();
    $this->__getPath($i, $j);
    return $this->__temp;
  }

  // memunculkan nama node
  public function getNodeNames(): array
  {
    return $this->__nodenames;
  }

  // memunculkan jumlah node
  public function getNodes(): int
  {
    return $this->__nodes;
  }

  // menampilkan jarak
  public function getDistances(): array
  {
    return $this->__distances;
  }

  // menampilkan predecessors rute sebelumnya
  public function getPredecessors(): array
  {
    return $this->__predecessor;
  }
}
