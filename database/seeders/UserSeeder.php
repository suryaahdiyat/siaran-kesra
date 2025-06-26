<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User::truncate(); // <-- HAPUS ATAU BERI KOMENTAR PADA BARIS INI

        // Akun untuk Kepala Bidang
        User::create([
            'name' => 'Kepala Bidang Kesra',
            'email' => 'kabid@kesra.go.id',
            'role' => 'kepala_bidang',
            'password' => Hash::make('passwordkabid')
        ]);

        // Akun untuk Staff Kesra
        User::create([
            'name' => 'Staff Kesra',
            'email' => 'staff@kesra.go.id',
            'role' => 'staff',
            'password' => Hash::make('passwordstaff')
        ]);
    }
}