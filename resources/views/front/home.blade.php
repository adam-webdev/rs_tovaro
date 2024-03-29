<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/jpg" sizes="16x16" href="/favicon.jpg">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', 'Home') </title>




    <link href="{{ asset('asset/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>

    </style>
</head>

<body style="overflow-x:hidden">

    <div class="video-background">
        <video autoplay muted loop poster="{{ asset('asset/img/bali.jpg') }}" width="100%"
            style="object-fit: cover; position: absolute; z-index: -1;">
            <source src="{{ asset('asset/img/background.mp4') }}" type="video/mp4">
            <!-- Tambahan sumber video jika diperlukan -->
        </video>

        <nav class="navbar navbar-expand topbar" style="background-color: transparent!important; ">

            <div class="input-group-append">
                <a href="/" style="text-decoration: none">
                    <h4 class="logo text-white font-weight-bold">Wisata Papua </h4>
                </a>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                @if (!Auth::user())
                    <li class="nav-item dropdown no-arrow">
                        <a href="{{ route('login') }}" class="nav-link text-white">Masuk</a>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a href="{{ route('register') }}" class="nav-link text-white">Daftar</a>
                    </li>
                @else
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li> --}}
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
                            @if (Auth::user()->foto)
                                <img style="object-fit: cover" class="img-profile rounded-circle border-white"
                                    src="/storage/{{ Auth::user()->foto }}">
                            @else
                                <img class="img-profile rounded-circle border-white"
                                    src="{{ asset('asset/img/avatar2.png') }}">
                            @endif
                        </a>
                        {{-- <p>{{ }}</p> --}}

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow " aria-labelledby="userDropdown">
                            {{-- @if (Auth::user()->roles->pluck('name')[0] == 'Admin') --}}
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                            {{-- @else
                                <a class="dropdown-item" href="{{ route('user.profile', [Auth::user()->id]) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            @endif --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>

        <div class="container">

            <div class="content ">
                <p>Jelajahi keindahan alam di kota Mimika Papua Tengah yang luar biasa
                    dan temukan keunikan budaya suku-suku asli yang memukau.</p>
            </div>
        </div>

    </div>

    <div class="container text-center mt-4">
        <h3 class="text-dark" style="color:black">Selamat datang di Kota Mimika Papua Tengah.</h3>
        <p>Berikut titik-titik lokasi tempat wisata</p>
    </div>


    <div class="row p-4" style="margin-top:20px;margin-bottom:50px">
        <div class="col-md-12">

            <div id='mymap' style='height: 600px; width:100%'>
                {{-- <div id="search-container">
                                <input type="text" id="search-input" placeholder="Cari lokasi">
                            </div> --}}
                <div id="buttons">
                    <button type="button" id="streetButton">
                        <i class="fas fa-map-marked"></i>
                    </button>
                    <button type="button" id="satelliteButton">
                        <i class="fas fa-globe-asia"></i>
                    </button>
                </div>
            </div>
        </div>

    </div> {{-- logout modal --}}

    <div class="row p-4"
        style="background: black;color:#fff;padding-top:40px!important;padding-bottom:40px!important;">
        <div class="col-md-3">
            <div class="div">
                <div class="icon">
                    <i class="fas fa-th"></i>
                </div>
                <p>Keanekaragaman Budaya </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div">
                <div class="icon">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <p>Keindahan Alam</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div">
                <div class="icon">
                    <i class="fas fa-language"></i>
                </div>
                <p>Bahasa dan Budaya</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div">
                <div class="icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <p>Aneka Kuliner khas</p>
            </div>
        </div>
    </div>
    <div class="row mt-4 p-4 align-items-center justify-content-center">
        <h4 style="color:black; font-weight:bold;border-bottom:6px solid black;border-radius:4px">Wisata Yang Tersedia
        </h4>
    </div>
    <div class="row p-4 gap-2">
        @foreach ($wisata as $w)
            <div class="col-md-3">
                <div class="card m-2">
                    <div width="100%" height="250px">
                        <img width="100%" height="250px" style="object-fit: cover"
                            src="/storage/{{ $w->banner }}" alt="{{ $w->nama_wisata }}">
                    </div>
                    <div class="card-body p-2">
                        <span class="text-dark font-weight-bold">{{ $w->nama_wisata }}</span><br>
                        <span>Biaya masuk : <span class="badge badge-sm badge-success">
                                @if ($w->harga == 0)
                                    {{ 'Gratis' }}
                                @else
                                    @currency($w->harga)
                                @endif
                            </span></span><br>
                        <span>Jam operasional <p>{{ $w->jam_buka }} - {{ $w->jam_tutup }}</p></span>
                    </div>
                    <a href="{{ !Auth::user() ? '#' : route('wisata.show', [$w->id]) }}" width="100%"
                        class="p-2 btn btn-sm popup-btn" style="background: #000;color:#fff">Lihat detail</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row flex-column mt-4 p-4 align-items-center justify-content-center"
        style="background: black;color:#fff;padding-top:40px!important;padding-bottom:40px!important;">
        <h6>Wisata Mimika, Papua Tengah </h6>
        <h6> Indonesia 🇮🇩
            <span class="indonesia">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40"
                    zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="40"
                    preserveAspectRatio="xMidYMid meet" version="1.0">
                    <defs>
                        <clipPath id="id1">
                            <path
                                d="M 2.128906 5.222656 L 27.53125 5.222656 L 27.53125 15 L 2.128906 15 Z M 2.128906 5.222656 "
                                clip-rule="nonzero" />
                        </clipPath>
                        <clipPath id="id2">
                            <path
                                d="M 2.128906 14 L 27.53125 14 L 27.53125 23.371094 L 2.128906 23.371094 Z M 2.128906 14 "
                                clip-rule="nonzero" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#id1)">
                        <path fill="rgb(86.268616%, 12.159729%, 14.898682%)"
                            d="M 24.703125 5.222656 L 4.957031 5.222656 C 3.398438 5.222656 2.132812 6.472656 2.132812 8.015625 L 2.132812 14.296875 L 27.523438 14.296875 L 27.523438 8.015625 C 27.523438 6.472656 26.261719 5.222656 24.703125 5.222656 Z M 24.703125 5.222656 "
                            fill-opacity="1" fill-rule="nonzero" />
                    </g>
                    <g clip-path="url(#id2)">
                        <path fill="rgb(93.328857%, 93.328857%, 93.328857%)"
                            d="M 27.523438 20.578125 C 27.523438 22.121094 26.261719 23.371094 24.703125 23.371094 L 4.957031 23.371094 C 3.398438 23.371094 2.132812 22.121094 2.132812 20.578125 L 2.132812 14.296875 L 27.523438 14.296875 Z M 27.523438 20.578125 "
                            fill-opacity="1" fill-rule="nonzero" />
                    </g>
                </svg>
            </span>
        </h6>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar aplikasi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" apabila ingin keluar aplikasi</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

{{-- Navbar style animasi --}}
<script>
    let prevScrollPos = window.pageYOffset;
    console.log(prevScrollPos)
    window.onscroll = function() {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollPos > currentScrollPos) {
            // Pengguna menggulir ke atas, munculkan navbar
            document.querySelector(".navbar").style.top = "0";
        } else {
            // Pengguna menggulir ke bawah, sembunyikan navbar
            document.querySelector(".navbar").style.top = "-80px";
            // Sesuaikan dengan tinggi navbar Anda
        }
        if (currentScrollPos > window.innerHeight) {
            document.querySelector(".navbar").style.background = "#101820";
        } else {
            document.querySelector(".navbar").style.background = "transparent";
        }
        prevScrollPos = currentScrollPos;
    }
</script>

{{--  map --}}
<script>
    function alertLogin() {
        return Swal.fire({
            type: 'error',
            title: 'Silahkan masuk terlebih dahulu',
            text: 'Anda belum login'
        });
    }
    const token = "{{ config('app.mapbox_api_key') }}"

    mapboxgl.accessToken = token
    var mymap = new mapboxgl.Map({
        container: 'mymap',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [136.56555, -4.54357],
        zoom: 9
    })


    // button untuk merubah style map
    document.getElementById('streetButton').addEventListener('click', function() {
        mymap.setStyle('mapbox://styles/mapbox/streets-v11');
    });

    document.getElementById('satelliteButton').addEventListener('click', function() {
        mymap.setStyle('mapbox://styles/mapbox/satellite-streets-v12');

    });
    var navigation = new mapboxgl.NavigationControl();
    mymap.addControl(navigation, 'top-right');


    // search box
    const geocoder = new MapboxGeocoder({
        accessToken: token,
        mapboxgl,
        countries: "id",
        language: "id"
    });


    mymap.addControl(
        geocoder, 'top-left'
    );

    // <button id="buttonTujuan" class="btn btn-sm popup-btn" style="background: #000;color:#fff" type="button">Pilih sebagai tujuan</button>
    const dataWisata = {!! json_encode($wisata) !!}

    dataWisata.forEach((data) => {
        // console.log(data.latitude, data.longitude)

        // card popup
        let cardHtml = `<div class="row m-1 gap-2">
                        <div class="card">
                            <input type="hidden" id="lat" value="${data.latitude}">
                            <input type="hidden" id="lng" value="${data.longitude}">
                            <img width="200px" src="/storage/${data.banner}" alt="${data.nama_wisata}">
                            <div class="card-body p-2">
                                <span style="color:black;font-weight:bold;">${data.nama_wisata}</span><br>
                                <span>Biaya masuk :
                                    <span class="badge badge-sm badge-success">
                                    ${data.harga == 0 ? "Gratis": data.harga}
                                    </span>
                                </span><br>
                                <span>Jam operasional
                                    <p>${data.jam_buka} - ${data.jam_tutup}</p>
                                </span>
                            </div>

                    </div>
                </div>`


        // custom icon marker
        var customMarker = document.createElement('div')
        customMarker.className = "marker-custom"
        customMarker.style.width = '30px'
        customMarker.style.height = '30px'
        customMarker.style.backgroundImage = `url('storage/${data.banner}')`
        console.log("baground",
            `url('storage/${data.banner}')`)
        // end

        // timika lat 4.5468, lng 136.8837
        //posisi anda

        // popup custom
        const popup = new mapboxgl.Popup().setHTML(cardHtml)

        // marker lokasi wisata
        const markerData = new mapboxgl.Marker(customMarker)
            .setLngLat([data.longitude, data.latitude])
            .setPopup(popup)
            .addTo(mymap)
        // ketika popup dibuka
        popup.on('open', () => {
            const latitudeTujuan = document.getElementById('lat').value
            const longitudeTujuan = document.getElementById('lng').value
            const buttonTujuan = document.getElementById('buttonTujuan')
            // menghapus popup ketika button tujuan diclick
            if (buttonTujuan) {
                buttonTujuan.addEventListener('click', () => {
                    //lokasi sesuai device
                    // const posisiAnda = [longitudeMe, latitudeMe]
                    const posisiAnda = [136.8837, -4.5468]
                    const posisiTujuan = [longitudeTujuan, latitudeTujuan]
                    getRoute(posisiAnda, posisiTujuan)
                    markerData.getPopup().remove()
                })
            }

        })
    })

    // });
    // } else {
    //     console.log("Geolocation tidak didukung di browser ini.");
    // }

    // async function getRoute(start, end) {
    //     const requestApi = await fetch(
    //         `https://api.mapbox.com/directions/v5/mapbox/walking/${start[0]},${start[1]};${end[0]},${end[1]}?alternatives=true&steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`, {
    //             method: 'GET'
    //         })
    //     const responseJson = await requestApi.json()
    //     console.log("response", responseJson)
    //     const data = responseJson.routes[0]
    //     const route = data.geometry.coordinates
    //     const geojson = {
    //         type: 'Feature',
    //         properties: {},
    //         geometry: {
    //             type: 'LineString',
    //             coordinates: route
    //         }

    //     }
    //     if (mymap.getSource('route')) {
    //         mymap.getSource('route').setData(geojson)
    //     } else {
    //         mymap.addLayer({
    //             id: "route",
    //             type: "line",
    //             source: {
    //                 type: "geojson",
    //                 data: geojson
    //             },
    //             layout: {
    //                 'line-join': 'round',
    //                 'line-cap': 'round'
    //             },
    //             paint: {
    //                 'line-color': '#0000a7',
    //                 'line-width': 5,
    //                 'line-opacity': 0.75
    //             }
    //         })
    //     }
    // }
</script>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('asset/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('asset/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('asset/js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('asset/js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('asset/vendor/select2/dist/js/select2.min.js') }}"></script>

</html>
