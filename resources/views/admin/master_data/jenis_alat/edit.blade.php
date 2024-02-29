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
                                <form class="form form-horizontal" method="post" action="{{ url('admin/jenis-alat/'.$jenisAlat->id) }}">
                                @method('patch')
                                @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-file-text-o"></i><b>Data Jenis Alat</b></h4>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="input1">Nama Jenis Alat</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" id="input1" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $jenisAlat->nama }}">
                                                <small class="text-danger"> {{ $errors->first('nama') }}</small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-actions text-right">
                                            <a href="{{ url('admin/jenis-alat') }}"><button type="button" class="btn btn-warning mr-1">
                                                <i class="ft-x"></i> Batal
                                                </button>
                                            </a>
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