-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2021 pada 06.43
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sumber_rejeki`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `suplierid` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `beli` double DEFAULT NULL,
  `jual` double DEFAULT NULL,
  `expired` date DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `edit` varchar(10) DEFAULT NULL,
  `kasir` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode`, `barcode`, `nama`, `suplierid`, `kategori`, `satuan`, `beli`, `jual`, `expired`, `stok`, `status`, `edit`, `kasir`) VALUES
(3, '490287', 'tes edit', 'Ganti Nama Supplier satu', 'Alat Listrik', 'Batang', 1500, 2000, '2022-10-29', 0, 'aktif', 'buka', NULL),
(4, '8999809102836', 'STEKER', 'Nama Supplier 2', 'Alat Listrik', 'Buah', 2500, 3000, '0000-00-00', 0, 'aktif', 'buka', NULL),
(5, '8999', 'Kabel Eterna', 'Ganti Nama Supplier satu', 'Alat Listrik', 'M', 4000, 5000, '0000-00-00', 0, 'aktif', 'tutup', NULL);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_barang` (
`kode` int(11)
,`barcode` varchar(100)
,`nama` varchar(100)
,`suplierid` varchar(100)
,`kategori` varchar(100)
,`satuan` varchar(100)
,`beli` double
,`jual` double
,`expired` date
,`stok` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_pembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_pembelian` (
`nota` varchar(150)
,`tgl` date
,`jatuh_tempo` date
,`status` enum('Lunas','Belum Lunas')
,`total_hbeli` double
,`bayar` double
,`kembalian` double
,`hutang` varchar(25)
,`kasir` varchar(100)
,`id` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_toko`
--

CREATE TABLE `data_toko` (
  `title` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `so` varchar(100) NOT NULL,
  `info` varchar(500) NOT NULL,
  `edit_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_toko`
--

INSERT INTO `data_toko` (`title`, `nama`, `alamat`, `telp`, `so`, `info`, `edit_barang`) VALUES
('TB.SUMBER REJEKI', 'TB.SUMBER REJEKI', 'Jl.Raya Ngantang, Malang, Jawa Timur', '0852012025', 'Buka', 'Toko Bangunan Terlengkap', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `dat_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `dat_barang` (
`kode` int(11)
,`barcode` varchar(100)
,`nama` varchar(100)
,`suplierid` varchar(100)
,`kategori` varchar(100)
,`satuan` varchar(100)
,`beli` double
,`jual` double
,`expired` date
,`stok` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id` varchar(20) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `pot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_beli`
--

CREATE TABLE `detail_beli` (
  `id` varchar(20) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `pot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `expire`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `expire` (
`kode` int(11)
,`barcode` varchar(100)
,`nama` varchar(100)
,`suplierid` varchar(100)
,`kategori` varchar(100)
,`satuan` varchar(100)
,`beli` double
,`jual` double
,`expired` date
,`stok` int(11)
,`STATUS` varchar(20)
,`edit` varchar(10)
,`selisih` int(7)
,`tgl_sekarang` date
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `grafik`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `grafik` (
`bulan` int(2)
,`kodeob` int(11)
,`namaob` varchar(100)
,`jumlah_jual` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode`, `nama`) VALUES
(1, 'Alat Listrik'),
(2, 'Alumunium'),
(3, 'Atap / Genteng'),
(4, 'Batu'),
(5, 'Besi'),
(6, 'Cat'),
(7, 'Keramik'),
(8, 'Kayu / Bambu'),
(9, 'Perlengkapan Tukang'),
(10, 'Pasir dan Semen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `opname`
--

CREATE TABLE `opname` (
  `kode_barang` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `nyata` int(11) DEFAULT NULL,
  `selisih` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_nota` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` varchar(100) NOT NULL,
  `nota` varchar(150) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status` enum('Lunas','Belum Lunas') DEFAULT NULL,
  `total_hbeli` double DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `kasir` varchar(100) DEFAULT NULL,
  `suplier` varchar(100) DEFAULT NULL,
  `hutang` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` varchar(20) NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `kembali` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `kasir` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `kode` varchar(10) DEFAULT NULL,
  `nm_bank` varchar(100) DEFAULT NULL,
  `nm_pemilik` varchar(100) DEFAULT NULL,
  `no_rek` varchar(100) DEFAULT NULL,
  `kode_sup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `kode` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`kode`, `nama`) VALUES
(1, 'Batang'),
(2, 'Buah'),
(3, 'Bungkus'),
(4, 'CM'),
(5, 'Dus'),
(6, 'Inc'),
(7, 'KG'),
(8, 'Lembar'),
(9, 'Liter'),
(10, 'Lonjor'),
(11, 'M'),
(12, 'MM'),
(13, 'M3'),
(14, 'Sak'),
(15, 'Sachet'),
(16, 'Set'),
(17, 'Unit');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `statis_lap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `statis_lap` (
`kode` int(11)
,`nama` varchar(100)
,`tgl` date
,`total_terjual` bigint(21)
,`jumlah` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `kode` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`kode`, `nama`, `kota`, `telp`, `email`, `alamat`) VALUES
(1, 'Ganti Nama Supplier satu', 'Ngantang', '081326344558', '', 'Jl.Arumba'),
(2, 'Nama Supplier 2', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id` varchar(20) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `barcode` varchar(25) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga` double DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `pot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_beli`
--

CREATE TABLE `temp_beli` (
  `id` varchar(20) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `barcode` varchar(25) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `satuan` varchar(25) DEFAULT NULL,
  `beli` double DEFAULT NULL,
  `jual` double DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `pot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_edit_beli`
--

CREATE TABLE `temp_edit_beli` (
  `id` varchar(20) DEFAULT NULL,
  `kode_barang` int(11) DEFAULT NULL,
  `barcode` varchar(25) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `satuan` varchar(25) DEFAULT NULL,
  `beli` double DEFAULT NULL,
  `jual` double DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `pot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `up_stok`
--

CREATE TABLE `up_stok` (
  `kode_barang` int(11) DEFAULT NULL,
  `tgl_update` date DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `masuk` int(11) DEFAULT NULL,
  `keluar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `akses` enum('Admin','Kasir') DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `domisili` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `akses`, `tempat_lahir`, `tgl_lahir`, `jk`, `domisili`, `telp`, `email`, `alamat`) VALUES
('admin', 'admin', 'Admin', 'Admin', '-', '2019-01-09', 'Perempuan', '-', '-', '-', '-'),
('kasir', 'kasir', 'Kasir', 'Kasir', NULL, NULL, NULL, NULL, NULL, NULL, 'Jl.Raya Ngantang');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pembelian` (
`id` varchar(100)
,`nota` varchar(150)
,`tgl` date
,`jatuh_tempo` date
,`status` enum('Lunas','Belum Lunas')
,`total_hbeli` double
,`bayar` double
,`kembalian` double
,`kasir` varchar(100)
,`suplier` varchar(100)
,`hutang` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_penjualan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_penjualan` (
`id` varchar(20)
,`tgl` date
,`total_harga` double
,`total_bayar` double
,`kembali` double
,`kasir` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `data_barang`
--
DROP TABLE IF EXISTS `data_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_barang`  AS SELECT `barang`.`kode` AS `kode`, `barang`.`barcode` AS `barcode`, `barang`.`nama` AS `nama`, `barang`.`suplierid` AS `suplierid`, `barang`.`kategori` AS `kategori`, `barang`.`satuan` AS `satuan`, `barang`.`beli` AS `beli`, `barang`.`jual` AS `jual`, `barang`.`expired` AS `expired`, `barang`.`stok` AS `stok` FROM `barang` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pembelian`
--
DROP TABLE IF EXISTS `data_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pembelian`  AS SELECT `pembelian`.`nota` AS `nota`, `pembelian`.`tgl` AS `tgl`, `pembelian`.`jatuh_tempo` AS `jatuh_tempo`, `pembelian`.`status` AS `status`, `pembelian`.`total_hbeli` AS `total_hbeli`, `pembelian`.`bayar` AS `bayar`, `pembelian`.`kembalian` AS `kembalian`, `pembelian`.`hutang` AS `hutang`, `pembelian`.`kasir` AS `kasir`, `pembelian`.`id` AS `id` FROM `pembelian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `dat_barang`
--
DROP TABLE IF EXISTS `dat_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dat_barang`  AS SELECT `barang`.`kode` AS `kode`, `barang`.`barcode` AS `barcode`, `barang`.`nama` AS `nama`, `barang`.`suplierid` AS `suplierid`, `barang`.`kategori` AS `kategori`, `barang`.`satuan` AS `satuan`, `barang`.`beli` AS `beli`, `barang`.`jual` AS `jual`, `barang`.`expired` AS `expired`, `barang`.`stok` AS `stok` FROM `barang` WHERE `barang`.`status` = 'aktif' ;

-- --------------------------------------------------------

--
-- Struktur untuk view `expire`
--
DROP TABLE IF EXISTS `expire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expire`  AS SELECT `barang`.`kode` AS `kode`, `barang`.`barcode` AS `barcode`, `barang`.`nama` AS `nama`, `barang`.`suplierid` AS `suplierid`, `barang`.`kategori` AS `kategori`, `barang`.`satuan` AS `satuan`, `barang`.`beli` AS `beli`, `barang`.`jual` AS `jual`, `barang`.`expired` AS `expired`, `barang`.`stok` AS `stok`, `barang`.`status` AS `STATUS`, `barang`.`edit` AS `edit`, to_days(curdate()) - to_days(`barang`.`expired`) AS `selisih`, curdate() AS `tgl_sekarang` FROM `barang` WHERE `barang`.`status` = 'aktif' ;

-- --------------------------------------------------------

--
-- Struktur untuk view `grafik`
--
DROP TABLE IF EXISTS `grafik`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grafik`  AS SELECT month(`penjualan`.`tgl`) AS `bulan`, `barang`.`kode` AS `kodeob`, `barang`.`nama` AS `namaob`, sum(`detail`.`qty`) AS `jumlah_jual` FROM ((`penjualan` join `detail`) join `barang`) WHERE `penjualan`.`id` = `detail`.`id` AND `barang`.`kode` = `detail`.`kode_barang` AND month(`penjualan`.`tgl`) = month(current_timestamp()) GROUP BY `detail`.`kode_barang` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `statis_lap`
--
DROP TABLE IF EXISTS `statis_lap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statis_lap`  AS SELECT `barang`.`kode` AS `kode`, `barang`.`nama` AS `nama`, `penjualan`.`tgl` AS `tgl`, count(`barang`.`kode`) AS `total_terjual`, sum(`detail`.`qty`) AS `jumlah` FROM ((`barang` join `detail`) join `penjualan`) WHERE `barang`.`kode` = `detail`.`kode_barang` AND `detail`.`id` = `penjualan`.`id` GROUP BY `barang`.`nama` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pembelian`
--
DROP TABLE IF EXISTS `v_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian`  AS SELECT `pembelian`.`id` AS `id`, `pembelian`.`nota` AS `nota`, `pembelian`.`tgl` AS `tgl`, `pembelian`.`jatuh_tempo` AS `jatuh_tempo`, `pembelian`.`status` AS `status`, `pembelian`.`total_hbeli` AS `total_hbeli`, `pembelian`.`bayar` AS `bayar`, `pembelian`.`kembalian` AS `kembalian`, `pembelian`.`kasir` AS `kasir`, `pembelian`.`suplier` AS `suplier`, `pembelian`.`hutang` AS `hutang` FROM `pembelian` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_penjualan`
--
DROP TABLE IF EXISTS `v_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS SELECT `penjualan`.`id` AS `id`, `penjualan`.`tgl` AS `tgl`, `penjualan`.`total_harga` AS `total_harga`, `penjualan`.`total_bayar` AS `total_bayar`, `penjualan`.`kembali` AS `kembali`, `penjualan`.`kasir` AS `kasir` FROM `penjualan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `suplierid` (`suplierid`),
  ADD KEY `toko` (`kasir`) USING BTREE;

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD KEY `id` (`id`),
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD KEY `id` (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `opname`
--
ALTER TABLE `opname`
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasir` (`kasir`) USING BTREE;

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasir` (`kasir`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD KEY `kode_sup` (`kode_sup`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD KEY `id` (`id`),
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `temp_beli`
--
ALTER TABLE `temp_beli`
  ADD KEY `id` (`id`),
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `temp_edit_beli`
--
ALTER TABLE `temp_edit_beli`
  ADD KEY `id` (`id`),
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `up_stok`
--
ALTER TABLE `up_stok`
  ADD KEY `kode_barang` (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `suplier`
--
ALTER TABLE `suplier`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kasir`) REFERENCES `user` (`username`);

--
-- Ketidakleluasaan untuk tabel `opname`
--
ALTER TABLE `opname`
  ADD CONSTRAINT `opname_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
