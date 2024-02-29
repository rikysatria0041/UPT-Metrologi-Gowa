<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Login') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistem Informasi Manajemen Pelayanan Tera Ulang Pada UPT Metrologi Legal Kab. Gowa">
        <meta name="keywords" content="Sistem Informasi Manajemen Pelayanan Tera Ulang Pada UPT Metrologi Legal Kab. Gowa">
        <meta name="author" content="this.vin">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Selamat Diting !</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2"> 
                                <div class="p-1">
                                    <form method="POST" class="form-horizontal" action="{{ route('login') }}">
                                        @csrf                                   
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Username" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('register') }}" class="btn btn-success btn-block waves-effect waves-light">Daftar</a>
                                        </div>
                                        {{-- <div class="mt-4 text-center">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                            @endif
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-5 text-center">
                            <div>
                                <p>Kembali ke <a href="{{ url('/') }}" class="font-weight-medium text-primary">halaman utama</a></p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>
