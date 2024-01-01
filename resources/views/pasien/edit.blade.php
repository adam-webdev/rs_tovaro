@extends('layouts.layout')
@section('title', 'Edit Data pasien')


@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('pasien.update', [$pasien->id]) }}" method="POST">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Ubah Data Pasien</legend>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien :</label>
                            <input type="text" name="nama" value="{{ $pasien->nama_pasien }}" class="form-control"
                                id="nama_pasien" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <tlabel for="no_ktp">No Ktp :</tlabel>
                            <input type="number" name="no_ktp" value="{{ $pasien->no_ktp }}" class="form-control"
                                id="no_ktp" required />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp">No Hp :</label>
                            <input type="text" name="no_hp" value="{{ $pasien->no_hp }}" class="form-control"
                                id="no_hp" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <tlabel for="no_rm">No Rekam Medis :</tlabel>
                            <input type="number" name="no_rm" value="{{ $pasien->no_rm }}" class="form-control"
                                id="no_rm" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea class="form-control" placeholder="Masukan alamat.." name="alamat" id="alamat" rows="5">{{ $pasien->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <input type="Button" class="btn btn-secondary btn-send" value="Kembali" onclick="history.go(-1)">
                @role('Admin')
                    <input type="submit" class="btn btn-success btn-send" value="Simpan Perubahan">
                @endrole
            </fieldset>
        </div>
    </form>
@endsection
