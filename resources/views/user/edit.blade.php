@extends('layouts.layout')
@section('title', 'Edit Profil')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profil </h1>

    </div>
    <!-- modal add data-->
    <div class="row">
        <div class="col-md-6">

            <div class="card p-3">
                <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('user.update', [$user->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label>Nama User :</label>
                        <input type="text" value="{{ $user->name }}" name="name" required autocomplete="off"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email User :</label>
                        <input type="email" value="{{ $user->email }}" name="email" required
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
                            <option value="Laki laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" value="Laki laki"
                                {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" value="{{ $user->roles->pluck('name') }}" name="roles" required
                        class="form-control">
                    {{-- <div class="form-group">
                        <label>Roles :</label>
                        <select id="roles" name="role" class="form-control" required>
                            <option value="">--Pilih Roles--</option>
                            <option value="Admin" {{ $user->roles->pluck('name') === '["Admin"]' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="User" {{ $user->roles->pluck('name') === '["User"]' ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </div> --}}

                    <span class="text-warning">Jika tidak ingin merubah password silahkan kosongkan!</span>
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                    </div>
                    {{-- @role('Admin') --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- @endrole --}}
                </form>
            </div>

        </div>
    </div>
@endsection
