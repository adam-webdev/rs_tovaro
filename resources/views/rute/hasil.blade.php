@extends('layouts.layout')
@section('title', 'Data Hasil Perhitungan')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Hasil Perhitungan Algoritma </h1>
        <!-- Button trigger modal -->

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        @foreach ($uniqueWisata as $wisata)
                            <th>{{ $wisata }}</th>
                        @endforeach
                    </tr>
                    @foreach ($uniqueWisata as $i => $wisata1)
                        <tr>
                            <th>{{ $wisata1 }}</th>
                            @php
                                foreach ($uniqueWisata as $j => $wisata2) {
                                    echo '<td>' . $i . ',' . $j . '</td>';
                                    // $distance = $distanceMatrix[$i][$j];
                                    // echo '<td>' . $distance == $inf ? 'INF' : $distance . '</td>';
                                }
                            @endphp
                        </tr>
                    @endforeach
                </table>
            </div>
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
