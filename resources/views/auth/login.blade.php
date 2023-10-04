<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Masuk</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body style="background: #f2f2f2">
    <div class="container">
        <!-- Outer Row -->
        <div class="card  shadow-lg center" style="margin-top:150px">

            <div class="row">
                <!-- Nested Row within Card Body -->

                <div class="col-md-6 p-4 align-items-center">
                    <div class="text-center">
                        <h1 class="h4 text-dark">Masuk<br>
                        </h1>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">

                                <label for="email">{{ __('E-Mail Address :') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">

                                <label for="password">{{ __('Password :') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="off">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                                <label for="password">{{ __('Konfirmasi Password :') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}


                        <div class="form-group row">
                            <div class="col-md-12">
                                <button style="width: 100%" type="submit" class="btn btn-primary">
                                    {{ __('Masuk') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-12 offset-md-12 text-center">
                                <a style="color:black" href="{{ route('register') }}">Belum punya akun ? silahkan
                                    <b>Register</b></a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('asset/img/bali.jpg') }}" style="object-fit: cover" width="100%"
                        height="100%">
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('asset/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('asset/js/sb-admin-2.min.js') }}"></script>
