<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdmin extends Authenticatable
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table      = 'user_admin';
    protected $primaryKey = 'id_admin';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'profile',
        'nama',
        'password',
        'role',
    ];

    protected $hidden = ['password'];

    // Relasi ke Misi
    public function misi()
    {
        return $this->hasMany(Misi::class, 'id_admin', 'id_admin');
    }
}
