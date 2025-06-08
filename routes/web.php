<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\MisiController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthAnggotaController;
use App\Http\Controllers\SettingAnggotaController;
use App\Http\Controllers\PoinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisiController as anggotaMisiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthAnggotaController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthAnggotaController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthAnggotaController::class, 'logout'])->name('logout');

// Protected Routes for Anggota
Route::middleware('auth:anggota')->group(function () {
    Route::get('/dashboard', function () {
        return view('anggota.dashboard');
    })->name('dashboard');

    // Placeholder routes untuk menu anggota
    Route::get('/misi', [anggotaMisiController::class, 'index'])->name('misi');
    Route::post('/anggota/misi/{id}/complete', [anggotaMisiController::class, 'complete'])->name('anggota.misi.complete');
    Route::post('/anggota/misi/checkin', [anggotaMisiController::class, 'checkin']);

    Route::get('/poin', function () {
        return view('anggota.poin');
    })->name('poin.index');

    Route::get('/kalender', function () {
        return view('anggota.kalender.index');
    })->name('kalender.index');

    Route::get('/leaderboard', function () {
        return view('anggota.leaderboard.index');
    })->name('leaderboard.index');

    Route::get('/about', function () {
        return view('anggota.about');
    })->name('about');

    // Route::get('/about', function () {
    //     return view('anggota.about.index');
    // })->name('about.index');

    Route::get('/setting', function () {
        return view('anggota.setting');
    })->name('setting');

    // Routes yang disesuaikan dengan SettingAnggotaController
    Route::get('/setting', [SettingAnggotaController::class, 'index'])->name('setting');
    Route::put('/setting/profile', [SettingAnggotaController::class, 'updateProfile'])->name('setting.profile');
    Route::put('/setting/password', [SettingAnggotaController::class, 'updatePassword'])->name('setting.password');
    Route::put('/setting/badge', [SettingAnggotaController::class, 'updateBadge'])->name('setting.badge');
    Route::delete('/setting/remove-image', [SettingAnggotaController::class, 'removeProfileImage'])->name('setting.remove-image');
    Route::put('/setting/notifications', [SettingAnggotaController::class, 'updateNotificationSettings'])->name('setting.notifications');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Authentication
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes dengan name prefix
    Route::middleware('auth:admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // ANGGOTA MANAGEMENT ROUTES - FIXED dengan custom parameter
        Route::resource('anggota', AnggotaController::class)->parameters([
            'anggota' => 'anggota', // Force Laravel untuk menggunakan 'anggota' sebagai parameter
        ]);

        // Placeholder routes untuk menu admin lainnya
        // Route::get('/misi', function () {
        //     return view('admin.misi.index');
        // })->name('misi.index');
        Route::resource('misi', MisiController::class);
        Route::patch('misi/{misi}/toggle-status', [MisiController::class, 'toggleStatus'])->name('misi.toggle-status');

        Route::get('/misi/create', function () {
            return view('admin.misi.create');
        })->name('misi.create');

        Route::get('/event', function () {
            return view('admin.event.index');
        })->name('event.index');

        Route::get('/event/create', function () {
            return view('admin.event.create');
        })->name('event.create');

        Route::get('/poin', function () {
            return view('admin.poin.index');
        })->name('poin.index');

        Route::get('/leaderboard', function () {
            return view('admin.leaderboard.index');
        })->name('leaderboard.index');

        Route::get('/laporan', function () {
            return view('admin.laporan.index');
        })->name('laporan.index');

        Route::get('/setting', function () {
            return view('admin.setting.index');
        })->name('setting.index');

        Route::get('/profile', function () {
            return view('admin.profile.index');
        })->name('profile');
    });
});

// Fallback route
Route::fallback(function () {
    return redirect()->route('login');
});
