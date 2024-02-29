@extends('layouts.app')
@section('title','Unggah Jadwal')
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/invoice.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
@endsection

@section('content_header')
<div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Unggah Jadwal</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('admin/kelola-berkas') }}">Kelola Berkas</a>
                </li>
                <li class="breadcrumb-item active">Unggah Jadwal
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
    <section class="card">
        <div id="invoice-template" class="card-body">
            <div id="invoice-customer-details" class="row pt-2">
                <div class="col-sm-12 text-center text-md-left">
                    <p class="text-muted"><h3>Data Pemohon</h3></p>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-left">
                    <ul class="px-0 list-unstyled">
                        <li class="text-bold-800">Nama Perusahaan : {{ $dataPermohonan->user->profilePerusahaan->nama }}</li>
                        <li>Email : {{ $dataPermohonan->user->email }}</li>
                        <li>No. Telp : {{ $dataPermohonan->user->profilePerusahaan->no_telp }}</li>
                        <li>Alamat : {{ $dataPermohonan->user->profilePerusahaan->alamat }}</li>
                        <li>Surat Izin Usaha : <a href="{{ url(Storage::url($dataPermohonan->user->profilePerusahaan->izin_usaha)) }}" target="_blank">lihat file</a></li>
                        @if ($dataPermohonan->invoice != NULL)
                        <li>Invoice : <a href="{{ url(Storage::url($dataPermohonan->invoice)) }}" target="_blank">lihat file</a></li>
                        @endif
                        @if ($dataPermohonan->bukti_bayar != NULL)
                        <li>Bukti Bayar : <a href="{{ url(Storage::url($dataPermohonan->bukti_bayar)) }}" target="_blank">lihat file</a></li>
                        @endif
                        @if ($dataPermohonan->jadwal != NULL)
                        <li>Jadwal : <a href="{{ url(Storage::url($dataPermohonan->jadwal)) }}" target="_blank">lihat file</a></li>
                        @endif
                        @if ($dataPermohonan->file_sk != NULL)
                        <li>SKHP : <a href="{{ url(Storage::url($dataPermohonan->file_sk)) }}" target="_blank">lihat file</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <p><span class="text-muted">Tanggal Kirim :</span> {{ $dataPermohonan->updated_at }}</p>
                    <p><h4><span class="text-muted">Status : 
                        @if ($dataPermohonan->status == 'DIPROSES')
                            </span><span class="badge badge-warning">{{ $dataPermohonan->status }}
                        @elseif($dataPermohonan->status == 'ACC ADMIN' || $dataPermohonan->status == 'ACC SUPER ADMIN')
                            </span><span class="badge badge-success">{{ $dataPermohonan->status }}
                        @elseif($dataPermohonan->status == 'TOLAK ADMIN' || $dataPermohonan->status == 'TOLAK SUPER ADMIN')
                            </span><span class="badge badge-danger">{{ $dataPermohonan->status }}
                        @endif
                    </span></h4></p>
                </div>
            </div>
            <div id="invoice-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Jenis Alat</th>
                                    <th class="text-center">Kapasitas</th>
                                    <th class="text-center">Merk</th>
                                    <th class="text-center">Model/Tipe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPermohonan as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-left">
                                    {{ $item->jenisAlat->nama }}
                                    @if ($item->jenisAlat->nama == 'Nozzle' || $item->jenisAlat->nama == 'nozzle' || $item->jenisAlat->nama == 'NOZZLE')
                                        - <a href="{{ url(Storage::url($item->file)) }}" target="_blank"> lihat file</a>
                                    @endif
                                    </td>
                                    <td class="text-center">{{ $item->kapasitas }}</td>
                                    <td class="text-center">{{ $item->merk }}</td>
                                    <td class="text-center">{{ $item->model_type }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form class="form form-horizontal" method="post" action="{{ url('admin/jadwal/'.$dataPermohonan->id) }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-3 label-control">Unggah Jadwal</label>
                            <div class="col-md-9 mx-auto">
                                <label id="jadwal" class="file center-block">
                                    <input type="file" name="jadwal" id="jadwal">
                                    <span class="file-custom"></span>
                                </label>
                                <small class="text-danger"> {{ $errors->first('jadwal') }}</small>
                            </div>
                        </div> 
                        
                        <div class="form-actions text-right">
                            <a href="{{ url('admin/kelola-berkas') }}"><button type="button" class="btn btn-warning mr-1">
                                <i class="ft-x"></i> Batal
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-send"></i> Kirim
                        </button>
                    </div>
                </form>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
@endsection