@extends('layouts.layout')
@section('title', 'Edit Data Jadwal Periksa')


@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('jadwalperiksa.update', [$jadwalperiksa->id]) }}" method="POST">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Edit Data Jadwal Periksa</legend>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokter">Dokter :</label>
                            <select name="dokter_id" id="dokter" class="form-control">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokter as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id === $jadwalperiksa->dokter_id ? 'selected' : '' }}>{{ $d->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hari">Hari :</label>
                            <select name="hari" id="hari" class="form-control">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin" {{ $jadwalperiksa->hari === 'Senin' ? 'selected' : '' }}>Senin
                                </option>
                                <option value="Selasa" {{ $jadwalperiksa->hari === 'Selasa' ? 'selected' : '' }}>Selasa
                                </option>
                                <option value="Rabu" {{ $jadwalperiksa->hari === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $jadwalperiksa->hari === 'Kamis' ? 'selected' : '' }}>Kamis
                                </option>
                                <option value="Jumat" {{ $jadwalperiksa->hari === 'Jumat' ? 'selected' : '' }}>Jumat
                                </option>
                                <option value="Sabtu" {{ $jadwalperiksa->hari === 'Sabtu' ? 'selected' : '' }}>Sabtu
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mulai">Jam Mulai :</label>
                            <input type="time" value="{{ $jadwalperiksa->jam_mulai }}" name="jam_mulai"
                                class="form-control" id="mulai" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="selesai">Jam Selesai :</label>
                            <input type="time" value="{{ $jadwalperiksa->jam_selesai }}" name="jam_selesai"
                                placeholder="Masukan jam selesai..." class="form-control" id="selesai" required />
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
