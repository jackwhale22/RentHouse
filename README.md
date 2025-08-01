# Kos Finder - Sistem Pencarian Kos

Sistem web pencarian kos yang dibangun dengan Laravel untuk memudahkan pencarian dan pengelolaan kos dengan 3 role pengguna: Admin, Pemilik Kos, dan Penyewa.

## 🚀 Fitur Utama

### Untuk Semua Pengguna (Guest)
- **Browse Kos**: Melihat daftar kos yang tersedia tanpa perlu login
- **Pencarian & Filter**: Mencari kos berdasarkan nama, lokasi, dan range harga
- **Detail Kos**: Melihat informasi lengkap kos termasuk fasilitas dan deskripsi
- **Featured Kos**: Menampilkan kos-kos unggulan di halaman utama

### Untuk Admin
- **Dashboard Admin**: Overview sistem dengan statistik lengkap
- **Verifikasi Kos**: Menyetujui atau menolak kos yang disubmit pemilik
- **Manajemen User**: Mengelola data pengguna (pemilik dan penyewa)
- **Monitoring Sistem**: Memantau aktivitas dan transaksi di sistem

### Untuk Pemilik Kos
- **Dashboard Pemilik**: Statistik kos dan transaksi
- **Kelola Kos**: Menambah, mengedit, dan menghapus kos milik sendiri
- **Upload Foto**: Mengunggah foto kos untuk menarik penyewa
- **Monitoring Kontak**: Melihat daftar penyewa yang menghubungi

### Untuk Penyewa
- **Dashboard Penyewa**: Statistik kontak dan kos favorit
- **Pencarian Advanced**: Filter pencarian dengan berbagai kriteria
- **Kontak Pemilik**: Menghubungi pemilik kos langsung dengan pesan
- **Riwayat Kontak**: Melihat status dan riwayat komunikasi dengan pemilik

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Database**: SQLite (mudah untuk development dan deployment)
- **Frontend**: Bootstrap 5.3 + Custom CSS
- **Icons**: Font Awesome 6
- **Authentication**: Laravel Breeze (custom implementation)
- **File Upload**: Laravel Storage

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM (opsional, untuk asset compilation)
- Web Server (Apache/Nginx) atau PHP built-in server

## 🔧 Instalasi

### 1. Clone atau Extract Project
```bash
# Jika dari ZIP, extract ke direktori web server
# Jika dari Git:
git clone <repository-url> kos-finder
cd kos-finder
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database
```bash
# Buat file database SQLite
touch database/database.sqlite

# Jalankan migration
php artisan migrate

# Jalankan seeder untuk data dummy
php artisan db:seed
```

### 5. Setup Storage
```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Pastikan direktori upload dapat ditulis
chmod -R 775 storage/
chmod -R 775 public/uploads/
```

### 6. Jalankan Server
```bash
# Development server
php artisan serve

# Atau gunakan web server lain dengan document root ke folder 'public'
```

## 👥 Akun Default

Setelah menjalankan seeder, tersedia akun default berikut:

### Admin
- **Email**: admin@kosfinder.com
- **Password**: admin123

### Pemilik Kos (5 akun)
- **Email**: budi@example.com, siti@example.com, ahmad@example.com, dewi@example.com, rudi@example.com
- **Password**: password123

### Penyewa (5 akun)
- **Email**: andi@example.com, maya@example.com, doni@example.com, rina@example.com, fajar@example.com
- **Password**: password123

## 📁 Struktur Project

```
kos-finder/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── HomeController.php
│   │   │   ├── PemilikController.php
│   │   │   └── PenyewaController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Kos.php
│       └── Transaksi.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── admin/
│       ├── pemilik/
│       └── penyewa/
├── routes/
│   └── web.php
└── public/
    └── uploads/
```

## 🎨 Fitur Desain

- **Responsive Design**: Kompatibel dengan desktop, tablet, dan mobile
- **Modern UI**: Menggunakan Bootstrap 5 dengan custom styling
- **User Experience**: Navigation yang intuitif dan user-friendly
- **Visual Hierarchy**: Tata letak yang jelas dan mudah dipahami
- **Interactive Elements**: Hover effects dan smooth transitions

## 🔐 Sistem Keamanan

- **Role-based Access Control**: Pembatasan akses berdasarkan role pengguna
- **Authentication Middleware**: Proteksi route yang memerlukan login
- **CSRF Protection**: Perlindungan terhadap Cross-Site Request Forgery
- **Input Validation**: Validasi data input di semua form
- **File Upload Security**: Validasi tipe dan ukuran file upload

## 📊 Database Schema

### Users Table
- id, name, email, phone, password, role, email_verified_at, timestamps

### Kos Table
- id, user_id, nama_kos, lokasi, harga, fasilitas, deskripsi, foto, status_ketersediaan, is_verified, timestamps

### Transaksis Table
- id, kos_id, penyewa_id, catatan, status_transaksi, timestamps

## 🚀 Deployment

### Untuk Production
1. Set `APP_ENV=production` di file `.env`
2. Set `APP_DEBUG=false` di file `.env`
3. Jalankan `php artisan config:cache`
4. Jalankan `php artisan route:cache`
5. Jalankan `php artisan view:cache`
6. Setup web server dengan document root ke folder `public`

### Untuk Shared Hosting
1. Upload semua file ke direktori hosting
2. Pindahkan isi folder `public` ke `public_html` atau `www`
3. Update path di `index.php` untuk mengarah ke folder Laravel
4. Set permission yang sesuai untuk folder `storage` dan `bootstrap/cache`

## 🐛 Troubleshooting

### Error Permission Denied
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Error Database Connection
- Pastikan file `database/database.sqlite` ada dan dapat ditulis
- Periksa konfigurasi database di file `.env`

### Error 500 Internal Server Error
- Periksa log error di `storage/logs/laravel.log`
- Pastikan semua dependencies terinstall dengan `composer install`

## 📞 Support

Jika mengalami masalah atau membutuhkan bantuan:
1. Periksa dokumentasi Laravel di [laravel.com](https://laravel.com)
2. Periksa log error di `storage/logs/`
3. Pastikan semua persyaratan sistem terpenuhi

## 📝 Changelog

### Version 1.0.0
- Implementasi sistem autentikasi dengan 3 role
- Fitur CRUD kos untuk pemilik
- Sistem verifikasi kos oleh admin
- Fitur pencarian dan filter kos
- Dashboard untuk setiap role
- Sistem kontak antara penyewa dan pemilik
- Desain responsive dan modern
- Data seeder untuk testing

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan pengembangan sistem informasi kos.

