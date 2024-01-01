@extends('layouts.layout')
@section('title', 'Daftar Periksa Pasien')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Periksa Pasien </h1>


    </div>
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th width="2%">No</th>
                                <th>Nama Pasien </th>
                                <th>No HP/WA</th>
                                <th>Keluhan</th>
                                <th>No Rekam Medis</th>
                                <th>Hari </th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarpoli as $dp)
                                <tr align="center">
                                    <td width="2%">{{ $loop->iteration }}</td>
                                    <td>{{ $dp->pasien->nama }}</td>
                                    <td>{{ $dp->pasien->no_hp }}</td>
                                    <td>{{ $dp->keluhan }}</td>
                                    <td>{{ $dp->pasien->no_rm }}</td>
                                    <td>{{ $dp->jadwalperiksa->hari }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dp->jadwalperiksa->jam_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($dp->jadwalperiksa->jam_selesai)->format('H:i') }}</td>
                                    <td align="center" width="15%">
                                        {{-- <div class="dropdown show">
                                            <a style="background: rgb(240, 240, 240)" class="btn  dropdown-toggle"
                                                href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </a> --}}
                                        {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> --}}

                                        <a class="btn btn-sm btn-success font-weight-bold"
                                            href="{{ route('periksa.pasien', [$dp->id]) }}">
                                            <i class="fas fa-edit"></i>
                                            catatan </a>
                                        {{-- </div>
                                        </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
