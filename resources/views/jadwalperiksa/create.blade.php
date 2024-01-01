@extends('layouts.layout')
@section('title', 'Create Jadwal Periksa')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('jadwalperiksa.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">

                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Jadwal Periksa</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokter">Dokter :</label>
                                    <select name="dokter_id" id="dokter" class="form-control">
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($dokter as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hari">Hari :</label>
                                    <select name="hari" id="hari" class="form-control">
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mulai">Jam Mulai :</label>
                                    <input type="time" name="jam_mulai" placeholder="Masukan jam mulai..."
                                        class="form-control" id="mulai" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selesai">Jam Selesai :</label>
                                    <input type="time" name="jam_selesai" placeholder="Masukan jam selesai..."
                                        class="form-control" id="selesai" required />
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
