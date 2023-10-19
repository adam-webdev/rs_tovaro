@extends('layouts.layout')
@section('title', 'Data Wisata')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Wisata </h1>
        <!-- Button trigger modal -->
        @role('Admin')
            <a href="{{ route('wisata.create') }}">
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
                                <th>No</th>
                                <th>Nama </th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup </th>
                                <th>Banner</th>
                                <th>Kota </th>
                                <th>Provinsi </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wisata as $t)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->nama_wisata }}</td>
                                    <td><span class="badge badge-success">{{ $t->jam_buka }}</span></td>
                                    <td><span class="badge badge-danger">{{ $t->jam_tutup }}</span></td>
                                    <td>
                                        <img style="display:block;10px!important;border-radius:8px" width="200"
                                            src="/storage/{{ $t->banner }}" alt="" />
                                    </td>
                                    <td>{{ $t->kota }}</td>
                                    <td>{{ $t->provinsi }}</td>
                                    <td align="center" width="15%">
                                        <div class="dropdown show">
                                            <a style="background: rgb(240, 240, 240)" class="btn  dropdown-toggle"
                                                href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item text-primary font-weight-bold"
                                                    href="{{ route('wisata.show', [$t->id]) }}">
                                                    Detail</a>
                                                @role('Admin')
                                                    <a class="dropdown-item text-secondary font-weight-bold"
                                                        href="{{ route('wisata.edit', [$t->id]) }}">Edit </a>

                                                    <a href="/wisata/hapus/{{ $t->id }}" data-toggle="tooltip"
                                                        title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                                        class=" dropdown-item text-danger font-weight-bold">
                                                        Hapus
                                                    </a>
                                                @endrole
                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('wisata.show', [$t->id]) }}" data-toggle="tooltip" title="Detail"
                                        class="d-none  d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                        <i class="fas fa-eye fa-sm text-white-50"></i>
                                    </a>
                                    @hasanyrole('Admin|User')
                                        <a href="{{ route('wisata.edit', [$t->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/wisata/hapus/{{ $t->id }}" data-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin Ingin menghapus ?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                        </a>
                                    @endhasanyrole --}}
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
