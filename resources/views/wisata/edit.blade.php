@extends('layouts.layout')
@section('title', 'Edit Transaksi')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Transaksi </h1>
    </div>

    <div class="card p-4">
        <form action="{{ route('transaksi.update', [$transaksi->id]) }}" method="POST">
            @method('put')
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_po">No PO :</label>
                            <input type="number" name="no_po" value="{{ $transaksi->no_po }}" class="form-control"
                                id="no_po" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul_po">Judul PO :</label>
                            <input type="text" name="judul_po" value="{{ $transaksi->judul_po }}" class="form-control"
                                id="judul_po" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai_po">Nila PO :</label>
                            <input type="number" name="nilai_po" value="{{ $transaksi->nilai_po }}" class="form-control"
                                id="nilai_po" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai_impor">Nila Impor :</label>
                            <input type="number" name="nilai_impor" value="{{ $transaksi->nilai_impor }}"
                                class="form-control" id="nilai_impor" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="total_shipment">Total Shipment :</label>
                    <input type="number" name="total_shipment" value="{{ $transaksi->total_shipment }}"
                        class="form-control" id="total_shipment" required>
                </div>
                <div class="form-group">
                    <label for="total_nilai_impor">Total Nilai Impor :</label>
                    <input type="number" name="total_nilai_impor" class="form-control" id="total_nilai_impor"
                        value="{{ $transaksi->total_nilai_import }}" required>
                </div>
                <div class="form-group">
                    <label for="remaining_amount">Remaining Amount :</label>
                    <input type="number" name="remaining_amount" class="form-control" id="remaining_amount"
                        value="{{ $transaksi->remaining_amount }}" required>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="history.back(-1)"> Batal</button>
                @hasanyrole('Admin|User')
                    <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                @endhasanyrole
            </div>
        </form>
    </div>
@endsection
