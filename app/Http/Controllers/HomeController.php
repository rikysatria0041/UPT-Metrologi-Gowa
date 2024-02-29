<?php

namespace App\Http\Controllers;

use App\Models\DataPermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('Perusahaan')) {
            $jml_permohonan_aktif =  DataPermohonan::where('user_id', Auth::user()->id)
                ->where(function ($query) {
                    $query->orWhere('status', 'DIPROSES')
                        ->orWhere('status', 'ACC ADMIN')
                        ->orWhere('status', 'ACC SUPER ADMIN');
                })->where('file_sk', NULL)
                ->count();

            $jml_permohonan_acc =  DataPermohonan::where('user_id', Auth::user()->id)
                ->where('status', 'ACC SUPER ADMIN')
                ->count();

            $jml_permohonan_decline =  DataPermohonan::where('user_id', Auth::user()->id)
                ->where('status', 'TOLAK ADMIN')
                ->count();

            $data = DataPermohonan::where('user_id', Auth::user()->id)
                ->where('file_sk', '!=', NULL)
                ->orderByDesc('updated_at')->get();

            return view('home', compact(
                'data',
                'jml_permohonan_aktif',
                'jml_permohonan_acc',
                'jml_permohonan_decline'
            ));
        } else {
            $jml_permohonan_aktif =  DataPermohonan::where(function ($query) {
                $query->orWhere('status', 'DIPROSES')
                    ->orWhere('status', 'ACC ADMIN')
                    ->orWhere('status', 'ACC SUPER ADMIN');
            })->where('file_sk', NULL)
                ->count();

            $jml_permohonan_acc =  DataPermohonan::where('status', 'ACC SUPER ADMIN')
                ->count();

            $jml_permohonan_decline =  DataPermohonan::where('status', 'TOLAK ADMIN')
                ->count();

            return view('home', compact(
                'jml_permohonan_aktif',
                'jml_permohonan_acc',
                'jml_permohonan_decline'
            ));
        }
    }
}
