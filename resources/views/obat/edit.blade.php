@extends('layouts.layout')
@section('title', 'Edit Data Poli')


@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('poli.update', [$poli->id]) }}" method="POST">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Ubah Data Poli</legend>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_poli">Nama Poli :</label>
                            <input type="text" name="nama_poli" value="{{ $poli->nama_poli }}" class="form-control"
                                id="nama_poli" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keterangan">Keterangan :</label>

                            <textarea class="form-control" placeholder="Masukan keterangana..." name="keterangan" id="keterangana" rows="5">{{ $poli->keterangan }}</textarea>
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
