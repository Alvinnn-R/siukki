<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAnggotaController;

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
    return view('welcome');
});

Route::get('/login', [AuthAnggotaController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthAnggotaController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthAnggotaController::class, 'logout'])->name('logout');

Route::middleware('auth:anggota')->group(function () {
    Route::get('/dashboard', function () {
        return view('anggota.dashboard');
    })->name('dashboard');
});
