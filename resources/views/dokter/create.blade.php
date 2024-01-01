@extends('layouts.layout')
@section('title', 'Create Data Dokter')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">

                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Dokter</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Dokter :</label>
                                    <input type="text" name="nama" placeholder="Masukan nama..." class="form-control"
                                        id="nama" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="biaya">No HP :</label>
                                    <input type="number" name="no_hp" placeholder="Masukan no handphone..."
                                        class="form-control" id="biaya" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="email" name="email" placeholder="Masukan email..." class="form-control"
                                        id="email" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input type="password" name="password" placeholder="Masukan password..."
                                        class="form-control" id="password" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin :</label>
                                    <select name="jenis_kelamin_id" id="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="poli">Poli :</label>
                                    <select name="poli_id" id="poli" class="form-control">
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach ($poli as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <textarea class="form-control" placeholder="Masukan alamat..." name="alamat" id="alamat" rows="5"></textarea>
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
