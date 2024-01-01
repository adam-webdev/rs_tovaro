@extends('layouts.layout')
@section('title', 'Edit Data Dokter')


@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('dokter.update', [$dokter->id]) }}" method="POST">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Edit Data Dokter</legend>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Dokter :</label>
                            <input type="text" name="nama" value="{{ $dokter->nama }}" vlueplaceholder="Masukan nama..."
                                class="form-control" id="nama" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="biaya">No HP :</label>
                            <input type="number" name="no_hp" value="{{ $dokter->no_hp }}"
                                placeholder="Masukan no handphone..." class="form-control" id="biaya" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="poli">Poli :</label>
                            <select name="poli_id" id="poli" class="form-control">
                                {{-- <option value="">-- Pilih Poli --</option> --}}
                                @foreach ($poli as $p)
                                    <option value="{{ $p->id }}" {{ $dokter->poli->id === $p->id ? 'select' : '' }}>
                                        {{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea class="form-control" placeholder="Masukan alamat..." name="alamat" id="alamat" rows="5">{{ $dokter->alamat }}</textarea>
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
