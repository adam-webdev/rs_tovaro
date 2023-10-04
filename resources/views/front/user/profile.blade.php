@extends('front.home')
@section('title', 'Profile')

@section('content')
    <div class="card p-4">
        <div class="d-sm-flex align-items-center justify-content-between ">
            <h1 class="h3 mb-0 text-gray-800">Detail Data User </h1>
            <!-- Button trigger modal -->
            <a href="{{ route('edit.profile', [$user->id]) }}" data-toggle="tooltip" title="Edit"
                class="d-none  d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-edit text-white-50"></i>
                {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
            </a>
        </div>
        <hr>
        <h4 class="mb-4">Profile</h4>
        <div class="row">
            <div class="col-md-3" style="display: flex; justify-content:space-between; flex-direction:column;">
                @if ($user->foto != 'default.jpg')
                    <img class="flex-1" style="border:2px solid black" src="/storage/{{ $user->foto }}" width="200px"
                        alt="foto profile">
                @else
                    <img class="flex-1" src="{{ asset('asset/img/profile.png') }}" width="200px" alt="foto profile">
                @endif
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
                        <td>No HP</td>
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
                </table>

            </div>
        </div>
    </div>
@endsection
