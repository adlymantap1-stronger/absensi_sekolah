-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2026 at 09:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('hadir','sakit','izin','alpa') NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `date`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(2, 8, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(3, 9, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(4, 14, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(5, 11, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(6, 12, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(7, 13, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(8, 7, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL),
(9, 6, '2026-07-16', 'hadir', 6, '2026-07-15 21:10:36', '2026-07-15 21:10:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@gmail.com|127.0.0.1', 'i:1;', 1784184900),
('admin@gmail.com|127.0.0.1:timer', 'i:1784184900;', 1784184900);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `major_id` bigint UNSIGNED NOT NULL,
  `wali_kelas_id` bigint UNSIGNED DEFAULT NULL,
  `grade_level` enum('X','XI','XII','XIII') NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `major_id`, `wali_kelas_id`, `grade_level`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 6, 7, 'X', 'X LPB 1', '2026-07-14 20:36:10', '2026-07-14 20:36:14', NULL),
(7, 6, NULL, 'X', 'X LPB 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(8, 6, NULL, 'X', 'X LPB 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(9, 7, NULL, 'X', 'X DKV 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(10, 7, NULL, 'X', 'X DKV 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(11, 7, NULL, 'X', 'X DKV 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(12, 8, NULL, 'X', 'X SIJA 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(13, 8, NULL, 'X', 'X SIJA 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(14, 6, NULL, 'XI', 'XI LPB 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(15, 6, NULL, 'XI', 'XI LPB 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(16, 6, NULL, 'XI', 'XI LPB 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(17, 7, NULL, 'XI', 'XI DKV 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(18, 7, NULL, 'XI', 'XI DKV 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(19, 7, NULL, 'XI', 'XI DKV 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(20, 8, NULL, 'XI', 'XI SIJA 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(21, 8, NULL, 'XI', 'XI SIJA 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(22, 6, NULL, 'XII', 'XII LPB 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(23, 6, NULL, 'XII', 'XII LPB 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(24, 6, NULL, 'XII', 'XII LPB 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(25, 7, NULL, 'XII', 'XII DKV 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(26, 7, NULL, 'XII', 'XII DKV 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(27, 7, NULL, 'XII', 'XII DKV 3', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(28, 8, NULL, 'XII', 'XII SIJA 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(29, 8, NULL, 'XII', 'XII SIJA 2', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(30, 8, NULL, 'XIII', 'XIII SIJA 1', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Layanan Perbankan', 'LPB', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(7, 'Desain Komunikasi Visual', 'DKV', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(8, 'Sistem Informasi Jaringan dan Aplikasi', 'SIJA', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_12_071520_add_role_to_users_table', 1),
(5, '2026_07_12_072146_create_majors_table', 1),
(6, '2026_07_12_072150_create_class_rooms_table', 1),
(7, '2026_07_12_072202_create_students_table', 1),
(8, '2026_07_12_072244_create_attendances_table', 1),
(9, '2026_07_15_033255_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 6, 'test', '6903a1a9f8d35e1d302b7679c9a5c098b998bd368127ad89bc5234714e0eef80', '[\"*\"]', '2026-07-14 20:40:56', NULL, '2026-07-14 20:39:57', '2026-07-14 20:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DBCMYV2EKs0Wy8N47tRc0s3mWVm0vQOBE8OzF3TI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQklISTBveTAxN1RUejJTNXpkSmFyUTR4eWJtOGxwQ0d6RUFlVlQ2NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9hYnNlbnNpLXNla29sYWgudGVzdC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly9hYnNlbnNpLXNla29sYWgudGVzdC9kYXNoYm9hcmQiO319', 1784366097),
('NweKqKFpIoo5pNx926TWWISFJ8yigBU31eCkpPlB', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmU2MlVsbzNkV2hqbU5nc2tYTHM5d2Y3M245NmlSZTdvVnhMREFMcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9hYnNlbnNpLXNla29sYWgudGVzdC9hdHRlbmRhbmNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1784184893),
('Vtr5fCBzrICo6497LQ4PpYjQP1yB2o7qgcHig62A', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOU4yb0RvdTJnMkxyQ1hOQlA1QTJjVEx4M0RLdGxBM1UxdVBzY0FobiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9hYnNlbnNpLXNla29sYWgudGVzdC9zdHVkZW50cy8xMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1784185437);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `class_room_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `class_room_id`, `name`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 6, 'Yuni Wahyuni', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(7, 6, 'Sri Permata', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(8, 6, 'Budi Suci', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(9, 6, 'Dewi Saputra', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(10, 6, 'Andi Wulandari', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(11, 6, 'Eko Suci', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(12, 6, 'Putri Wulandari', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(13, 6, 'Rizki Salim', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(14, 6, 'Doni Gunawan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(15, 7, 'Yuni Ramadhan', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(16, 7, 'Nur Pratama', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(17, 7, 'Ratna Ramadhan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(18, 7, 'Wulan Astuti', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(19, 7, 'Yuni Lestari', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(20, 7, 'Hendra Gunawan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(21, 7, 'Lestari Pratama', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(22, 7, 'Agus Saputra', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(23, 8, 'Eko Sari', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(24, 8, 'Indah Sari', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(25, 8, 'Wulan Gunawan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(26, 8, 'Rizki Salim', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(27, 8, 'Dewi Ramadhan', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(28, 8, 'Indah Permata', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(29, 8, 'Rizki Gunawan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(30, 8, 'Agus Astuti', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(31, 8, 'Bayu Suci', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(32, 9, 'Ratna Ramadhan', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(33, 9, 'Eko Permata', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(34, 9, 'Rizki Aji', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(35, 9, 'Sri Setiawan', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(36, 9, 'Wulan Saputra', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(37, 9, 'Rizki Setiawan', 'P', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(38, 9, 'Fajar Sari', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(39, 9, 'Budi Aji', 'L', '2026-07-14 20:36:10', '2026-07-14 20:36:10', NULL),
(40, 9, 'Ratna Saputra', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(41, 9, 'Agus Santoso', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(42, 10, 'Indah Salim', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(43, 10, 'Yuni Salim', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(44, 10, 'Wulan Permata', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(45, 10, 'Hendra Suci', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(46, 10, 'Doni Wulandari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(47, 10, 'Dewi Lestari', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(48, 10, 'Dewi Santoso', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(49, 10, 'Agus Lestari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(50, 10, 'Sri Suci', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(51, 11, 'Hendra Lestari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(52, 11, 'Eko Permata', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(53, 11, 'Eko Salim', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(54, 11, 'Putri Aji', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(55, 11, 'Fajar Ramadhan', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(56, 11, 'Putri Lestari', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(57, 11, 'Lestari Gunawan', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(58, 11, 'Wulan Setiawan', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(59, 11, 'Ratna Sari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(60, 12, 'Doni Aji', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(61, 12, 'Ratna Astuti', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(62, 12, 'Budi Setiawan', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(63, 12, 'Doni Wahyuni', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(64, 12, 'Ahmad Pratama', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(65, 12, 'Budi Wulandari', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(66, 12, 'Dewi Sari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(67, 13, 'Eko Gunawan', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(68, 13, 'Sri Saputra', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(69, 13, 'Bayu Wahyuni', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(70, 13, 'Sri Santoso', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(71, 13, 'Agus Suci', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(72, 13, 'Yuni Santoso', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(73, 13, 'Agus Prasetyo', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(74, 13, 'Putri Santoso', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(75, 14, 'Putri Wulandari', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(76, 14, 'Nur Lestari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(77, 14, 'Bayu Saputra', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(78, 14, 'Yuni Wahyuni', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(79, 14, 'Rizki Salim', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(80, 14, 'Doni Suci', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(81, 14, 'Agus Aji', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(82, 15, 'Andi Gunawan', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(83, 15, 'Ahmad Prasetyo', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(84, 15, 'Putri Wulandari', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(85, 15, 'Siti Salim', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(86, 15, 'Andi Prasetyo', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(87, 15, 'Wulan Ramadhan', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(88, 15, 'Dewi Suci', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(89, 15, 'Sri Saputra', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(90, 15, 'Andi Sari', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(91, 16, 'Rizki Astuti', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(92, 16, 'Lestari Setiawan', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(93, 16, 'Dewi Saputra', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(94, 16, 'Lestari Prasetyo', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(95, 16, 'Yuni Astuti', 'L', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(96, 16, 'Budi Prasetyo', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(97, 16, 'Hendra Santoso', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(98, 16, 'Eko Santoso', 'P', '2026-07-14 20:36:11', '2026-07-14 20:36:11', NULL),
(99, 17, 'Agus Astuti', 'L', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(100, 17, 'Hendra Lestari', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(101, 17, 'Eko Salim', 'L', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(102, 17, 'Agus Wulandari', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(103, 17, 'Andi Ramadhan', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(104, 17, 'Andi Santoso', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(105, 17, 'Indah Permata', 'L', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(106, 18, 'Siti Ramadhan', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(107, 18, 'Fajar Astuti', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(108, 18, 'Ratna Gunawan', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(109, 18, 'Lestari Wahyuni', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(110, 18, 'Rizki Gunawan', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(111, 18, 'Nur Pratama', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(112, 18, 'Ratna Ramadhan', 'P', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(113, 18, 'Dewi Prasetyo', 'L', '2026-07-14 20:36:12', '2026-07-14 20:36:12', NULL),
(114, 19, 'Dewi Lestari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(115, 19, 'Siti Prasetyo', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(116, 19, 'Eko Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(117, 19, 'Doni Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(118, 19, 'Putri Santoso', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(119, 19, 'Eko Saputra', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(120, 19, 'Indah Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(121, 20, 'Hendra Suci', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(122, 20, 'Agus Prasetyo', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(123, 20, 'Ratna Ramadhan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(124, 20, 'Andi Salim', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(125, 20, 'Budi Setiawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(126, 20, 'Indah Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(127, 20, 'Doni Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(128, 20, 'Siti Prasetyo', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(129, 20, 'Putri Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(130, 20, 'Fajar Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(131, 21, 'Eko Saputra', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(132, 21, 'Yuni Gunawan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(133, 21, 'Yuni Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(134, 21, 'Doni Salim', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(135, 21, 'Putri Suci', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(136, 21, 'Ahmad Saputra', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(137, 21, 'Bayu Wulandari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(138, 21, 'Bayu Aji', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(139, 21, 'Nur Permata', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(140, 22, 'Fajar Santoso', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(141, 22, 'Sri Ramadhan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(142, 22, 'Doni Sari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(143, 22, 'Putri Astuti', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(144, 22, 'Eko Pratama', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(145, 22, 'Lestari Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(146, 22, 'Ratna Astuti', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(147, 22, 'Wulan Sari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(148, 22, 'Budi Ramadhan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(149, 23, 'Putri Salim', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(150, 23, 'Hendra Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(151, 23, 'Agus Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(152, 23, 'Rizki Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(153, 23, 'Eko Suci', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(154, 23, 'Nur Sari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(155, 23, 'Putri Saputra', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(156, 23, 'Doni Aji', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(157, 24, 'Hendra Sari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(158, 24, 'Eko Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(159, 24, 'Putri Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(160, 24, 'Budi Gunawan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(161, 24, 'Agus Lestari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(162, 24, 'Doni Aji', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(163, 25, 'Lestari Santoso', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(164, 25, 'Dewi Setiawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(165, 25, 'Agus Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(166, 25, 'Bayu Ramadhan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(167, 25, 'Fajar Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(168, 25, 'Rizki Wulandari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(169, 25, 'Ratna Lestari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(170, 25, 'Doni Wahyuni', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(171, 26, 'Eko Lestari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(172, 26, 'Eko Pratama', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(173, 26, 'Lestari Prasetyo', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(174, 26, 'Wulan Setiawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(175, 26, 'Ahmad Saputra', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(176, 26, 'Hendra Saputra', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(177, 26, 'Fajar Gunawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(178, 26, 'Bayu Santoso', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(179, 26, 'Bayu Lestari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(180, 26, 'Siti Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(181, 27, 'Sri Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(182, 27, 'Eko Permata', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(183, 27, 'Agus Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(184, 27, 'Budi Wulandari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(185, 27, 'Bayu Ramadhan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(186, 27, 'Hendra Santoso', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(187, 27, 'Bayu Prasetyo', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(188, 27, 'Putri Gunawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(189, 27, 'Doni Setiawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(190, 27, 'Bayu Permata', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(191, 28, 'Yuni Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(192, 28, 'Siti Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(193, 28, 'Wulan Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(194, 28, 'Hendra Saputra', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(195, 28, 'Fajar Setiawan', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(196, 28, 'Indah Saputra', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(197, 28, 'Rizki Santoso', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(198, 28, 'Hendra Lestari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(199, 29, 'Agus Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(200, 29, 'Eko Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(201, 29, 'Ahmad Pratama', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(202, 29, 'Indah Sari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(203, 29, 'Fajar Sari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(204, 29, 'Ahmad Permata', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(205, 29, 'Andi Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(206, 29, 'Doni Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(207, 29, 'Eko Astuti', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(208, 29, 'Fajar Lestari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(209, 30, 'Hendra Sari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(210, 30, 'Hendra Setiawan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(211, 30, 'Putri Wahyuni', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(212, 30, 'Agus Wulandari', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(213, 30, 'Hendra Salim', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(214, 30, 'Doni Astuti', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(215, 30, 'Lestari Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(216, 30, 'Dewi Ramadhan', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(217, 30, 'Wulan Suci', 'P', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL),
(218, 30, 'Ahmad Wulandari', 'L', '2026-07-14 20:36:13', '2026-07-14 20:36:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','wali_kelas') NOT NULL DEFAULT 'wali_kelas',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Admin Sekolah', 'admin@example.com', 'admin', '2026-07-14 20:36:13', '$2y$12$xs7MRX1AVG5Wv8lhN744i.ns7NCBDSPSZOh7yyFOE5ZbXBGtXFUOu', 'FxLkSST9ZWUP0eUak4JuYxAFr9pktsAhNgnqWh9EzbHNfXA53IR0kn4e19uk', '2026-07-14 20:36:14', '2026-07-14 20:36:14'),
(7, 'Budi Wali Kelas', 'walikelas@example.com', 'wali_kelas', '2026-07-14 20:36:14', '$2y$12$xs7MRX1AVG5Wv8lhN744i.ns7NCBDSPSZOh7yyFOE5ZbXBGtXFUOu', 'yOpMsasyGA', '2026-07-14 20:36:14', '2026-07-14 20:36:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_id_date_unique` (`student_id`,`date`),
  ADD KEY `attendances_created_by_foreign` (`created_by`);

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
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_rooms_major_id_foreign` (`major_id`),
  ADD KEY `class_rooms_wali_kelas_id_foreign` (`wali_kelas_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `majors_code_unique` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_class_room_id_foreign` (`class_room_id`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD CONSTRAINT `class_rooms_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_rooms_wali_kelas_id_foreign` FOREIGN KEY (`wali_kelas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
