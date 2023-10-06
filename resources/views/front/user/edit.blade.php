@extends('front.Layout')
@section('title', 'Edit profile')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>

    </div>
    <!-- modal add data-->
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('update.profile', [$user->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label>Nama User :</label>
                        <input type="text" value="{{ $user->name }}" name="name" required
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>NIK :</label>
                        <input type="text" value="{{ $user->nik }}" name="nik" required
                            class="form-control @error('nik') is-invalid @enderror">
                        @error('nik')
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
                        <label>No HP :</label>
                        <input type="number" value="{{ $user->no_hp }}" name="no_hp" required
                            class="form-control @error('no_hp') is-invalid @enderror">
                        @error('no_hp')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin :</label>
                        <select id="roles" name="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki laki" {{ $user->jenis_kelamin == 'Laki laki' ? 'selected' : '' }}>Laki laki
                            </option>
                            <option value="Perempuan" value="Laki laki"
                                {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Foto :</label>
                        <input type="file" name="foto" class="form-control mb-2">
                        <img height="200px" src="/storage/{{ $user->foto }}" alt="profile">
                    </div>
                    <input type="hidden" value="{{ $user->roles->pluck('name') }}" name="roles" required
                        class="form-control">

                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
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
