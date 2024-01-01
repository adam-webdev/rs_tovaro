@extends('layouts.layout')
@section('title', 'Create Data Obat')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('obat.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">

                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Obat</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Obat :</label>
                                    <input type="text" name="nama_obat" placeholder="Masukan nama obat..."
                                        class="form-control" id="nama" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kemasan">Keterangan :</label>
                                    <input type="text" name="kemasan" placeholder="Masukan kemasan..."
                                        class="form-control" id="kemasan" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga Obat :</label>
                                    <input type="number" name="harga" placeholder="Masukan harga obat..."
                                        class="form-control" id="harga" required />
                                </div>
                            </div>
                        </div>

                        <input type="Button" class="btn btn-secondary btn-send" value="Kembali" onclick="history.go(-1)">
                        <input type="submit" class="btn btn-success btn-send" value="Simpan">
                    </fieldset>
                </div>

            </div>
        </div>
    </form>
@endsection
