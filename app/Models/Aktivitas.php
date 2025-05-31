<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';
    protected $primaryKey = 'id_aktivitas';

    protected $fillable = [
        'npm',
        'id_misi',
        'bukti_aktifitas',
        'tanggal',
        'status',
        'keterangan',
        'xp_diperoleh'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'xp_diperoleh' => 'integer'
    ];

    // Relasi ke Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'npm', 'npm');
    }

    // Relasi ke Misi
    public function misi()
    {
        return $this->belongsTo(Misi::class, 'id_misi', 'id_misi');
    }

    // Accessor untuk URL bukti aktivitas
    public function getBuktiUrlAttribute()
    {
        if ($this->bukti_aktifitas) {
            return asset('uploads/bukti_aktivitas/' . $this->bukti_aktifitas);
        }
        return null;
    }

    // Accessor untuk status color (untuk UI)
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger'
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    // Accessor untuk status text
    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];

        return $texts[$this->status] ?? 'Tidak Diketahui';
    }

    // Scope untuk filter by anggota
    public function scopeByAnggota($query, $npm)
    {
        return $query->where('npm', $npm);
    }

    // Scope untuk filter by misi
    public function scopeByMisi($query, $idMisi)
    {
        return $query->where('id_misi', $idMisi);
    }

    // Scope untuk filter by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter by tanggal
    public function scopeByTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }

    // Scope untuk aktivitas hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', today());
    }

    // Scope untuk aktivitas bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
    }

    // Scope untuk aktivitas yang disetujui
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope untuk aktivitas pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Event listeners untuk auto update XP anggota
    protected static function boot()
    {
        parent::boot();

        // Ketika aktivitas disetujui, update XP anggota
        static::updated(function ($aktivitas) {
            if ($aktivitas->isDirty('status') && $aktivitas->status === 'approved') {
                $aktivitas->updateAnggotaXp();
            }
        });

        // Ketika aktivitas dibuat dengan status approved langsung
        static::created(function ($aktivitas) {
            if ($aktivitas->status === 'approved') {
                $aktivitas->updateAnggotaXp();
            }
        });
    }

    // Method untuk update XP anggota
    public function updateAnggotaXp()
    {
        $anggota = $this->anggota;
        $misi = $this->misi;

        if ($anggota && $misi) {
            // Set XP yang diperoleh sama dengan reward misi (bisa dimodifikasi admin)
            if ($this->xp_diperoleh == 0 && $this->status === 'approved') {
                $this->update(['xp_diperoleh' => $misi->xp_reward]);
            }

            // Add XP ke anggota dan auto level up
            if ($this->status === 'approved' && $this->xp_diperoleh > 0) {
                $anggota->addXp($this->xp_diperoleh);
            }
        }
    }

    // Method untuk approve aktivitas
    public function approve($keterangan = null)
    {
        $this->update([
            'status' => 'approved',
            'keterangan' => $keterangan
        ]);

        return $this;
    }

    // Method untuk reject aktivitas
    public function reject($keterangan = null)
    {
        $this->update([
            'status' => 'rejected',
            'keterangan' => $keterangan,
            'xp_diperoleh' => 0
        ]);

        return $this;
    }
}
