-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 10:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-image-post.svg',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `image`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Tes Post Update Pengumuman 4', '<div>tes update pengumuman lagi</div>', 'default-image-post.svg', 1, '2022-06-20 14:19:28', '2022-06-22 20:04:28'),
(2, 'Tes Post 2', 'Tes bikin pengumuman 2', 'default-image-post.svg', 1, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(3, 'Tes Post 3', 'Tes bikin pengumuman 3', 'default-image-post.svg', 1, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(6, 'Test Post 4', '<div>Ini adalah pengumuman sekolah terbaru</div>', '1655884039.png', 1, '2022-06-22 07:47:19', '2022-06-22 07:47:19'),
(7, 'Test Post 5', '<div>Silahkan</div>', '1655885576.png', 1, '2022-06-22 08:12:56', '2022-06-22 08:12:56'),
(8, 'Test Post 6', '<div>Berhasil</div>', '1655885686.jpeg', 1, '2022-06-22 08:14:46', '2022-06-22 08:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `present_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `st` enum('a','h') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `schedule_id`, `siswa_id`, `present_at`, `st`, `created_at`, `updated_at`) VALUES
(1, 3, 4, '2022-06-22 07:48:17', 'a', NULL, NULL),
(2, 5, 4, '2022-06-22 08:31:58', 'h', NULL, NULL),
(3, 7, 4, '2022-06-22 08:36:12', 'h', NULL, NULL),
(4, 6, 4, '2022-06-22 08:42:55', 'h', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `nama_course`, `room_id`, `description`, `guru_id`, `created_at`, `updated_at`) VALUES
(1, 'MTK', 3, 'Sama', 3, '2022-06-20 14:56:22', '2022-06-22 07:27:14'),
(3, 'PBO', 2, 'Matakuliah PBO', 3, '2022-06-22 07:26:50', '2022-06-22 07:26:50'),
(4, 'Aljali', 3, 'Aljali', 3, '2022-06-22 07:52:41', '2022-06-22 07:52:41'),
(5, 'PSW', 2, 'PSW', 3, '2022-06-22 07:53:00', '2022-06-22 07:53:00'),
(6, 'DASPRO', 3, 'DASPRO', 3, '2022-06-22 07:53:18', '2022-06-22 07:53:18'),
(7, 'DASPRO', 11, 'DASPRO', 3, '2022-06-22 08:21:57', '2022-06-22 08:49:07'),
(8, 'Aljali', 5, 'Aljali', 3, '2022-06-22 08:22:13', '2022-06-22 08:49:14'),
(9, 'PKM', 5, 'PKM', 3, '2022-06-22 08:26:06', '2022-06-22 08:49:21'),
(10, 'SBK', 4, 'SBK', 3, '2022-06-22 08:26:32', '2022-06-22 08:49:29'),
(11, 'Aljali', 12, 'Aljali', 3, '2022-06-22 08:26:55', '2022-06-22 08:49:36'),
(12, 'DASPRO', 15, 'DASPRO', 3, '2022-06-22 08:27:09', '2022-06-22 08:50:34'),
(13, 'B,.ING', 1, 'B.ING', 3, '2022-06-22 08:50:14', '2022-06-22 08:50:14');

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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'login',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `class_id`, `action`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'login', '2022-06-20 14:22:56', '2022-06-20 14:22:56'),
(2, 5, 2, 'login', '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(3, 6, 3, 'login', '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(4, 7, 1, 'login', '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(7, 4, 0, 'login', '2022-06-21 06:42:09', '2022-06-21 06:42:09'),
(8, 4, 3, 'login', '2022-06-22 16:44:04', '2022-06-22 16:44:04'),
(9, 3, 0, 'login', '2022-06-22 16:45:33', '2022-06-22 16:45:33'),
(10, 6, 3, 'login', '2022-06-22 16:46:31', '2022-06-22 16:46:31'),
(11, 5, 2, 'login', '2022-06-22 16:49:07', '2022-06-22 16:49:07'),
(12, 4, 3, 'login', '2022-06-22 17:49:06', '2022-06-22 17:49:06');

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
(1, '2021_07_13_110616_create_akademik_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `task_id`, `siswa_id`, `file`, `uploaded_at`) VALUES
(1, 2, 4, 'progress/Z6cXbNKUWMRClg3HdnqIIs4ajQLJ6wh2DVfo6EUz.docx', '2022-06-22 07:44:50'),
(2, 4, 4, 'progress/j5CnnjyUeXSPogEVmVOgJ9yBjoAKfoq2lfw2ZfkI.docx', '2022-06-22 08:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `raport`
--

CREATE TABLE `raport` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courses_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kehadiran` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tugas` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uts` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uas` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kkm` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_akhir` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raport`
--

INSERT INTO `raport` (`id`, `courses_id`, `siswa_id`, `kehadiran`, `tugas`, `uts`, `uas`, `kkm`, `nilai_akhir`, `created_at`) VALUES
(11, 3, 4, 'P', '91', '92', '93', '60', '95', '2022-06-22 19:49:36'),
(14, 5, 4, 'P', '90', '90', '90', '50', '90', '2022-06-22 08:40:08'),
(15, 6, 4, 'P', '90', '90', '90', '50', '90', '2022-06-22 08:40:28'),
(16, 1, 5, 'A', '90', '90', '90', '50', '90', '2022-06-22 08:42:02'),
(17, 13, 4, 'P', '90', '90', '90', '50', '90', '2022-06-22 08:51:21'),
(18, 4, 4, 'P', '80', '90', '93', '75', '95', '2022-06-22 19:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tingkat_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `tingkat_kelas`, `jurusan`, `no_kelas`, `nama_kelas`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 'X', 'IPA', '1', 'X IPA 1', 2022, '2022-06-20 14:19:27', '2022-06-22 08:15:54'),
(2, 'X', 'IPA', '2', 'X IPA 2', 2022, '2022-06-20 14:19:27', '2022-06-22 08:17:44'),
(3, 'X', 'IPA', '3', 'X IPA 3', 2022, '2022-06-20 14:19:27', '2022-06-22 08:17:52'),
(4, 'XI', 'IPA', '1', 'XI IPA 1', 2022, '2022-06-22 07:28:06', '2022-06-22 08:18:16'),
(5, 'XI', 'IPA', '2', 'XI IPA 2', 2022, '2022-06-22 08:15:40', '2022-06-22 08:18:08'),
(6, 'XI', 'IPA', '3', 'XI IPA 3', 2022, '2022-06-22 08:16:29', '2022-06-22 08:18:26'),
(7, 'XII', 'IPA', '1', 'XII IPA 1', 2022, '2022-06-22 08:17:02', '2022-06-22 08:18:54'),
(8, 'XII', 'IPA', '2', 'XII IPA 2', 2022, '2022-06-22 08:18:45', '2022-06-22 08:18:45'),
(9, 'XII', 'IPA', '3', 'XII IPA 3', 2022, '2022-06-22 08:19:05', '2022-06-22 08:19:05'),
(10, 'X', 'IPS', '1', 'X IPS 1', 2022, '2022-06-22 08:19:28', '2022-06-22 08:19:28'),
(11, 'X', 'IPS', '2', 'X IPS 2', 2022, '2022-06-22 08:19:37', '2022-06-22 08:19:37'),
(12, 'X', 'IPS', '3', 'X IPS 3', 2022, '2022-06-22 08:19:48', '2022-06-22 08:19:48'),
(13, 'X', 'IPS', '3', 'X IPS 3', 2022, '2022-06-22 08:20:12', '2022-06-22 08:20:12'),
(14, 'XI', 'IPS', '1', 'XI IPS 1', 2022, '2022-06-22 08:20:28', '2022-06-22 08:20:28'),
(15, 'XI', 'IPS', '2', 'XI IPS 2', 2022, '2022-06-22 08:20:40', '2022-06-22 08:20:40'),
(16, 'XI', 'IPS', '3', 'XI IPS 3', 2022, '2022-06-22 08:20:50', '2022-06-22 08:20:50'),
(17, 'XII', 'IPS', '1', 'XII IPS 1', 2022, '2022-06-22 08:21:04', '2022-06-22 08:21:04'),
(18, 'XII', 'IPS', '3', 'XII IPS 3', 2022, '2022-06-22 08:21:18', '2022-06-22 08:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `course_id`, `class_id`, `start_at`, `end_at`, `url`, `created_at`, `updated_at`) VALUES
(2, 3, 4, '2022-06-30 05:00:00', '2022-06-30 08:00:00', 'https://www.google.com', '2022-06-22 07:37:32', '2022-06-22 07:37:32'),
(6, 3, 3, '2022-06-23 05:00:00', '2022-06-23 07:00:00', 'https://www.google.com', '2022-06-22 08:34:45', '2022-06-22 08:34:45'),
(7, 3, 3, '2022-06-13 05:00:00', '2022-06-13 07:00:00', 'https://www.google.com', '2022-06-22 08:35:15', '2022-06-22 08:35:15'),
(8, 1, 1, '2022-06-22 05:00:00', '2022-06-22 08:00:00', 'contoh https://www.google.com', '2022-06-22 14:57:44', '2022-06-22 14:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `schedule_id`, `title`, `description`, `file`, `due_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pkpl', 'Y', 'progress/28RtjfaNL7fbDdU2Z701hJV4ug8ME1yox7vQIHER.pptx', '2022-06-22 07:49:00', '2022-06-20 15:09:25', '2022-06-22 07:49:00'),
(2, 3, 'Tugas Merancang', 'Silahkan Di Kerjakan Sebaik Mungkin', 'progress/NsHaZspEWPt7g9hhn8exq2vqWQKnu2fBi9xt7nRi.docx', '2022-06-22 08:43:09', '2022-06-22 07:39:59', '2022-06-22 08:43:09'),
(3, 4, 'Pembukuan', 'Silahkan Diselesaikan', 'task/qeKtcbwXlAE5DR6DJhH3qZRBkzyLN3MLgt5ZB71O.docx', '2022-06-28 17:00:00', '2022-06-22 08:29:17', '2022-06-22 08:31:32'),
(4, 7, 'Sdd', 'Sdd', 'task/Mcr3LXFwerOiw9Ut88b4izwj2FWs7992Wj2cqE6F.doc', '2022-06-30 05:00:00', '2022-06-22 08:35:43', '2022-06-22 08:35:43'),
(5, 8, 'Tugas Terbaru', 'Silahkan Di Submit Tepat Waktu', 'task/1NFcUQAXvxmpFT0ps9NyIpjCn4llwphNapcpdKWW.docx', '2022-06-30 05:00:00', '2022-06-22 15:14:44', '2022-06-22 15:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` enum('l','p') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('a','g','s') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nisn`, `nip`, `phone`, `email`, `name`, `place_birth`, `date_birth`, `religion`, `email_verified_at`, `password`, `address`, `photo`, `class_id`, `gender`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '0', 'admin@gmail.com', 'Administrator', NULL, NULL, NULL, '2022-06-20 14:19:27', '$2y$10$xgShSq0Ln4SIJjm3fyY3dOFWmHLVLd/ta/zo8lBozAS3k9EmlxXay', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(2, NULL, NULL, '089512345678', 'admin2@gmail.com', 'Administrator 2', NULL, NULL, NULL, '2022-06-20 14:19:27', '$2y$10$0pOKNWBFUHNpl7omxzdIy.czonN1ZpL0XUqJYLRAKJfdw.rrEI2zm', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(3, NULL, NULL, '081234567890', 'guru@gmail.com', 'Guru', NULL, NULL, NULL, '2022-06-20 14:19:28', '$2y$10$uuHfCzVYIqmswXPsUjvDmuI0ZJQJYweh5FpPX28TSLktRZzwqdhaO', NULL, NULL, NULL, NULL, 'g', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(4, NULL, NULL, '089876543210', 'juwita@gmail.com', 'juwita', NULL, NULL, NULL, '2022-06-20 14:19:28', '$2y$10$yy5ILbEv.RyWVzESGFeGduuxmLMaOgQ24HGfREoZvyV0siqwx8UuG', NULL, NULL, 3, NULL, 's', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(5, NULL, NULL, '089876543211', 'samto@gmail.com', 'samto', NULL, NULL, NULL, '2022-06-20 14:19:28', '$2y$10$SjfGZFkUxOGF4Bjk9vc4n.YrM3wJD1UYvmC4Ygz.oCvdP6I7Ul47K', NULL, NULL, 2, NULL, 's', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(6, NULL, NULL, '089876543212', 'dwi@gmail.com', 'dwi', NULL, NULL, NULL, '2022-06-20 14:19:28', '$2y$10$qk7dcIuPypWmHCdWs9WlUuwpEmrfGtMyuKY68Id5e4AgdVpVMaXKC', NULL, NULL, 3, NULL, 's', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(7, NULL, NULL, '089876543213', 'sofia@gmail.com', 'sofia', NULL, NULL, NULL, '2022-06-20 14:19:28', '$2y$10$0J0B6XwIE4loPIAGt2HMie4QCi64KetKqvfO/5D.hgJxgbRAkf3Oa', NULL, NULL, 1, NULL, 's', NULL, '2022-06-20 14:19:28', '2022-06-20 14:19:28'),
(12, NULL, '1985051920100012039', '087652434', 'Guru2@gmail.com', 'Guru 2', 'Simpang limun', '1989-06-21', 'islam', NULL, '$2y$10$icZgXeYrIjgw3/CADzaVJeFDxFDcb06eo.jdx8UVXqdyccNZU02Am', 'Bandung', NULL, NULL, 'p', 'g', NULL, '2022-06-22 07:54:17', '2022-06-22 07:54:17'),
(13, NULL, '19850519201000120386', '098764247654', 'Guru3@gmail.com', 'Guru3', 'Simpang sigura gura', '1988-05-18', 'protestan', NULL, '$2y$10$.9XzPBwkZQmdxaCtik3guumedAbO.EdVPsDjhaYRiPj347xDS4TCC', 'Medan', NULL, NULL, 'p', 'g', NULL, '2022-06-22 07:55:21', '2022-06-22 07:55:21'),
(14, NULL, '1985051920100012', '0987654321', 'guru4@gmail.com', 'Ibu Sondang', 'Selatan', '1987-08-19', 'hindu', NULL, '$2y$10$FsVzTIA9p/B5CM2eytXnC.0d2hyICjXUhrI/0WqkINfT4j7OMdRzG', 'Jakarta timur', NULL, NULL, 'p', 'g', NULL, '2022-06-22 07:56:49', '2022-06-22 07:56:49'),
(15, NULL, '19850519201000', '09876543210', 'guru5@gmail.com', 'Herdianto Siregar', 'Bandung', '1890-06-13', 'islam', NULL, '$2y$10$ry9xcjIkYOWQ4ZAglQh4oOdgfXyujTl3TvAB9CDC/eKaL0pOu2aWe', 'Jakarta pusat', NULL, NULL, 'l', 'g', NULL, '2022-06-22 07:58:26', '2022-06-22 07:58:26'),
(16, NULL, NULL, '088888976434', 'Admin3@gmail.com', 'Admin3', NULL, NULL, NULL, NULL, '$2y$10$yEY2VjnDZat/wzqEjTg7sePq/9Eyf/A20eKLUa4v6c8/AHyCiD1ry', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 07:59:22', '2022-06-22 07:59:22'),
(17, NULL, NULL, '09825353322', 'admin5@gmail.com', 'Admin5', NULL, NULL, NULL, NULL, '$2y$10$T86/ZEO.GNnnZa8wT00d9eN5SOCj9zxXmyO7R/AQHSWwvc9W35RmO', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 07:59:49', '2022-06-22 07:59:49'),
(18, NULL, NULL, '0997334566433', 'admin6@gmail.com', 'Admin 6', NULL, NULL, NULL, NULL, '$2y$10$YjWB5M1rj7CtEI1FPweyJuG2I/ontGoN/VbZRtzuziXRKNumkSMnK', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:00:30', '2022-06-22 08:00:30'),
(19, NULL, NULL, '09873635343', 'admin7@gmail.com', 'Admin7', NULL, NULL, NULL, NULL, '$2y$10$IQukavlqwfJ.9yVXwAxhaecn1PX9ZiYPBPmsLjWg1gGXvVYB9kltS', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:01:05', '2022-06-22 08:01:05'),
(20, NULL, NULL, '09877645653', 'admin8@gmail.com', 'Admin 8', NULL, NULL, NULL, NULL, '$2y$10$PmbbD8X/FpA58UbU1odnkOr2c/zZHcIALmZO3RJua7FbESnchOje.', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:01:35', '2022-06-22 08:01:35'),
(21, NULL, NULL, '09988264422', 'amin4@gmail.com', 'Admin 4', NULL, NULL, NULL, NULL, '$2y$10$Z3g6hLcuHCnXI.NLBRGyZejIBKVXZImsN0MaMWdvdh39kQjfOAhMy', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:02:15', '2022-06-22 08:02:15'),
(22, NULL, NULL, '09887765333', 'admin9@gmail.com', 'Admin 9', NULL, NULL, NULL, NULL, '$2y$10$lY2aO.B2BrMZn47XtfL/0.Ivl.U708TA.6mOI.6zWLX1oqugVvlDC', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:02:53', '2022-06-22 08:02:53'),
(23, NULL, NULL, '2129877625411', 'admin10@gmail.com', 'Admin10', NULL, NULL, NULL, NULL, '$2y$10$3ymhiwCULT8NLeGiEBeOn.EJsYjyXU.2iqr9Xz5LQPvOLHMCDGiFq', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:03:16', '2022-06-22 08:03:16'),
(24, NULL, NULL, '098776652442', 'admin11@gmail.com', 'Admin11', NULL, NULL, NULL, NULL, '$2y$10$MDzTi5ofl7dII71HHIappe8uCCM5Wkg/6YeKhusAmNpnxctObc93e', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:03:42', '2022-06-22 08:03:42'),
(25, NULL, NULL, '0997662542424', 'admin12@gmail.com', 'Admin12', NULL, NULL, NULL, NULL, '$2y$10$6fCC8Z0Wva/mJWoS..iTNOdzEDHK5L.hrij7LmqRQnSDmopI2VkIG', NULL, NULL, NULL, NULL, 'a', NULL, '2022-06-22 08:04:16', '2022-06-22 08:04:16'),
(26, NULL, '198505192010001', '098872625422', 'guru7@gmail.com', 'Garuda', 'Simpang 7', '1789-06-17', 'hindu', NULL, '$2y$10$22cfSm6vjlnFFtMJYjrngOjr3.4NodrQ3Ekuk84JYYmzFt9QnJ56.', 'Amsterdam', NULL, NULL, 'l', 'g', NULL, '2022-06-22 08:07:04', '2022-06-22 08:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raport`
--
ALTER TABLE `raport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raport`
--
ALTER TABLE `raport`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
