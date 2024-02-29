@extends('layouts.app')
@section('title','Info SKHP')
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
    <!-- END: Custom CSS-->
@endsection

@section('content_header')
<div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Info SKHP</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</a>
                </li>
                <li class="breadcrumb-item active">Info SKHP
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Info SKHP</h4>
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
                                            <th>Status</th>
                                            <th>Tgl Permohonan</th>
                                            <th>Tgl Acc Admin</th>
                                            <th>Tgl Acc Super Admin</th>
                                            <th>Masa Berlaku SKHP</th>
                                            <th>Count Down</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->status == 'DIPROSES')
                                                        </span><span class="badge badge-warning">{{ $item->status }}
                                                    @elseif($item->status == 'ACC ADMIN' || $item->status == 'ACC SUPER ADMIN')
                                                        </span><span class="badge badge-success">{{ $item->status }}
                                                    @elseif($item->status == 'TOLAK ADMIN' || $item->status == 'TOLAK SUPER ADMIN')
                                                        </span><span class="badge badge-danger">{{ $item->status }}
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:i:s'); }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_approved_admin)->format('d-m-Y h:i:s'); }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_approved_super_admin)->format('d-m-Y h:i:s'); }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->masa_berlaku)->format('d-m-Y h:i:s'); }}</td>
                                                <td>
                                                    <p id="countdown-{{ $item->id }}"></p>
                                                </td>
                                                <script>
                                                    var waktuTarget_{{ $item->id }} = new Date('{{ $item->masa_berlaku }}').getTime();

                                                    var x_{{ $item->id }} = setInterval(function() {
                                                        var sekarang = new Date().getTime();
                                                        var selisih = waktuTarget_{{ $item->id }} - sekarang;

                                                        var hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                                                        var jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
                                                        var detik = Math.floor((selisih % (1000 * 60)) / 1000);

                                                        document.getElementById("countdown-{{ $item->id }}").innerHTML = hari + " hari " + jam + " jam " + menit + " menit " + detik + " detik ";

                                                        if (selisih < 0) {
                                                            clearInterval(x_{{ $item->id }});
                                                            document.getElementById("countdown-{{ $item->id }}").innerHTML = "Masa berlaku habis!";
                                                        }
                                                    }, 1000);
                                                </script>
                                                <td>
                                                    @if (Auth::user()->hasRole(['Admin']))
                                                        <a href="{{ url('admin/riwayat-permohonan/'.$item->id) }}" class="btn btn-success btn-sm">Detail</a>  
                                                    @elseif (Auth::user()->hasRole(['Super Admin']))
                                                        <a href="{{ url('superadmin/riwayat-permohonan/'.$item->id) }}" class="btn btn-success btn-sm">Detail</a>  
                                                    @else
                                                        <a href="{{ url('admin/riwayat-permohonan/'.$item->id) }}" class="btn btn-success btn-sm">Detail</a>  
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
    <!-- END: Page JS-->
@endsection