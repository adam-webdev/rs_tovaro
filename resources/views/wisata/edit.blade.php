@extends('layouts.layout')
@section('title', 'Edit Wisata')

@section('css')
    <style>
        .wrapp-image {
            border: 2px dashed grey;
            display: flex;
            height: 150px;
            align-items: center;
            justify-content: center;
        }

        .dropzone-desc {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            width: 40%;
            top: 50px;
            font-size: 16px;
        }

        .wrapp-image:hover,
        .image:hover {
            cursor: pointer;
            border: 2px dashed rgb(18, 18, 66);

        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-exist {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-exist-images {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-image {
            max-width: 120px;
            height: 80;
            margin: 5px;
            object-position: 'center';
            object-fit: cover;
        }

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

        .preview-banner {
            max-width: 150px;
            height: 100;
            margin: 5px;
            object-position: 'center';
            object-fit: cover;
        }

        .remove-button {
            background-color: red;
            color: white;
            border: none;
            padding: 2px 6px;
            cursor: pointer;
        }

        .images {
            opacity: 0;
            /* border: 1px solid black; */
            width: 100%;
            height: 100%;
        }

        .icon-upload {
            width: 40px;
            text-align: center;
        }


        .btn-image {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5;
            margin-top: 10px;
            margin-right: 10px;
        }
    </style>
@endsection
@section('content')
    @include('sweetalert::alert')

    <form action="{{ route('wisata.update', [$wisata->id]) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        {{-- <input type="hidden" name="" method="PUT" id=""> --}}
        <div class="card  p-3 ">
            <fieldset>
                <legend class="form-header">Ubah Data Wisata</legend>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_wisata">Nama Wisata :</label>
                            <input type="text" name="nama_wisata" value="{{ $wisata->nama_wisata }}" class="form-control"
                                id="nama_wisata" required class="@error('nama_wisata') is-invalid @enderror" />
                            @error('nama_wisata')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="biaya">Biaya Masuk :</label>
                            <input type="number" value="{{ $wisata->harga }}" name="harga" class="form-control"
                                id="biaya" class="@error('biaya') is-invalid @enderror" />
                            @error('biaya')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="buka">Jam Buka :</label>
                            <input type="time" value="{{ $wisata->jam_buka }}" name="jam_buka" class="form-control"
                                id="buka" class="@error('jam_buka') is-invalid @enderror" />
                            @error('jam_buka')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tutup">Jam Tutup :</label>
                            <input type="time" value="{{ $wisata->jam_tutup }}" name="jam_tutup" class="form-control"
                                id="tutup" class="@error('jam_tutup') is-invalid @enderror" />
                            @error('jam_tutup')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Wisata:</label>
                            <textarea type="text" id="summernote deskripsi" rows="10" name="deskripsi" class="form-control" required
                                class="@error('deskripsi') is-invalid @enderror">{{ $wisata->deskripsi }}</textarea>
                            @error('deskripsi')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="bannerInput">Banner Wisata: <span class="text-sm text-danger">File harus berformat (jpg,
                                jpeg, png)</span></label>
                        <div class="wrapp-image" id="bannerWrapper">
                            <div class="dropzone-desc">
                                {{-- <i class="glyphicon glyphicon-download-alt"></i> --}}
                                <i class="fas fa-cloud-upload-alt icon-upload"></i>
                                <p>Pilih sebuah gambar atau tarik kesini.</p>
                            </div>
                            <input type="file" value="{{ $wisata->banner }}" id="bannerInput" rows="10"
                                name="banner" class="form-control-file images @error('banner') is-invalid @enderror" />

                        </div>

                        {{-- @error('images')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror --}}
                        @error('banner')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div id="existBanner" class="preview-exist">
                            <img class="preview-banner" src="/storage/{{ $wisata->banner }}"
                                alt="{{ $wisata->nama_wisata }}">
                        </div>
                        <div id="bannerPreview" class="preview-container"></div>
                    </div>
                </div>
                <div class="row" style="margin-top:20px">
                    <div class="col-md-11">
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
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="latitude">Latitude :</label>
                            <input type="text" value="{{ $wisata->latitude }}" name="latitude" class="form-control"
                                id="latitude" required class="@error('latitude') is-invalid @enderror" />
                            @error('latitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="longitude">Longitude :</label>
                            <input type="text" value="{{ $wisata->longitude }}" name="longitude"
                                class="form-control" id="longitude" required
                                class="@error('longitude') is-invalid @enderror" />
                            @error('longitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan :</label>
                            <input type="text" value="{{ $wisata->kecamatan }}" name="kecamatan"
                                class="form-control" id="kecamatan" class="@error('kecamatan') is-invalid @enderror" />
                            @error('kecamatan')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kota :</label>
                            <input type="text" value="{{ $wisata->kota }}" name="kota" class="form-control"
                                id="kota" class="@error('kota') is-invalid @enderror" />
                            @error('kota')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi :</label>
                            <input type="text" value="{{ $wisata->provinsi }}" name="provinsi" class="form-control"
                                id="provinsi" class="@error('provinsi') is-invalid @enderror" />
                            @error('provinsi')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-11">
                            <label for="file">Image Wisata: <span class="text-sm text-danger">File harus berformat
                                    (jpg, jpeg, png)</span></label>
                            <div class="wrapp-image" id="imageWrapper">
                                <div class="dropzone-desc">
                                    {{-- <i class="glyphicon glyphicon-download-alt"></i> --}}
                                    <i class="fas fa-cloud-upload-alt icon-upload"></i>

                                    <p>Masukan beberapa foto wisata yang diinginkan.</p>
                                </div>
                                <input type="file" id="imageInput" rows="10" name="images[]" multiple
                                    class="form-control-file images @error('images.*') is-invalid @enderror" />

                            </div>
                            {{-- @error('images')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror --}}
                            @foreach ($errors->get('images.*') as $error)
                                <div class="alert alert-danger mt-2">{{ $error[0] }}</div>
                            @endforeach
                            <div id="existImages" class="preview-exist-images">
                                @foreach ($wisata->wisataimages as $img)
                                    <img id="{{ $img->id }} imgWisata" class="preview-image"
                                        src="/storage/{{ $img->path }}" alt="{{ $img->path }}">
                                @endforeach
                            </div>
                            <div id="imagePreview" class="preview-container"></div>
                        </div>
                    </div>
                </div>

                <input type="Button" class="btn btn-secondary btn-send" value="Kembali" onclick="history.go(-1)">
                <input type="submit" class="btn btn-success btn-send" value="Simpan Perubahan">
            </fieldset>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript">
        const bannerInput = document.getElementById('bannerInput')
        const bannerPreview = document.getElementById('bannerPreview')
        const bannerWrapper = document.getElementById('bannerWrapper')
        const existBanner = document.getElementById('existBanner')

        // menampilkan banner yang diinput
        bannerInput.addEventListener('change', function() {
            bannerPreview.innerHTML = ''
            const bannerImage = bannerInput.files[0]
            console.log(bannerImage)
            const readerBanner = new FileReader()

            readerBanner.onload = function(e) {
                existBanner.style.display = "none"
                const banner = document.createElement('img')
                banner.src = e.target.result
                banner.className = 'preview-banner'
                bannerPreview.appendChild(banner)
            }
            readerBanner.readAsDataURL(bannerImage)
        })

        const imageInput = document.getElementById('imageInput')
        const imagePreview = document.getElementById('imagePreview')
        const imageWrapper = document.getElementById('imageWrapper')
        const existImages = document.getElementById('existImages')

        // menampilkan beberapa images yang diinput
        imageInput.addEventListener('change', function() {
            imagePreview.innerHTML = ''
            const files = Array.from(imageInput.files);
            files.forEach(function(file) {
                console.log("file", file)
                const reader = new FileReader()

                reader.onload = function(e) {
                    existImages.style.display = "none"
                    const img = document.createElement('img')
                    img.src = e.target.result
                    img.className = 'preview-image'
                    imagePreview.appendChild(img)
                }
                reader.readAsDataURL(file)
            });
        })

        const deleteImage = document.querySelector('.preview-image');
    </script>
    <script>
        $(document).ready(function() {
            $('#tag').select2({
                tags: true,
                width: 'resolve'
            });
        });
        $(document).ready(function() {
            $('#summernote').summernote();
        })
    </script>

    <script>
        const token = "{{ config('app.mapbox_api_key') }}"
        const latDB = "{{ $wisata->latitude }}"
        const lngDB = "{{ $wisata->longitude }}"
        mapboxgl.accessToken = token
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [lngDB, latDB],
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

        var marker = null
        // menambahkan marker dari lat,lng yang tersedia di db


        marker = new mapboxgl.Marker().setLngLat([lngDB, latDB]).addTo(map)

        map.on('click', async function(e) {
            console.log("event", e.lngLat)
            if (marker !== null) {
                marker.remove()
            }
            marker = new mapboxgl.Marker().setLngLat(e.lngLat).addTo(map)
            //desa = 1, kecamatan = 2.locality, kota = 3.place, 4.provinsi = region
            const data = await fetch(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${e.lngLat.lng},${e.lngLat.lat}.json?language=id&access_token=${token}`, {
                    method: "GET"
                }
            )
            const response = await data.json()

            const latitude = e.lngLat.lat
            const longitude = e.lngLat.lng
            let kecamatan, kota, provinsi
            if (response.features[0].context.length === 5) {
                kecamatan = response.features[0].context[1].text
                kota = response.features[0].context[2].text
                provinsi = response.features[0].context[3].text
            } else {
                kecamatan = response.features[0].context[2].text
                kota = response.features[0].context[3].text
                provinsi = response.features[0].context[4].text
            }

            // mengisi otomatis input lat, lng, kecamatan, kota, provinsi
            document.getElementById('latitude').value = latitude
            document.getElementById('longitude').value = longitude
            document.getElementById('kecamatan').value = kecamatan
            document.getElementById('kota').value = kota
            document.getElementById('provinsi').value = provinsi
            console.log("data = ", response.features[0])
        })
    </script>
@endsection
