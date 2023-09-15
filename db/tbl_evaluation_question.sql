-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 09:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_question`
--

CREATE TABLE `tbl_evaluation_question` (
  `evaluation_question_id` int(11) NOT NULL,
  `evaluation_question_title` text DEFAULT NULL,
  `evaluation_question_data` text DEFAULT NULL,
  `question_status` int(11) DEFAULT NULL,
  `evaluation_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_evaluation_question`
--

INSERT INTO `tbl_evaluation_question` (`evaluation_question_id`, `evaluation_question_title`, `evaluation_question_data`, `question_status`, `evaluation_point`) VALUES
(1, 'ຄຸນນະພາບສິນຄ້າ', 'ສິນຄ້າ ແລະ ບໍລິການມີຄຸນນະພາບດີ ສະພາບດີ', 1, 6),
(2, 'ການມອບສິນຄ້າ', 'ການສົ່ງມອບຕົງເວລາທີ່ນັດໝາຍ ແລະ ສະພາບສິນຄ້າສົມບູນ ຄົບຕາມຈຳນວນການສົ່ງມອບ ພ້ອມເອກະສານ', 1, 6),
(3, 'ການຕິດຕໍ່ຊື່ສານ', 'ຊ່ອງທາງການຕິດຕໍ່ຊື່ສານສະດວກ, ຖືກຕ້ອງ, ໄວ', 1, 2),
(4, 'ການບໍລິການ', 'ການໃຫ້ບໍລິການດີ ມີການຊ່ວຍເຫຼືອ ແລະ ປະທັບໃຈ', 1, 2),
(5, 'ລາຄາ ແລະ ເງື່ອນໄຂການຊຳລະ', 'ລາຄາສົມເຫດສົມຜົນ ແລະ ມີເງື່ອນໄຂຊຳລະທີ່ເໝາະສົມເມື່ອທຽບກັບຜູ້ຂາຍເຈົ້າອື່ນໆ', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_evaluation_question`
--
ALTER TABLE `tbl_evaluation_question`
  ADD PRIMARY KEY (`evaluation_question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_evaluation_question`
--
ALTER TABLE `tbl_evaluation_question`
  MODIFY `evaluation_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
