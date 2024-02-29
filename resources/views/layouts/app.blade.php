<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sistem Informasi Manajemen Pelayanan Tera Ulang Pada UPT Metrologi Legal Kab. Gowa">
    <meta name="keywords" content="Sistem Informasi Manajemen Pelayanan Tera Ulang Pada UPT Metrologi Legal Kab. Gowa">
    <meta name="author" content="this.vin">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    @yield('css_section')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-content-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="/">
                            <h3 class="brand-text">UPT Metrologi Gowa</h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse"  id="navbar-mobile" style="height: 40px">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span><span class="avatar avatar-online"><img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=556EE6&color=fff" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                @yield('content_header')
            </div>

            <!-- BEGIN: Main Menu-->
            <div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
                <div class="main-menu-content">
                    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                        @if (Auth::user()->hasRole(['Admin']))
                            <li class="nav-item @if(Route::current()->uri === 'admin/home') active @endif">
                                <a href="{{ url('admin/home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                            </li>
                            <li class="nav-item @if(Route::current()->uri === 'admin/jenis-alat') active @endif"><a href="{{ url('admin/jenis-alat') }}"><i class="la la-tag"></i><span class="menu-title" data-i18n="">Jenis Alat</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'admin/permohonan-masuk') active @endif"><a href="{{ url('admin/permohonan-masuk') }}"><i class="la la-inbox"></i><span class="menu-title" data-i18n="">Permohonan Masuk</span>
                                <span class="badge badge-pill badge-danger badge-up badge-glow">
                                    {{ $admin_notif }}
                                </span>
                            </a></li>
                            <li class="nav-item @if(Route::current()->uri === 'admin/kelola-berkas') active @endif"><a href="{{ url('admin/kelola-berkas') }}"><i class="la la-file"></i><span class="menu-title" data-i18n="">Kelola Berkas</span>
                                <span class="badge badge-pill badge-danger badge-up badge-glow">
                                    {{ $admin_notif1 }}
                                </span>
                            </a></li>
                            <li class=" nav-item @if(Route::current()->uri === 'admin/riwayat-permohonan' || Route::current()->uri === 'admin/permohonan-ditolak') has-sub open @endif"><a href="index.html"><i class="la la-history"></i><span class="menu-title" data-i18n="nav.dash.main">Riwayat Permohonan</span></a>
                                <ul class="menu-content">
                                    <li @if(Route::current()->uri === 'admin/riwayat-permohonan') class="active" @endif>
                                        <a class="menu-item" href="{{ url('admin/riwayat-permohonan') }}"><i></i>Diterima</a>
                                    </li>
                                    <li @if(Route::current()->uri === 'admin/permohonan-ditolak') class="active" @endif>
                                        <a class="menu-item" href="{{ url('admin/permohonan-ditolak') }}"><i></i>Ditolak</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item @if(Route::current()->uri === 'admin/data-perusahaan') active @endif"><a href="{{ url('admin/data-perusahaan') }}"><i class="la la-building"></i><span class="menu-title" data-i18n="">Data Perusahaan</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'admin/info-skhp') active @endif"><a href="{{ url('admin/info-skhp') }}"><i class="la la-file"></i><span class="menu-title" data-i18n="">Info SKHP</span></a></li>
                        @endif

                        @if (Auth::user()->hasRole(['Super Admin']))
                            <li class="nav-item @if(Route::current()->uri === 'superadmin/home') active @endif">
                                <a href="{{ url('superadmin/home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                            </li>
                            <li class="nav-item @if(Route::current()->uri === 'superadmin/permohonan-masuk') active @endif"><a href="{{ url('superadmin/permohonan-masuk') }}"><i class="la la-file"></i><span class="menu-title" data-i18n="">Permohonan Masuk</span>
                                <span class="badge badge-pill badge-danger badge-up badge-glow">
                                    {{ $super_admin_notif }}
                                </span>
                            </a></li>
                            <li class="nav-item @if(Route::current()->uri === 'superadmin/riwayat-permohonan') active @endif"><a href="{{ url('superadmin/riwayat-permohonan') }}"><i class="la la-history"></i><span class="menu-title" data-i18n="">Riwayat Permohonan</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'superadmin/data-perusahaan') active @endif"><a href="{{ url('superadmin/data-perusahaan') }}"><i class="la la-building"></i><span class="menu-title" data-i18n="">Data Perusahaan</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'superadmin/info-skhp') active @endif"><a href="{{ url('superadmin/info-skhp') }}"><i class="la la-file"></i><span class="menu-title" data-i18n="">Info SKHP</span></a></li>
                        @endif

                        @if (Auth::user()->hasRole(['Perusahaan']))
                            <li class="nav-item @if(Route::current()->uri === 'home') active @endif">
                                <a href="{{ url('home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                            </li>
                            <li class="nav-item @if(Route::current()->uri === 'profil') active @endif"><a href="{{ url('profil') }}"><i class="la la-user"></i><span class="menu-title" data-i18n="">Profil</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'ajukan-permohonan') active @endif"><a href="{{ url('ajukan-permohonan') }}"><i class="la la-tag"></i><span class="menu-title" data-i18n="">Ajukan Permohonan</span></a></li>
                            <li class="nav-item @if(Route::current()->uri === 'permohonan-aktif') active @endif"><a href="{{ url('/permohonan-aktif') }}"><i class="la la-check-circle-o"></i><span class="menu-title" data-i18n="">Permohonan Aktif</span>
                                <span class="badge badge-pill badge-danger badge-up badge-glow">
                                    {{ $perusahaan_notif }}
                                </span>
                            </a></li>
                            <li class=" nav-item @if(Route::current()->uri === 'riwayat-permohonan' || Route::current()->uri === 'permohonan-ditolak') has-sub open @endif"><a href="index.html"><i class="la la-history"></i><span class="menu-title" data-i18n="nav.dash.main">Riwayat Permohonan</span></a>
                                <ul class="menu-content">
                                    <li @if(Route::current()->uri === 'riwayat-permohonan') class="active" @endif>
                                        <a class="menu-item" href="{{ url('riwayat-permohonan') }}"><i></i>Diterima</a>
                                    </li>
                                    <li @if(Route::current()->uri === 'permohonan-ditolak') class="active" @endif>
                                        <a class="menu-item" href="{{ url('permohonan-ditolak') }}"><i></i>Ditolak</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- END: Main Menu-->

            @yield('content')

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Sistem Pelayanan Tera/Tera Ulang</span><span class="float-md-right d-none d-lg-block">Copyright &copy; {{ date('Y') }} <span id="scroll-top"></span></span></p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Page JS-->
    @yield('js_section')
    <!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>
