<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPermohonan;
use App\Models\PermohonanTeraUlang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PermohonanMasukController extends Controller
{
    public function index()
    {
        $data = DataPermohonan::where('status', 'DIPROSES')->orderByDesc('updated_at')->get();
        return view('admin.permohonan.index', compact('data'));
    }

    public function show(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('admin.permohonan.detail', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function tolak(Request $request, DataPermohonan $dataPermohonan)
    {
        DataPermohonan::where('id', $dataPermohonan->id)
            ->update([
                'status' => 'TOLAK ADMIN'
            ]);

        return redirect('admin/permohonan-masuk/' . $dataPermohonan->id)->with('status', 'Permohonan telah ditolak!');
    }

    public function verifikasi(Request $request, DataPermohonan $dataPermohonan)
    {
        DataPermohonan::where('id', $dataPermohonan->id)
            ->update([
                'status' => 'ACC ADMIN',
                'tgl_approved_admin' => Carbon::now()
            ]);

        return redirect('admin/permohonan-masuk/' . $dataPermohonan->id)->with('status', 'Permohonan telah verifikasi!');
    }

    public function riwayat()
    {
        $page_tittle = 'Diterima';
        $data = DataPermohonan::where('status', '!=', 'DIPROSES')
            ->where('file_sk', '!=', NULL)
            ->orderByDesc('updated_at')->get();
        return view('admin.permohonan.riwayat', compact('data', 'page_tittle'));
    }

    public function riwayatDitolak()
    {
        $page_tittle = 'Ditolak';
        $data = DataPermohonan::where('status', 'TOLAK ADMIN')
            ->orderByDesc('updated_at')->get();
        return view('admin.permohonan.riwayat', compact('data', 'page_tittle'));
    }
}
