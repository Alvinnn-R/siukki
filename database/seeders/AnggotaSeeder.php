<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anggotas')->insert([
            'npm'        => '23081010021',
            'profile'    => null,
            'nama'       => 'Riky Hermawan',
            'password'   => Hash::make('password123'),
            'xp'         => 0,
            'level'      => 1,
            'badge'      => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
