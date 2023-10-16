@extends('layouts.layout')
@section('title', 'Data Graph')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Simpul Rute </h1>
        <!-- Button trigger modal -->
        @hasanyrole('Admin|User')
            <a href="{{ route('graph.create') }}">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Tambah
                </button>
            </a>
        @endhasanyrole

    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Awal </th>
                            <th>Tujuan</th>
                            <th>Jarak </th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($graph as $t)
                            <tr align="center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->awal }}</td>
                                <td>{{ $t->tujuan }}</td>
                                <td>{{ $t->jarak }}</td>
                                <td>{{ $t->waktu }}</td>

                                <td align="center" width="15%">
                                    <div class="dropdown show">
                                        <a class="btn bg-white dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-primary font-weight-bold"
                                                href="{{ route('graph.show', [$t->id]) }}">
                                                Detail</a>
                                            <a class="dropdown-item text-secondary font-weight-bold"
                                                href="{{ route('graph.edit', [$t->id]) }}">Edit </a>

                                            <a href="/graph/hapus/{{ $t->id }}" data-toggle="tooltip" title="Hapus"
                                                onclick="return confirm('Yakin Ingin menghapus data?')"
                                                class=" dropdown-item text-danger font-weight-bold">
                                                Hapus
                                            </a>
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
