@extends('layouts.layout')
@section('title', 'Rincian Biaya Berobat')
@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rincian Biaya</h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <a href="{{ route('periksa.create') }}">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Tambah
                </button>
            </a>
        @endrole --}}

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <table>
                    <tr>
                        <td>
                            <h5>Data Pasien</h5>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%">Nama Pasien</td>
                        <td width="2%">:</td>
                        <td width="50%"><b>{{ $periksa->daftarpoli->pasien->nama }}</b></td>
                    </tr>
                    <tr>
                        <td width="20%">No Nik</td>
                        <td width="2%">:</td>
                        <td width="50%"><b>{{ $periksa->daftarpoli->pasien->no_ktp }}</b></td>
                    </tr>
                    <tr>
                        <td width="20%">No Rekam Medis</td>
                        <td width="2%">:</td>
                        <td width="50%"><b>{{ $periksa->daftarpoli->pasien->no_rm }}</b></td>
                    </tr>
                    <tr>
                        <td width="20%">No Hp/Wa</td>
                        <td width="2%">:</td>
                        <td width="50%"><b>{{ $periksa->daftarpoli->pasien->no_hp }}</b></td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="margin-top: 30px">Data Obat & Biaya Periksa</h5>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Biaya Periksa </td>
                        <td width="2%">:</td>
                        <td width="50%"><b>@currency(150000)</b></td>
                    </tr>

                    @foreach ($detail_periksa as $dp)
                        <tr>
                            <td width="20%">{{ $dp->obat->nama_obat }} </td>
                            <td width="2%">:</td>
                            <td width="50%"><b>@currency($dp->obat->harga)</b></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td width="20%">Total</td>
                        <td width="2%">:</td>
                        <td width="50%"><b>@currency($periksa->biaya_periksa)</b></td>
                    </tr>
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
