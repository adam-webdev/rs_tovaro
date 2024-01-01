@extends('layouts.layout')
@section('title', 'Create Data Pasien')

@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">

                <div class="card  p-3">
                    <fieldset>
                        <legend class="form-header">Tambah Data Pasien</legend>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Pasien :</label>
                                    <input type="text" name="nama" placeholder="Masukan nama..." class="form-control"
                                        id="nama" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_ktp">No KTP :</label>
                                    <input type="number" minlength="16" maxlength="16" name="no_ktp"
                                        placeholder="Masukan no ktp..." class="form-control" id="no_ktp" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No Hp :</label>
                                    <input type="number" minlength="11" maxlength="13" name="no_hp"
                                        placeholder="Masukan no hp..." class="form-control" id="no_hp" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No Rekam Medis :</label>
                                    <input type="text" name="no_rm" value="{{ $no_rm }}" readonly
                                        class="form-control" id="no_hp" required />
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

@section('scripts')
    <script>
        $(document).ready(function() {
            var ktp = $('#no_ktp').val();
            if (ktp.length > 16 && ktp.length < 16 && !/[0-9]{16}/.test(ktp)) {
                alert("Format harus angka berjumlah 16")
            }
        })
    </script>
@endsection
