<?php
namespace Database\Seeders;

use App\Models\Aktivitas;
use App\Models\Anggota;
use App\Models\Misi;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    public function run()
    {
        $anggotas = Anggota::all();
        $misis    = Misi::all();

        foreach ($anggotas as $anggota) {
            // Simulasi aktivitas beberapa hari terakhir
            for ($i = 0; $i < 7; $i++) {
                $tanggal = now()->subDays($i);

                // Random misi harian yang dikerjakan (1-3 misi per hari)
                $misiHarian = $misis->where('tipe_misi', 'harian')->random(rand(1, 3));

                foreach ($misiHarian as $misi) {
                    // 80% chance anggota mengerjakan misi
                    if (rand(1, 100) <= 80) {
                        $aktivitas = Aktivitas::create([
                            'npm'          => $anggota->npm,
                            'id_misi'      => $misi->id_misi,
                            'tanggal'      => $tanggal,
                            'status'       => rand(1, 100) <= 90 ? 'approved' : 'pending', // 90% approved
                            'xp_diperoleh' => rand(1, 100) <= 90 ? $misi->xp_reward : 0,
                            'keterangan'   => 'Aktivitas dilakukan dengan baik',
                        ]);
                    }
                }
            }

            // Simulasi beberapa aktivitas mingguan
            $misiMingguan = $misis->where('tipe_misi', 'mingguan')->random(1);
            foreach ($misiMingguan as $misi) {
                if (rand(1, 100) <= 60) { // 60% chance untuk misi mingguan
                    Aktivitas::create([
                        'npm'          => $anggota->npm,
                        'id_misi'      => $misi->id_misi,
                        'tanggal'      => now()->subDays(rand(1, 7)),
                        'status'       => 'approved',
                        'xp_diperoleh' => $misi->xp_reward,
                        'keterangan'   => 'Mengikuti kajian dengan antusias',
                    ]);
                }
            }
        }

        // Sync XP untuk semua anggota berdasarkan aktivitas yang approved
        foreach ($anggotas as $anggota) {
            $totalXp = $anggota->aktivitas()->approved()->sum('xp_diperoleh');
            $anggota->update([
                'xp'    => $totalXp,
                'level' => intval($totalXp / 300) + 1,
            ]);

            // Update badge berdasarkan level
            if ($anggota->level >= 9) {
                $anggota->update(['badge' => 'Cendekiawan Islami']);
            } elseif ($anggota->level >= 5) {
                $anggota->update(['badge' => 'Penuntut Kebaikan']);
            } else {
                $anggota->update(['badge' => 'Murid Ilmu']);
            }
        }
    }
}
