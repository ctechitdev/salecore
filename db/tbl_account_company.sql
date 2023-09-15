-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 09:40 AM
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
-- Table structure for table `tbl_account_company`
--

CREATE TABLE `tbl_account_company` (
  `ac_ic` int(11) NOT NULL,
  `acc_number` varchar(30) DEFAULT NULL,
  `acc_name` varchar(150) DEFAULT NULL,
  `acc_code` varchar(50) DEFAULT NULL,
  `company_code` varchar(10) DEFAULT NULL,
  `code_type` varchar(50) DEFAULT NULL,
  `code_lenght` varchar(50) DEFAULT NULL,
  `vendor_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_company`
--

INSERT INTO `tbl_account_company` (`ac_ic`, `acc_number`, `acc_name`, `acc_code`, `company_code`, `code_type`, `code_lenght`, `vendor_code`) VALUES
(1, '4200-100-550', 'UI', '_SYS00000001612', '550', 'onlygen', '7', 'S-E'),
(2, '4200-110-551', 'BF', '_SYS00000001613', '551', 'onlygen', '7', 'S-N'),
(3, '4200-120-552', 'KCP', '_SYS00000001614', '552', 'onlygen', '3', 'S-N'),
(4, '4200-130-553', 'Kubota RT & NC', '_SYS00000001615', '553', 'pvcode', '3', 'S-N'),
(5, '4200-140-554', 'Karshine', '_SYS00000001616', '554', 'teamcode', '3', 'S-N'),
(6, '4200-150-555', 'Toto HO', '_SYS00000001617', '555', 'onlygen', '7', 'S-N'),
(7, '4200-160-556', 'Rinnai', '_SYS00000001618', '556', 'onlygen', '6', 'S-N'),
(8, '4200-170-557', 'Acecook', '_SYS00000001619', '557', 'pvcode', '3', 'S-N'),
(9, '4200-180-558', 'Yamaha', '_SYS00000001620', '558', 'pvcode', '3', 'S-N'),
(10, '4200-190-559', 'Sugar', '_SYS00000001621', '559', 'pvcode', '3', 'S-N'),
(11, '4200-200-560', 'Philips', '_SYS00000001622', '560', 'onlygen', '6', 'S-N'),
(12, '4200-210-561', 'Tyres Derler', '_SYS00000001623', '561', 'pvcode', '3', 'S-N'),
(13, '4200-220-562', 'PTT Lub. Oil', '_SYS00000001624', '562', 'teamcode', '3', 'S-N'),
(14, '4200-230-563', 'Toyota Lub. Oil', '_SYS00000001625', '563', 'pvcode', '3', 'S-N'),
(15, '4200-240-564', 'Kubota Tractor', '_SYS00000001626', '564', 'pvcode', '3', 'S-N'),
(16, '4200-250-565', 'Battery', '_SYS00000001627', '565', 'teamcode', '3', 'S-N'),
(17, '4200-260-566', 'Tyres Center', '_SYS00000001997', '566', 'pvcode', '3', 'S-N'),
(18, '4200-270-567', 'Fertilizer', '_SYS00000002056', '567', 'pvcode', '3', 'S-N'),
(19, '4200-280-568', 'Account Receivable -', '_SYS00000002120', '568', 'pvcode', '3', 'S-N'),
(20, '4200-290-569', 'New Holland Backhoe', '_SYS00000002289', '569', 'pvcode', '3', 'S-N'),
(21, '4200-300-570', 'Hitachi', '_SYS00000002355', '570', 'pvcode', '3', 'S-N'),
(22, '4200-310-571', 'Foton', '_SYS00000002356', '571', 'pvcode', '3', 'S-N'),
(23, '4200-320-572', 'Hager', '_SYS00000002484', '572', 'pvcode', '3', 'S-N'),
(24, '4200-330-573', 'Shell Lubricants Oil SVKT', '_SYS00000002594', '573', 'pvcode', '3', 'S-N'),
(25, '4200-340-574', 'Steel Pipe', '_SYS00000002738', '574', 'pvcode', '3', 'S-N'),
(26, '4200-350-575', 'Surapon Food', '_SYS00000002803', '575', 'pvcode', '3', 'S-N'),
(27, '4200-360-576', 'Silicone Shin Etsu', '_SYS00000002870', '576', 'pvcode', '3', 'S-N'),
(28, '4200-370-577', 'TUCL', '_SYS00000002905', '577', 'pvcode', '3', 'S-N'),
(29, '4200-380-578', 'Condom', '_SYS00000003420', '578', 'pvcode', '3', 'S-N'),
(30, '4200-390-579', 'Unicharm', '_SYS00000003493', '579', 'gentext', '5', 'S-N'),
(31, '4200-400-580', 'Mineral water Mont Fleur', '_SYS00000003665', '580', 'pvcode', '3', 'S-N'),
(32, '4200-410-581', 'Tyres Modern Trade', '_SYS00000003744', '581', 'pvcode', '3', 'S-N'),
(33, '4200-420-582', 'Tyres Fleet', '_SYS00000003819', '582', 'pvcode', '3', 'S-N'),
(34, '4200-430-583', 'Tyres Special Project', '_SYS00000003897', '583', 'pvcode', '3', 'S-N'),
(35, '4200-440-584', 'Philips - PAKSE', '_SYS00000003979', '584', 'teamcode', '3', 'S-N'),
(36, '4200-450-585', '3M Thailand - Industrial', '_SYS00000004220', '585', 'pvcode', '3', 'S-N'),
(37, '4200-460-586', 'Shell Lubricants Oil VTE', '_SYS00000004249', '586', 'pvcode', '4', 'S-N'),
(38, '4200-470-587', 'Fitne & Hotta', '_SYS00000004379', '587', 'onlygen', '3', 'S-N'),
(39, '4200-480-588', 'Chupa Chups', '_SYS00000004380', '588', 'pvcode', '3', 'S-N'),
(40, '4200-490-589', 'Tyres Mobile Service', '_SYS00000004537', '589', 'pvcode', '3', 'S-N'),
(41, '4200-510-900', 'Admin', '_SYS00000001628', '900', 'pvcode', '3', 'S-N'),
(42, '4200-520-905', 'ICT', '_SYS00000001629', '905', 'pvcode', '3', 'S-N'),
(43, '4200-530-910', 'Food Catering', '_SYS00000001630', '910', 'onlygen', '3', 'S-N'),
(44, '4200-540-915', 'Warehouse', '_SYS00000001631', '915', 'pvcode', '3', 'S-N'),
(45, '4200-550-920', 'Cucumber', '_SYS00000001632', '920', 'pvcode', '3', 'S-N'),
(46, '4200-560-925', 'Account', '_SYS00000001633', '925', 'pvcode', '3', 'S-N'),
(47, '4200-570-930', 'HR', '_SYS00000001634', '930', 'pvcode', '3', 'S-N'),
(48, '4200-580-935', 'Management', '_SYS00000001635', '935', 'pvcode', '3', 'S-N'),
(49, '4200-590-940', 'Logistic', '_SYS00000001636', '940', 'onlygen', '6', 'S-N'),
(50, '4200-600-945', 'Business Analysis and Development', '_SYS00000002595', '945', 'pvcode', '3', 'S-N'),
(51, '4200-610-950', 'Heavy Truck Showroom', '_SYS00000002671', '950', 'pvcode', '3', 'S-N'),
(52, '4200-620-955', 'New Project - KP Mining Co.,Ltd', '_SYS00000004061', '955', 'pvcode', '3', 'S-N'),
(53, '4200-801-810', 'Account Receivable - Oil Filter', '_SYS00000004396', '810', 'pvcode', '3', 'S-N'),
(54, '4200-802-820', 'Philips-kptl', '_SYS00000004399', '820', 'onlygen', '6', 'S-N'),
(55, '4200-803-830', 'Rinnai-kptl', '_SYS00000004505', '830', 'onlygen', '6', 'S-N'),
(56, '4230-100-110', 'Transportation Internal', '_SYS00000003753', '110', 'onlygen', '6', 'S-N'),
(57, '4230-100-111', 'Transportation External', '_SYS00000004078', '111', 'onlygen', '6', 'S-N'),
(58, '4230-200-210', 'Shipping Service Internal', '_SYS00000003754', '210', 'onlygen', '6', 'S-N'),
(59, '4231-200-211', 'Shipping Service External', '_SYS00000004122', '211', 'onlygen', '6', 'S-N'),
(60, '4230-300-310', 'Warehouse Service Internal', '_SYS00000003757', '310', 'onlygen', '6', 'S-N'),
(61, '4231-300-311', 'Warehouse Service  External', '_SYS00000004132', '311', 'onlygen', '6', 'S-N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_company`
--
ALTER TABLE `tbl_account_company`
  ADD PRIMARY KEY (`ac_ic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_company`
--
ALTER TABLE `tbl_account_company`
  MODIFY `ac_ic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
