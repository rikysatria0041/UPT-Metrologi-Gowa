@extends('layouts.app')
@section('title','Input Data Jenis Alat')
@section('css_section')

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-content-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

@endsection

@section('content_header')
<div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Jenis Alat</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('admin/jenis-alat') }}">Jenis Alat</a>
                </li>
                <li class="breadcrumb-item active">Edit Data
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="content-body">
        <section id="horizontal-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                        </button>
                                        {{ session('status') }}
                                    </div>
                                    </div>
                                @endif
                                <form class="form form-horizontal" method="post" action="{{ url('profil/'.$profil->id) }}" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-user"></i><b>Data Profil</b></h4>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input1">Nama Perusahaan</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="input1" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $profil->profilePerusahaan->nama }}">
                                                <small class="text-danger"> {{ $errors->first('nama') }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input2">Email Perusahaan</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="input2" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $profil->email }}">
                                                <small class="text-danger"> {{ $errors->first('email') }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input3">Alamat Perusahaan</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="input3" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $profil->profilePerusahaan->alamat }}">
                                                <small class="text-danger"> {{ $errors->first('alamat') }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input4">No. Telp Perusahaan</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="input4" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $profil->profilePerusahaan->no_telp }}">
                                                <small class="text-danger"> {{ $errors->first('no_telp') }}</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">Izin Usaha</label>
                                            <div class="col-md-9 mx-auto">
                                                <label id="izin_usaha" class="file center-block">
                                                    <input type="file" name="izin_usaha" id="izin_usaha">
                                                    <span class="file-custom"></span>
                                                </label>
                                                <small class="text-danger"> {{ $errors->first('izin_usaha') }}</small>
                                            </div>
                                        </div> 
                                        
                                        <div class="form-actions text-right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js_section')
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/headroom.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
@endsection