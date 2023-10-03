@extends('layouts.layout')
@section('title', 'Detail Data Wisata')
@section('css')
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            /* Lebar minimum 200px, sebanyak mungkin kolom */
            gap: 16px;
            /* Jarak antar elemen */
        }

        .gallery-item {
            overflow: hidden;
            /* Untuk memotong gambar jika terlalu besar */
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .gallery-item img:hover {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Wisata </h1>
        <!-- Button trigger modal -->
        @hasanyrole('Admin|User')
            <a href="{{ route('wisata.edit', [$wisata->id]) }}" data-toggle="tooltip" title="Edit"
                class="d-none  d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-edit text-white-50"></i>
                {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
            </a>
        @endhasanyrole

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="font-weight-bold text-dark">{{ $wisata->nama_wisata }}</h5>
                <br>
                <div>Jam Operasional : <p class="badge badge-large badge-primary"> {{ $wisata->jam_buka }} -
                        {{ $wisata->jam_tutup }}</p>
                </div>
                <div>Biaya Masuk :
                    @if ($wisata->harga == 0)
                        <p class="badge badge-success"> gratis </p>
                    @else
                        <p class="badge badge-success"> @currency($wisata->harga)</p>
                    @endif
                </div>
                <div class="d-flex">Lokasi : <p class="ml-2 text-dark">Kecamatan {{ $wisata->kecamatan }},
                        Kota/Kabupaten {{ $wisata->kota }}, Provinsi
                        {{ $wisata->provinsi }}</p>
                </div>
                <img style="height: 300px;object-fit:cover;border-radius:4px;" src="/storage/{{ $wisata->banner }}"
                    alt="{{ $wisata->nama_wisata }}">
                <p style="text-indent: 50px;margin-top:10px;color:black">
                    {{ $wisata->deskripsi }}
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3" style="box-sizing: border-box">

                <p>Foto Tempat Wisata :</p>
                <div class="gallery">
                    @foreach ($wisata->wisataimages as $img)
                        <div class="gallery-item">
                            <img class="img-wisata" src="/storage/{{ $img->path }}" alt="{{ $wisata->nama_wisata }}">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    {{-- modal image --}}
    <div class="modal fade " id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img style="object-fit: cover; object-position:center;" width="100%" src="" id="modal-image"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".img-wisata").click(function() {
                var imgSrc = $(this).attr("src");
                $("#modal-image").attr("src", imgSrc);
                $("#myModal").modal();
            });
        });
    </script>
@endsection
