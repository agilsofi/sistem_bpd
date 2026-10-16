<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Create BK (Bimbingan Konseling) user
        User::create([
            'username' => 'bk',
            'password' => Hash::make('bk123'),
            'role' => 'bk',
            'status' => 'aktif',
        ]);

        // Create Kesiswaan user
        User::create([
            'username' => 'kesiswaan',
            'password' => Hash::make('kesiswaan123'),
            'role' => 'kesiswaan',
            'status' => 'aktif',
        ]);
    }
}
