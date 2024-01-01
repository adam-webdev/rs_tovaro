@extends('layouts.layout')
@section('title', 'Data Jadwal Periksa')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jadwal Periksa </h1>
        <!-- Button trigger modal -->
        @role('Admin')
            <a href="{{ route('jadwalperiksa.create') }}">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Tambah
                </button>
            </a>
        @endrole

    </div>

    <div class="card">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th width="2%">No</th>
                                <th>Nama Dokter </th>
                                <th>Hari Periksa</th>
                                <th>Jam Mulai </th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalperiksa as $jp)
                                <tr align="center">
                                    <td width="2%">{{ $loop->iteration }}</td>
                                    <td>{{ $jp->dokter->nama }}</td>
                                    <td>{{ $jp->hari }}</td>
                                    <td><span
                                            class="btn-sm btn-success ">{{ \Carbon\Carbon::parse($jp->jam_mulai)->format('H:i') }}</span>
                                    </td>
                                    <td> <span
                                            class="btn-sm btn-danger">{{ \Carbon\Carbon::parse($jp->jam_selesai)->format('H:i') }}</span>
                                    </td>
                                    <td align="center" width="15%">
                                        <div class="dropdown show">
                                            <a style="background: rgb(240, 240, 240)" class="btn  dropdown-toggle"
                                                href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                @role('Admin')
                                                    <a class="dropdown-item text-secondary font-weight-bold"
                                                        href="{{ route('jadwalperiksa.edit', [$jp->id]) }}">Edit </a>

                                                    <a href="/jadwalperiksa/hapus/{{ $jp->id }}" data-toggle="tooltip"
                                                        title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                        class=" dropdown-item text-danger font-weight-bold">
                                                        Hapus
                                                    </a>
                                                @endrole
                                            </div>
                                        </div>
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
