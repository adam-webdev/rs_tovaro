@extends('layouts.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="card p-4">
        <h5>Selamat Datang <b>{{ Auth::user()->name }} </b> di Dashboard Sistem Informasi Produksi</h5>
        <hr>
        <div class="row ">
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class="fas fa-user-injured text-primary" style="font-size:40px"></i></p>
                            <p>Pasien</p>
                        </span>
                        <span>
                            <p class="jumlah  font-weight-bold" style="font-size: 24px">{{ $pasien }}</p>
                            <a href="{{ route('pasien.index') }}" class="text-dark ">Detail
                                <i class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class=" fas fa-user-md text-primary" style="font-size:40px"></i></p>
                            <p>Dokter</p>
                        </span>
                        <span>
                            <p class="jumlah  font-weight-bold" style="font-size: 24px">{{ $dokter }}</p>
                            <a href="{{ route('dokter.index') }}" class="text-dark ">Detail <i
                                    class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class="fas fa-hospital text-primary" style="font-size:40px"></i></p>
                            <p>Poli</p>
                        </span>
                        <span>
                            <p class="jumlah font-weight-bold" style="font-size: 24px">{{ $poli }}</p>
                            <a href="{{ route('poli.index') }}" class="text-dark">Detail <i
                                    class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class="fas fa-pills text-primary" style="font-size:40px"></i></p>
                            <p>Obat</p>
                        </span>
                        <span>
                            <p class="jumlah  font-weight-bold" style="font-size: 24px ">{{ $obat }}</p>
                            <a href="{{ route('obat.index') }}" class="text-dark">Detail <i
                                    class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
