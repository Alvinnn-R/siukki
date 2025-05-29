<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_admin';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = ['nama', 'password', 'role'];
    protected $hidden   = ['password'];
}
