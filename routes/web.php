<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthAnggotaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthAnggotaController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthAnggotaController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthAnggotaController::class, 'logout'])->name('logout');

// Route::middleware('auth:anggota')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('anggota.dashboard');
//     })->name('dashboard');
// });

// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
//     Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

//     Route::middleware('auth:admin')->group(function () {
//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');
//     });
// });

// Protected Routes for Anggota
Route::middleware('auth:anggota')->group(function () {
    Route::get('/dashboard', function () {
        return view('anggota.dashboard');
    })->name('dashboard');

    // Placeholder routes untuk menu anggota - akan dibuat nanti
    Route::get('/misi', function () {
        return view('anggota.misi.index');
    })->name('misi.index');

    Route::get('/poin', function () {
        return view('anggota.poin.index');
    })->name('poin.index');

    Route::get('/kalender', function () {
        return view('anggota.kalender.index');
    })->name('kalender.index');

    Route::get('/leaderboard', function () {
        return view('anggota.leaderboard.index');
    })->name('leaderboard.index');

    Route::get('/about', function () {
        return view('anggota.about.index');
    })->name('about.index');

    Route::get('/setting', function () {
        return view('anggota.setting.index');
    })->name('setting.index');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Authentication
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Placeholder routes untuk menu admin - akan dibuat nanti
        Route::get('/anggota', function () {
            return view('admin.anggota.index');
        })->name('admin.anggota.index');

        Route::get('/anggota/create', function () {
            return view('admin.anggota.create');
        })->name('admin.anggota.create');

        Route::get('/misi', function () {
            return view('admin.misi.index');
        })->name('admin.misi.index');

        Route::get('/misi/create', function () {
            return view('admin.misi.create');
        })->name('admin.misi.create');

        Route::get('/event', function () {
            return view('admin.event.index');
        })->name('admin.event.index');

        Route::get('/event/create', function () {
            return view('admin.event.create');
        })->name('admin.event.create');

        Route::get('/poin', function () {
            return view('admin.poin.index');
        })->name('admin.poin.index');

        Route::get('/leaderboard', function () {
            return view('admin.leaderboard.index');
        })->name('admin.leaderboard.index');

        Route::get('/laporan', function () {
            return view('admin.laporan.index');
        })->name('admin.laporan.index');

        Route::get('/setting', function () {
            return view('admin.setting.index');
        })->name('admin.setting.index');

        Route::get('/profile', function () {
            return view('admin.profile.index');
        })->name('admin.profile');
    });
});

// Fallback route - redirect any undefined routes to login
Route::fallback(function () {
    return redirect()->route('login');
});
