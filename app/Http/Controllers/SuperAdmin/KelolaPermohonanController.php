<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataPermohonan;
use App\Models\PermohonanTeraUlang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelolaPermohonanController extends Controller
{
    public function index()
    {
        $data = DataPermohonan::where('status', 'ACC ADMIN')->orderByDesc('updated_at')->get();
        return view('super_admin.permohonan.index', compact('data'));
    }

    public function show(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('super_admin.permohonan.detail', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function verifikasi(Request $request, DataPermohonan $dataPermohonan)
    {
        DataPermohonan::where('id', $dataPermohonan->id)
            ->update([
                'status' => 'ACC SUPER ADMIN',
                'tgl_approved_super_admin' => Carbon::now()
            ]);

        return redirect('superadmin/permohonan-masuk/' . $dataPermohonan->id)->with('status', 'Permohonan telah verifikasi!');
    }

    public function riwayat()
    {
        $data = DataPermohonan::where('status', '!=', 'DIPROSES')
            ->where('status', '!=', 'ACC ADMIN')
            ->where('status', '!=', 'TOLAK ADMIN')
            ->orderByDesc('updated_at')
            ->get();
        return view('super_admin.permohonan.riwayat', compact('data'));
    }
}
