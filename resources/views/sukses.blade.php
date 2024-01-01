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

    <style>
        body {
            background: url("{{ asset('asset/img/bg-home.jpg') }}") no-repeat;
            object-fit: contain;
            background-position: center;
        }

        .daftar {
            box-shadow:
                0 1px 2px 0 rgba(60, 64, 67, .3), 0 1px 3px 1px rgba(60, 64, 67, .15);
            margin: 10px;
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
    <div class="card p-4" style="margin-top: 50px">
        <div class="logo">
            <img class="text-center mt-4" width="120px" src="{{ asset('asset/img/rumahsakit.jpg') }}" alt="logo rs">
            <h5 class="text-center text-dark mt-2">Rs Tovaro</h5>
        </div>
        <table class="table table-bordered" width="400px">
            <tr>
                <td>No Antrian :</td>
                <td>{{ $add_daftarpoli->no_antrian }}</td>
            </tr>
            <tr>
                <td>Nama :</td>
                <td>{{ $cek_nik->nama }}</td>
            </tr>

            <tr>
                <td>Hari :</td>
                <td>{{ $jadwal->jadwalperiksa->hari }}</td>
            </tr>
            {{-- <tr>
                <td>Jam :</td>
                <td>{{ \Carbon\Carbon::parse($jadwal->jadwalperiksa->jam_mulai)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($jadwal->jadwalperiksa->jam_selesai)->format('H:i') }}</td>
            </tr> --}}
            <tr>
                <td>Dokter :</td>
                <td>{{ $jadwal->jadwalperiksa->dokter->nama }} </td>
            </tr>
            <tr>
                <td>Poli :</td>
                <td>{{ $jadwal->jadwalperiksa->dokter->poli->nama_poli }} </td>
            </tr>
        </table>

    </div>


</body>

</html>
