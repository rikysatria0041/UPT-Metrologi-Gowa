<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\DataPermohonan;
use App\Models\JenisAlat;
use App\Models\PermohonanTeraUlang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanTeraUlangController extends Controller
{
    public function create()
    {
        $cekPermohonan = DataPermohonan::where('user_id', Auth::user()->id)
            ->where('status', 'DIPROSES')
            ->orWhere('status', 'ACC ADMIN')
            ->count();
        $jenisAlat = JenisAlat::all();
        $dataPermohonan = PermohonanTeraUlang::where('user_id', Auth::user()->id)->where('IDPermohonan', NULL)->get();
        $cekIzinUsaha = User::where('id', Auth::user()->id)->first();
        return view('perusahaan.ajukan_permohonan', compact(
            'cekPermohonan',
            'jenisAlat',
            'cekIzinUsaha',
            'dataPermohonan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'jenis_alat_id' => 'required',
                'kapasitas' => 'required',
                'merk' => 'required',
                'model_type' => 'required',
                'file' => 'required_if:jenis_alat_id,1',
            ],
            [
                'required' => 'Data ini tidak boleh kosong.',
                'required_if' => 'Unggah file wajib jika jenis alat yang dipilih ialah Nozzle.',
            ]
        );

        $model = $request->all();
        $path = '';
        if ($request->hasFile('file')) {
            $upload_path = 'public/nozzle_file';
            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs(
                $upload_path,
                $filename
            );

            $model['file'] = $path;
        }

        if (PermohonanTeraUlang::create($model)) {
            return redirect('ajukan-permohonan')->with('status', 'Data berhasil ditambahkan!');
        } else {
            return redirect('ajukan-permohonan')->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function destroy($id)
    {
        PermohonanTeraUlang::destroy($id);
        return redirect('ajukan-permohonan')->with('status', 'Data berhasil dihapus!');
    }

    public function kirim(Request $request)
    {
        $uniqeID = date("YmdHis") . rand(1000, 9999);

        DataPermohonan::insert([
            'user_id' => Auth::user()->id,
            'IDPermohonan' => $uniqeID,
            'status' => 'DIPROSES',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        PermohonanTeraUlang::where('user_id', Auth::user()->id)
            ->where('IDPermohonan', NULL)
            ->update([
                'IDPermohonan' => $uniqeID,
            ]);
        return redirect('permohonan-aktif')->with('status', 'Pengajuan permohonan tera/tera ulang berhasil dikirim!');
    }

    public function aktif()
    {
        $data = DataPermohonan::where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->orWhere('status', 'DIPROSES')
                    ->orWhere('status', 'ACC ADMIN')
                    ->orWhere('status', 'ACC SUPER ADMIN');
            })->where('file_sk', NULL)
            ->orderByDesc('updated_at')->get();
        return view('perusahaan.riwayat', compact('data'));
    }

    public function riwayat()
    {
        $page_tittle = 'Diterima';
        $data = DataPermohonan::where('user_id', Auth::user()->id)
            ->where('file_sk', '!=', NULL)
            ->orderByDesc('updated_at')->get();
        return view('perusahaan.riwayat', compact('data', 'page_tittle'));
    }

    public function riwayatDitolak()
    {
        $page_tittle = 'Ditolak';
        $data = DataPermohonan::where('user_id', Auth::user()->id)
            ->where('status', 'TOLAK ADMIN')
            ->orderByDesc('updated_at')->get();
        return view('perusahaan.riwayat', compact('data', 'page_tittle'));
    }

    public function show(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('perusahaan.detail', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function buktiBayar(Request $request, DataPermohonan $dataPermohonan)
    {
        $request->validate(
            [
                'bukti_bayar' => 'required|mimes:pdf|max:2028',
            ],
            [
                'max' => 'Data tidak boleh lebih dari 2 Mb.',
                'mimes' => 'Ekstensi tidak didukung.',
                'required' => 'File bukti bayar tidak boleh kosong.',
            ]
        );

        $path = '';
        if ($request->hasFile('bukti_bayar')) {
            $upload_path = 'public/bukti_bayar';
            $filename = time() . '_' . $request->file('bukti_bayar')->getClientOriginalName();
            $path = $request->file('bukti_bayar')->storeAs(
                $upload_path,
                $filename
            );

            DataPermohonan::where('id', $dataPermohonan->id)->update([
                'bukti_bayar' => $path,
            ]);
        }
        return redirect('riwayat-permohonan/' . $dataPermohonan->id)->with('status', 'Bukti bayar berhasil diunggah!');
    }

    public function infoSkhp()
    {
        $data = DataPermohonan::where('file_sk', '!=', NULL)
            ->orderByDesc('updated_at')->get();
        return view('perusahaan.info_skhp', compact('data'));
    }
}
