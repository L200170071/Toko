-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2023 pada 05.21
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_adatoko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `berat` int(11) NOT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `berat`, `deskripsi`, `gambar`) VALUES
(17, 'Bolu Pisang', 6, 15000, 500, 'Bolu dengan bahan tambahan pisang sehingga memiliki rasa yang manis dan gurih karena terdapat tamabahan keju diatasnya', 'bolupisang1.jpeg'),
(19, 'Lapis', 6, 14000, 500, 'Lapis legit dengan rasa gurih dan manis karena berbahan dasar coklat dan keju', 'lapis1.jpeg'),
(21, 'Pandan Butter', 9, 18000, 250, 'Butter Pandan dengan rasa pandan dan manis serta terdapat taburan mesis', 'pandanbutter1.jpeg'),
(22, 'Kue Semprit', 9, 25000, 250, 'Kue semprit dengan rasa keju dan topping coklat', 'kuesemprit1.jpeg'),
(23, 'Cotton Sponge', 6, 20000, 500, 'Cotton Sponge adalah bolu dengan bahan dasar keju yang memiliki tekstur lembut', 'cottonsponge1.jpeg'),
(24, 'Bolu Gulung', 6, 14000, 300, 'Bolu keju yang digulung dan berisi krim vanila', 'bolugulung1.jpeg'),
(25, 'Katangel', 9, 25000, 250, 'Kue kastangel dengan toping parutan keju ', 'kastangel1.jpeg'),
(26, 'Keripik Pisang', 10, 15000, 250, 'Keripik Pisang asli dengan rasa manis dan gurih', 'kripikpisang1.jpeg'),
(27, 'Onde-onde', 10, 20000, 250, 'Onde-onde kering dengan balutan full wijen', 'ondeonde1.jpeg'),
(28, 'Kembang Goyang', 10, 18000, 250, 'Kembang goyang yang manis dan renyah ', 'kuegoyang1.jpeg'),
(29, 'Rainbow Cake', 6, 30000, 250, 'Bolu dengan rasa strawbery,nanas,pandan dan coklat', 'bolupelangi1.jpeg'),
(30, 'Bolu Wijen', 6, 35000, 250, 'Kue Bolu dengan selai bluebery dan dibalut dengan wijen', 'boluwijen1.jpeg'),
(31, 'Kacang Bawang', 10, 35000, 250, 'Kacang Bawang goreng dengan rasa gurih dan asin', 'kacangbawang1.jpeg'),
(32, 'Nastar Bunga', 9, 25000, 250, 'Nastar dengan selai nanas dan berbentuk bunga teratai', 'nastarbunga1.jpeg'),
(33, 'Nastar Buah', 9, 35000, 250, 'Nastar nanas dengan bentuk berbagai macam buah sehingga terkesan menarik', 'buah1.jpeg'),
(34, 'Cookies Pandan', 9, 20000, 250, 'Kue kering dengan rasa pandan manis', 'cookispandan1.jpeg'),
(35, 'Nastar Pisang', 9, 25000, 250, 'Nastar dengan selai nanas dan dibentuk seperti piang serta dibalut keju dan coklat', 'kue_pisang.jpeg'),
(36, 'Cookies Coklat', 9, 30000, 250, 'Kue kering coklat dengan tekstur yang lembut dan manis', 'coklat1.jpeg'),
(37, 'Putri Salju Pandan', 9, 20000, 250, 'Kue Putri Salju dengan rasa pandan dan dibalut gula putih', 'putrisaljupandan1.jpeg'),
(38, 'Kue Pisang', 9, 25000, 250, 'Kue kering keju dengan bentuk pisang dan memiliki rasa manis', 'pisangcoklat1.jpeg'),
(39, 'Kue Ulat', 9, 25000, 250, 'Kue sempirit dengan bentuk ulat rasa keju dan pandan', 'ulat1.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero`
--

CREATE TABLE `hero` (
  `id_hero` int(11) NOT NULL,
  `file_foto` text DEFAULT NULL,
  `status_foto` enum('disetujui','belum_disetujui') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `hero`
--

INSERT INTO `hero` (`id_hero`, `file_foto`, `status_foto`) VALUES
(19, 'dollar-gill-fcnbIO5axMI-unsplash.jpg', 'belum_disetujui'),
(20, 'slideer1.jpeg', 'disetujui'),
(21, 'sliderr1.jpg', 'belum_disetujui'),
(22, 'pandanbutter1.jpeg', 'disetujui'),
(23, 'heroo1.jpeg', 'belum_disetujui'),
(24, 'foto1.jpeg', 'disetujui'),
(25, 'sliider1.jpeg', 'belum_disetujui'),
(26, 'bolu1.jpeg', 'disetujui'),
(27, 'buolu1.jpeg', 'disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(6, 'Bolu '),
(9, 'Kue Kering'),
(10, 'Makanan Jadul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `password`, `foto`) VALUES
(1, 'eka oktianturi', 'ekaoktianturi@gmail.com', 'eka1', 'foto.jpg'),
(2, 'Turi', 'Tyaturi@gmail.com\r\n', 'tyaa', 'foto.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BRI', '123456789', 'Eka Tya'),
(2, 'BNI', '987654321', 'Eka Oktia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian`
--

CREATE TABLE `rincian` (
  `id_rincian` int(11) NOT NULL,
  `no_order` varchar(25) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rincian`
--

INSERT INTO `rincian` (`id_rincian`, `no_order`, `id_barang`, `qty`) VALUES
(2, '20221208HZGPRMXY', 5, 1),
(3, '20221208HZGPRMXY', 3, 2),
(4, '20221208FYEDFXBI', 5, 2),
(5, '20221208FYEDFXBI', 3, 2),
(6, '20221208PJUXBKA0', 5, 2),
(7, '20221208PJUXBKA0', 3, 2),
(8, '20221208PJUXBKA0', 2, 1),
(9, '20221208PJUXBKA0', 1, 1),
(10, '20221208LK5KMGWL', 5, 1),
(11, '20221208LK5KMGWL', 3, 1),
(12, '20221208JOZXN3UP', 5, 1),
(13, '20221208JOZXN3UP', 3, 1),
(14, '20221208DGF5QXUU', 5, 1),
(15, '20221208DGF5QXUU', 3, 1),
(16, '20221208KVDJWBGX', 2, 1),
(17, '20221212XNTUJZZC', 17, 1),
(18, '20221212XNTUJZZC', 16, 1),
(19, '20221212XNTUJZZC', 12, 1),
(20, '20230116Q51CWHIY', 17, 1),
(21, '20230116WTN3YZ9I', 24, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(1) NOT NULL,
  `nama_toko` varchar(20) DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `lokasi`, `alamat_toko`, `no_telp`) VALUES
(1, 'AdaToko', 497, 'Jl. Persada, Pule, Selogiri, Wonogiri, Jawa Tengah.', '089516253714');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(25) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_penerima` varchar(45) DEFAULT NULL,
  `hp_penerima` varchar(15) DEFAULT NULL,
  `provinsi` varchar(25) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(8) DEFAULT NULL,
  `expedisi` varchar(45) DEFAULT NULL,
  `paket` varchar(45) DEFAULT NULL,
  `estimasi` varchar(45) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tanggal`, `nama_penerima`, `hp_penerima`, `provinsi`, `kota`, `alamat`, `kode_pos`, `expedisi`, `paket`, `estimasi`, `ongkir`, `grand_total`, `berat`, `total_bayar`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `status_order`, `no_resi`) VALUES
(17, 1, '20221212XNTUJZZC', '2022-12-12', 'Azril', '089512345679', 'Jawa Tengah', 'Karanganyar', 'Tempat tak tahu arah', '57652', 'jne', 'REG', '3-6 Hari', 6000, 42250, 1260, 48250, 1, 'slider1.jpg', 'Puan Maharani', 'BNI', '1545-001-2002', 3, 'KYR20221208'),
(18, 3, '20230116Q51CWHIY', '2023-01-16', 'eka', '08976543212', 'Jawa Tengah', 'Klaten', 'karangnongko', '54321', 'jne', 'REG', '3-6 Hari', 6000, 13750, 250, 19750, 1, 'ayampop.jpeg', 'eka', 'bri', '0987654', 2, '9876'),
(19, 1, '20230116WTN3YZ9I', '2023-01-16', 'eka', '08976543212', 'Kalimantan Utara', 'Bulungan (Bulongan)', 'kalbar', '54321', 'jne', 'OKE', '5-7 Hari', 54000, 14000, 300, 68000, 1, 'pti.png', 'eka', 'bri', '987654321', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `level_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(1, 'Tyaa', 'admin', 'admin', 1),
(2, 'Oktia', 'user', 'user', 2),
(3, 'Eka', 'user', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_barang_id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `fk_gambar_id_barang` (`id_barang`);

--
-- Indeks untuk tabel `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id_hero`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `rincian`
--
ALTER TABLE `rincian`
  ADD PRIMARY KEY (`id_rincian`),
  ADD KEY `fk_barang_id_barang` (`id_barang`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hero`
--
ALTER TABLE `hero`
  MODIFY `id_hero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rincian`
--
ALTER TABLE `rincian`
  MODIFY `id_rincian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `fk_gambar_id_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
