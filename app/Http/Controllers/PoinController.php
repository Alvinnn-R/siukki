<?php
namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Support\Facades\Auth;

class PoinController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $anggota = Auth::guard('anggota')->user();

        // Ambil informasi xp dan badge
        $xp    = $anggota->xp;
        $badge = $anggota->badge;

                                           // Ambil riwayat XP dari aktivitas 3 hari terakhir yang disetujui
        $history = Aktivitas::with('misi') // <= load relasi ke misi
            ->where('npm', $anggota->npm)
            ->where('status', 'approved')
            ->whereDate('tanggal', '>=', now()->subDays(3))
            ->orderBy('tanggal', 'desc')
            ->get();

        // Kirim semua data ke view 'anggota.poin'
        return view('anggota.poin', [
            'xp'      => $xp,
            'badge'   => $badge,
            'history' => $history,
        ]);
    }
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

        return view('anggota.leaderboard', compact('anggota', 'filter'));
    }
}
