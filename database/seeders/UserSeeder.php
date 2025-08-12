<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user (already exists from AdminSeeder)
        
        // Create pemilik users
        $pemilikData = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'role' => 'pemilik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@example.com',
                'phone' => '081234567891',
                'role' => 'pemilik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'phone' => '081234567892',
                'role' => 'pemilik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'phone' => '081234567893',
                'role' => 'pemilik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rudi Hermawan',
                'email' => 'rudi@example.com',
                'phone' => '081234567894',
                'role' => 'pemilik',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($pemilikData as $data) {
            User::create($data);
        }

        // Create penyewa users
        $penyewaData = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@example.com',
                'phone' => '081234567895',
                'role' => 'penyewa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya@example.com',
                'phone' => '081234567896',
                'role' => 'penyewa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Doni Setiawan',
                'email' => 'doni@example.com',
                'phone' => '081234567897',
                'role' => 'penyewa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rina Wati',
                'email' => 'rina@example.com',
                'phone' => '081234567898',
                'role' => 'penyewa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar@example.com',
                'phone' => '081234567899',
                'role' => 'penyewa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($penyewaData as $data) {
            User::create($data);
        }
    }
}
