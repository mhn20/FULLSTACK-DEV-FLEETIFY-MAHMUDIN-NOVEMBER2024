-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Waktu pembuatan: 16 Nov 2024 pada 03.15
-- Versi server: 10.11.7-MariaDB-1:10.11.7+maria~ubu2204
-- Versi PHP: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `attendance_id` varchar(100) NOT NULL,
  `clock_in` timestamp NOT NULL,
  `clock_out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `attendance_id`, `clock_in`, `clock_out`, `created_at`, `updated_at`) VALUES
(4, '20241115232130', '20241115235432', '2024-11-15 23:54:32', '2024-11-15 23:57:38', '2024-11-15 23:54:32', '2024-11-15 23:57:38'),
(5, '20241115232130', '20241116000038', '2024-11-16 00:00:38', '2024-11-16 00:30:42', '2024-11-16 00:00:38', '2024-11-16 00:30:42'),
(6, '20241115231813', '20241116000200', '2024-11-16 00:02:00', '2024-11-16 00:31:04', '2024-11-16 00:02:00', '2024-11-16 00:31:04'),
(7, '20241115231721', '20241116000249', '2024-11-16 00:02:49', '2024-11-16 00:33:52', '2024-11-16 00:02:49', '2024-11-16 00:33:52'),
(9, '20241116090252', '20241116090305', '2024-11-16 09:03:05', '2024-11-16 09:03:19', '2024-11-16 09:03:05', '2024-11-16 09:03:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance_history`
--

CREATE TABLE `attendance_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `attendance_id` varchar(100) NOT NULL,
  `date_attendance` timestamp NOT NULL,
  `attendance_type` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `attendance_history`
--

INSERT INTO `attendance_history` (`id`, `employee_id`, `attendance_id`, `date_attendance`, `attendance_type`, `description`, `created_at`, `updated_at`) VALUES
(6, '20241115232130', '20241115235432', '2024-11-15 23:54:32', 1, 'Absen Masuk', '2024-11-15 23:54:32', '2024-11-15 23:54:32'),
(8, '20241115232130', '20241115235432', '2024-11-15 23:57:38', 2, 'Absen Keluar', '2024-11-15 23:57:38', '2024-11-15 23:57:38'),
(9, '20241115232130', '20241116000038', '2024-11-16 00:00:38', 1, 'Absen Masuk', '2024-11-16 00:00:38', '2024-11-16 00:00:38'),
(10, '20241115231813', '20241116000200', '2024-11-16 00:02:00', 1, 'Absen Masuk', '2024-11-16 00:02:00', '2024-11-16 00:02:00'),
(11, '20241115231721', '20241116000249', '2024-11-16 00:02:49', 1, 'Absen Masuk', '2024-11-16 00:02:49', '2024-11-16 00:02:49'),
(12, '20241115232130', '20241116000038', '2024-11-16 00:30:42', 2, 'Absen Keluar', '2024-11-16 00:30:42', '2024-11-16 00:30:42'),
(13, '20241115231813', '20241116000200', '2024-11-16 00:31:04', 2, 'Absen Keluar', '2024-11-16 00:31:04', '2024-11-16 00:31:04'),
(14, '20241115231721', '20241116000249', '2024-11-16 00:33:52', 2, 'Absen Keluar', '2024-11-16 00:33:52', '2024-11-16 00:33:52'),
(17, '20241116090252', '20241116090305', '2024-11-16 09:03:05', 1, 'Absen Masuk', '2024-11-16 09:03:05', '2024-11-16 09:03:05'),
(18, '20241116090252', '20241116090305', '2024-11-16 09:03:19', 2, 'Absen Keluar', '2024-11-16 09:03:19', '2024-11-16 09:03:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departement`
--

CREATE TABLE `departement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_name` varchar(255) NOT NULL,
  `max_clock_in_time` time NOT NULL,
  `max_clock_out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departement`
--

INSERT INTO `departement` (`id`, `departement_name`, `max_clock_in_time`, `max_clock_out_time`) VALUES
(1, 'Fullstack Developer', '09:00:00', '17:00:00'),
(2, 'Marketing', '09:00:00', '17:00:00'),
(3, 'Manager IT', '09:00:00', '17:00:00'),
(4, 'Project Manager', '09:00:00', '17:00:00'),
(5, 'UI UX', '09:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `departement_id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, '20241115231721', 1, 'Mahmud', 'Tangerang Selatan', '2024-11-15 23:17:21', '2024-11-15 23:17:21'),
(2, '20241115231813', 1, 'Bagus Juliawan', 'Jakarta', '2024-11-15 23:18:13', '2024-11-15 23:18:13'),
(3, '20241115232130', 1, 'Ade Bagus', 'Jakarta', '2024-11-15 23:21:30', '2024-11-15 23:21:30'),
(6, '20241116090252', 3, 'dsa', 'sdd', '2024-11-16 09:02:52', '2024-11-16 09:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(41, '0001_01_01_000000_create_users_table', 1),
(42, '0001_01_01_000001_create_cache_table', 1),
(43, '0001_01_01_000002_create_jobs_table', 1),
(44, '2024_11_15_060549_create_departements_table', 1),
(45, '2024_11_15_062055_create_employees_table', 1),
(46, '2024_11_15_062350_create_attendances_table', 1),
(47, '2024_11_15_064141_create_attendance_history_table', 1),
(48, '2024_11_15_071700_fk_employee_departement', 1),
(49, '2024_11_15_072705_fk_attendance_employee', 1),
(50, '2024_11_15_073346_fk_attendancehistory_employee', 1),
(51, '2024_11_15_073506_fk_attendancehistory_attendance', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('J2xQGOuPC2wix8xqqZaxle9RjdNNtluKPirRG6Ey', NULL, '172.30.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3RyTGpRd0wxdUtPbEd0UFByR083RFVQZDBXNzRrQTdyQmdac2U1OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731722216),
('NRAV1bmt7rP9ksHaapMDxxWrmMs8RSfRDflmDYAS', NULL, '172.30.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjZMQ2J2VkpmM29LWVBCakg4d2xCMmtTZm5lbEZ4TW1taGJReHJqcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kZXBhcnRlbWVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731702844),
('tf1UkqUHiPSxNgDNECvkHwiGH9L02EcWEfTWCdLS', NULL, '172.30.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNEJOVWk3RlR3TUQycXNIQXhDaHV1VFFrRVFUTUZoQmt4RloxU0lINCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1731722601);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendance_attendance_id_unique` (`attendance_id`),
  ADD KEY `attendance_employee_id_foreign` (`employee_id`);

--
-- Indeks untuk tabel `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_history_employee_id_foreign` (`employee_id`),
  ADD KEY `attendance_history_attendance_id_foreign` (`attendance_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_employee_id_unique` (`employee_id`),
  ADD KEY `employee_departement_id_foreign` (`departement_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `attendance_history`
--
ALTER TABLE `attendance_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `departement`
--
ALTER TABLE `departement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD CONSTRAINT `attendance_history_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendance` (`attendance_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_history_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
