<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'id_admin'   => 'admin01',
                'nama'       => 'Admin Arif',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin'   => 'admin02',
                'nama'       => 'Admin Alvin',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin'   => 'superadmin',
                'nama'       => 'Super Admin',
                'password'   => Hash::make('superadmin123'),
                'role'       => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
