<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kos;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyewaUsers = User::where('role', 'penyewa')->get();
        $verifiedKos = Kos::where('is_verified', true)->get();
        
        $transaksiData = [
            [
                'kos_id' => $verifiedKos[0]->id,
                'penyewa_id' => $penyewaUsers[0]->id,
                'catatan' => 'Halo, saya tertarik dengan kos ini. Apakah masih tersedia kamar untuk bulan depan?',
                'status_transaksi' => 'pending',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'kos_id' => $verifiedKos[1]->id,
                'penyewa_id' => $penyewaUsers[1]->id,
                'catatan' => 'Selamat pagi, saya ingin menanyakan tentang fasilitas yang tersedia di kos ini.',
                'status_transaksi' => 'selesai',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            [
                'kos_id' => $verifiedKos[2]->id,
                'penyewa_id' => $penyewaUsers[2]->id,
                'catatan' => 'Apakah bisa lihat kamar dulu sebelum memutuskan untuk sewa?',
                'status_transaksi' => 'pending',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'kos_id' => $verifiedKos[3]->id,
                'penyewa_id' => $penyewaUsers[3]->id,
                'catatan' => 'Saya mahasiswa baru, apakah ada diskon untuk kontrak tahunan?',
                'status_transaksi' => 'selesai',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(4),
            ],
            [
                'kos_id' => $verifiedKos[4]->id,
                'penyewa_id' => $penyewaUsers[4]->id,
                'catatan' => 'Halo pak/bu, saya ingin tanya apakah kos ini dekat dengan halte busway?',
                'status_transaksi' => 'pending',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'kos_id' => $verifiedKos[5]->id,
                'penyewa_id' => $penyewaUsers[0]->id,
                'catatan' => 'Saya tertarik dengan kos yang ada tamannya. Bisa minta info lebih detail?',
                'status_transaksi' => 'dibatalkan',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(8),
            ],
            [
                'kos_id' => $verifiedKos[6]->id,
                'penyewa_id' => $penyewaUsers[1]->id,
                'catatan' => 'Apakah ada slot parkir motor yang tersedia?',
                'status_transaksi' => 'pending',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'kos_id' => $verifiedKos[7]->id,
                'penyewa_id' => $penyewaUsers[2]->id,
                'catatan' => 'Saya pekerja shift malam, apakah ada aturan khusus untuk keluar masuk?',
                'status_transaksi' => 'selesai',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($transaksiData as $data) {
            Transaksi::create($data);
        }
    }
}
