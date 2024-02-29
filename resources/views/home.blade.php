@extends('layouts.app')
@section('title','BERANDA')
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

@endsection

@section('content')
<div class="content-body">
    @if (Auth::user()->hasRole(['Admin', 'Super Admin']))
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{ $jml_permohonan_aktif }}</h3>
                                <h6 style="color: chartreuse">Permohonan Aktif</h6>
                            </div>
                            <div>
                                <i class="la la-clock-o info font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{ $jml_permohonan_acc }}</h3>
                                <h6>Permohonan Diterima</h6>
                            </div>
                            <div>
                                <i class="la la-check-circle-o success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ $jml_permohonan_decline }}</h3>
                                <h6>Permohonan Ditolak</h6>
                            </div>
                            <div>
                                <i class="la la-times-circle-o danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->hasRole('Perusahaan'))
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{ $jml_permohonan_aktif }}</h3>
                                <h6>Permohonan Aktif</h6>
                            </div>
                            <div>
                                <i class="la la-clock-o info font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{ $jml_permohonan_acc }}</h3>
                                <h6>Permohonan Diterima</h6>
                            </div>
                            <div>
                                <i class="la la-check-circle-o success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ $jml_permohonan_decline }}</h3>
                                <h6>Permohonan Ditolak</h6>
                            </div>
                            <div>
                                <i class="la la-times-circle-o danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                            <th>Masa Berlaku SKHP</th>
                                            <th>Count Down</th>
                                            <th>Tgl Permohonan</th>
                                            <th>Tgl Acc Admin</th>
                                            <th>Tgl Acc Super Admin</th>
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
                                                <td>{{ \Carbon\Carbon::parse($item->masa_berlaku)->format('d-m-Y'); }}</td>
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
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y'); }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_approved_admin)->format('d-m-Y'); }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tgl_approved_super_admin)->format('d-m-Y'); }}</td>
                                                <td>
                                                    <a href="{{ url('riwayat-permohonan/'.$item->id) }}" class="btn btn-success btn-sm">Detail</a>
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
    @endif
</div>
@endsection

@section('js_section')
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
