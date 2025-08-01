<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kos;
use App\Models\User;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemilikUsers = User::where('role', 'pemilik')->get();
        
        $kosData = [
            [
                'nama_kos' => 'Kos Melati Indah',
                'lokasi' => 'Jl. Melati No. 15, Yogyakarta',
                'harga' => 800000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar',
                'deskripsi' => 'Kos nyaman dan strategis dekat dengan kampus UGM. Lingkungan aman dan tenang, cocok untuk mahasiswa. Tersedia dapur bersama dan area parkir.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[0]->id,
            ],
            [
                'nama_kos' => 'Kos Mawar Residence',
                'lokasi' => 'Jl. Mawar Raya No. 22, Jakarta Selatan',
                'harga' => 1200000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, TV, Kulkas Mini',
                'deskripsi' => 'Kos modern dengan fasilitas lengkap di area Jakarta Selatan. Dekat dengan stasiun MRT dan pusat perbelanjaan. Keamanan 24 jam.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[1]->id,
            ],
            [
                'nama_kos' => 'Kos Anggrek Putih',
                'lokasi' => 'Jl. Anggrek No. 8, Bandung',
                'harga' => 600000,
                'fasilitas' => 'WiFi, Kamar Mandi Dalam, Kasur, Lemari',
                'deskripsi' => 'Kos sederhana dan terjangkau di pusat kota Bandung. Dekat dengan ITB dan berbagai tempat kuliner. Lingkungan bersih dan nyaman.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[2]->id,
            ],
            [
                'nama_kos' => 'Kos Dahlia Premium',
                'lokasi' => 'Jl. Dahlia No. 45, Surabaya',
                'harga' => 1000000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar, Balkon',
                'deskripsi' => 'Kos premium dengan view kota Surabaya. Fasilitas lengkap dan modern. Dekat dengan kampus dan pusat bisnis. Tersedia laundry service.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[3]->id,
            ],
            [
                'nama_kos' => 'Kos Kenanga Asri',
                'lokasi' => 'Jl. Kenanga No. 12, Malang',
                'harga' => 500000,
                'fasilitas' => 'WiFi, Kamar Mandi Luar, Kasur, Lemari',
                'deskripsi' => 'Kos ekonomis di kota Malang yang sejuk. Cocok untuk mahasiswa dengan budget terbatas. Lingkungan asri dan dekat dengan kampus.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[4]->id,
            ],
            [
                'nama_kos' => 'Kos Tulip Garden',
                'lokasi' => 'Jl. Tulip No. 33, Semarang',
                'harga' => 750000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Taman',
                'deskripsi' => 'Kos dengan konsep garden yang asri dan sejuk. Dilengkapi taman yang indah untuk bersantai. Dekat dengan UNDIP dan pusat kota.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[0]->id,
            ],
            [
                'nama_kos' => 'Kos Sakura Modern',
                'lokasi' => 'Jl. Sakura No. 18, Depok',
                'harga' => 900000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar, CCTV',
                'deskripsi' => 'Kos modern dengan keamanan terjamin di Depok. Dekat dengan UI dan stasiun kereta. Fasilitas lengkap dan lingkungan aman.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[1]->id,
            ],
            [
                'nama_kos' => 'Kos Flamboyan',
                'lokasi' => 'Jl. Flamboyan No. 7, Solo',
                'harga' => 550000,
                'fasilitas' => 'WiFi, Kamar Mandi Dalam, Kasur, Lemari, Dapur Bersama',
                'deskripsi' => 'Kos dengan suasana kekeluargaan di Solo. Tersedia dapur bersama untuk memasak. Dekat dengan UNS dan pusat kota Solo.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[2]->id,
            ],
            [
                'nama_kos' => 'Kos Bougenville',
                'lokasi' => 'Jl. Bougenville No. 25, Medan',
                'harga' => 650000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari',
                'deskripsi' => 'Kos nyaman di pusat kota Medan. Akses mudah ke berbagai tempat. Lingkungan bersih dan aman untuk mahasiswa dan pekerja.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[3]->id,
            ],
            [
                'nama_kos' => 'Kos Lavender Hills',
                'lokasi' => 'Jl. Lavender No. 40, Bogor',
                'harga' => 700000,
                'fasilitas' => 'WiFi, Kamar Mandi Dalam, Kasur, Lemari, Teras, Parkir Motor',
                'deskripsi' => 'Kos dengan udara sejuk khas Bogor. Dilengkapi teras untuk bersantai. Dekat dengan IPB dan tempat wisata Bogor.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => true,
                'user_id' => $pemilikUsers[4]->id,
            ],
            // Beberapa kos yang belum diverifikasi
            [
                'nama_kos' => 'Kos Cempaka Baru',
                'lokasi' => 'Jl. Cempaka No. 55, Jakarta Pusat',
                'harga' => 1100000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Gym',
                'deskripsi' => 'Kos baru dengan fasilitas gym di Jakarta Pusat. Lokasi strategis dekat dengan perkantoran dan pusat perbelanjaan.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => false,
                'user_id' => $pemilikUsers[0]->id,
            ],
            [
                'nama_kos' => 'Kos Teratai Indah',
                'lokasi' => 'Jl. Teratai No. 88, Tangerang',
                'harga' => 850000,
                'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Kolam Renang',
                'deskripsi' => 'Kos dengan fasilitas kolam renang di Tangerang. Cocok untuk yang ingin tinggal dengan fasilitas rekreasi.',
                'status_ketersediaan' => 'tersedia',
                'is_verified' => false,
                'user_id' => $pemilikUsers[1]->id,
            ],
        ];

        foreach ($kosData as $data) {
            Kos::create($data);
        }
    }
}
