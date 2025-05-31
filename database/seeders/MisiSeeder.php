<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Misi;
use Carbon\Carbon;

class MisiSeeder extends Seeder
{
    public function run()
    {
        // Misi Harian
        $misiHarian = [
            [
                'nama_misi' => 'Check-in Harian',
                'deskripsi' => 'Buka aplikasi SiUKKI dan lakukan check-in harian untuk mendapatkan poin',
                'xp_reward' => 5,
                'tipe_misi' => 'harian',
                'status' => 'aktif',
                'jadwal' => now(),
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addYear(),
                'icon' => 'check_circle'
            ],
            [
                'nama_misi' => 'Membaca Al-Qur\'an',
                'deskripsi' => 'Baca minimal 1 halaman Al-Qur\'an dan upload bukti bacaan',
                'xp_reward' => 15,
                'tipe_misi' => 'harian',
                'status' => 'aktif',
                'jadwal' => now(),
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addYear(),
                'icon' => 'menu_book'
            ],
            [
                'nama_misi' => 'Sholat Berjamaah',
                'deskripsi' => 'Melaksanakan sholat berjamaah di masjid kampus',
                'xp_reward' => 10,
                'tipe_misi' => 'harian',
                'status' => 'aktif',
                'jadwal' => now(),
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addYear(),
                'icon' => 'place'
            ],
            [
                'nama_misi' => 'Membaca Doa',
                'deskripsi' => 'Membaca doa harian (pagi/sore) dan upload bukti',
                'xp_reward' => 5,
                'tipe_misi' => 'harian',
                'status' => 'aktif',
                'jadwal' => now(),
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addYear(),
                'icon' => 'auto_stories'
            ]
        ];

        // Misi Mingguan
        $misiMingguan = [
            [
                'nama_misi' => 'Kajian Mingguan',
                'deskripsi' => 'Mengikuti kajian rutin mingguan UKKI',
                'xp_reward' => 30,
                'tipe_misi' => 'mingguan',
                'status' => 'aktif',
                'jadwal' => now()->startOfWeek(),
                'tanggal_mulai' => now()->startOfWeek(),
                'tanggal_selesai' => now()->endOfWeek(),
                'icon' => 'school'
            ],
            [
                'nama_misi' => 'Diskusi Keislaman',
                'deskripsi' => 'Berpartisipasi dalam diskusi keislaman mingguan',
                'xp_reward' => 25,
                'tipe_misi' => 'mingguan',
                'status' => 'aktif',
                'jadwal' => now()->startOfWeek(),
                'tanggal_mulai' => now()->startOfWeek(),
                'tanggal_selesai' => now()->endOfWeek(),
                'icon' => 'forum'
            ]
        ];

        // Misi Event
        $misiEvent = [
            [
                'nama_misi' => 'Seminar Keislaman',
                'deskripsi' => 'Mengikuti seminar keislaman yang diadakan UKKI',
                'xp_reward' => 60,
                'tipe_misi' => 'event',
                'status' => 'aktif',
                'jadwal' => now()->addDays(7),
                'tanggal_mulai' => now()->addDays(7),
                'tanggal_selesai' => now()->addDays(7),
                'icon' => 'event'
            ],
            [
                'nama_misi' => 'Lomba Tahfidz',
                'deskripsi' => 'Berpartisipasi dalam lomba tahfidz Al-Qur\'an',
                'xp_reward' => 100,
                'tipe_misi' => 'event',
                'status' => 'aktif',
                'jadwal' => now()->addDays(14),
                'tanggal_mulai' => now()->addDays(14),
                'tanggal_selesai' => now()->addDays(14),
                'icon' => 'emoji_events'
            ],
            [
                'nama_misi' => 'Bakti Sosial',
                'deskripsi' => 'Mengikuti kegiatan bakti sosial UKKI',
                'xp_reward' => 80,
                'tipe_misi' => 'event',
                'status' => 'aktif',
                'jadwal' => now()->addDays(21),
                'tanggal_mulai' => now()->addDays(21),
                'tanggal_selesai' => now()->addDays(21),
                'icon' => 'volunteer_activism'
            ]
        ];

        // Insert semua misi
        foreach (array_merge($misiHarian, $misiMingguan, $misiEvent) as $misi) {
            Misi::create($misi);
        }
    }
}
