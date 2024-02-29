<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = User::where('id', Auth::user()->id)->first();
        return view('perusahaan.profil', compact('profil'));
    }

    public function update_profil(Request $request, User $user)
    {
        $request->validate(
            [
                'email' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'izin_usaha'       => 'mimes:pdf|nullable',
            ]
        );

        $path = '';
        if ($request->hasFile('izin_usaha')) {
            $upload_path = 'public/izin_usaha';
            $filename = time() . '_' . $request->file('izin_usaha')->getClientOriginalName();
            $path = $request->file('izin_usaha')->storeAs(
                $upload_path,
                $filename
            );

            PerusahaanProfile::where('user_id', $user->id)->update([
                'izin_usaha' => $path,
            ]);
        }

        User::where('id', $user->id)->update([
            'email' => $request->email,
        ]);
        PerusahaanProfile::where('user_id', $user->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return back()->with('status', 'Berhasil update profil!');
    }

    public function dataPerusahaan()        // for admin and super admin view
    {
        $perusahaan = PerusahaanProfile::all();
        return view('perusahaan.data', compact('perusahaan'));
    }

    public function destroyPerusahaan(PerusahaanProfile $perusahaanProfile)     // for admin and super admin action
    {
        User::destroy($perusahaanProfile->user_id);
        if (Auth::user()->hasRole('Super Admin')) {
            return redirect('superadmin/data-perusahaan')->with('status', 'Data perusahaan berhasil dihapus!');
        } elseif (Auth::user()->hasRole('Admin')) {
            return redirect('admin/data-perusahaan')->with('status', 'Data perusahaan berhasil dihapus!');
        }
    }
}
