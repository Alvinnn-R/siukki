<?php
namespace App\Models;

use App\Models\Aktivitas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Anggota extends Authenticatable
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table      = 'anggotas';
    protected $primaryKey = 'npm';
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $fillable   = [
        'profile',
        'nama',
        'password',
        'xp',
        'level',
        'badge',
    ];
    protected $hidden = ['password'];

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'npm', 'npm');
    }
}
