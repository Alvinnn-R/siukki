<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aktivitas;
use App\Models\Anggota;

class PoinController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $anggota = Auth::guard('anggota')->user();

        // Ambil informasi xp dan badge 
        $xp = $anggota->xp;
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
            'xp' => $xp,
            'badge' => $badge,
            'history' => $history
        ]);
    }
}
