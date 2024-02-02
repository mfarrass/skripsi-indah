-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2024 pada 17.30
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmeans`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_prov`
--

CREATE TABLE `data_prov` (
  `id_prov` int(11) NOT NULL,
  `nama_kk` varchar(50) NOT NULL,
  `tahun_2019` int(11) NOT NULL,
  `tahun_2020` int(11) NOT NULL,
  `tahun_2021` int(11) NOT NULL,
  `tahun_2022` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_prov`
--

INSERT INTO `data_prov` (`id_prov`, `nama_kk`, `tahun_2019`, `tahun_2020`, `tahun_2021`, `tahun_2022`) VALUES
(1, 'Imam Suherman', 1, 2, 4, 1),
(2, 'Widiarto', 2, 3, 3, 2),
(3, 'Ahmad Saifudin', 2, 3, 2, 2),
(4, 'Trisno', 3, 4, 5, 3),
(5, 'Karto Prianggono', 4, 4, 4, 4),
(9, 'Sukeri', 3, 2, 4, 4),
(10, 'M Yusuf', 3, 4, 2, 4),
(11, 'Irwan Fadil', 2, 2, 3, 2),
(12, 'Wawan', 3, 3, 1, 3),
(13, 'Yusuf Maliki', 4, 4, 2, 3),
(14, 'Iwan', 1, 3, 3, 1),
(15, 'Rahmat', 1, 3, 2, 2),
(16, 'Saman', 2, 2, 3, 3),
(17, 'Yanto Darmo', 2, 3, 2, 2),
(18, 'Dhamar Cahyadi', 3, 3, 3, 3),
(19, 'Umar', 2, 2, 4, 4),
(20, 'Eko Supriyadi', 2, 3, 3, 4),
(21, 'Surya M', 4, 4, 2, 4),
(22, 'Wahyu', 3, 3, 1, 3),
(23, 'Joko Suryadi', 3, 4, 3, 4),
(24, 'Dani Irwan', 1, 2, 3, 1),
(25, 'Helmi', 2, 2, 3, 2),
(26, 'Suparjo', 3, 3, 3, 2),
(27, 'Ilham Zulfikar', 2, 3, 4, 2),
(28, 'Firman', 3, 3, 4, 3),
(30, 'RIDWAN', 1, 2, 4, 1),
(31, 'SLAMET', 2, 3, 3, 2),
(32, 'CUPRAY', 3, 4, 5, 3),
(33, 'RAKUN', 2, 3, 2, 2),
(34, 'SAPTO', 4, 4, 4, 4),
(35, 'IBNU', 3, 2, 4, 4),
(36, 'NENENG', 3, 4, 2, 4),
(37, 'OPIK', 2, 2, 3, 2),
(38, 'IRFAN', 3, 3, 1, 3),
(39, 'ROZAK', 4, 4, 2, 3),
(40, 'PUTRA', 1, 3, 3, 1),
(41, 'ADAM', 1, 3, 2, 2),
(42, 'GARAY', 2, 2, 3, 3),
(43, 'INDRA', 2, 3, 2, 2),
(44, 'MAMAT', 3, 3, 3, 3),
(45, 'CIMET', 2, 2, 4, 4),
(46, 'LUKMAN', 2, 3, 3, 4),
(47, 'HENDI', 4, 4, 2, 4),
(48, 'SUBADI', 3, 3, 1, 3),
(49, 'RUBEN ADI', 3, 4, 3, 4),
(50, 'ERI SUBARI', 1, 2, 3, 1),
(51, 'HENDRA', 2, 2, 3, 2),
(52, 'TEGUH', 3, 3, 3, 2),
(53, 'GITO', 2, 3, 4, 2),
(54, 'FERY', 3, 3, 4, 3),
(55, 'Bayu', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_lok`
--

CREATE TABLE `dt_lok` (
  `id_lok` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `longit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_lok`
--

INSERT INTO `dt_lok` (`id_lok`, `id_prov`, `alamat`, `lat`, `longit`) VALUES
(2, 1, 'Jl. Raya Tj. Barat No.12, RW.8, Pasar Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', '-6.2927783', '106.8418622'),
(3, 2, 'Jl. Raya Tj. Barat No.17A, RW.8, Pejaten Tim., Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', '-6.2907243', '106.8416105'),
(4, 3, 'Gg. Langgar 1 No.20, RT.11/RW.2, Pejaten Tim., Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', '-6.2894556', '106.8437339'),
(5, 4, 'Jl. Swadaya 1 11-3, RT.11/RW.10, Pejaten Tim., Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', '-6.288953', '106.8462608'),
(6, 5, 'Jl. Swadaya IA/VI, RT.13/RW.9, Pejaten Tim., Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', '-6.2897841', '106.8469451'),
(7, 9, 'Jl. M. Khafi No.107, RT.3/RW.4, Jagakarsa, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12620', '-6.3219513', '106.8060213'),
(8, 10, 'Gg. Indah 2 Blok Swanas I No.47, RT.5/RW.7, Jagakarsa, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12620', '-6.3330599', '106.8196038'),
(9, 11, 'Jl. Langgar 48, RT.4/RW.3, Jagakarsa, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550', '-6.3225126', '106.8228714'),
(11, 12, 'Gg. H. Naiman 6, RT.6/RW.6, Kebagusan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520', '-6.3123286', '106.8303933'),
(12, 13, 'Jl. Sonton, RT.3/RW.2, Lenteng Agung, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta', '-6.3177962', '106.8398284');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_prov`
--
ALTER TABLE `data_prov`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indeks untuk tabel `dt_lok`
--
ALTER TABLE `dt_lok`
  ADD PRIMARY KEY (`id_lok`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_prov`
--
ALTER TABLE `data_prov`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `dt_lok`
--
ALTER TABLE `dt_lok`
  MODIFY `id_lok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
