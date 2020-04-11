-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Apr 2019 pada 09.16
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-filing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `level` varchar(20) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `nama`, `username`, `password`, `level`, `kategori`) VALUES
(1, 'Admin UP2TI', 'admin_up2ti', '21232f297a57a5a743894a0e4a801fc3', 'admin', 8),
(2, 'Admin Informatika', 'admin_informatika', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 6),
(3, 'Admin Biologi', 'admin_biologi', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 4),
(4, 'Admin Fakultas', 'admin_fakultas', '21232f297a57a5a743894a0e4a801fc3', 'admin_fakultas', 7),
(5, 'Admin Statistika', 'admin_statistika', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 5),
(6, 'Admin Matematika', 'admin_matematika', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 1),
(7, 'Admin Kimia', 'admin_kimia', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 3),
(8, 'Admin Fisika', 'admin_fisika', '21232f297a57a5a743894a0e4a801fc3', 'departemen', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_dep` int(11) NOT NULL,
  `departemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_dep`, `departemen`) VALUES
(1, 'Matematika'),
(2, 'Fisika'),
(3, 'Kimia'),
(4, 'Biologi'),
(5, 'Statistika'),
(6, 'Ilmu Komputer/Informatika'),
(7, 'Admin Fakultas'),
(8, 'Admin UP2TI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_nsk`
--

CREATE TABLE `dokumen_nsk` (
  `id` int(11) NOT NULL,
  `nama_nsk` varchar(250) NOT NULL,
  `judul` text NOT NULL,
  `ukuran_file` int(11) NOT NULL,
  `ekstensi` varchar(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `iddepartemen` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen_nsk`
--

INSERT INTO `dokumen_nsk` (`id`, `nama_nsk`, `judul`, `ukuran_file`, `ekstensi`, `kategori`, `iddepartemen`, `tahun`, `date`) VALUES
(3, 'BAB_7_Pengenalan_Prolog.pdf', 'File Daftar Matakuliah Terbaru', 10169495, 'pdf', 'akademik', 4, 2019, '2019-03-12'),
(4, 'DecisionTree.pdf', 'File nilai mahasiswa', 285564, 'pdf', 'akademik', 4, 2018, '2018-10-16'),
(5, '160119_3._Clustering.pdf', 'SK Mat1', 416918, 'pdf', 'akademik', 1, 2019, '2019-03-13'),
(6, 'css_link3.html', 'SK KImia', 2196, 'html', 'akademik', 3, 2019, '2019-03-08'),
(7, 'css_box3.html', 'SK Fisika', 1812, 'html', 'akademik', 2, 2019, '2019-03-05'),
(8, '12-Eksepsi 2018_2.pdf', 'File Daftar Matakuliah Terbaru', 309399, 'pdf', 'akademik', 6, 2019, '2019-03-13'),
(9, '9a.pdf', 'SK Ujian Akhir', 88753, 'pdf', 'akademik', 6, 2018, '2018-08-08'),
(12, 'artikel stegano.pdf', 'File penting sekali bro', 637002, 'pdf', 'akademik', 2, 0000, '2019-03-14'),
(14, 'Software Engineering - A Practitioner''s Approach (Eighth Edition).pdf', 'Sakit Smeua', 24046416, 'pdf', 'akademik', 6, 0000, '2017-03-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_sk`
--

CREATE TABLE `dokumen_sk` (
  `id` int(11) NOT NULL,
  `no_sk` varchar(250) NOT NULL,
  `nama_sk` varchar(250) NOT NULL,
  `judul` text NOT NULL,
  `ukuran_file` int(20) NOT NULL,
  `ekstensi` varchar(20) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `iddepartemen` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen_sk`
--

INSERT INTO `dokumen_sk` (`id`, `no_sk`, `nama_sk`, `judul`, `ukuran_file`, `ekstensi`, `kategori`, `iddepartemen`, `tahun`, `date`) VALUES
(18, '001/SK/Mei/2019', 'DecisionTree.pdf', 'SK Pengangkatan Ketua Departemen', 285564, 'pdf', 'akademik', 6, 2019, '2019-03-13'),
(22, '003/SK/Mei/2019', 'css_box.html', 'SK Pengukuhan HM', 1459, 'html', 'kemahasiswaan', 6, 2019, '2019-03-04'),
(23, '002/SK/Mei/2019', 'css_table.html', 'SK Anggaran Belanja HM', 1001, 'html', 'keuangan', 6, 2018, '2018-07-11'),
(25, '002/SK/Mei/2019', 'BAB_7_Pengenalan_Prolog.pdf', 'SK Pengangkatan Ketua Departemen', 10169495, 'pdf', 'akademik', 4, 2019, '2019-03-12'),
(26, '006/SK/Mei/2019', 'Praktikum_2_PM.pdf', 'SK Lain', 330602, 'pdf', 'lain-lain', 6, 2018, '2018-08-07'),
(27, '002/SK/Mei/2019', '117595_708-2194-1-PB.pdf', 'SK Statistka1', 407946, 'pdf', 'akademik', 5, 2019, '2019-03-13'),
(28, '006/SK1/Mei/2019', 'Praktikum_2_PM-1.pdf', 'SK Stat2', 330602, 'pdf', 'akademik', 5, 2018, '2018-05-22'),
(29, '005/SKM/Mei/2019', '2.2._Hierarchical-Clustering.pdf', 'SK mat2', 1027622, 'pdf', 'akademik', 1, 2019, '2019-03-06'),
(30, '003/SKF/Mei/2019', '11c_form_validasi_Tugas_.html', 'SK MFK', 1914, 'html', 'akademik', 2, 2019, '2019-03-07'),
(37, '004/SK/Mei/2019', '9a.pdf', 'sgdgfdg', 88753, 'pdf', 'akademik', 6, 2019, '2019-03-07'),
(38, '003/SK/Mei/2019', 'hw9soln_06.pdf', 'sdfsdf', 108783, 'pdf', 'akademik', 6, 2018, '2018-10-09'),
(39, '002/SK/Mei/2019', 'HW2-Solutions-2016-Spring.pdf', 'gjhggh', 247209, 'pdf', 'akademik', 6, 2019, '2019-03-05'),
(44, '024/SK/Mei/2019', 'jadwal-wisuda-ke-150-undip.pdf', 'dgdfgdf', 816745, 'pdf', 'akademik', 6, 0000, '2019-03-20'),
(45, '001/SK/Mei/20191', 'data_isiruang.txt', 'zxczxcz', 402, 'txt', 'akademik', 6, 0000, '2019-03-06'),
(46, '004/SK/Mei/2019', 'artikel stegano.pdf', 'sas', 637002, 'pdf', 'akademik', 6, 0000, '2019-03-07'),
(47, '004/SK/Mei/2019', 'Model Waterfall.docx', 'aaACA', 17030, 'docx', 'akademik', 6, 0000, '2019-03-21'),
(48, '004/SK/Mei/2019', 'jadwal-wisuda-ke-150-undip-1.pdf', 'sass', 816745, 'pdf', 'akademik', 6, 0000, '2019-03-16'),
(49, '006/SK/Mei/2019', '9a-1.pdf', 'zxczc', 88753, 'pdf', 'akademik', 6, 0000, '2019-03-02'),
(51, '003/SK/Mei/2019', '01-Pengantar.pptx', 'scsc', 272728, 'pptx', 'akademik', 6, 0000, '2019-03-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_sk`
--

CREATE TABLE `kategori_sk` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_sk`
--

INSERT INTO `kategori_sk` (`id`, `nama_kategori`) VALUES
(1, 'akademik'),
(2, 'kemahasiswaan'),
(3, 'keuangan'),
(4, 'lain-lain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `dokumen_nsk`
--
ALTER TABLE `dokumen_nsk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddepartemen` (`iddepartemen`);

--
-- Indexes for table `dokumen_sk`
--
ALTER TABLE `dokumen_sk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddepartemen` (`iddepartemen`);

--
-- Indexes for table `kategori_sk`
--
ALTER TABLE `kategori_sk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dokumen_nsk`
--
ALTER TABLE `dokumen_nsk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `dokumen_sk`
--
ALTER TABLE `dokumen_sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `kategori_sk`
--
ALTER TABLE `kategori_sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
