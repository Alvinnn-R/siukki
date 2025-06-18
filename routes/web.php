<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\LeaderboardController;
use App\Http\Controllers\Admin\MisiController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthAnggotaController;
use App\Http\Controllers\MisiController as anggotaMisiController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\SettingAnggotaController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/poin', [PoinController::class, 'index'])->name('poin.index');

    Route::get('/kalender', function () {
        return view('anggota.kalender');
    })->name('kalender');

    Route::get('/leaderboard/{filter?}', [PoinController::class, 'leaderboard'])->name('leaderboard');

    Route::get('/about', function () {
        return view('anggota.about');
    })->name('about');

    Route::get('/setting', function () {
        return view('anggota.setting');
    })->name('setting');

    // Routes yang disesuaikan dengan SettingAnggotaController
    Route::post('/setting', [SettingAnggotaController::class, 'index'])->name('setting');
    Route::post('/setting/profile', [SettingAnggotaController::class, 'updateProfile'])->name('setting.profile');
    Route::post('/setting/password', [SettingAnggotaController::class, 'updatePassword'])->name('setting.password');
    Route::post('/setting/update-username', [SettingAnggotaController::class, 'updateUsername'])->name('setting.username.update');
    Route::post('/setting/remove-image', [SettingAnggotaController::class, 'removeImage'])->name('setting.profile.remove');
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
        // Route::resource('misi', MisiController::class);
        // // Route::get('/misi', [MisiController::class, 'index'])->name('admin.misi.index');
        // Route::patch('misi/{misi}/toggle-status', [MisiController::class, 'toggleStatus'])->name('misi.toggle-status');

        // Route::get('/misi/create', function () {
        //     return view('admin.misi.create');
        // })->name('misi.create');

        // Resource route untuk CRUD misi
        Route::resource('misi', MisiController::class);

        // Route khusus untuk toggle status
        Route::patch('misi/{misi}/toggle-status', [MisiController::class, 'toggleStatus'])
            ->name('misi.toggle-status');

        Route::get('/event', function () {
            return view('admin.event.index');
        })->name('event.index');

        Route::get('/event/create', function () {
            return view('admin.event.create');
        })->name('event.create');

        Route::get('/leaderboard/{filter?}', [LeaderboardController::class, 'leaderboard'])->name('leaderboard');

        Route::get('/kalender', function () {
            return view('admin.kalender');
        })->name('kalender');

        Route::get('/laporan', function () {
            return view('admin.laporan.index');
        })->name('laporan.index');

        Route::get('/setting', [App\Http\Controllers\Admin\SettingAdminController::class, 'index'])->name('setting');
        Route::post('/setting/username/update', [App\Http\Controllers\Admin\SettingAdminController::class, 'updateUsername'])->name('setting.username.update');
        Route::post('/setting/password/update', [App\Http\Controllers\Admin\SettingAdminController::class, 'updatePassword'])->name('setting.password');

        Route::get('/profile', function () {
            return view('admin.profile.index');
        })->name('profile');
    });
});

// Fallback route
Route::fallback(function () {
    return redirect()->route('login');
});
