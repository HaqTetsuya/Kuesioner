-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2025 pada 15.38
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuesioner`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_likert`
--

CREATE TABLE `jawaban_likert` (
  `id` int(11) NOT NULL,
  `responden_id` int(11) DEFAULT NULL,
  `pertanyaan_id` int(11) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_tekstual`
--

CREATE TABLE `jawaban_tekstual` (
  `id` int(11) NOT NULL,
  `responden_id` int(11) DEFAULT NULL,
  `pertanyaan_id` int(11) DEFAULT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL,
  `type` enum('likert','text') DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `type`, `pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 'likert', 'Chatbot mudah digunakan', '2025-05-16 12:47:42', NULL),
(2, 'likert', 'Saya tidak mengalami kesulitan saat berinteraksi dengan chatbot', '2025-05-16 12:48:10', NULL),
(3, 'likert', 'Chatbot memahami pertanyaan saya dengan baik dan tepat.', '2025-05-16 12:57:04', '2025-05-16 13:44:23'),
(4, 'likert', '	Chatbot tetap dapat menjawab meskipun saya salah ketik / typo.', '2025-05-16 13:06:52', '2025-05-16 13:44:40'),
(5, 'likert', 'Chatbot bisa memahami pertanyaan dengan bahasa yang berbeda-beda (misalnya bahasa formal/santai).', '2025-05-16 13:08:21', '2025-05-16 13:57:04'),
(6, 'likert', 'Chatbot bisa menangkap maksud saya walau pertanyaannya tidak jelas.', '2025-05-16 13:08:47', '2025-05-16 13:57:23'),
(7, 'likert', 'Chatbot bisa membedakan jenis pertanyaan (misal: permintaan informasi, waktu buka, dsb).', '2025-05-16 13:14:04', '2025-05-16 13:58:03'),
(8, 'likert', 'Saya merasa puas dengan keakuratan jawaban', '2025-05-16 13:14:53', NULL),
(9, 'likert', 'Jawaban yang diberikan oleh chatbot relevan dengan pertanyaan saya.', '2025-05-16 13:58:49', NULL),
(10, 'likert', 'Jawaban chatbot mudah dipahami oleh saya sebagai pengguna umum.', '2025-05-16 13:59:08', NULL),
(11, 'likert', 'Chatbot membantu saya mendapat informasi tentang layanan perpustakaan.', '2025-05-16 14:42:38', '2025-05-16 14:50:09'),
(12, 'likert', 'Respon chatbot cepat dan tidak membuat saya menunggu lama.', '2025-05-16 14:48:07', NULL),
(13, 'likert', '	Chatbot membantu saya mencari buku atau informasi koleksi.', '2025-05-16 14:50:31', NULL),
(14, 'likert', 'Tampilan chatbot menarik dan mudah dipahami.', '2025-05-16 14:50:58', NULL),
(15, 'likert', 'Saya merasa nyaman menggunakan chatbot meskipun pertama kali.', '2025-05-16 15:09:53', NULL),
(16, 'likert', 'Desain tema chatbot cocok untuk dan relavan untuk perpustakaan', '2025-05-16 15:10:35', NULL),
(17, 'likert', '	Saya merasa puas menggunakan chatbot ini secara keseluruhan.', '2025-05-16 15:11:03', NULL),
(18, 'likert', 'Saya akan menggunakan chatbot ini lagi jika diperlukan.', '2025-05-16 15:11:22', NULL),
(19, 'likert', 'Saya akan merekomendasikan chatbot ini kepada orang lain.', '2025-05-16 15:11:42', NULL),
(20, 'likert', 'Saya merasa chatbot ini adalah contoh baik dari digitalisasi layanan informasi perpustakaan.', '2025-05-16 15:12:12', NULL),
(21, 'text', 'Menurut Anda, apa kelebihan dari chatbot ini?', '2025-05-16 15:17:50', '2025-05-16 15:33:17'),
(22, 'text', 'Apa kekurangan yang Anda temui saat menggunakan chatbot ini?', '2025-05-16 15:33:55', NULL),
(23, 'text', 'Apakah ada tambahan intent atau topik pertanyaan chatbot yang menurut Anda perlu ditambahkan?', '2025-05-16 15:35:02', '2025-05-16 15:35:39'),
(24, 'likert', 'Apakah ada fitur lain selain cari buku yang menurut Anda perlu ditambahkan?', '2025-05-16 15:36:01', '2025-05-16 15:36:17'),
(25, 'likert', 'Menurut Anda, apa peran chatbot dalam mendukung layanan perpustakaan secara digital?', '2025-05-16 15:38:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `responden`
--

CREATE TABLE `responden` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Elise Watson', 'elisewasoson341@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jawaban_likert`
--
ALTER TABLE `jawaban_likert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_likert_ibfk_1` (`responden_id`),
  ADD KEY `jawaban_likert_ibfk_2` (`pertanyaan_id`);

--
-- Indeks untuk tabel `jawaban_tekstual`
--
ALTER TABLE `jawaban_tekstual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_tekstual_ibfk_1` (`responden_id`),
  ADD KEY `jawaban_tekstual_ibfk_2` (`pertanyaan_id`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`nama`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jawaban_likert`
--
ALTER TABLE `jawaban_likert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_tekstual`
--
ALTER TABLE `jawaban_tekstual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `responden`
--
ALTER TABLE `responden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jawaban_likert`
--
ALTER TABLE `jawaban_likert`
  ADD CONSTRAINT `jawaban_likert_ibfk_1` FOREIGN KEY (`responden_id`) REFERENCES `responden` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_likert_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_tekstual`
--
ALTER TABLE `jawaban_tekstual`
  ADD CONSTRAINT `jawaban_tekstual_ibfk_1` FOREIGN KEY (`responden_id`) REFERENCES `responden` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_tekstual_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD CONSTRAINT `rfdfbdfbdb` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
