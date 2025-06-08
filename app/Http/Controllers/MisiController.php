<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Aktivitas;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisiController extends Controller
{
    // Menampilkan halaman utama misi untuk anggota
    public function index()
    {
        // Ambil NPM dari user yang sedang login melalui guard 'anggota'
        $npm = Auth::guard('anggota')->user()->npm;

        // Ambil semua misi harian aktif dan tersedia hari ini
        $misiHarian = Misi::aktif()->harian()->availableToday()->get()
            ->map(function ($misi) use ($npm) {
                // Tandai apakah misi sudah diselesaikan oleh user hari ini
                $misi->is_completed = $misi->isCompletedTodayBy($npm);
                // Tandai apakah ini adalah misi check-in
                $misi->is_checkin = strtolower(trim($misi->nama_misi)) === 'check-in harian';
                return $misi;
            });

        // Ambil semua misi event aktif dalam 30 hari ke depan
        $misiEvent = Misi::where('tipe_misi', 'event')
            ->where('status', 'aktif')
            ->whereBetween('tanggal_mulai', [today(), today()->addDays(30)])
            ->orderBy('tanggal_mulai', 'asc')
            ->get()
            ->map(function ($misi) use ($npm) {
                // Tandai apakah misi event ini sudah diselesaikan oleh user hari ini
                $misi->is_completed = $misi->isCompletedTodayBy($npm);
                return $misi;
            });


        // Kirim semua data ke view 'anggota.misi'
        return view('anggota.misi', compact(
            'misiHarian',
            'misiEvent',
        ));
    }

    // Method untuk menyelesaikan misi (selain check-in)
    public function complete(Request $request, $id)
    {
        $npm = Auth::guard('anggota')->user()->npm;

        // Ambil data misi berdasarkan id_misi
        $misi = Misi::where('id_misi', $id)->firstOrFail();

        // Cek apakah user sudah menyelesaikan misi ini hari ini
        $sudahSelesai = Aktivitas::where('npm', $npm)
            ->where('id_misi', $id)
            ->whereDate('tanggal', today())
            ->exists();

        if ($sudahSelesai) {
            // Jika sudah dikerjakan, kembalikan respon gagal
            return response()->json([
                'success' => false,
                'message' => 'Misi sudah diselesaikan hari ini.'
            ], 400);
        }

        try {
            // Simpan aktivitas penyelesaian misi
            Aktivitas::create([
                'npm' => $npm,
                'id_misi' => $id,
                'bukti_aktifitas' => null, 
                'tanggal' => today(),
                'status' => 'approved',
                'keterangan' => 'Misi diselesaikan',
                'xp_diperoleh' => $misi->xp_reward
            ]);

            // Tambahkan XP ke anggota
            $anggota = Anggota::where('npm', $npm)->first();
            $anggota->addXp($misi->xp_reward);

            // Respon sukses
            return response()->json([
                'success' => true,
                'message' => 'Misi berhasil diselesaikan'
            ]);
        } catch (\Exception $e) {
            // Jika gagal simpan, kembalikan error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk check-in harian
    public function checkin(Request $request)
    {
        $npm = Auth::guard('anggota')->user()->npm;

        // Ambil ID misi dari request (walaupun tidak dipakai karena kita cari misi berdasarkan nama)
        $id = $request->id_misi;

        // Cari misi "Check-in Harian" yang aktif dan berlaku hari ini
        $misi = Misi::where('nama_misi', 'Check-in Harian')
            ->where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', today())
            ->whereDate('tanggal_selesai', '>=', today())
            ->first();

        // Jika misi check-in tidak tersedia
        if (!$misi) {
            return response()->json([
                'success' => false,
                'message' => 'Misi check-in tidak tersedia saat ini.'
            ], 404);
        }

        // Cek apakah user sudah check-in hari ini
        $sudah = Aktivitas::where('npm', $npm)
            ->where('id_misi', $misi->id_misi)
            ->whereDate('tanggal', today())
            ->where('status', 'approved')
            ->exists();

        if ($sudah) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah check-in hari ini.'
            ], 409); // 409: Conflict
        }

        // Simpan aktivitas check-in ke tabel Aktivitas
        Aktivitas::create([
            'npm' => $npm,
            'id_misi' => $misi->id_misi,
            'tanggal' => today(),
            'status' => 'approved',
            'bukti_aktifitas' => null,
            'keterangan' => 'Check-in harian',
            'xp_diperoleh' => $misi->xp_reward
        ]);

        // Tambahkan XP ke anggota
        $anggota = Anggota::where('npm', $npm)->first();
        $anggota->addXp($misi->xp_reward);

        // Kirim respon sukses beserta XP yang didapat
        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil!',
            'xp' => $misi->xp_reward,
            'total_xp' => $anggota->xp
        ]);
    }
}
