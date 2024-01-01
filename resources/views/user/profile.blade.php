@extends('layouts.layout')
@section('title', 'Profile')

@section('content')
    <div class="card p-4">
        <div class="d-sm-flex align-items-center justify-content-between ">
            <h1 class="h3 mb-0 text-gray-800">Detail Profil </h1>
            <!-- Button trigger modal -->
            <a href="{{ route('user.edit', [$user->id]) }}" data-toggle="tooltip" title="Edit"
                class="d-none  d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-edit text-white-50"></i>
                {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
            </a>
        </div>
        <hr>
        <h4 class="mb-4">Profile</h4>
        <div class="row">

            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td> <b>{{ $user->name }}</b></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> <b>{{ $user->email }}</b></td>
                    </tr>
                    {{-- <tr>
                        <td>No HP</td>
                        <td> <b>{{ $user->email }}</b></td>
                    </tr> --}}
                    {{-- <tr>
                        <td>Nik</td>
                        <td> <b>{{ $user->nik }}</b></td>
                    </tr> --}}
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td> <b>{{ $user->jenis_kelamin }}</b></td>
                    </tr>
                </table>

            </div>
        </div>
        @role('Dokter')
            <h4 class="mb-4">Poli :</h4>
            <div class="row">

                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama Poli</td>
                            <td>Keterangan</td>
                        </tr>
                        @foreach ($poli as $p)
                            <tr>
                                <td> <b>{{ $p->nama_poli }}</b></td>
                                <td> <b>{{ $p->keterangan }}</b></td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        @endrole
    </div>
@endsection
