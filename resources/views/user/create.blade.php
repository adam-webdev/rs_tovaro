@extends('layouts.layout')
@section('title', 'Create User')

@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Pengguna</h1>

    </div>
    <!-- modal add data-->
    <div class="row">
        <div class="col-md-6">

            <div class="card p-3">
                <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('user.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Nama User :</label>
                        <input type="text" name="name" required autocomplete="off"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email User :</label>
                        <input type="email" name="email" required
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin :</label>
                        <select id="roles" name="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-laki">Laki laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Roles :</label>
                        <select id="roles" name="role" class="form-control" required>
                            <option value="">--Pilih Roles--</option>
                            <option value="Admin">Admin</option>
                            <option value="Dokter">Dokter</option>
                            <option value="Pasien">Pasien</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" required
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    {{-- @role('Admin') --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- @endrole --}}
                </form>
            </div>

        </div>
    </div>
@endsection
