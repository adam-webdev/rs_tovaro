@extends('layouts.layout')
@section('title', 'Edit Data Graph')
@section('css')
    <style>
        #buttons {
            position: absolute;
            bottom: 0;
            margin-bottom: 10px;
            left: 100px;
            z-index: 1;
        }

        #search-container {
            position: absolute;
            top: 10px;
            left: 100px;
            z-index: 1;
        }

        #search-input {
            width: 200px;
            padding: 8px;
        }




        .marker-custom {
            border-radius: 50%;
            cursor: pointer;
            background-size: cover;
        }

        .popup-btn:focus {
            border: none;
        }

        .popup-btn:hover {
            transition: .5s;
            background: rgba(1, 1, 1, 0.637) !important
        }

        .popup-btn-awal:hover {
            transition: .5s;
            background: rgb(224, 224, 224) !important;
        }
    </style>
@endsection
@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('graph.update', [$graph->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Edit Rute</legend>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="awal">Posisi Awal :</label>
                            <input type="text" name="awal" value="{{ $graph->awal }}" class="form-control"
                                id="awal" required readonly class="@error('awal') is-invalid @enderror" />
                            @error('awal')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan :</label>
                            <input type="text" name="tujuan" value="{{ $graph->tujuan }}" class="form-control"
                                id="tujuan" required readonly class="@error('tujuan') is-invalid @enderror" />
                            @error('tujuan')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                            <input type="hidden" id="setLatAwal">
                            <input type="hidden" id="setLngAwal">
                            <input type="hidden" id="setLatTujuan">
                            <input type="hidden" id="setLngTujuan">
                        </div>
                        <div class="form-group">
                            <label for="jarak">Jarak (km):</label>
                            <input type="text" name="jarak" value="{{ $graph->jarak }}" class="form-control"
                                id="jarak" required readonly class="@error('jarak') is-invalid @enderror" />
                            @error('jarak')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="waktu">Waktu (jam):</label>
                            <input type="text" name="waktu" value="{{ $graph->waktu }}" class="form-control"
                                id="waktu" required readonly class="@error('waktu') is-invalid @enderror" />
                            @error('waktu')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id='map' style='height: 600px;'>
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
                </div>

                <div class="mt-2 gap-2">

                    <input type="Button" class="btn btn-secondary btn-send mr-2" value="Kembali" onclick="history.go(-1)">
                    <input type="submit" class="btn btn-success btn-send" value="Simpan">
                </div>
            </fieldset>
        </div>
    </form>
@endsection
@section('scripts')

    <script>
        const token = "{{ config('app.mapbox_api_key') }}"
        mapboxgl.accessToken = token
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [136.56555, -4.54357],
            zoom: 9
        })
        // button untuk merubah style
        document.getElementById('streetButton').addEventListener('click', function() {
            map.setStyle('mapbox://styles/mapbox/streets-v11');
        });

        document.getElementById('satelliteButton').addEventListener('click', function() {
            map.setStyle('mapbox://styles/mapbox/satellite-streets-v12');

        });
        var navigation = new mapboxgl.NavigationControl();
        map.addControl(navigation, 'top-right');

        const geocoder = new MapboxGeocoder({
            accessToken: token,
            mapboxgl,
            countries: "id",
            language: "id"
        });

        map.addControl(
            geocoder, 'top-left'
        );

        // console.log("geocode", geocoder)
        // document.getElementById('search-container').appendChild(geocoder.onAdd(map));

        const dataWisata = {!! json_encode($wisata) !!}

        console.log(dataWisata)
        dataWisata.forEach((data) => {
            // console.log(data.banner)
            // console.log(data.latitude, data.longitude)

            // card popup
            let cardHtml = `
                <div class="row m-1 gap-2">
                    <div class="card p-2">
                        <span class="text-dark font-weight-bold">${data.nama_wisata}</span>
                        <input type="hidden" id="namaWisata" value="${data.nama_wisata}">
                        <input type="hidden" id="lat" value="${data.latitude}">
                        <input type="hidden" id="lng" value="${data.longitude}">
                        <img width="200px" src="/storage/${data.banner}" alt="${data.nama_wisata}">
                        <span>Biaya masuk : <span class="badge badge-sm badge-success">${data.harga == 0 ? "Gratis": data.harga}</span></span>
                        <span>Jam operasional <p>${data.jam_buka} - ${data.jam_tutup}</p></span>
                        <button id="buttonAwal" class="btn btn-sm popup-btn-awal" style="background: #fff;color:#000;border:1px solid black" type="button">Pilih sebagai posisi awal</button>
                        <button id="buttonTujuan" class="btn mt-2 btn-sm popup-btn" style="background: #000;color:#fff" type="button">Pilih sebagai
                            tujuan</button>
                    </div>
                </div>`


            // custom icon marker
            var customMarker = document.createElement('div')
            customMarker.className = "marker-custom"
            customMarker.style.width = '40px'
            customMarker.style.height = '40px'
            // customMarker.style.backgroundImage = `url('storage/${data.banner}')`
            // end
            // console.log(
            //     "Background", `url('storage/${data.banner}')`
            // )
            // timika lat 4.5468, lng 136.8837

            // popup custom
            const popup = new mapboxgl.Popup().setHTML(cardHtml)

            const markerWisata = new mapboxgl.Marker({
                    color: 'red'
                })
                .setLngLat([data?.longitude, data?.latitude])
                .setPopup(popup)
                .addTo(map)
            // marker lokasi wisata
            // const markerWisata = new mapboxgl.Marker(customMarker)


            // ketika popup dibuka
            popup.on('open', () => {
                const latitudeW = document.getElementById('lat').value
                const longitudeW = document.getElementById('lng').value

                const jarak = document.getElementById('jarak')
                const waktu = document.getElementById('waktu')

                const namaWisata = document.getElementById('namaWisata').value

                const buttonAwal = document.getElementById('buttonAwal')
                const buttonTujuan = document.getElementById('buttonTujuan')

                const namaWistaAwal = document.getElementById('awal')
                const namaWistaTujuan = document.getElementById('tujuan')

                // kirim value
                const setLatTujuan = document.getElementById('setLatTujuan')
                const setLngTujuan = document.getElementById('setLngTujuan')
                const setLatAwal = document.getElementById('setLatAwal')
                const setLngAwal = document.getElementById('setLngAwal')

                let posisiAwal;
                let posisiTujuan;



                // menghapus popup ketika button tujuan diclick
                buttonAwal.addEventListener('click', () => {
                    setLatAwal.value = latitudeW
                    setLngAwal.value = longitudeW
                    // console.log("lokasi", latitudeW, longitudeW)
                    namaWistaAwal.value = namaWisata
                    if (namaWistaAwal.value == namaWistaTujuan.value) {
                        Swal.fire({
                            type: 'error',
                            title: 'Posisi awal dan tujuan tidak boleh sama!',
                            text: 'Terjadi Kesalahan!',
                        });
                        namaWistaAwal.value = ""
                    }
                    markerWisata.getPopup().remove()
                })

                buttonTujuan.addEventListener('click', () => {
                    setLatTujuan.value = latitudeW
                    setLngTujuan.value = longitudeW
                    namaWistaTujuan.value = namaWisata
                    if (namaWistaAwal.value == namaWistaTujuan.value) {
                        Swal.fire({
                            type: 'error',
                            title: 'Posisi awal dan tujuan tidak boleh sama!',
                            text: 'Terjadi Kesalahan!',
                        });
                        namaWistaTujuan.value = ""
                    }
                    posisiAwal = [setLatAwal.value, setLngAwal.value]
                    posisiTujuan = [setLatTujuan.value, setLngTujuan.value]
                    if (posisiAwal.length > 0 && posisiTujuan.length > 0) {
                        getRoute(posisiAwal, posisiTujuan)

                    }
                    markerWisata.getPopup().remove()
                })

            })
        })

        async function getRoute(posisiAwal, posisiTujuan) {
            console.log("posisiAwal Route", posisiAwal)
            console.log("posisiTujuan Route", posisiTujuan)
            const requestApi = await fetch(
                `https://api.mapbox.com/directions/v5/mapbox/walking/${posisiAwal[1]},${posisiAwal[0]};${posisiTujuan[1]},${posisiTujuan[0]}?alternatives=true&steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`, {
                    method: 'GET'
                })
            const responseJson = await requestApi.json()
            if (responseJson.code == "NoRoute") {
                document.getElementById('awal').value = ""
                document.getElementById('tujuan').value = ""
                return Swal.fire({
                    type: 'error',
                    title: 'Route tidak ditemukan',
                    text: 'Silahkan pilih lokasi yang lain!',
                });

            }
            console.log("response route", responseJson)
            const data = responseJson.routes[0]
            const jarakResult = data.distance / 1000
            // send value to input jarak
            jarak.value = jarakResult.toFixed(1)
            // send value to input waktu
            const waktuResult = data.duration / 3600
            waktu.value = waktuResult.toFixed(1)
            console.log("jarak ", jarakResult, "km")
            console.log("waktu ", waktuResult, "jam")
            const route = data.geometry.coordinates
            const geojson = {
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'LineString',
                    coordinates: route
                }

            }
        }
        // if (mymap.getSource('route')) {
        //     mymap.getSource('route').setData(geojson)
        // } else {
        //     mymap.addLayer({
        //         id: "route",
        //         type: "line",
        //         source: {
        //             type: "geojson",
        //             data: geojson
        //         },
        //         layout: {
        //             'line-join': 'round',
        //             'line-cap': 'round'
        //         },
        //         paint: {
        //             'line-color': '#0000a7',
        //             'line-width': 5,
        //             'line-opacity': 0.75
        //         }
        //     })
        // }
        // }
    </script>
@endsection
