<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPermohonan;
use App\Models\PermohonanTeraUlang;
use Illuminate\Http\Request;

class KelolaBerkasController extends Controller
{
    public function index()
    {
        $data = DataPermohonan::where('status', 'ACC SUPER ADMIN')
            ->where('file_sk', NULL)
            ->orderByDesc('updated_at')->get();
        return view('admin.kelola_berkas.index', compact('data'));
    }

    public function invoice(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('admin.kelola_berkas.invoice', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function storeInvoice(Request $request, DataPermohonan $dataPermohonan)
    {
        $request->validate(
            [
                'invoice' => 'required|mimes:pdf|max:2028',
            ],
            [
                'max' => 'Data tidak boleh lebih dari 2 Mb.',
                'mimes' => 'Ekstensi tidak didukung.',
                'required' => 'File Invoice tidak boleh kosong.',
            ]
        );

        $path = '';
        if ($request->hasFile('invoice')) {
            $upload_path = 'public/invoice';
            $filename = time() . '_' . $request->file('invoice')->getClientOriginalName();
            $path = $request->file('invoice')->storeAs(
                $upload_path,
                $filename
            );

            DataPermohonan::where('id', $dataPermohonan->id)->update([
                'invoice' => $path,
            ]);
        }
        return redirect('admin/kelola-berkas')->with('status', 'Invoice berhasil diunggah!');
    }

    public function jadwal(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('admin.kelola_berkas.jadwal', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function storeJadwal(Request $request, DataPermohonan $dataPermohonan)
    {
        $request->validate(
            [
                'jadwal' => 'required|mimes:pdf|max:2028',
            ],
            [
                'max' => 'Data tidak boleh lebih dari 2 Mb.',
                'mimes' => 'Ekstensi tidak didukung.',
                'required' => 'File jadwal tidak boleh kosong.',
            ]
        );

        $path = '';
        if ($request->hasFile('jadwal')) {
            $upload_path = 'public/jadwal';
            $filename = time() . '_' . $request->file('jadwal')->getClientOriginalName();
            $path = $request->file('jadwal')->storeAs(
                $upload_path,
                $filename
            );

            DataPermohonan::where('id', $dataPermohonan->id)->update([
                'jadwal' => $path,
            ]);
        }
        return redirect('admin/kelola-berkas')->with('status', 'Jadwal berhasil diunggah!');
    }

    public function sk(DataPermohonan $dataPermohonan)
    {
        $detailPermohonan = PermohonanTeraUlang::where('IDPermohonan', $dataPermohonan->IDPermohonan)->get();
        return view('admin.kelola_berkas.sk', compact('dataPermohonan', 'detailPermohonan'));
    }

    public function storeSK(Request $request, DataPermohonan $dataPermohonan)
    {
        $request->validate(
            [
                'masa_berlaku' => 'required',
                'file_sk' => 'required|mimes:pdf|max:2028',
            ],
            [
                'max' => 'Data tidak boleh lebih dari 2 Mb.',
                'mimes' => 'Ekstensi tidak didukung.',
                'required' => 'Kolom tidak boleh kosong.',
            ]
        );

        $path = '';
        if ($request->hasFile('file_sk')) {
            $upload_path = 'public/file_sk';
            $filename = time() . '_' . $request->file('file_sk')->getClientOriginalName();
            $path = $request->file('file_sk')->storeAs(
                $upload_path,
                $filename
            );

            DataPermohonan::where('id', $dataPermohonan->id)->update([
                'masa_berlaku' => $request->masa_berlaku,
                'file_sk' => $path,
            ]);
        }
        return redirect('admin/riwayat-permohonan')->with('status', 'SK berhasil diunggah! List data telah dipindahkan pada riwayat permohonan.');
    }
}
