@extends('layouts.app')
@section('title','Input Data Barang')
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
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Ajukan Permohonan
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="content-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section id="form-repeater">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form">Ajukan permohonan tera/tera ulang</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @if ($cekIzinUsaha->profilePerusahaan->izin_usaha == NULL)
                                    <div class="alert bg-warning alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Oops,</strong> agar dapat melakukan proses pengajuan tera/tera ulang anda diwajibkan mengunggah surat izin usaha pada menu profil terlebih dahulu. Terima Kasih
                                    </div>
                                @elseif($cekPermohonan > 0)
                                    <div class="alert bg-warning alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Maaf,</strong> anda tidak dapat melakukan permohonan layanan tera/tera ulang karena masih memiliki permohonan yang aktif. Terima Kasih
                                    </div>
                                @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-success block btn-lg" data-toggle="modal" data-target="#inlineForm">
                                    Tambah Data Alat
                                </button>
                                @if (session('status'))
                                    <div class="alert bg-success alert-dismissible mt-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade text-left" id="inlineForm" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <label class="modal-title text-text-bold-600" id="myModalLabel33">Input data alat</label>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal" method="post" action="{{ url('ajukan-permohonan') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <div class="modal-body">
                                                    <label>Jenis Alat : </label>
                                                    <div class="form-group">
                                                        <select name="jenis_alat_id" id="jenis_alat_id" class="form-control" onchange="showHideFileInput()" required>
                                                            <option value="" selected disabled>Pilih Jenis Alat</option>
                                                            @foreach ($jenisAlat as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div id="fileInputContainer" style="display: none;">
                                                        <label>Unggah File : </label>
                                                        <div class="form-group">
                                                            <input type="file" name="file" id="file" class="form-control">
                                                        </div>
                                                    </div>

                                                    <label>Kapasitas : </label>
                                                    <div class="form-group">
                                                        <select name="kapasitas" class="form-control" required>
                                                            <option value="" selected disabled>Pilih Kapasitas</option>
                                                            <option value="0kg - 10kg">0kg - 10kg</option>
                                                            <option value="10kg - 20kg">10kg - 20kg</option>
                                                            <option value="20kg - 30kg">20kg - 30kg</option>
                                                            <option value="30kg - 40kg">30kg - 40kg</option>
                                                            <option value="40kg - 50kg">40kg - 50kg</option>
                                                            <option value="50kg - 60kg">50kg - 60kg</option>
                                                        </select>
                                                    </div>

                                                    <label>Merk : </label>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Masukkan Merk" class="form-control" name="merk" required>
                                                    </div>

                                                    <label>Model/Tipe : </label>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Masukkan Model/Tipe" class="form-control" name="model_type" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal" value="close">
                                                    <input type="submit" class="btn btn-outline-primary" value="Simpan">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-2">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Alat</th>
                                                <th>Kapasitas</th>
                                                <th>Merk</th>
                                                <th>Model/Tipe</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPermohonan as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $item->jenisAlat->nama }}
                                                    @if ($item->jenisAlat->nama == 'Nozzle' || $item->jenisAlat->nama == 'nozzle' || $item->jenisAlat->nama == 'NOZZLE')
                                                        - <a href="{{ url(Storage::url($item->file)) }}" target="_blank"> lihat file</a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->kapasitas }}</td>
                                                <td>{{ $item->merk }}</td>
                                                <td>{{ $item->model_type }}</td>
                                                <td>
                                                    <form action="{{ url('ajukan-permohonan/'.$item->id) }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <form class="form form-horizontal" method="post" action="{{ url('data-permohonan') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-actions text-right">
                                            <a href="/home">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Batal
                                                </button>
                                            </a>
                                            <button type="submit" class="btn btn-info">
                                                <i class="la la-send"></i> Kirim
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
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
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        function showHideFileInput() {
            var selectBox = document.getElementById("jenis_alat_id");
            var fileInputContainer = document.getElementById("fileInputContainer");
            // Periksa jika pilihan yang dipilih adalah "Pilihan 1" atau "Pilihan 2"
            if (selectBox.options[selectBox.selectedIndex].textContent == "Nozzle" || selectBox.options[selectBox.selectedIndex].textContent == "NOZZLE" || selectBox.options[selectBox.selectedIndex].textContent == "nozzle") {
                fileInputContainer.style.display = "block"; // Tampilkan input file
            } else {
                fileInputContainer.style.display = "none"; // Sembunyikan input file
            }
        }
    </script>
@endsection
