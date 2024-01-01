@extends('layouts.layout')
@section('title', 'Edit Data Periksa')


@section('content')
    @php
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    @endphp
    @include('sweetalert::alert')
    <form action="{{ route('periksa.update', [$periksa->id]) }}" method="POST">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Edit Data Periksa Pasien</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokter">Pasien :</label>
                                    <input type="text" value="{{ $periksa->daftarpoli->pasien->nama }}" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokter">Tanggal Periksa :</label>
                                    <input type="text" name="tgl_periksa"
                                        value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->isoFormat('dddd, D MMMM Y') }}"
                                        class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="obat">Obat :</label>
                                    <select name="obat_id[]" id="obat" class="form-control select2" multiple>
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach ($obat as $o)
                                            <option value="{{ $o->id }}"
                                                {{ in_array($o->id, $detail_periksa->pluck('obat_id')->toArray()) ? 'selected' : '' }}>
                                                {{ $o->nama_obat }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="catatan">Catatan :</label>
                                    <textarea class="form-control" placeholder="Masukan catatan..." name="catatan" id="catatan" rows="5">{{ $periksa->catatan }}</textarea>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2()

        })
    </script>
@endsection
