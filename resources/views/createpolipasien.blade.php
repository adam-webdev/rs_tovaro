<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/jpg" sizes="16x16" href="/rumahsakit.jpg">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', 'RS Tovaro')</title>
    <link href="{{ asset('asset/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- swal --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <style>
        body {
            background: url("{{ asset('asset/img/bg-home.jpg') }}");
            object-fit: contain;
            background-size: 100%;
            /* background-position: center; */
        }

        .daftar {
            width: 500px;
            box-shadow:
                0 1px 2px 0 rgba(60, 64, 67, .3), 0 1px 3px 1px rgba(60, 64, 67, .15)
        }

        .row {
            width: 100%;
        }

        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <form action="{{ route('polipasien.simpan') }}" method="POST" style="margin-top: 50px">
        @csrf
        <div class="row">

            <div class="card daftar  p-3">
                <fieldset>
                    <legend class="form-header text-center">Form Pendaftaran Poli</legend>
                    <div class="logo">
                        <img class="text-center mt-4" width="120px" src="{{ asset('asset/img/rumahsakit.jpg') }}"
                            alt="logo rs">
                        <h5 class="text-center text-dark mt-2">Rs Tovaro</h5>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_ktp">No KTP :</label>
                                <input type="number" minlength="16" maxlength="16" name="no_ktp"
                                    placeholder="Masukan no ktp..." class="form-control" id="no_ktp" required />
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_hp">No Hp :</label>
                                <input type="number" minlength="11" maxlength="13" name="no_hp"
                                    placeholder="Masukan no hp..." class="form-control" id="no_hp" required />
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

                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Cek No KTP / NIK</button>
                        </div>
                    </div>
                    <a href="/" class=" text-center d-block mt-2">kembali</a>
                    {{-- <span class="d-block mt-2 mb-2 text-center text-dark">Sudah pernah daftar pasien? silhkan klik
                        daftar
                        poli</span>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('daftarpoli.pasien') }}" class="btn btn-success w-100 text-white">Daftar
                                Poli</a>
                        </div>
                    </div>
                </fieldset>
                <span class="text-dark text-center mt-2">Login sebagai Admin atau Dokter <a
                        class="text-dark text-center mt-2" href="{{ route('login') }}"><b><u>Klik
                                disini</u></b></a></span> --}}
            </div>
        </div>
    </form>


</body>

</html>
