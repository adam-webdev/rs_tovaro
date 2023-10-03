@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
        @role('Admin')
            <div class="card-header py-3" align="right">
                <a href="{{ route('user.create') }}">
                    <button class="btn btn-primary  btn-flat" data-toggle="modal" data-target="#modal-add">
                        + Tambah</button>
                </a>
            </div>
        @endrole
    </div>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            <th>Nik</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->nik }}</td>
                                <td>{{ $row->jenis_kelamin }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    {{ $row->roles->pluck('name') }}
                                </td>
                                <td> <img src="storage/{{ $row->foto }}" width="200px" alt="profile"> </td>
                                <td align="center" width="15%">
                                    <div class="dropdown show">
                                        <a class="btn bg-white dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-primary font-weight-bold"
                                                href="{{ route('user.show', [$row->id]) }}">
                                                Detail</a>
                                            <a class="dropdown-item text-secondary font-weight-bold"
                                                href="{{ route('user.edit', [$row->id]) }}">Edit </a>

                                            <a href="/user/hapus/{{ $row->id }}" data-toggle="tooltip" title="Hapus"
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
