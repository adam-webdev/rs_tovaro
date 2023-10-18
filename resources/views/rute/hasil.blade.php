@extends('layouts.layout')
@section('title', 'Data Hasil Perhitungan')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Hasil Perhitungan Algoritma </h1>
        <!-- Button trigger modal -->

    </div>
    @php
        $totalJarakDijkstra = $path[0];
        $pathDijkstra = $path[1];
        $countPathDijkstra = count($path[1]);
        // ddd($countPathDijkstra);
    @endphp


    <h3>Floydwarshall.</h3>
    <div class="card p-4">

        <div class="row">
            <div class="col-md-6">
                <p>Berikut table jarak antar rute wisata sebelum dihitung.</p>

                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>#</th>
                        @foreach ($nodeNames as $i => $wisata)
                            <th style="width:15px!important;height:15px;font-size:12px">{{ $wisata }}</th>
                        @endforeach
                    </tr>
                    @foreach ($nodeNames as $i => $wisata1)
                        <tr>
                            <th style="width:15px!important;height:15px;font-size:12px">{{ $wisata1 }}</th>
                            @php
                                foreach ($nodeNames as $j => $wisata2) {
                                    echo '<td style="width:15px!important;height:15px;font-size:12px">' . $graphmatrice[$i][$j] . '</td>';
                                    // $distance = $distanceMatrix[$i][$j];
                                    // echo '<td>' . $distance == $inf ? 'INF' : $distance . '</td>';
                                }
                            @endphp
                        </tr>
                    @endforeach
                </table>
            </div>
            @php
                $nodenames = $floydwarshall->getNodeNames();
                $nodes = $floydwarshall->getNodes();
                $distances = $floydwarshall->getDistances();

            @endphp
            <div class="col-md-6">
                <p>Berikut table jarak antar rute wisata setelah dihitung.</p>

                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>#</th>
                        @foreach ($nodeNames as $i => $wisata)
                            <th style="width:15px!important;height:15px;font-size:12px">{{ $wisata }}</th>
                        @endforeach
                    </tr>
                    @foreach ($nodeNames as $i => $wisata1)
                        <tr>
                            <th style="width:15px!important;height:15px;font-size:12px">{{ $wisata1 }}</th>
                            @php
                                // $jarakTotal = 0;
                                foreach ($nodeNames as $j => $wisata2) {
                                    echo '<td style="width:15px!important;height:15px;font-size:12px">' . ($distances[$i][$j] === PHP_INT_MAX ? 'INF' : $distances[$i][$j]) . '</td>';
                                    // $distance = $distanceMatrix[$i][$j];
                                    // echo '<td>' . $distance == $inf ? 'INF' : $distance . '</td>';
                                }
                            @endphp
                        </tr>
                    @endforeach
                </table>
            </div>
            <p>Rute terpendek dari
                <span class="text-dark font-weight-bold">{{ $awal }}</span> menuju
                <span class="text-dark font-weight-bold">{{ $tujuan }}</span> berdasarkan perhitungan dengan algoritma
                <span class="text-dark font-weight-bold">Floydwarshall</span> adalah sebagai berikut :
            </p>


            <hr />
        </div>
        <div class="row pl-2">

            @php
                $path = $floydwarshall->getPath($indexAwal, $indexTujuan);
                $distances = $floydwarshall->getDistances();

                echo '<br>';
                $countPath = count($path);
                foreach ($path as $key => $value) {
                    echo '<p class="text-bold text-dark font-weight-bold">' . $nodeNames[$value];
                    if ($key < $countPath - 1) {
                        echo ' &rarr; ';
                    }
                    echo '</p>';
                }
            @endphp
        </div>
        <div class="row pl-2">
            {{-- @php
                $distances = $floydwarshall->getDistances();
                for
            @endphp --}}
            <p>Jarak tempuh : <span class="text-dark font-weight-bold">
                    {{ $distances[$indexAwal][$indexTujuan] }} km</span>
            </p>
        </div>
    </div>
    <br>
    <br>
    <h3>Dijkstra.</h3>
    <div class="card p-4">
        <p>Rute terpendek dari
            <span class="text-dark font-weight-bold">{{ $awal }}</span> menuju
            <span class="text-dark font-weight-bold">{{ $tujuan }}</span> berdasarkan perhitungan dengan algoritma
            <span class="text-dark font-weight-bold">Dijkstra </span> adalah sebagai berikut :
        </p>

        <br>
        <div class="row pl-3">

            @php
                // {{-- {{ ddd(count($path[1])) }} --}}

                foreach ($pathDijkstra as $key => $value) {
                    echo '<p class="text-bold text-dark font-weight-bold">' . $value;
                    if ($key < $countPathDijkstra - 1) {
                        echo ' &rarr; ';
                    }
                    echo '</p>';
                }
            @endphp

        </div>
        <div class="row pl-3">
            <p>Jarak tempuh : <span class="text-dark font-weight-bold">{{ $totalJarakDijkstra }} km</span> </p>
        </div>
    </div>

@endsection
@if (count($errors) > 0)
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show')
            })
        </script>
    @endsection
@endif
