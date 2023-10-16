<?php

namespace App\Http;

class Dijkstra
{
  public $nodes = [];
  public $awal;
  public $akhir;

  public function __construct($nodes, $from, $destination)
  {
    $this->nodes = $nodes;
    $this->awal = $from;
    $this->akhir = $destination;
  }
  public function call_dijkstra()
  {

    $ver = array();
    $next = array();

    foreach ($this->nodes as $node) {
      array_push($ver, $node[0], $node[1]);
      $next[$node[0]][] = array("tujuan" => $node[1], "cost" => $node[2]);
      $next[$node[1]][] = array("tujuan" => $node[0], "cost" => $node[2]);
    }

    // echo '<pre>';
    // print_r($next);
    // echo '</pre>';
    $ver = array_unique($ver);
    $tujuan = array();

    foreach ($ver as $v) {
      $tcost[$v] = INF;
      $tujuan[$v] = NULL;
    }

    $tcost[$this->awal] = 0;
    $V = $ver;

    while (count($V) > 0) {

      $min = INF;

      foreach ($V as $vke) {
        if ($tcost[$vke] < $min) {
          $min = $tcost[$vke];
          $u = $vke;
        }
      }

      $V = array_diff($V, array($u));

      if ($tcost[$u] == INF or $u == $this->akhir) {
        break;
      }

      if (isset($next[$u])) {
        foreach ($next[$u] as $key => $n) {
          $cost = $tcost[$u] + $n["cost"];
          if ($cost < $tcost[$n["tujuan"]]) {
            $tcost[$n["tujuan"]] = $cost;
            $tujuan[$n["tujuan"]] = $u;
          }
        }
      }
    }

    $path = array();
    $akh = $this->akhir;

    while (isset($tujuan[$akh])) {
      array_unshift($path, $akh);
      $akh = $tujuan[$akh];
    }
    array_unshift($path, $this->awal);

    $result['path'] = $path;
    $result['cost'] = (int)$min;

    return $result;
  }
}


// $dataWisata = [
//   ["jakarta", "bekasi", 18],
//   ["jakarta", "bogor", 10],
//   ["bogor", "cianjur", 22],
//   ["bogor", "depok", 9],
//   ["tangerang", "bekasi", 49],
//   ["cianjur", "sukabumi", 5],
//   ["purwakarta", "sukabumi", 55],
//   ["cianjur", "bandung", 29],
//   ["cianjur", "purwakarta", 49],
//   ["depok", "bekasi", 20],
//   ["bekasi", "tangerang", 40],
//   ["jakarta", "tangerang", 10],
//   ["jakarta", "bandung", 140],
//   ["bekasi", "karawang", 40],
//   ["karawang", "cikampek", 20],
//   ["cikampek", "bekasi", 60],
//   ["cikampek", "purwakarta", 80],
//   ["purwakarta", "bandung", 80],
//   ["bandung", "tangerang", 230],
//   ["karawang", "jakarta", 90],
// ];
// $dijkstr = new Dijkstra($dataWisata, "jakarta", "bandung");

// $hasil = $dijkstr->call_dijkstra();
// // $hasil = dijkstraAlgorithm($dataWisata, "karawang", "bandung");

// echo "path yang harus dilewati : " . implode(", ", $hasil['path']) . "\n";
// echo '<br>';
// echo "total cost : ";
// echo (int)$hasil['cost'];