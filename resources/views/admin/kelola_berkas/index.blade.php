@extends('layouts.app')
@section('title','Permohonan Masuk')
@section('css_section')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- END: Custom CSS-->
@endsection

@section('content_header')
<div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Data Permohonan Masuk</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Permohonan Masuk
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    @if (session('status'))
    <div class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('status') }}</strong>
    </div>
    @endif
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Permohonan Tera/Tera Ulang</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Tanggal</th>
                                            <th>Opsi</th>
                                            <th>Invoice</th>
                                            <th>Bukti Bayar</th>
                                            <th>Jadwal</th>
                                            <th>SKHP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->user->profilePerusahaan->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y'); }}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ url('admin/permohonan-masuk/'.$item->id) }}" class="btn btn-success btn-sm">Detail</a>                                            
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($item->invoice == NULL)
                                                        <a href="{{ url('admin/invoice/'.$item->id) }}" class="btn btn-info btn-sm">unggah</a>                                            
                                                    @else
                                                        <a href="{{ url(Storage::url($item->invoice)) }}" target="_blank" class="btn btn-success btn-sm"><i class="la la-eye"></i></a>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($item->invoice != NULL)
                                                        @if ($item->bukti_bayar == NULL)
                                                            belum di-unggah                                           
                                                        @else
                                                            <a href="{{ url(Storage::url($item->bukti_bayar)) }}" target="_blank" class="btn btn-success btn-sm"><i class="la la-eye"></i></a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($item->bukti_bayar != NULL)
                                                        @if ($item->jadwal == NULL)
                                                            <a href="{{ url('admin/jadwal/'.$item->id) }}" class="btn btn-info btn-sm">unggah</a>                                            
                                                        @else
                                                            <a href="{{ url(Storage::url($item->jadwal)) }}" target="_blank" class="btn btn-success btn-sm"><i class="la la-eye"></i></a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($item->jadwal != NULL)
                                                        @if ($item->file_sk == NULL)
                                                            <a href="{{ url('admin/sk/'.$item->id) }}" class="btn btn-info btn-sm">unggah</a>                                            
                                                        @else
                                                            <a href="{{ url(Storage::url($item->file_sk)) }}" target="_blank" class="btn btn-success btn-sm"><i class="la la-eye"></i></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js_section')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/headroom.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- END: Page JS-->
@endsection