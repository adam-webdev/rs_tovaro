@extends('layouts.layout')
@section('title', 'Data Periksa')
@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Riwayat Periksa Pasien </h1>
        <!-- Button trigger modal -->
        {{-- @role('Admin')
            <a href="{{ route('periksa.create') }}">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Tambah
                </button>
            </a>
        @endrole --}}

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
                                <th>No Rekam Medis </th>
                                <th>Tanggal periksa</th>
                                <th>Catatan</th>
                                {{-- <th>Obat </th> --}}
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periksa as $p)
                                <tr align="center">
                                    <td width="2%">{{ $loop->iteration }}</td>
                                    <td>{{ $p->daftarpoli->pasien->nama }}</td>
                                    <td>{{ $p->daftarpoli->pasien->no_rm }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tgl_periksa)->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>{{ $p->catatan }}</td>
                                    <td>@currency($p->biaya_periksa)</td>

                                    <td align="center" width="15%">
                                        <div class="dropdown show">
                                            <a style="background: rgb(240, 240, 240)" class="btn  dropdown-toggle"
                                                href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                {{-- @role('Admin') --}}
                                                <a class="dropdown-item text-secondary font-weight-bold"
                                                    href="{{ route('periksa.edit', [$p->id]) }}">Edit </a>
                                                <a class="dropdown-item text-secondary text-success font-weight-bold"
                                                    href="{{ route('rincian', [$p->id]) }}">Rincian Biaya </a>

                                                {{-- <a href="/periksa/hapus/{{ $p->id }}" data-toggle="tooltip"
                                                    title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                    class=" dropdown-item text-danger font-weight-bold">
                                                    Hapus
                                                </a> --}}
                                                {{-- @endrole --}}
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
