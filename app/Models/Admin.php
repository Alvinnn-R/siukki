<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Primary key adalah id_admin (string)
    protected $primaryKey = 'id_admin';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_admin',
        'nama',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Override method untuk authentication
    public function getAuthIdentifierName()
    {
        return 'id_admin';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute('id_admin');
    }
}
