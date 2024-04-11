-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2024 at 10:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Riyan Admin Edit', 'admin@admin.com', '$2y$12$DkzPVAcI3KWdQpvIPuZM5OOEfAJSY/QBW.LYiqS6vY/GJkzxJzqF6', NULL, '2024-04-03 09:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hit` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `link`, `location`, `filename`, `hit`, `created_at`, `updated_at`) VALUES
(1, 'https://www.tokopedia.com/pajak/samsat/', 'HOME', 'Group 2 (3).png', 0, '2024-04-04 03:49:35', '2024-04-04 03:49:35'),
(2, 'https://google.com', 'HOME', 'banner-6.jpg', 0, '2024-04-05 23:00:14', '2024-04-05 23:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` varchar(455) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `admin_id`, `title`, `featured_image`, `body`, `labels`, `hit`, `created_at`, `updated_at`) VALUES
(1, 1, 'SAMSAT Trenggalek Meluncurkan Aplikasi untuk Mempermudah Mengurus Surat-surat Kendaraan', 'Hecker.jpg', '<p><strong>Trenggalek, Jawa Timur</strong> - Samsat Trenggalek meluncurkan aplikasi baru untuk memudahkan masyarakat dalam mengurus surat-surat kendaraan. Aplikasi bernama \"Samsat Trenggalek\" ini dapat diunduh secara gratis di Google Play Store dan App Store.</p><p>Aplikasi ini menyediakan berbagai layanan, seperti:</p><ul><li>Pembayaran pajak kendaraan bermotor (PKB)</li><li>Pengesahan Surat Tanda Nomor Kendaraan (STNK)</li><li>Mutasi kendaraan</li><li>Balik nama kendaraan</li><li>Cetak BPKB</li><li>Cek status blokir kendaraan</li></ul><p>Kepala Samsat Trenggalek, Arief Budiman, mengatakan bahwa aplikasi ini diluncurkan untuk meningkatkan pelayanan kepada masyarakat. \"Dengan aplikasi ini, masyarakat tidak perlu lagi datang ke kantor Samsat untuk mengurus surat-surat kendaraan,\" kata Arief.</p><p>Masyarakat dapat menggunakan aplikasi ini dengan mudah. Pertama, pengguna perlu mendaftar akun dengan memasukkan data diri dan nomor kendaraan. Setelah akun terdaftar, pengguna dapat langsung menggunakan berbagai layanan yang tersedia.</p><p>Aplikasi Samsat Trenggalek diharapkan dapat meningkatkan kepatuhan masyarakat dalam membayar pajak kendaraan. Selain itu, aplikasi ini juga diharapkan dapat meningkatkan efisiensi dan transparansi pelayanan Samsat.</p><p><strong>Manfaat Aplikasi Samsat Trenggalek:</strong></p><ul><li>Menghemat waktu dan biaya</li><li>Menghindari antrian panjang di kantor Samsat</li><li>Memudahkan proses pembayaran pajak kendaraan</li><li>Meningkatkan transparansi pelayanan Samsat</li></ul><p><strong>Cara menggunakan Aplikasi Samsat Trenggalek:</strong></p><ol><li>Unduh aplikasi Samsat Trenggalek di Google Play Store atau App Store.</li><li>Daftar akun dengan memasukkan data diri dan nomor kendaraan.</li><li>Pilih layanan yang ingin digunakan.</li><li>Ikuti petunjuk yang tertera di layar.</li><li>Lakukan pembayaran sesuai dengan tagihan.</li></ol><p><strong>Samsat Trenggalek berkomitmen untuk terus meningkatkan pelayanan kepada masyarakat. Dengan aplikasi ini, diharapkan masyarakat dapat mengurus surat-surat kendaraan dengan mudah dan cepat.</strong></p>', 'Berita,Informasi', 0, '2024-04-11 08:35:15', '2024-04-11 08:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanans`
--

CREATE TABLE `layanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `flow` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanans`
--

INSERT INTO `layanans` (`id`, `name`, `requirement`, `flow`, `created_at`, `updated_at`) VALUES
(2, 'Her Tahunan', 'STNK Asli||Identitas Asli (KTP/SIM/KK)', 'Datang ke SAMSAT', '2024-04-03 10:35:57', '2024-04-03 10:51:49'),
(3, 'Balik Nama Kendaraan Bermotor', 'BPKB (Asli & Fotocopy)||STNK (Asli & Fotocopy)||Identitas Diri (Asli & Fotocopy)||Kuitansi Pembelian (Asli) Dibubuhi Materai||Fotocopy Kartu Keluarga (Kendaraan Mobile Pribadi)', 'Datang ke SAMSAT', '2024-04-03 10:53:24', '2024-04-03 10:53:24'),
(4, 'Blokir Kendaraan Bermotor / Lapor Jual', 'Identitas Diri (Asli & Fotocopy)||Materai Rp 10.000,00', 'Datang ke SAMSAT', '2024-04-03 10:54:36', '2024-04-03 10:54:36'),
(5, 'Her Lima Tahunan', 'BPKB Asli||STNK Asli||Identitas Asli (KTP/SIM/KK)||Berkas Verifikasi Kendaraan||Berkas Cek Fisik Kendaraan', 'Datang ke SAMSAT Induk', '2024-04-11 09:07:12', '2024-04-11 09:07:12'),
(6, 'Mutasi Masuk Kendaraan Bermotor', 'Berkas dari Daerah Asal||BPKB (Asli & Fotocopy)||STNK (Asli & Fotocopy)||Identitas Diri (KTP/SIM/KK) Asli dan Fotocopy||Dokumen Cek Fisik Kendaraan||Fiskal||Faktur Kendaraan||Cross Check Polda (Khusus Kendaraan dari Luar Provinsi)', 'Datang ke SAMSAT', '2024-04-11 12:43:25', '2024-04-11 12:43:25'),
(7, 'Mutasi Keluar Kendaraan Bermotor', 'BPKB (Asli & Fotocopy)||STNK (Asli & Fotocopy)||Identitas Diri Asli & Fotocopy (KTP/SIM/KK)||Dokumen Cek Fisik Kendaraan||Kuitansi Jual Beli', 'Datang ke SAMSAT', '2024-04-11 12:45:03', '2024-04-11 12:45:03'),
(8, 'Duplikat / Kehilangan STNK', 'BPKB (Asli & Fotocopy)||Identitas Asli Pelapor dan Pemilik (KTP/SIM/KK)||Laporan Kehilangan dari Kepolisian||Dokumen Cek Fisik Kendaraan||Berita Acara dari Reskrim dan Lapju (Polres setempat yang menerangkan kendaraan bermotor tidak terlibat tindak kriminal dan lapor jual)||Surat Keterangan dari Satlantas (Polres setempat yang menerangkan kendaraan bermotor tidak terlibat pelanggaran lalu lintas)||Surat Keterangan dari Lakalantas (Polres setempat yang menerangkan kendaraan bermotortidak terlibat lakalantas)||.Iklan Koran yang memuat berita kehilangan STNK beserta kuitansi pembayaran iklan.', 'Datang ke SAMSAT', '2024-04-11 12:46:50', '2024-04-11 12:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `lokasis`
--

CREATE TABLE `lokasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bentuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gmaps_link` varchar(455) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinates` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasis`
--

INSERT INTO `lokasis` (`id`, `name`, `bentuk`, `image`, `address`, `gmaps_link`, `coordinates`, `created_at`, `updated_at`) VALUES
(10, 'Sampokja Kedunglurah', 'Payment Point', '5677_sampokja.jpg', 'Taman Desa Kedunglurah, Kecamatan Pogalan, Kabupaten Trenggalek', 'https://maps.app.goo.gl/Hufspz7s58XYQFuR9', '-8.1141306||111.7752092', '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(11, 'Drive Thru Menak Sopal', 'Drive Thru', '9916_menaksopal.jpg', 'Taman Desa Kedunglurah, Kecamatan Pogalan, Kabupaten Trenggalek', 'https://maps.app.goo.gl/6LkZu7Co6Ua1ttHt7', '-8.0736735||111.7059731', '2024-04-04 02:54:42', '2024-04-04 04:51:23'),
(12, 'SAMSAT Induk Trenggalek', 'Samsat Induk', '4855_samsat-induk.jpg', 'Jl. Ki Mangun Sarkoro No. 11 Trenggalek', 'https://maps.app.goo.gl/Hhj5MKaCCVhsaLVJ9', '-8.05054||111.717283', '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(13, 'Payment Point Gandusari', 'Payment Point', '4668_samsat-gandusari.jpg', 'Kantor Kecamatan Gandusari (Jl.\r\nGandusari-Kampak, Kecamatan Gandusari,\r\nKabupaten Trenggalek)', 'https://maps.app.goo.gl/ZVZVMd8ExxpZdkkB9', '-8.1294135||111.7017867', '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(15, 'Payment Point Suruh', 'Payment Point', '6957_suruh.jpg', 'Halaman Kantor Kecamatan Suruh (Jl. Raya Suruh-Dongko, Jatirejo, Kecamatan Suruh, Kabupaten Trenggalek', 'https://maps.app.goo.gl/QRz8uYNTVRJy5K8o7', '-8.097723||111.643995', '2024-04-11 12:58:24', '2024-04-11 13:16:38'),
(16, 'Samsat Keliling Watulimo', 'Samsat Keliling Semar Jawara', '6378_samling.jpg', 'Bank Jatim KCP Watulimo (Jl. Raya Pantai Prigi, Ketawang, Tasikmadu, Kec. Watulimo, Kabupaten Trenggalek)', 'https://maps.app.goo.gl/92PRGV2cptgvHvWR9', '-8.0454747||110.9968862', '2024-04-11 13:24:21', '2024-04-11 13:24:21'),
(17, 'Samsat Keliling Tugu', 'Samsat Keliling Semar Jawara', '4508_samtugu.jpg', 'Halaman Kantor Kecamatan Tugu, Jl. Raya Trenggalek -Ponorogo, Kecamatan Tugu, Kabupaten Trenggalek.', 'https://maps.app.goo.gl/92PRGV2cptgvHvWR9', '-8.0454747||110.9968862', '2024-04-11 13:26:46', '2024-04-11 13:26:46'),
(18, 'Samsat Keliling Dongko', 'Samsat Keliling Semar Jawara', '8340_samtugu.jpg', 'Halaman Kantor Kecamatan Dongko', 'https://maps.app.goo.gl/3ut5vNfferUUY7Qx5', '-8.1880313||111.5747482', '2024-04-11 13:28:39', '2024-04-11 13:28:39'),
(19, 'Samsat Keliling Munjungan', 'Samsat Keliling Semar Jawara', '2987_samtugu.jpg', 'Polsek Munjungan (Jl. Raya Munjungan No. 05, Kecamatan Munjungan, Kabupaten Trenggalek)', 'https://maps.app.goo.gl/3ut5vNfferUUY7Qx5', '-8.1880313||111.5747482', '2024-04-11 13:30:19', '2024-04-11 13:30:19'),
(20, 'Sampokja Panggul', 'Payment Point', '5684_sampokja-panggul.jpg', 'Bank Jatim KCP Panggul, Jl. Panji Nawangkung, Karang, Wonocoyo, Kecamatan Panggul, Kabupaten Trenggalek', 'https://maps.app.goo.gl/cS9kEDdVqYNibPgu8', '-8.2470698||111.4540532', '2024-04-11 13:32:42', '2024-04-11 13:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_images`
--

CREATE TABLE `lokasi_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_images`
--

INSERT INTO `lokasi_images` (`id`, `lokasi_id`, `filename`, `created_at`, `updated_at`) VALUES
(13, 10, '5677_sampokja.jpg', '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(14, 11, '9916_menaksopal.jpg', '2024-04-04 02:54:42', '2024-04-04 02:54:42'),
(15, 12, '4855_samsat-induk.jpg', '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(16, 13, '4668_samsat-gandusari.jpg', '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(17, 15, '6957_suruh.jpg', '2024-04-11 12:58:24', '2024-04-11 12:58:24'),
(18, 16, '6378_samling.jpg', '2024-04-11 13:24:21', '2024-04-11 13:24:21'),
(19, 17, '4508_samtugu.jpg', '2024-04-11 13:26:46', '2024-04-11 13:26:46'),
(20, 18, '8340_samtugu.jpg', '2024-04-11 13:28:39', '2024-04-11 13:28:39'),
(21, 19, '2987_samtugu.jpg', '2024-04-11 13:30:19', '2024-04-11 13:30:19'),
(22, 20, '5684_sampokja-panggul.jpg', '2024-04-11 13:32:42', '2024-04-11 13:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_jadwals`
--

CREATE TABLE `lokasi_jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_selesai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_jadwals`
--

INSERT INTO `lokasi_jadwals` (`id`, `lokasi_id`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(7, 10, 'Senin - Kamis', '08:00', '16:00', '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(8, 10, 'Jumat', '08:00', '11:00', '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(9, 10, 'Sabtu', '08:00', '14:00', '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(28, 11, 'Senin - Kamis', '06:00', '16:00', '2024-04-04 04:51:23', '2024-04-04 04:51:23'),
(29, 11, 'Jumat', '08:00', '11:00', '2024-04-04 04:51:23', '2024-04-04 04:51:23'),
(30, 11, 'Sabtu', '08:00', '14:00', '2024-04-04 04:51:23', '2024-04-04 04:51:23'),
(31, 12, 'Senin - Kamis', '08:00', '13:00', '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(32, 12, 'Jumat', '08:00', '11:00', '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(33, 12, 'Sabtu', '08:00', '12:00', '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(34, 13, 'Senin - Kamis', '08:00', '12:00', '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(35, 13, 'Jumat', '08:00', '11:00', '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(36, 13, 'Sabtu', '08:00', '12:00', '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(49, 15, 'Senin - Kamis', '08:00', '12:00', '2024-04-11 13:16:38', '2024-04-11 13:16:38'),
(50, 15, 'Jumat', '08:00', '11:00', '2024-04-11 13:16:38', '2024-04-11 13:16:38'),
(51, 15, 'Sabtu', '08:00', '12:00', '2024-04-11 13:16:38', '2024-04-11 13:16:38'),
(52, 16, 'Hari Pasaran Pahing', '08:00', '12:00', '2024-04-11 13:24:21', '2024-04-11 13:24:21'),
(53, 17, 'Hari Pasaran Pon', '08:00', '12:00', '2024-04-11 13:26:46', '2024-04-11 13:26:46'),
(54, 18, 'Hari Pasaran Kliwon', '08:00', '12:00', '2024-04-11 13:28:39', '2024-04-11 13:28:39'),
(55, 19, 'Hari Pasaran Legi', '08:00', '12:00', '2024-04-11 13:30:19', '2024-04-11 13:30:19'),
(56, 20, 'Hari Pasaran Wage', '08:00', '12:00', '2024-04-11 13:32:42', '2024-04-11 13:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_layanans`
--

CREATE TABLE `lokasi_layanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `layanan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_layanans`
--

INSERT INTO `lokasi_layanans` (`id`, `lokasi_id`, `layanan_id`, `created_at`, `updated_at`) VALUES
(6, 10, 2, '2024-04-04 02:51:38', '2024-04-04 02:51:38'),
(11, 11, 2, '2024-04-04 04:51:23', '2024-04-04 04:51:23'),
(12, 12, 2, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(13, 12, 5, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(14, 12, 3, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(15, 12, 4, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(16, 12, 6, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(17, 12, 7, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(18, 12, 8, '2024-04-11 12:50:53', '2024-04-11 12:50:53'),
(19, 13, 2, '2024-04-11 12:55:38', '2024-04-11 12:55:38'),
(24, 15, 2, '2024-04-11 13:16:38', '2024-04-11 13:16:38'),
(25, 16, 2, '2024-04-11 13:24:21', '2024-04-11 13:24:21'),
(26, 17, 2, '2024-04-11 13:26:46', '2024-04-11 13:26:46'),
(27, 18, 2, '2024-04-11 13:28:39', '2024-04-11 13:28:39'),
(28, 19, 2, '2024-04-11 13:30:19', '2024-04-11 13:30:19'),
(29, 20, 2, '2024-04-11 13:32:42', '2024-04-11 13:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_03_162744_create_admins_table', 1),
(5, '2024_04_03_164324_create_banners_table', 2),
(6, '2024_04_03_164615_create_surats_table', 3),
(7, '2024_04_03_165135_create_layanans_table', 4),
(8, '2024_04_03_183024_create_lokasis_table', 5),
(9, '2024_04_03_184745_create_lokasi_images_table', 6),
(10, '2024_04_04_063221_create_lokasi_layanans_table', 7),
(11, '2024_04_04_064427_create_lokasi_jadwals_table', 8),
(12, '2024_04_04_093009_create_payment_links_table', 9),
(13, '2024_04_04_110921_create_partnerships_table', 10),
(14, '2024_04_04_111417_create_personal_access_tokens_table', 10),
(16, '2024_04_06_041516_add_whatsapp_to_users_table', 11),
(19, '2024_04_11_151451_create_infos_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `partnerships`
--

CREATE TABLE `partnerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partnerships`
--

INSERT INTO `partnerships` (`id`, `user_id`, `type`, `record`, `created_at`, `updated_at`) VALUES
(1, 2, 'rju', '[{\"type\":\"text\",\"value\":\"CV Maju Jaya\",\"label\":\"Nama \\/ Instansi\",\"key\":\"name\"},{\"type\":\"textarea\",\"value\":\"Di rumah\",\"label\":\"Alamat (Lengkap Sesuai KTP)\",\"key\":\"address\"},{\"type\":\"number\",\"value\":\"085159772902\",\"label\":\"Nomor WhatsApp\",\"key\":\"phone\"},{\"type\":\"dropdown\",\"value\":\"Kegiatan Promosi\",\"label\":\"Peruntukan RJU\",\"key\":\"purpose\",\"options\":[\"Makanan \\/ Minuman\",\"Fotocopy\",\"Banner\",\"Kegiatan Promosi\",\"Test Drive Kendaraan\",\"Kotak Brosur\",\"Iklan Produk\",\"Gerai ATM\"]},{\"type\":\"view\",\"label\":\"Informasi CP 0895807713939\"}]', '2024-04-06 03:33:25', '2024-04-06 03:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_links`
--

CREATE TABLE `payment_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_links`
--

INSERT INTO `payment_links` (`id`, `name`, `link`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Tokopedia Edited', 'https://www.tokopedia.com/pajak/samsat/', '3180_tokped.png', '2024-04-04 03:53:44', '2024-04-04 03:56:08'),
(3, 'GoPay', 'https://www.gojek.com/blog/gotagihan/cara-bayar-pajak-online', '5410_Gopay_logo.svg.png', '2024-04-06 01:22:45', '2024-04-06 01:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5enU88O2jr54IA0ZqA0I6bKiQdbd7HYJpKHXHmlq', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSTlXcktVd3BXTVJtbXNvc08wWkh0UU1sWXpEZzE4eENkc1hEd2NTTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXltZW50Ijt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1712867682),
('AOA2XFkVZxzPpJsrmUbZv9wF3ZWhBJqLWaKgkLLk', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS3BITzJqaDNmaENmc3FGdHY3ZzV4YmVZMjJPSURzY3lReFc5cjBzNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sYXlhbmFuIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1712851632),
('Bv59UIRUh67kpM2OD0PoK4oAJIZF9Mt5V25jGlKx', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieTRFM3JJdXowMEhwZ3NJUHNqMnpRSmtIeDZ2SW1HTGNyckZrRkw3SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS9hZG1pbi9pbmZvIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1712848493),
('msSGPeG00Ck3TakNUu0k36El1WIggWnWaCGg0W1W', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmFmdFFzVTQ5eTdZQUVHSVR0U1I4WkJLNEpGRGp3N0tmMURlTTRxTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1712848270),
('N0OTxC5MwLBO4lKcHRPsHweK5PndhA4O6cXXjQiT', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2hOa0ZvNUR0ZmE4UlBiMm02d0JOUFRBNGZUQTFtblNqdDF6bEhxaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9pbmZvL2NyZWF0ZSI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1712850530),
('xfU5xArxN7x7vjHyC81Zyav9FdCKnwfv4Ab7A584', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFVJYjlmTUpLVmlraDk2VHJ4Z2VldzZxcTZvZndEN3Myckl0M2dYbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2thc2kiO31zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1712404845);

-- --------------------------------------------------------

--
-- Table structure for table `surats`
--

CREATE TABLE `surats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `arah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nopol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `whatsapp`, `email`, `email_verified_at`, `password`, `nopol`, `remember_token`, `token`, `created_at`, `updated_at`) VALUES
(2, '0686683568585', 'Tony Stark', '85159772902', 'tony@starkindustries.com', NULL, '$2y$12$a.8PIXLRgiaQdSuJxQAmhuoVF93EsT/k1BRJgDlgNUF3N4FhjzuFa', 'Stststs', NULL, 'VWFijYjREmbiU3RY', '2024-04-05 21:35:21', '2024-04-05 22:56:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infos_admin_id_index` (`admin_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasis`
--
ALTER TABLE `lokasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_images`
--
ALTER TABLE `lokasi_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lokasi_images_lokasi_id_index` (`lokasi_id`);

--
-- Indexes for table `lokasi_jadwals`
--
ALTER TABLE `lokasi_jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lokasi_jadwals_lokasi_id_index` (`lokasi_id`);

--
-- Indexes for table `lokasi_layanans`
--
ALTER TABLE `lokasi_layanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lokasi_layanans_lokasi_id_index` (`lokasi_id`),
  ADD KEY `lokasi_layanans_layanan_id_index` (`layanan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partnerships`
--
ALTER TABLE `partnerships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partnerships_user_id_index` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `surats`
--
ALTER TABLE `surats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surats_nomor_unique` (`nomor`),
  ADD KEY `surats_admin_id_index` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanans`
--
ALTER TABLE `layanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lokasis`
--
ALTER TABLE `lokasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lokasi_images`
--
ALTER TABLE `lokasi_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lokasi_jadwals`
--
ALTER TABLE `lokasi_jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `lokasi_layanans`
--
ALTER TABLE `lokasi_layanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `partnerships`
--
ALTER TABLE `partnerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surats`
--
ALTER TABLE `surats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `infos`
--
ALTER TABLE `infos`
  ADD CONSTRAINT `infos_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lokasi_images`
--
ALTER TABLE `lokasi_images`
  ADD CONSTRAINT `lokasi_images_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lokasi_jadwals`
--
ALTER TABLE `lokasi_jadwals`
  ADD CONSTRAINT `lokasi_jadwals_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lokasi_layanans`
--
ALTER TABLE `lokasi_layanans`
  ADD CONSTRAINT `lokasi_layanans_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lokasi_layanans_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `partnerships`
--
ALTER TABLE `partnerships`
  ADD CONSTRAINT `partnerships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surats`
--
ALTER TABLE `surats`
  ADD CONSTRAINT `surats_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
