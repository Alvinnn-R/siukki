<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_admins')->insert([
            'id_admin'   => 'admin01',
            'profile'    => null,
            'nama'       => 'Admin Siukki',
            'password'   => Hash::make('adminpassword'), // hash password!
            'role'       => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
