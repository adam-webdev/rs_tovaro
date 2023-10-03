@extends('layouts.layout')
@section('content')
    <div class="card p-2">
        <h4 class="mb-4">Profile</h4>
        <div class="row">
            <div class="col-md-3" style="display: flex; justify-content:space-between; flex-direction:column;">
                @if ($user->foto != 'default.jpg')
                    <img class="flex-1" src="/storage/{{ $user->foto }}" width="200px" alt="foto profile">
                @else
                    <img class="flex-1" src="{{ asset('asset/img/profile.png') }}" width="200px" alt="foto profile">
                @endif
                <a style="margin-top:100px; display:block;" class=" btn btn-secondary"
                    href="{{ route('user.edit', [$user->id]) }}">Edit
                    Profile</a>
            </div>
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
                    <tr>
                        <td>Nik</td>
                        <td> <b>{{ $user->nik }}</b></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td> <b>{{ $user->jenis_kelamin }}</b></td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td> <b>{{ $user->posisi->nama_posisi }}</b></td>
                    </tr>

                    <tr>
                        <td>Seksi</td>
                        <td> <b>{{ $user->seksi->nama_seksi }}</b></td>
                    </tr>

                    <tr>
                        <td>Kode PGR</td>
                        <td> <b>{{ $user->pgr->kode_pgr }}</b></td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
@endsection
