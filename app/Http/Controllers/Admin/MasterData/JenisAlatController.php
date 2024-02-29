<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\JenisAlat;
use Illuminate\Http\Request;

class JenisAlatController extends Controller
{
    public function index()
    {
        $data = JenisAlat::orderByDesc('updated_at')->get();
        return view('admin.master_data.jenis_alat.index', compact('data'));
    }

    public function create()
    {
        return view('admin.master_data.jenis_alat.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'required' => 'Data ini tidak boleh kosong.',
            ]
        );

        if (JenisAlat::create($request->all())) {
            return redirect('admin/jenis-alat')->with('status', 'Data berhasil disimpan!');
        } else {
            return redirect('admin/jenis-alat')->with('error', 'Data gagal disimpan!');
        }
    }

    public function edit(JenisAlat $jenisAlat)
    {
        return view('admin.master_data.jenis_alat.edit', compact('jenisAlat'));
    }

    public function update(Request $request, JenisAlat $jenisAlat)
    {
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'required' => 'Data ini tidak boleh kosong.',
            ]
        );

        if ($jenisAlat->update($request->all())) {
            return redirect('admin/jenis-alat')->with('status', 'Data berhasil diedit!');
        } else {
            return redirect('admin/jenis-alat')->with('error', 'Data gagal diedit!');
        }
    }

    public function destroy(JenisAlat $jenisAlat)
    {
        JenisAlat::destroy($jenisAlat->id);
        return redirect('admin/jenis-alat')->with('status', 'Data berhasil dihapus!');
    }
}
