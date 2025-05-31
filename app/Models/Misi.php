<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    use HasFactory;

    protected $table      = 'misis';
    protected $primaryKey = 'id_misi';

    protected $fillable = [
        'nama_misi',
        'deskripsi',
        'xp_reward',
        'tipe_misi',
        'status',
        'jadwal',
        'tanggal_mulai',
        'tanggal_selesai',
        'icon',
    ];

    protected $casts = [
        'jadwal'          => 'date',
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'xp_reward'       => 'integer',
    ];

    // Relasi ke Aktivitas
    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'id_misi', 'id_misi');
    }

    // Scope untuk misi aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk misi harian
    public function scopeHarian($query)
    {
        return $query->where('tipe_misi', 'harian');
    }

    // Scope untuk misi mingguan
    public function scopeMingguan($query)
    {
        return $query->where('tipe_misi', 'mingguan');
    }

    // Scope untuk misi event
    public function scopeEvent($query)
    {
        return $query->where('tipe_misi', 'event');
    }

    // Scope untuk misi yang tersedia hari ini
    public function scopeAvailableToday($query)
    {
        $today = today();
        return $query->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_selesai', '>=', $today);
    }

    // Check apakah misi masih berlaku
    public function isBerlaku()
    {
        $today = today();
        return $this->status === 'aktif' &&
        $today >= $this->tanggal_mulai &&
        $today <= $this->tanggal_selesai;
    }

    // Check apakah anggota sudah menyelesaikan misi hari ini (untuk misi harian)
    public function isCompletedTodayBy($npm)
    {
        if ($this->tipe_misi === 'harian') {
            return $this->aktivitas()
                ->where('npm', $npm)
                ->whereDate('tanggal', today())
                ->where('status', 'approved')
                ->exists();
        }

        // Untuk misi mingguan/event, cek dalam periode yang berlaku
        return $this->aktivitas()
            ->where('npm', $npm)
            ->where('status', 'approved')
            ->whereBetween('tanggal', [$this->tanggal_mulai, $this->tanggal_selesai])
            ->exists();
    }

    // Check apakah anggota bisa mengambil misi ini
    public function canBeCompletedBy($npm)
    {
        // Misi harus aktif dan masih dalam periode
        if (! $this->isBerlaku()) {
            return false;
        }

        // Untuk misi harian, bisa diambil lagi setiap hari
        if ($this->tipe_misi === 'harian') {
            return ! $this->isCompletedTodayBy($npm);
        }

        // Untuk misi mingguan/event, hanya bisa sekali dalam periode
        return ! $this->isCompletedTodayBy($npm);
    }

    // Get icon URL atau default icon
    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('assets/icons/' . $this->icon . '.svg');
        }

        // Default icon berdasarkan tipe misi
        $defaultIcons = [
            'harian'   => 'today',
            'mingguan' => 'calendar_week',
            'event'    => 'event',
        ];

        return asset('assets/icons/' . ($defaultIcons[$this->tipe_misi] ?? 'assignment') . '.svg');
    }

    // Get status color untuk UI
    public function getStatusColorAttribute()
    {
        return $this->status === 'aktif' ? 'success' : 'secondary';
    }

    // Get type color untuk UI
    public function getTypeColorAttribute()
    {
        $colors = [
            'harian'   => 'primary',
            'mingguan' => 'warning',
            'event'    => 'info',
        ];

        return $colors[$this->tipe_misi] ?? 'secondary';
    }

    // Get participants count
    public function getParticipantsCountAttribute()
    {
        return $this->aktivitas()->distinct('npm')->count();
    }

    // Get completion rate (approved vs total submissions)
    public function getCompletionRateAttribute()
    {
        $total    = $this->aktivitas()->count();
        $approved = $this->aktivitas()->where('status', 'approved')->count();

        return $total > 0 ? round(($approved / $total) * 100, 2) : 0;
    }

    // Get average XP given for this mission
    public function getAverageXpGivenAttribute()
    {
        return $this->aktivitas()
            ->where('status', 'approved')
            ->avg('xp_diperoleh') ?? 0;
    }
}
