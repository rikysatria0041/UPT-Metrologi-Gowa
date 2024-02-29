<?php

namespace App\Providers;

use App\Models\DataPermohonan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            if ($user) {
                if ($user->hasRole(['Perusahaan'])) {
                    $view->with('perusahaan_notif', DataPermohonan::where('user_id', Auth::user()->id)
                        ->where(function ($query) {
                            $query->orWhere('status', 'DIPROSES')
                                ->orWhere('status', 'ACC ADMIN')
                                ->orWhere('status', 'ACC SUPER ADMIN');
                        })->where('file_sk', NULL)
                        ->count());
                }

                if ($user->hasRole(['Admin'])) {
                    $view->with('admin_notif', DataPermohonan::where('status', 'DIPROSES')->orderByDesc('updated_at')->count());
                    $view->with('admin_notif1', DataPermohonan::where('status', 'ACC SUPER ADMIN')
                        ->where('file_sk', NULL)
                        ->orderByDesc('updated_at')->count());
                }

                if ($user->hasRole(['Super Admin'])) {
                    $view->with('super_admin_notif', DataPermohonan::where('status', 'ACC ADMIN')->orderByDesc('updated_at')->count());
                }
            }
        });

        // 
    }
}
