-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Mei 2018 pada 09.46
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `user`, `email`, `password`, `foto`) VALUES
(1, 'Alfian Nurfallah', 'admin@optimize.id', '0192023a7bbd73250516f069df18b500', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `tahun_masuk` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `email`, `jenis_kelamin`, `agama`, `divisi`, `tahun_masuk`, `alamat`, `foto`, `status`) VALUES
(101001, 'Fatoni Arif', 'Lamongan', '1999-05-15', 'pino@gmail.com', 'Laki-Laki', 'Islam', 'Teknologi Informasi', '2014', 'Lamongan', '101001.jpg', 1),
(101002, 'Mundzir Masruri', 'Lamongan', '1988-01-01', 'mundzir@gmail.com', 'Laki-Laki', 'Islam', 'Keuangan', '2014', 'Lamongan', '101002.jpg', 2),
(101003, 'Abdul Ghofur', 'Gresik', '1990-04-15', 'abdul.g@yahoo.com', 'Laki-Laki', 'Islam', 'Pemasaran', '2014', 'Lamongan', '101003.jpg', 1),
(101004, 'Susi Indrawati', 'Lamongan', '1990-11-20', 'susi.indra99@yahoo.co.id', 'Perempuan', 'Islam', 'Produksi', '2014', 'Lamongan', '101004.jpg', 1),
(101005, 'Wati Jayanti', 'Kalimantan', '1990-10-11', 'w.jayanti@gmail.com', 'Perempuan', 'Islam', 'Pemasaran', '2014', 'Gresik', '101005.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `nip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101006;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
