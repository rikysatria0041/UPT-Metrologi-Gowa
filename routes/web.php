<?php

use App\Http\Controllers\Admin\KelolaBerkasController;
use App\Http\Controllers\Admin\MasterData\JenisAlatController;
use App\Http\Controllers\Admin\PermohonanMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Perusahaan\PermohonanTeraUlangController;
use App\Http\Controllers\Perusahaan\ProfilController;
use App\Http\Controllers\SuperAdmin\KelolaPermohonanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (null !== Auth::user()) {
        if (Auth::user()->hasRole(['Super Admin'])) {
            return redirect('/superadmin/home');
        } elseif (Auth::user()->hasRole(['Admin'])) {
            return redirect('/admin/home');
        } else {
            return redirect('/home');
        }
    } else {
        return redirect('/login');
    }
});

Auth::routes();

Route::group([
    'prefix'     => 'superadmin',
    'as'         => 'superadmin.',
    'middleware' => ['auth', 'verified', 'role:Super Admin']
], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/permohonan-masuk', [KelolaPermohonanController::class, 'index']);
    Route::get('/permohonan-masuk/{dataPermohonan}', [KelolaPermohonanController::class, 'show']);
    Route::patch('/permohonan-masuk/{dataPermohonan}/verifikasi', [KelolaPermohonanController::class, 'verifikasi']);
    Route::get('/riwayat-permohonan', [KelolaPermohonanController::class, 'riwayat']);
    Route::get('/data-perusahaan', [ProfilController::class, 'dataPerusahaan']);
    Route::delete('/data-perusahaan/{perusahaanProfile}', [ProfilController::class, 'destroyPerusahaan']);
    Route::get('/info-skhp', [PermohonanTeraUlangController::class, 'infoSkhp']);
    Route::get('/riwayat-permohonan/{dataPermohonan}', [PermohonanTeraUlangController::class, 'show']);
});

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth', 'verified', 'role:Admin']
], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('jenis-alat', JenisAlatController::class);
    Route::get('/permohonan-masuk', [PermohonanMasukController::class, 'index']);
    Route::get('/permohonan-masuk/{dataPermohonan}', [PermohonanMasukController::class, 'show']);
    Route::get('/tolak-permohonan-masuk/{dataPermohonan}', [PermohonanMasukController::class, 'tolak']);
    Route::get('/verifikasi-permohonan-masuk/{dataPermohonan}', [PermohonanMasukController::class, 'verifikasi']);
    Route::get('/kelola-berkas', [KelolaBerkasController::class, 'index']);
    Route::get('/invoice/{dataPermohonan}', [KelolaBerkasController::class, 'invoice']);
    Route::get('/jadwal/{dataPermohonan}', [KelolaBerkasController::class, 'jadwal']);
    Route::get('/sk/{dataPermohonan}', [KelolaBerkasController::class, 'sk']);
    Route::post('/invoice/{dataPermohonan}', [KelolaBerkasController::class, 'storeInvoice']);
    Route::post('/jadwal/{dataPermohonan}', [KelolaBerkasController::class, 'storeJadwal']);
    Route::post('/sk/{dataPermohonan}', [KelolaBerkasController::class, 'storeSK']);
    Route::get('/riwayat-permohonan', [PermohonanMasukController::class, 'riwayat']);
    Route::get('/permohonan-ditolak', [PermohonanMasukController::class, 'riwayatDitolak']);
    Route::get('/data-perusahaan', [ProfilController::class, 'dataPerusahaan']);
    Route::delete('/data-perusahaan/{perusahaanProfile}', [ProfilController::class, 'destroyPerusahaan']);
    Route::get('/info-skhp', [PermohonanTeraUlangController::class, 'infoSkhp']);
    Route::get('/riwayat-permohonan/{dataPermohonan}', [PermohonanTeraUlangController::class, 'show']);
});

Route::group(['middleware' => ['auth', 'verified', 'role:Perusahaan']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/ajukan-permohonan', [PermohonanTeraUlangController::class, 'create']);
    Route::post('/ajukan-permohonan', [PermohonanTeraUlangController::class, 'store']);
    Route::delete('/ajukan-permohonan/{id}', [PermohonanTeraUlangController::class, 'destroy']);
    Route::post('data-permohonan', [PermohonanTeraUlangController::class, 'kirim']);
    Route::get('/profil', [ProfilController::class, 'index']);
    Route::patch('profil/{user}', [ProfilController::class, 'update_profil']);
    Route::get('/permohonan-aktif', [PermohonanTeraUlangController::class, 'aktif']);
    Route::get('/riwayat-permohonan', [PermohonanTeraUlangController::class, 'riwayat']);
    Route::get('/permohonan-ditolak', [PermohonanTeraUlangController::class, 'riwayatDitolak']);
    Route::get('/riwayat-permohonan/{dataPermohonan}', [PermohonanTeraUlangController::class, 'show']);
    Route::post('/bukti_bayar/{dataPermohonan}', [PermohonanTeraUlangController::class, 'buktiBayar']);
});
