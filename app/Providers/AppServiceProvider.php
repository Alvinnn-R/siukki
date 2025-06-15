<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (session('role') === 'admin') {
                $view->with('user', Auth::guard('admin')->user());
            } elseif (session('role') === 'anggota') {
                $view->with('user', Auth::guard('anggota')->user());
            } else {
                $view->with('user', null);
            }
        });
    }
}
