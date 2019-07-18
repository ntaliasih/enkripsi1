SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `db_infokes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_infokes`;

CREATE TABLE `tb_layanan` (
  `layanan_id` int(5) NOT NULL,
  `layanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_layanan` (`layanan_id`, `layanan`) VALUES
(1, 'admin'),
(2, 'e-farmasi'),
(3, 'e-rujukan'),
(4, 'e-puskesmas'),
(5, 'e-clinic'),
(6, 'e-antrian');

CREATE TABLE `tb_request` (
  `request_id` int(5) NOT NULL,
  `no_permintaan` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `user_id` int(5) NOT NULL,
  `secret_key` varchar(300) NOT NULL,
  `path` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tb_role` (
  `role_id` int(5) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_role` (`role_id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Client');

CREATE TABLE `tb_user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `layanan_id` int(5) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `kantor_wilayah` varchar(50) NOT NULL,
  `role_id` int(5) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT './assets/img/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `nama`, `email`, `layanan_id`, `kab_kota`, `kantor_wilayah`, `role_id`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nurhikmah Taliasih', 'nurhikmah@infokes.id', 1, 'Bandung', 'Bandung', 1, './assets/img/default.png'),
(2, 'pkmlampung', '0cf2f8f242052f44c60962efa2583603', 'PKM Lampung', 'pkmlampung@infokes.id', 2, 'Lampung', 'Lampung', 2, './assets/img/default.png');


ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`layanan_id`);

ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`request_id`);

ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`role_id`);

ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
