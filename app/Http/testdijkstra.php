<?php
// Step 1: Buat daftar unik dari kota-kota
$uniqueCities = array_unique(array_merge(array_column($dataWisata, 0), array_column($dataWisata, 1)));

// Step 2: Inisialisasi matriks awal
$inf = PHP_INT_MAX; // Nilai tak hingga
$cityCount = count($uniqueCities);
$distanceMatrix = [];

for ($i = 0; $i < $cityCount; $i++) {
  for ($j = 0; $j < $cityCount; $j++) {
    if ($i == $j) {
      $distanceMatrix[$i][$j] = 0; // Jarak dari kota ke dirinya sendiri adalah 0
    } else {
      $distanceMatrix[$i][$j] = $inf; // Inisialisasi dengan nilai tak hingga
    }
  }
}

// Step 3: Isi matriks dengan jarak sesuai data perjalanan
foreach ($dataWisata as $trip) {
  $city1 = array_search($trip[0], $uniqueCities);
  $city2 = array_search($trip[1], $uniqueCities);
  $distanceMatrix[$city1][$city2] = $trip[2];
}

// Step 4: Algoritma Floyd-Warshall
for ($k = 0; $k < $cityCount; $k++) {
  for ($i = 0; $i < $cityCount; $i++) {
    for ($j = 0; $j < $cityCount; $j++) {
      if ($distanceMatrix[$i][$j] > $distanceMatrix[$i][$k] + $distanceMatrix[$k][$j]) {
        $distanceMatrix[$i][$j] = $distanceMatrix[$i][$k] + $distanceMatrix[$k][$j];
      }
    }
  }
}

// Hasil akhir adalah matriks jarak terpendek antara semua kota
print_r($distanceMatrix);
