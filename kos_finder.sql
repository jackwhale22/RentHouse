-- =====================================================
-- KOS FINDER DATABASE - MySQL Version (Updated)
-- Generated from SQLite database
-- Compatible with PHPMyAdmin
-- Updated with Message Management Features
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `kos_finder`
-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `kos_finder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kos_finder`;

-- =====================================================
-- Table structure for table `migrations`
-- =====================================================

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_28_183942_create_kos_table', 1),
(6, '2025_07_28_184003_create_transaksis_table', 1),
(7, '2025_07_29_060000_add_status_kontak_to_transaksis_table', 2);

-- =====================================================
-- Table structure for table `users`
-- =====================================================

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pemilik','penyewa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'penyewa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@kosfinder.com', '081234567890', '2025-07-28 18:44:45', '$2y$12$UZyk.9x.JiNLQlLET7WBwOL8Mi/OKPDd4UU3ynMNhVcRvj0rkw4LK', 'admin', NULL, '2025-07-28 18:44:45', '2025-07-28 18:44:45'),
(2, 'Budi Santoso', 'budi@example.com', '081234567890', '2025-07-28 18:58:31', '$2y$12$DtjC7JlENSRhmMKvBMihh.u1nGuGLFlfbyaqjyu4NB4YEbkTiIkci', 'pemilik', NULL, '2025-07-28 18:58:32', '2025-07-28 18:58:32'),
(3, 'Siti Rahayu', 'siti@example.com', '081234567891', '2025-07-28 18:58:32', '$2y$12$C8sCsMM.NF9lnxxfvljvy.v.osbD4iXAiKjCQ.ctk7FAx.FwMLM.6', 'pemilik', NULL, '2025-07-28 18:58:33', '2025-07-28 18:58:33'),
(4, 'Ahmad Wijaya', 'ahmad@example.com', '081234567892', '2025-07-28 18:58:32', '$2y$12$yDT1GJp5uiMPWoL6fror5.RuidPU1YcY6L0lp6HnpnnGntFzmKK.O', 'pemilik', NULL, '2025-07-28 18:58:33', '2025-07-28 18:58:33'),
(5, 'Dewi Lestari', 'dewi@example.com', '081234567893', '2025-07-28 18:58:32', '$2y$12$uZI0f.g4Qux1Jp9jRY38G.h0XKs4TfzZ2LTo6gXFhla/DOT4fHJ8K', 'pemilik', NULL, '2025-07-28 18:58:33', '2025-07-28 18:58:33'),
(6, 'Rudi Hermawan', 'rudi@example.com', '081234567894', '2025-07-28 18:58:32', '$2y$12$aOwR0IXApLESkXtuOssr3OuMpNUl/CfcuUoLbeXRGAqK9xRNQjMhq', 'pemilik', NULL, '2025-07-28 18:58:33', '2025-07-28 18:58:33'),
(7, 'Andi Pratama', 'andi@example.com', '081234567895', '2025-07-28 18:58:33', '$2y$12$4nmWVET6I4uPVVHZQplfYu0l724Pk67bRhgjxS3n2XMStGWT9BSuO', 'penyewa', NULL, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(8, 'Maya Sari', 'maya@example.com', '081234567896', '2025-07-28 18:58:33', '$2y$12$W4wMpuxElJ1Zh6HRsn8G9.07gjQK9.h/PR1D7I5Nyk8Xxuu2M7Q2i', 'penyewa', NULL, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(9, 'Doni Setiawan', 'doni@example.com', '081234567897', '2025-07-28 18:58:33', '$2y$12$o4nqjTIuuMZB1U0ShaFK0Ovx8UU4EiC.1a98LAm8rgOJm4nlSuF1a', 'penyewa', NULL, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(10, 'Rina Wati', 'rina@example.com', '081234567898', '2025-07-28 18:58:34', '$2y$12$JBWV/zY/SaGHmfOIQXc79ulzK3Di6xUlK0d95yhnWKbMXjrD.4Rae', 'penyewa', NULL, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(11, 'Fajar Nugroho', 'fajar@example.com', '081234567899', '2025-07-28 18:58:34', '$2y$12$AORteSfhEoHaEN0LGDDDy.2oo5W2XCxr619ltdAsVh1DpHTYzHrzO', 'penyewa', NULL, '2025-07-28 18:58:34', '2025-07-28 18:58:34');

-- =====================================================
-- Table structure for table `password_reset_tokens`
-- =====================================================

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table structure for table `failed_jobs`
-- =====================================================

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table structure for table `personal_access_tokens`
-- =====================================================

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table structure for table `kos`
-- =====================================================

DROP TABLE IF EXISTS `kos`;
CREATE TABLE `kos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ketersediaan` enum('tersedia','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kos_user_id_foreign` (`user_id`),
  CONSTRAINT `kos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `kos`
INSERT INTO `kos` (`id`, `nama_kos`, `lokasi`, `harga`, `fasilitas`, `deskripsi`, `foto`, `status_ketersediaan`, `user_id`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Kos Melati Indah', 'Jl. Melati No. 15, Yogyakarta', 800000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar', 'Kos nyaman dan strategis dekat dengan kampus UGM. Lingkungan aman dan tenang, cocok untuk mahasiswa. Tersedia dapur bersama dan area parkir.', NULL, 'tersedia', 2, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(2, 'Kos Mawar Residence', 'Jl. Mawar Raya No. 22, Jakarta Selatan', 1200000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, TV, Kulkas Mini', 'Kos modern dengan fasilitas lengkap di area Jakarta Selatan. Dekat dengan stasiun MRT dan pusat perbelanjaan. Keamanan 24 jam.', NULL, 'tersedia', 3, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(3, 'Kos Anggrek Putih', 'Jl. Anggrek No. 8, Bandung', 600000.00, 'WiFi, Kamar Mandi Dalam, Kasur, Lemari', 'Kos sederhana dan terjangkau di pusat kota Bandung. Dekat dengan ITB dan berbagai tempat kuliner. Lingkungan bersih dan nyaman.', NULL, 'tersedia', 4, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(4, 'Kos Dahlia Premium', 'Jl. Dahlia No. 45, Surabaya', 1000000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar, Balkon', 'Kos premium dengan view kota Surabaya. Fasilitas lengkap dan modern. Dekat dengan kampus dan pusat bisnis. Tersedia laundry service.', NULL, 'tersedia', 5, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(5, 'Kos Kenanga Asri', 'Jl. Kenanga No. 12, Malang', 500000.00, 'WiFi, Kamar Mandi Luar, Kasur, Lemari', 'Kos ekonomis di kota Malang yang sejuk. Cocok untuk mahasiswa dengan budget terbatas. Lingkungan asri dan dekat dengan kampus.', NULL, 'tersedia', 6, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(6, 'Kos Tulip Garden', 'Jl. Tulip No. 33, Semarang', 750000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Taman', 'Kos dengan konsep garden yang asri dan sejuk. Dilengkapi taman yang indah untuk bersantai. Dekat dengan UNDIP dan pusat kota.', NULL, 'tersedia', 2, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(7, 'Kos Sakura Modern', 'Jl. Sakura No. 18, Depok', 900000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar, CCTV', 'Kos modern dengan keamanan terjamin di Depok. Dekat dengan UI dan stasiun kereta. Fasilitas lengkap dan lingkungan aman.', NULL, 'tersedia', 3, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(8, 'Kos Flamboyan', 'Jl. Flamboyan No. 7, Solo', 550000.00, 'WiFi, Kamar Mandi Dalam, Kasur, Lemari, Dapur Bersama', 'Kos dengan suasana kekeluargaan di Solo. Tersedia dapur bersama untuk memasak. Dekat dengan UNS dan pusat kota Solo.', NULL, 'tersedia', 4, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(9, 'Kos Bougenville', 'Jl. Bougenville No. 25, Medan', 650000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari', 'Kos nyaman di pusat kota Medan. Akses mudah ke berbagai tempat. Lingkungan bersih dan aman untuk mahasiswa dan pekerja.', NULL, 'tersedia', 5, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(10, 'Kos Lavender Hills', 'Jl. Lavender No. 40, Bogor', 700000.00, 'WiFi, Kamar Mandi Dalam, Kasur, Lemari, Teras, Parkir Motor', 'Kos dengan udara sejuk khas Bogor. Dilengkapi teras untuk bersantai. Dekat dengan IPB dan tempat wisata Bogor.', NULL, 'tersedia', 6, 1, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(11, 'Kos Cempaka Baru', 'Jl. Cempaka No. 55, Jakarta Pusat', 1100000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Gym', 'Kos baru dengan fasilitas gym di Jakarta Pusat. Lokasi strategis dekat dengan perkantoran dan pusat perbelanjaan.', NULL, 'tersedia', 2, 0, '2025-07-28 18:58:34', '2025-07-28 18:58:34'),
(12, 'Kos Teratai Indah', 'Jl. Teratai No. 88, Tangerang', 850000.00, 'AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Kolam Renang', 'Kos dengan fasilitas kolam renang di Tangerang. Cocok untuk yang ingin tinggal dengan fasilitas rekreasi.', NULL, 'tersedia', 3, 0, '2025-07-28 18:58:34', '2025-07-28 18:58:34');

-- =====================================================
-- Table structure for table `transaksis` (UPDATED)
-- =====================================================

DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kos_id` bigint(20) UNSIGNED NOT NULL,
  `penyewa_id` bigint(20) UNSIGNED NOT NULL,
  `status_transaksi` enum('pending','dibatalkan','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_kontak` enum('pending','contacted','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `balasan_pemilik` text COLLATE utf8mb4_unicode_ci NULL,
  `tanggal_balasan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_kos_id_foreign` (`kos_id`),
  KEY `transaksis_penyewa_id_foreign` (`penyewa_id`),
  CONSTRAINT `transaksis_kos_id_foreign` FOREIGN KEY (`kos_id`) REFERENCES `kos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksis_penyewa_id_foreign` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `transaksis` (UPDATED WITH NEW COLUMNS)
INSERT INTO `transaksis` (`id`, `kos_id`, `penyewa_id`, `status_transaksi`, `status_kontak`, `catatan`, `balasan_pemilik`, `tanggal_balasan`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'pending', 'contacted', 'Halo, saya tertarik dengan kos ini. Apakah masih tersedia kamar untuk bulan depan?', 'Halo Andi, terima kasih atas minatnya. Kamar masih tersedia untuk bulan depan. Silakan hubungi saya di 081234567890 untuk jadwal lihat kamar.', '2025-07-27 10:30:00', '2025-07-26 18:58:34', '2025-07-27 10:30:00'),
(2, 2, 8, 'selesai', 'closed', 'Selamat pagi, saya ingin menanyakan tentang fasilitas yang tersedia di kos ini.', 'Selamat pagi Maya, fasilitas lengkap tersedia termasuk AC, WiFi, TV, dan kulkas mini. Sudah termasuk listrik dan air. Silakan datang langsung untuk melihat kamar.', '2025-07-24 09:15:00', '2025-07-23 18:58:34', '2025-07-25 18:58:34'),
(3, 3, 9, 'pending', 'pending', 'Apakah bisa lihat kamar dulu sebelum memutuskan untuk sewa?', NULL, NULL, '2025-07-27 18:58:34', '2025-07-27 18:58:34'),
(4, 4, 10, 'selesai', 'contacted', 'Saya mahasiswa baru, apakah ada diskon untuk kontrak tahunan?', 'Halo Rina, untuk kontrak tahunan ada diskon 5%. Harga menjadi Rp 950.000/bulan. Silakan hubungi saya untuk diskusi lebih lanjut.', '2025-07-22 14:20:00', '2025-07-21 18:58:34', '2025-07-24 18:58:34'),
(5, 5, 11, 'pending', 'pending', 'Halo pak/bu, saya ingin tanya apakah kos ini dekat dengan halte busway?', NULL, NULL, '2025-07-28 12:58:34', '2025-07-28 12:58:34'),
(6, 6, 7, 'dibatalkan', 'closed', 'Saya tertarik dengan kos yang ada tamannya. Bisa minta info lebih detail?', 'Halo Andi, kos ini memiliki taman yang asri dan nyaman. Sayangnya sepertinya Anda sudah menemukan kos lain. Terima kasih atas minatnya.', '2025-07-19 16:45:00', '2025-07-18 18:58:34', '2025-07-20 18:58:34'),
(7, 7, 8, 'pending', 'contacted', 'Apakah ada slot parkir motor yang tersedia?', 'Halo Maya, parkir motor tersedia dan aman dengan CCTV 24 jam. Tidak ada biaya tambahan untuk parkir. Silakan datang lihat lokasi parkir.', '2025-07-28 08:30:00', '2025-07-28 06:58:34', '2025-07-28 08:30:00'),
(8, 8, 9, 'selesai', 'closed', 'Saya pekerja shift malam, apakah ada aturan khusus untuk keluar masuk?', 'Halo Doni, tidak ada aturan khusus untuk pekerja shift. Akses 24 jam tersedia. Lingkungan aman dan tenang untuk istirahat siang hari.', '2025-07-26 11:00:00', '2025-07-25 18:58:34', '2025-07-27 18:58:34');

-- =====================================================
-- AUTO_INCREMENT settings
-- =====================================================

ALTER TABLE `migrations` AUTO_INCREMENT = 8;
ALTER TABLE `users` AUTO_INCREMENT = 12;
ALTER TABLE `kos` AUTO_INCREMENT = 13;
ALTER TABLE `transaksis` AUTO_INCREMENT = 9;

COMMIT;

-- =====================================================
-- ACCOUNT INFORMATION FOR TESTING
-- =====================================================

/*
AKUN DEFAULT UNTUK TESTING:

ADMIN:
- Email: admin@kosfinder.com
- Password: admin123

PEMILIK KOS (5 akun):
- budi@example.com / password123
- siti@example.com / password123
- ahmad@example.com / password123
- dewi@example.com / password123
- rudi@example.com / password123

PENYEWA (5 akun):
- andi@example.com / password123
- maya@example.com / password123
- doni@example.com / password123
- rina@example.com / password123
- fajar@example.com / password123

FITUR BARU:
- Manajemen pesan untuk pemilik kos
- Status kontak: pending, contacted, closed
- Balasan pemilik dengan timestamp
- Interface dalam bahasa Indonesia

DATA SAMPLE:
- 12 kos listings (10 verified, 2 unverified)
- 8 transaksi dengan berbagai status kontak dan balasan
- Lokasi: Yogyakarta, Jakarta, Bandung, Surabaya, Malang, Semarang, Depok, Solo, Medan, Bogor, Tangerang
- Range harga: Rp 500,000 - Rp 1,200,000 per bulan
*/

