<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'npm';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'npm',
        'nama',
        'password',
        'profile',
        'xp',
        'level',
        'badge',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'xp'       => 'integer',
        'level'    => 'integer',
    ];

    // Accessor untuk mendapatkan URL profile picture
    public function getProfileUrlAttribute()
    {
        if ($this->profile) {
            return asset('uploads/profiles/' . $this->profile);
        }
        return asset('assets/images/Avater.png'); // default avatar
    }

    // Accessor untuk mendapatkan XP yang dibutuhkan untuk level selanjutnya
    public function getXpToNextLevelAttribute()
    {
        $nextLevel  = $this->level + 1;
        $requiredXp = $nextLevel * 300; // Setiap level butuh 300 XP
        return $requiredXp - $this->xp;
    }

    // Accessor untuk progress percentage ke level selanjutnya
    public function getProgressPercentageAttribute()
    {
        $currentLevelXp = $this->level * 300;
        $nextLevelXp    = ($this->level + 1) * 300;
        $progressXp     = $this->xp - (($this->level - 1) * 300);

        return ($progressXp / 300) * 100;
    }

    // Method untuk menambah XP dan auto level up
    public function addXp($amount)
    {
        $this->xp += $amount;

        // Auto level up jika XP cukup
        $newLevel = intval($this->xp / 300) + 1;
        if ($newLevel > $this->level) {
            $this->level = $newLevel;

            // Auto update badge based on level
            if ($this->level >= 9) {
                $this->badge = 'Cendekiawan Islami';
            } elseif ($this->level >= 5) {
                $this->badge = 'Penuntut Kebaikan';
            } else {
                $this->badge = 'Murid Ilmu';
            }
        }

        $this->save();
        return $this;
    }

    // Relasi dengan aktivitas
    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'npm', 'npm');
    }

    // Method untuk mendapatkan aktivitas hari ini
    public function aktivitasToday()
    {
        return $this->aktivitas()->whereDate('tanggal', today());
    }

    // Method untuk mendapatkan aktivitas bulan ini
    public function aktivitasThisMonth()
    {
        return $this->aktivitas()->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year);
    }

    // Method untuk menghitung total XP dari aktivitas
    public function calculateTotalXpFromActivities()
    {
        return $this->aktivitas()
            ->where('status', 'approved')
            ->sum('xp_diperoleh');
    }

    // Method untuk sync XP dari aktivitas ke field xp
    public function syncXpFromActivities()
    {
        $totalXp  = $this->calculateTotalXpFromActivities();
        $this->xp = $totalXp;

        // Auto level up
        $newLevel = intval($this->xp / 300) + 1;
        if ($newLevel > $this->level) {
            $this->level = $newLevel;

            // Auto update badge
            if ($this->level >= 9) {
                $this->badge = 'Cendekiawan Islami';
            } elseif ($this->level >= 5) {
                $this->badge = 'Penuntut Kebaikan';
            } else {
                $this->badge = 'Murid Ilmu';
            }
        }

        $this->save();
        return $this;
    }

    // Scope untuk filter by level
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    // Scope untuk filter by badge
    public function scopeByBadge($query, $badge)
    {
        return $query->where('badge', $badge);
    }

    public function getRouteKeyName()
    {
        return 'npm';
    }
}
