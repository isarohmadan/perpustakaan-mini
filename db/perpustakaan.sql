-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2024 pada 14.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id_buku` char(30) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `status` enum('available','unavailable','','') NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `path_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id_buku`, `judul`, `penulis`, `deskripsi`, `penerbit`, `id_genre`, `status`, `supplier`, `path_img`) VALUES
('3d38e439-48e8-4574-b77d-abab89', 'Psychology Of Money', 'Morgan Housel', 'Overall, The Psychology of Money is an insightful and thought-provoking book that offers a fresh perspective on a subject that affects us all. Whether you&#039;re struggling to manage your finances or simply looking for a better understanding of how money works, this book is definitely worth reading.', 'The Collaborative Fund', 272, 'available', 'The Collaborative Fund', '5cb04cbbb0_The-Psychology-of-Money-PDF-Book-By-Morgan-Housel.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `jenis_genre` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`id_genre`, `jenis_genre`, `description`) VALUES
(271, 'Action', 'Action adalah genre yang memadukan antara seni berperang dan seni senian'),
(272, 'Self-Help Book', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kode_pinjaman` char(60) NOT NULL,
  `id_user` char(40) NOT NULL,
  `id_buku` char(40) NOT NULL,
  `tanggal_pinjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`kode_pinjaman`, `id_user`, `id_buku`, `tanggal_pinjaman`) VALUES
('e1fcf740-92ba-4801-9cf0-671074d0a62d', 'b059bf1f-3fed-4a5c-b4a2-f0e0e77ec3fa', '3d38e439-48e8-4574-b77d-abab89', '2024-04-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` char(40) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  `level` enum('Admin','User') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `alamat`, `nomor`, `level`, `password`) VALUES
('b059bf1f-3fed-4a5c-b4a2-f0e0e77ec3fa', 'komang', 'komang@gmail.com', 'jalan kepundung', '08174763291', 'User', 'e10adc3949ba59abbe56e057f20f883e'),
('c636d247-aad3-409f-8262-a834247e6039', 'isaramadan24', 'isagaul1z22@gmail.com', 'jalan kepundung', '081293127812', 'Admin', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_genre_2` (`id_genre`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_pinjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `books` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
