-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2023 pada 03.06
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digiroom_cred`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `credentials`
--

CREATE TABLE `credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `satker` varchar(255) NOT NULL,
  `deleteable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `credentials`
--

INSERT INTO `credentials` (`id`, `username`, `password`, `nama`, `satker`, `deleteable`, `created_at`, `updated_at`) VALUES
(1, 'admin', '4dm1n!!!', 'admin', 'Pemerintah Kab. Ponorogo', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `credential_to_routes`
--

CREATE TABLE `credential_to_routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credential_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `credential_to_routes`
--

INSERT INTO `credential_to_routes` (`id`, `credential_id`, `route_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(2, 1, 2, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(3, 1, 3, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(4, 1, 4, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(5, 1, 5, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(6, 1, 6, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(7, 1, 7, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(8, 1, 8, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(9, 1, 9, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(10, 1, 10, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(11, 1, 11, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(12, 1, 12, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(13, 1, 13, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(14, 1, 14, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(15, 1, 15, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(16, 1, 16, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(17, 1, 17, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(18, 1, 18, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(19, 1, 19, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(20, 1, 20, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(21, 1, 21, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(22, 1, 22, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(23, 1, 23, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(24, 1, 24, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(25, 1, 25, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(26, 1, 26, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(27, 1, 27, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(28, 1, 28, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(29, 1, 29, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(30, 1, 30, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(31, 1, 31, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(32, 1, 32, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(33, 1, 33, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(34, 1, 34, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(35, 1, 35, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(36, 1, 36, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(37, 1, 37, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(38, 1, 38, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(39, 1, 39, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(40, 1, 40, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(41, 1, 41, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(42, 1, 42, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(43, 1, 43, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(44, 1, 44, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(45, 1, 45, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(46, 1, 46, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(47, 1, 47, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(48, 1, 48, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(49, 1, 49, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(50, 1, 50, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(51, 1, 51, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(52, 1, 52, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(53, 1, 53, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(54, 1, 54, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(55, 1, 55, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(56, 1, 56, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(57, 1, 57, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(58, 1, 58, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(59, 1, 59, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(60, 1, 60, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(61, 1, 61, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(62, 1, 62, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(63, 1, 63, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(64, 1, 64, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(65, 1, 65, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(66, 1, 66, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(67, 1, 67, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(68, 1, 68, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(69, 1, 69, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(70, 1, 70, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(71, 1, 71, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(72, 1, 72, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(73, 1, 73, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(74, 1, 74, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(75, 1, 75, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(76, 1, 76, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(77, 1, 77, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(78, 1, 78, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(79, 1, 79, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(80, 1, 80, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(81, 1, 81, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(82, 1, 82, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(83, 1, 83, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(84, 1, 84, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(85, 1, 85, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(86, 1, 86, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(87, 1, 87, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(88, 1, 88, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(89, 1, 89, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(90, 1, 90, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(91, 1, 91, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(92, 1, 92, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(93, 1, 93, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(94, 1, 94, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(95, 1, 95, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(96, 1, 96, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(97, 1, 97, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(98, 1, 98, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(99, 1, 99, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(100, 1, 100, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(101, 1, 101, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(102, 1, 102, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(103, 1, 103, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(104, 1, 104, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(105, 1, 105, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(106, 1, 106, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(107, 1, 107, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(108, 1, 108, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(109, 1, 109, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(110, 1, 110, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(111, 1, 111, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(112, 1, 112, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(113, 1, 113, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(114, 1, 114, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(115, 1, 115, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(116, 1, 116, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(117, 1, 117, '2023-11-14 19:59:20', '2023-11-14 19:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `routing_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `index` varchar(255) DEFAULT NULL,
  `deleteable` tinyint(1) NOT NULL DEFAULT 1,
  `viewonmenu` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `routing_group_id`, `name`, `index`, `deleteable`, `viewonmenu`, `created_at`, `updated_at`) VALUES
(1, 1, 'Credentials', 'credential.user.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(2, 1, 'Route Management', 'credential.route.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(3, 1, 'Route Management', 'credential.routing-group.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(4, 2, 'Kecamatan', 'operator.kecamatan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(5, 2, 'Desa', 'operator.desa.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(6, 3, 'Infrastruktur Jalan', 'operator.infrastruktur-jalan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(7, 3, 'Infrastruktur Jembatan', 'operator.infrastruktur-jembatan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(8, 3, 'Bulk Insert Jalan', 'operator.infrastruktur-jalan.bulkpage', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(9, 3, 'Bulk Insert Jembatan', 'operator.infrastruktur-jembatan.bulkpage', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(10, 4, 'Pariwisata', 'operator.wisata.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(11, 5, 'Sekolah', 'operator.sekolah.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(12, 5, 'Guru', 'operator.guru.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(13, 6, 'Anggaran', 'operator.anggaran.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(14, 7, 'Pasar', 'operator.pasar.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(15, 7, 'Komoditas Pasar', 'operator.komoditas-pasar.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(16, 8, 'Kelompok Tani', 'operator.kelompok-masyarakat-tani.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(17, 8, 'Komoditas', 'operator.komoditas.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(18, 9, 'Fasyankes', 'operator.kesehatan-fasyankes.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(19, 9, 'Poli', 'operator.kesehatan-poli.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(20, 9, 'Tenaga Kesehatan', 'operator.kesehatan-tenaga.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(21, 9, 'Bulk Insert Nakes', 'operator.kesehatan-tenaga.bulkpage', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(22, 10, 'Dashboard Jalan', 'edm.infrastruktur-jalan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(23, 10, 'Dashboard Jembatan', 'edm.infrastruktur-jembatan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(24, 11, 'Wisata', 'edm.wisata.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(25, 12, 'Pendidikan', 'edm.pendidikan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(26, 13, 'Anggaran', 'edm.anggaran.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(27, 14, 'Pasar', 'edm.pasar.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(28, 15, 'Pertanian', 'edm.pertanian.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(29, 16, 'Kesehatan', 'edm.kesehatan.index', 0, 1, '2023-11-14 19:59:20', '2023-11-14 19:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text NOT NULL,
  `deleteable` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `routes`
--

INSERT INTO `routes` (`id`, `menu_id`, `name`, `deleteable`, `created_at`, `updated_at`) VALUES
(1, 1, 'credential.user.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(2, 1, 'credential.user.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(3, 1, 'credential.user.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(4, 1, 'credential.user.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(5, 1, 'credential.user.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(6, 2, 'credential.route.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(7, 2, 'credential.route.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(8, 2, 'credential.route.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(9, 2, 'credential.route.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(10, 2, 'credential.route.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(11, 3, 'credential.routing-group.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(12, 3, 'credential.routing-group.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(13, 3, 'credential.routing-group.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(14, 3, 'credential.routing-group.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(15, 3, 'credential.routing-group.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(16, 4, 'operator.kecamatan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(17, 4, 'operator.kecamatan.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(18, 4, 'operator.kecamatan.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(19, 4, 'operator.kecamatan.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(20, 4, 'operator.kecamatan.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(21, 5, 'operator.desa.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(22, 5, 'operator.desa.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(23, 5, 'operator.desa.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(24, 5, 'operator.desa.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(25, 5, 'operator.desa.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(26, 6, 'operator.infrastruktur-jalan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(27, 6, 'operator.infrastruktur-jalan.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(28, 6, 'operator.infrastruktur-jalan.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(29, 6, 'operator.infrastruktur-jalan.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(30, 6, 'operator.infrastruktur-jalan.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(31, 7, 'operator.infrastruktur-jembatan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(32, 7, 'operator.infrastruktur-jembatan.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(33, 7, 'operator.infrastruktur-jembatan.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(34, 7, 'operator.infrastruktur-jembatan.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(35, 7, 'operator.infrastruktur-jembatan.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(36, 8, 'operator.infrastruktur-jalan.bulkpage', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(37, 8, 'operator.infrastruktur-jalan.bulkinsert', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(38, 8, 'operator.infrastruktur-jalan.bulkvalidate', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(39, 9, 'operator.infrastruktur-jembatan.bulkpage', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(40, 9, 'operator.infrastruktur-jembatan.bulkinsert', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(41, 9, 'operator.infrastruktur-jembatan.bulkvalidate', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(42, 10, 'operator.wisata.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(43, 10, 'operator.wisata.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(44, 10, 'operator.wisata.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(45, 10, 'operator.wisata.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(46, 10, 'operator.wisata.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(47, 11, 'operator.sekolah.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(48, 11, 'operator.sekolah.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(49, 11, 'operator.sekolah.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(50, 11, 'operator.sekolah.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(51, 11, 'operator.sekolah.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(52, 12, 'operator.guru.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(53, 12, 'operator.guru.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(54, 12, 'operator.guru.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(55, 12, 'operator.guru.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(56, 12, 'operator.guru.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(57, 13, 'operator.anggaran.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(58, 14, 'operator.pasar.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(59, 14, 'operator.pasar.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(60, 14, 'operator.pasar.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(61, 14, 'operator.pasar.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(62, 14, 'operator.pasar.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(63, 15, 'operator.komoditas-pasar.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(64, 15, 'operator.komoditas-pasar.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(65, 15, 'operator.komoditas-pasar.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(66, 15, 'operator.komoditas-pasar.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(67, 15, 'operator.komoditas-pasar.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(68, 16, 'operator.kelompok-masyarakat-tani.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(69, 16, 'operator.kelompok-masyarakat-tani.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(70, 16, 'operator.kelompok-masyarakat-tani.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(71, 16, 'operator.kelompok-masyarakat-tani.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(72, 16, 'operator.kelompok-masyarakat-tani.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(73, 17, 'operator.komoditas.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(74, 17, 'operator.komoditas.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(75, 17, 'operator.komoditas.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(76, 17, 'operator.komoditas.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(77, 17, 'operator.komoditas.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(78, 18, 'operator.kesehatan-fasyankes.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(79, 18, 'operator.kesehatan-fasyankes.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(80, 18, 'operator.kesehatan-fasyankes.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(81, 18, 'operator.kesehatan-fasyankes.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(82, 18, 'operator.kesehatan-fasyankes.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(83, 19, 'operator.kesehatan-poli.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(84, 19, 'operator.kesehatan-poli.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(85, 19, 'operator.kesehatan-poli.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(86, 19, 'operator.kesehatan-poli.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(87, 19, 'operator.kesehatan-poli.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(88, 20, 'operator.kesehatan-tenaga.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(89, 20, 'operator.kesehatan-tenaga.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(90, 20, 'operator.kesehatan-tenaga.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(91, 20, 'operator.kesehatan-tenaga.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(92, 20, 'operator.kesehatan-tenaga.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(93, 21, 'operator.kesehatan-tenaga.bulkpage', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(94, 21, 'operator.kesehatan-tenaga.bulkinsert', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(95, 21, 'operator.kesehatan-tenaga.bulkvalidate', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(96, 22, 'edm.infrastruktur-jalan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(97, 22, 'edm.infrastruktur-jalan.kondisi', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(98, 22, 'edm.infrastruktur-jalan.kecamatan', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(99, 22, 'edm.infrastruktur-jalan.desa', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(100, 23, 'edm.infrastruktur-jembatan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(101, 23, 'edm.infrastruktur-jembatan.kondisi', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(102, 23, 'edm.infrastruktur-jembatan.kecamatan', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(103, 23, 'edm.infrastruktur-jembatan.desa', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(104, 24, 'edm.wisata.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(105, 24, 'edm.wisata.detail', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(106, 25, 'edm.pendidikan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(107, 26, 'edm.anggaran.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(108, 27, 'edm.pasar.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(109, 28, 'edm.pertanian.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(110, 29, 'edm.kesehatan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(111, NULL, 'edm.kecamatan.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(112, NULL, 'edm.desa.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(113, NULL, 'operator.anggota-pokmas.index', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(114, NULL, 'operator.anggota-pokmas.store', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(115, NULL, 'operator.anggota-pokmas.edit', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(116, NULL, 'operator.anggota-pokmas.update', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(117, NULL, 'operator.anggota-pokmas.destroy', '0', '2023-11-14 19:59:20', '2023-11-14 19:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `routing_groups`
--

CREATE TABLE `routing_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleteable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `routing_groups`
--

INSERT INTO `routing_groups` (`id`, `name`, `deleteable`, `created_at`, `updated_at`) VALUES
(1, 'Konfigurasi Credentials', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(2, 'Master Data Kewilayahan', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(3, 'Master Data Infrastruktur', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(4, 'Master Data Pariwisata', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(5, 'Master Data Pendidikan', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(6, 'Master Data Anggaran', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(7, 'Master Data Pasar', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(8, 'Master Data Pertanian', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(9, 'Master Data Kesehatan', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(10, 'EDM: Infrastruktur', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(11, 'EDM: Pariwisata', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(12, 'EDM: Pendidikan', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(13, 'EDM: Anggaran', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(14, 'EDM: Pasar', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(15, 'EDM: Pertanian', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20'),
(16, 'EDM: Kesehatan', 0, '2023-11-14 19:59:20', '2023-11-14 19:59:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `credential_to_routes`
--
ALTER TABLE `credential_to_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credential_to_routes_credential_id_foreign` (`credential_id`),
  ADD KEY `credential_to_routes_route_id_foreign` (`route_id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `routing_groups`
--
ALTER TABLE `routing_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `credential_to_routes`
--
ALTER TABLE `credential_to_routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `routing_groups`
--
ALTER TABLE `routing_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `credential_to_routes`
--
ALTER TABLE `credential_to_routes`
  ADD CONSTRAINT `credential_to_routes_credential_id_foreign` FOREIGN KEY (`credential_id`) REFERENCES `credentials` (`id`),
  ADD CONSTRAINT `credential_to_routes_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
