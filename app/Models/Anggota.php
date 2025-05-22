<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'npm';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'nama', 'password', 'profile', 'xp', 'level', 'badge',
    ];

    protected $hidden = ['password'];
}
