@extends('layouts.layout')
@section('title', 'Create Periksa')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('periksa.store') }}" method="POST">
        @csrf
        <input type="hidden" name="daftarpoli_id" value="{{ $daftarpoli->id }}" class="form-control">
        <div class="row">
            <div class="col-md-8">
                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Periksa Pasien</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokter">Pasien :</label>
                                    <input type="text" value="{{ $daftarpoli->pasien->nama }}" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokter">Tanggal Periksa :</label>
                                    <input type="date" name="tgl_periksa" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="obat">Obat :</label>
                                    <select name="obat_id[]" id="obat" class="form-control select2" multiple>
                                        <option value="" disabled>-- Pilih Obat --</option>
                                        @foreach ($obat as $obat)
                                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="catatan">Catatan :</label>
                                    <textarea class="form-control" placeholder="Masukan catatan..." name="catatan" id="catatan" rows="5"></textarea>
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
