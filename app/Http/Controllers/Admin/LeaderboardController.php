<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LeaderboardController extends Controller
{
    public function leaderboard($filter = 'day')
    {
        if ($filter === 'week') {
            // Ambil XP total minggu ini
            $anggota = \App\Models\Anggota::withSum(['aktivitas as xp_minggu' => function ($q) {
                $q->where('status', 'approved')
                    ->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
            }], 'xp_diperoleh')
                ->orderByDesc('xp_minggu')
                ->take(10)
                ->get();
        } elseif ($filter === 'month') {
            // Ambil XP total bulan ini
            $anggota = \App\Models\Anggota::withSum(['aktivitas as xp_bulan' => function ($q) {
                $q->where('status', 'approved')
                    ->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
            }], 'xp_diperoleh')
                ->orderByDesc('xp_bulan')
                ->take(10)
                ->get();
        } elseif ($filter === 'day') {
            // Ambil XP total hari ini saja
            $anggota = \App\Models\Anggota::withSum(['aktivitas as xp_hari' => function ($q) {
                $q->where('status', 'approved')
                    ->whereDate('tanggal', now()->toDateString());
            }], 'xp_diperoleh')
                ->orderByDesc('xp_hari')
                ->take(10)
                ->get();
        } else {
            // Default: XP total all time
            $anggota = \App\Models\Anggota::orderByDesc('xp')->take(10)->get();
        }

        return view('admin.leaderboard', compact('anggota', 'filter'));
    }
}
