<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table      = 'aktivitas';
    protected $primaryKey = 'id_aktivitas';

    protected $fillable = [
        'npm',
        'id_misi',
        'riwayat_aktivitas',
        'tanggal',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'npm', 'npm');
    }

    public function misi()
    {
        return $this->belongsTo(Misi::class, 'id_misi', 'id_misi');
    }
}
