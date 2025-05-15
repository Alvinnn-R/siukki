<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table      = 'misi';
    protected $primaryKey = 'id_misi';

    protected $fillable = [
        'id_admin',
        'nama',
        'deskripsi',
        'poin',
        'jadwal',
    ];

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'id_misi', 'id_misi');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_admin');
    }
}
