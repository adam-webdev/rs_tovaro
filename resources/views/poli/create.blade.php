@extends('layouts.layout')
@section('title', 'Create Data Poli')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('poli.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">

                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Poli</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Poli :</label>
                                    <input type="text" name="nama_poli" placeholder="Masukan nama..."
                                        class="form-control" id="nama" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangana">Keterangan :</label>
                                    <textarea class="form-control" placeholder="Masukan keterangan..." name="keterangan" id="keterangan" rows="5"></textarea>
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
