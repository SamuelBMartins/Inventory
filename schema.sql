-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: h2mysql16
-- Generation Time: May 17, 2017 at 02:08 PM
-- Server version: 5.6.33-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nren_inventario`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accesso`
--

CREATE TABLE `Accesso` (
  `idAccesso` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Accesso`
--

INSERT INTO `Accesso` (`idAccesso`, `password`) VALUES
(1, '$2y$10$8cRtr0WAyn6fhrZto2zwGOOSdITTj2AdKtkSFQYnnhNzq4lJ1G272');

-- --------------------------------------------------------

--
-- Table structure for table `Aula`
--

CREATE TABLE `Aula` (
  `idAula` int(11) NOT NULL,
  `aula` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Aula`
--

INSERT INTO `Aula` (`idAula`, `aula`) VALUES
(1, 'aula4'),
(2, 'aula6'),
(3, 'aula7'),
(4, 'aula21'),
(5, 'aula22'),
(6, 'aula23'),
(7, 'aula24'),
(8, 'aula31'),
(9, 'aula32'),
(10, 'aula35'),
(11, 'aula36'),
(12, 'aula37'),
(13, 'Magazzino'),
(14, 'Aula informatica'),
(15, 'Direzione'),
(16, 'Segreteria'),
(17, 'Aula docenti');

-- --------------------------------------------------------

--
-- Table structure for table `Consentiti`
--

CREATE TABLE `Consentiti` (
  `idConsentiti` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `RichiesteScan_idRichiesteScan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Consentiti`
--

INSERT INTO `Consentiti` (`idConsentiti`, `data`, `RichiesteScan_idRichiesteScan`) VALUES
(1, '2016-04-05 00:00:00', 1),
(2, '2017-04-05 00:00:00', 2),
(3, '2017-04-06 07:56:33', 6),
(4, '2017-04-06 08:34:04', 7),
(5, '2017-04-07 16:07:54', 8),
(13, '2017-04-12 16:12:01', 18),
(15, '2017-04-13 14:37:31', 19),
(16, '2017-04-13 14:38:59', 20),
(17, '2017-04-13 20:21:51', 21),
(18, '2017-04-14 11:14:43', 22);

-- --------------------------------------------------------

--
-- Table structure for table `controllo`
--

CREATE TABLE `controllo` (
  `idControllo` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `Dispositivi_idDispositivi` int(11) NOT NULL,
  `Consentiti_idConsentiti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `controllo`
--

INSERT INTO `controllo` (`idControllo`, `data`, `Dispositivi_idDispositivi`, `Consentiti_idConsentiti`) VALUES
(64, '2017-02-14 10:33:53', 25, 1),
(65, '2017-04-14 10:38:21', 26, 1),
(66, '2017-04-14 10:39:15', 27, 1),
(67, '2017-02-14 10:41:00', 28, 1),
(68, '2017-04-14 10:41:38', 29, 1),
(69, '2017-04-14 10:47:47', 30, 1),
(70, '2017-04-14 10:51:24', 31, 1),
(71, '2017-02-14 10:54:27', 32, 1),
(72, '2017-04-14 10:55:16', 33, 1),
(73, '2017-04-14 10:55:47', 34, 1),
(74, '2017-04-14 11:00:24', 35, 1),
(75, '2017-04-14 11:01:51', 36, 1),
(76, '2017-04-14 11:14:45', 36, 18),
(77, '2017-04-14 11:15:02', 35, 18),
(78, '2017-04-14 11:26:52', 37, 1),
(79, '2017-04-14 11:29:23', 36, 18),
(80, '2017-04-14 11:29:35', 36, 18),
(81, '2017-04-14 12:54:33', 38, 1),
(82, '2017-05-10 13:38:25', 39, 1),
(83, '2017-05-16 09:40:43', 40, 1),
(84, '2017-05-16 09:51:33', 41, 1),
(85, '2017-05-16 09:56:45', 42, 1),
(86, '2017-05-16 10:00:42', 43, 1),
(87, '2017-05-16 10:02:15', 44, 1),
(88, '2017-05-16 10:04:54', 45, 1),
(89, '2017-05-16 10:08:21', 46, 1),
(90, '2017-05-16 10:10:26', 47, 1),
(91, '2017-05-16 10:12:40', 48, 1),
(92, '2017-05-16 10:18:43', 49, 1),
(93, '2017-05-16 10:19:42', 50, 1),
(94, '2017-05-16 10:20:19', 51, 1),
(95, '2017-05-16 10:23:32', 52, 1),
(96, '2017-05-16 10:24:11', 53, 1),
(97, '2017-05-16 10:26:05', 54, 1),
(98, '2017-05-16 10:57:42', 55, 1),
(99, '2017-05-16 11:02:34', 56, 1),
(100, '2017-05-16 11:11:05', 57, 1),
(101, '2017-05-16 11:35:36', 58, 1),
(102, '2017-05-16 11:38:40', 59, 1),
(103, '2017-05-16 11:39:46', 60, 1),
(104, '2017-05-16 13:12:57', 61, 1),
(105, '2017-05-16 13:15:21', 62, 1),
(106, '2017-05-16 13:16:34', 63, 1),
(107, '2017-05-16 13:29:32', 64, 1),
(108, '2017-05-16 13:36:10', 65, 1),
(109, '2017-05-16 13:41:31', 66, 1),
(110, '2017-05-16 13:43:48', 67, 1),
(111, '2017-05-16 13:45:59', 68, 1),
(112, '2017-05-16 15:40:59', 69, 1),
(113, '2017-05-16 15:47:23', 70, 1),
(114, '2017-05-16 15:49:40', 71, 1),
(115, '2017-05-16 15:52:27', 72, 1),
(116, '2017-05-16 15:53:28', 73, 1),
(117, '2017-05-16 15:54:38', 74, 1),
(118, '2017-05-16 16:00:55', 75, 1),
(119, '2017-05-16 16:13:05', 76, 1),
(120, '2017-05-16 16:17:53', 77, 1),
(121, '2017-05-16 16:18:45', 78, 1),
(122, '2017-05-16 16:19:39', 79, 1),
(123, '2017-05-16 16:22:06', 80, 1),
(124, '2017-05-16 16:23:57', 81, 1),
(125, '2017-05-16 16:25:06', 82, 1),
(126, '2017-05-16 16:26:01', 83, 1),
(127, '2017-05-16 16:26:53', 84, 1),
(128, '2017-05-17 08:08:16', 85, 1),
(129, '2017-05-17 08:10:28', 86, 1),
(130, '2017-05-17 08:11:37', 87, 1),
(131, '2017-05-17 08:12:34', 88, 1),
(132, '2017-05-17 08:17:57', 89, 1),
(133, '2017-05-17 08:29:09', 90, 1),
(134, '2017-05-17 08:30:40', 91, 1),
(135, '2017-05-17 08:38:10', 92, 1),
(136, '2017-05-17 08:40:03', 93, 1),
(137, '2017-05-17 08:42:08', 94, 1),
(138, '2017-05-17 08:44:00', 95, 1),
(139, '2017-05-17 08:45:11', 96, 1),
(140, '2017-05-17 08:46:18', 97, 1),
(141, '2017-05-17 08:47:11', 98, 1),
(142, '2017-05-17 08:48:00', 99, 1),
(143, '2017-05-17 08:48:47', 100, 1),
(144, '2017-05-17 09:05:57', 101, 1),
(145, '2017-05-17 09:16:14', 102, 1),
(146, '2017-05-17 09:17:02', 103, 1),
(147, '2017-05-17 09:18:15', 104, 1),
(148, '2017-05-17 09:18:52', 105, 1),
(149, '2017-05-17 09:20:47', 106, 1),
(150, '2017-05-17 09:21:46', 107, 1),
(151, '2017-05-17 09:32:11', 108, 1),
(152, '2017-05-17 09:34:17', 109, 1),
(153, '2017-05-17 09:35:24', 110, 1),
(154, '2017-05-17 09:36:06', 111, 1),
(155, '2017-05-17 09:37:09', 112, 1),
(156, '2017-05-17 09:38:12', 113, 1),
(157, '2017-05-17 09:39:11', 114, 1),
(158, '2017-05-17 09:39:58', 115, 1),
(159, '2017-05-17 09:41:17', 116, 1),
(160, '2017-05-17 09:41:53', 117, 1),
(161, '2017-05-17 10:20:33', 118, 1),
(162, '2017-05-17 10:21:46', 119, 1),
(163, '2017-05-17 10:27:38', 120, 1),
(164, '2017-05-17 10:28:51', 121, 1),
(165, '2017-05-17 10:34:11', 122, 1),
(166, '2017-05-17 10:52:46', 123, 1),
(167, '2017-05-17 10:53:53', 124, 1),
(168, '2017-05-17 10:55:03', 125, 1),
(169, '2017-05-17 10:55:45', 126, 1),
(170, '2017-05-17 10:56:27', 127, 1),
(171, '2017-05-17 10:57:21', 128, 1),
(172, '2017-05-17 10:58:28', 129, 1),
(173, '2017-05-17 10:59:20', 130, 1),
(174, '2017-05-17 11:00:14', 131, 1),
(175, '2017-05-17 11:01:01', 132, 1),
(176, '2017-05-17 11:01:45', 133, 1),
(177, '2017-05-17 11:05:07', 134, 1),
(178, '2017-05-17 11:06:35', 135, 1),
(179, '2017-05-17 11:07:04', 136, 1),
(180, '2017-05-17 11:09:15', 137, 1),
(181, '2017-05-17 11:09:47', 138, 1),
(182, '2017-05-17 11:10:42', 139, 1),
(183, '2017-05-17 11:34:31', 140, 1),
(184, '2017-05-17 11:36:48', 141, 1),
(185, '2017-05-17 11:41:05', 142, 1),
(186, '2017-05-17 11:42:02', 143, 1),
(187, '2017-05-17 11:42:38', 144, 1),
(188, '2017-05-17 11:43:29', 145, 1),
(189, '2017-05-17 11:44:29', 146, 1),
(190, '2017-05-17 11:51:55', 147, 1),
(191, '2017-05-17 11:52:51', 148, 1),
(192, '2017-05-17 11:54:08', 149, 1),
(193, '2017-05-17 11:55:10', 150, 1),
(194, '2017-05-17 11:55:54', 151, 1),
(195, '2017-05-17 12:03:36', 152, 1),
(196, '2017-05-17 12:12:25', 153, 1),
(197, '2017-05-17 12:13:13', 154, 1),
(198, '2017-05-17 12:13:47', 155, 1),
(199, '2017-05-17 12:14:21', 156, 1),
(200, '2017-05-17 12:14:58', 157, 1),
(201, '2017-05-17 12:15:34', 158, 1),
(202, '2017-05-17 12:17:19', 159, 1),
(203, '2017-05-17 12:19:07', 160, 1),
(204, '2017-05-17 12:20:50', 161, 1),
(205, '2017-05-17 12:21:19', 162, 1),
(206, '2017-05-17 12:21:56', 163, 1),
(207, '2017-05-17 12:23:07', 164, 1),
(208, '2017-05-17 12:24:12', 165, 1),
(209, '2017-05-17 12:24:50', 166, 1),
(210, '2017-05-17 12:25:07', 167, 1),
(211, '2017-05-17 12:25:42', 168, 1),
(212, '2017-05-17 12:26:41', 169, 1),
(213, '2017-05-17 12:27:32', 170, 1),
(214, '2017-05-17 12:30:18', 171, 1),
(215, '2017-05-17 12:30:36', 172, 1),
(216, '2017-05-17 12:31:48', 173, 1),
(217, '2017-05-17 12:54:15', 174, 1),
(218, '2017-05-17 13:40:36', 175, 1),
(219, '2017-05-17 13:41:23', 176, 1),
(220, '2017-05-17 13:41:50', 177, 1),
(221, '2017-05-17 13:42:37', 178, 1),
(222, '2017-05-17 13:45:37', 179, 1),
(223, '2017-05-17 13:48:28', 180, 1),
(224, '2017-05-17 13:50:46', 181, 1),
(225, '2017-05-17 13:51:28', 182, 1),
(226, '2017-05-17 13:52:18', 183, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Dispositivi`
--

CREATE TABLE `Dispositivi` (
  `idDispositivi` int(11) NOT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_number` varchar(100) DEFAULT NULL,
  `inizio_garanzia` date DEFAULT NULL,
  `fine_garanzia` date DEFAULT NULL,
  `etichetta` varchar(45) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `smaltito` int(11) NOT NULL,
  `Aula_idAula` int(11) NOT NULL,
  `Marca_idMarca` int(11) NOT NULL,
  `Tipo_idTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Dispositivi`
--

INSERT INTO `Dispositivi` (`idDispositivi`, `serial_number`, `product_name`, `product_number`, `inizio_garanzia`, `fine_garanzia`, `etichetta`, `note`, `smaltito`, `Aula_idAula`, `Marca_idMarca`, `Tipo_idTipo`) VALUES
(25, 'VLAGD33', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-10-15', '2010-10-14', 'MonDMS', '', 0, 1, 4, 1),
(26, 'CZC1231L2M', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-07-08', 'CLIENT8842', '', 0, 1, 1, 4),
(27, 'V1N5371965', 'FS-2100DN', 'FS-2100DN', '0000-00-00', '0000-00-00', 'aula4bn10', '', 0, 1, 7, 7),
(28, 'CNC302PTLP', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'MON21', '', 0, 2, 1, 1),
(29, 'CNC302PRNL', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor21', '', 0, 2, 1, 1),
(30, 'CZC32016T0', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8857', '', 0, 2, 1, 2),
(31, 'CZC3186LT8', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'client8860', '', 0, 2, 1, 2),
(32, 'V698360', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'MONITOR30', '', 0, 3, 4, 1),
(33, 'CZC32016S2', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8859', '', 0, 3, 1, 2),
(34, 'CZC3216NTR', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2013-06-23', '', '', 0, 3, 1, 4),
(35, 'CZC1231L17', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-07-08', 'HP Tower 1/ client8858', '', 0, 5, 1, 4),
(36, 'F4KE015669', '', 'CP-AX3003', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 11, 8, 5),
(37, 'VLAGD50', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'Mon6', '', 0, 10, 4, 1),
(38, 'VLAGD48', 'ASSEMBLY L171P-9417 Monitor', '4438HB2', '2007-09-27', '2010-09-26', 'Mon2', '', 0, 8, 4, 1),
(39, '', '', 'EB-1430Wi', '0000-00-00', '0000-00-00', '', '', 0, 1, 3, 6),
(40, 'S4RM817', 'M90 Desktop (ThinkCentre)', '5485W9N', '2010-08-25', '2013-08-24', '', '', 0, 13, 4, 2),
(41, 'S4RM824', 'M90 Desktop (ThinkCentre)', '5485W9N', '2010-08-25', '2013-08-24', '', '', 0, 13, 4, 2),
(42, 'CNCJB86114', 'HP LaserJet P2055d Printer', 'CE457A', '2010-08-24', '2011-11-21', 'aula7bn28', 'Difettosa', 0, 13, 1, 7),
(43, '21OBN18Ai049', '', 'P61212', '0000-00-00', '0000-00-00', 'MonServ', '15\" monitor server', 0, 13, 10, 1),
(44, 'A3G6N05645', '', 'DS210J', '0000-00-00', '0000-00-00', '', 'scollegato', 0, 13, 11, 8),
(45, 'V698466', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', '', 'imballato\r\n', 0, 13, 4, 1),
(46, 'CZC3186LYY', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client 89112', '', 0, 15, 1, 2),
(47, 'CZC32016SF', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client89121', '', 0, 15, 1, 2),
(48, 'CZC32016TD', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '0000-00-00', '0000-00-00', 'Client89200', '', 0, 15, 1, 2),
(49, '3CQ25019KX', 'HP ZR2330w 23-in LED S-IPS Monitor', 'C6Y18AT', '2013-02-13', '2016-03-13', 'MonDir1', '', 0, 15, 1, 1),
(50, '3CQ25019L1', 'HP LaserJet P2055d Printer', 'C6Y18AT', '2013-02-13', '2016-03-13', 'MonDir2', '', 0, 15, 1, 1),
(51, '3CQ25019L5', 'HP ZR2330w 23-in LED S-IPS Monitor', 'C6Y18AT', '2013-02-13', '2016-03-13', 'MonDir3', '', 0, 15, 1, 1),
(52, 'V1Q5326820', '', '', '0000-00-00', '0000-00-00', 'auladirbn22', '', 0, 15, 7, 7),
(53, 'LWS3Z01571', '', '', '0000-00-00', '0000-00-00', 'auladircol23', '', 0, 15, 1, 7),
(54, 'CZC3216NTT', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2016-06-23', 'Client8984', '', 0, 16, 1, 2),
(55, 'CZC3186LTC', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'ClientSeg1', '', 0, 16, 1, 2),
(56, 'CNC302PTLL', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'MonSegt2', '', 0, 16, 1, 1),
(57, 'CNC302PRFH', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'MonSegt1', '', 0, 16, 1, 1),
(58, 'CNC302PSH3', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'MonSegt3', '', 0, 16, 1, 1),
(59, 'CNC302PTWJ', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'Monitor13', '', 0, 16, 1, 1),
(60, '6500396100', '', 'MX-4141N', '0000-00-00', '0000-00-00', 'Seg COL19', '', 0, 16, 12, 7),
(61, 'CZC443277M', 'HP EliteOne 800 G1 Touch AiO 23', 'D0A61AV', '2014-10-25', '2017-11-23', '', 'Samuel', 0, 1, 1, 1),
(62, 'CNC302PRSZ', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor1', 'Samuel', 0, 14, 1, 1),
(63, 'CZC32016T6', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-16', 'client8870', '', 0, 14, 1, 1),
(64, 'Q521106885', 'FS-C5150DN', 'FS-C5150DN', '0000-00-00', '0000-00-00', 'aulainfocol25', '', 0, 14, 7, 7),
(65, 'CNC302PRLQ', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-07', 'monitor18', 'Jonathan', 0, 14, 1, 1),
(66, 'CZC6188SVQ', 'HP EliteDesk 800 G2 SFF', 'L1G76AV', '2016-05-10', '2019-06-08', '', 'Jonathan', 0, 14, 1, 2),
(67, 'CNC205Q9HD', 'HP CPQ LA2306x 23-In LED LCD ALL', 'XN375AT', '2012-03-22', '2015-04-20', 'Mon23', 'Giorgio', 0, 14, 1, 1),
(68, 'CZC2197H2N', 'HP Compaq 8200 Elite CMT PC', 'XL508AV', '2012-05-14', '2015-06-12', 'client8880/cfengine3', 'Giorgio', 0, 14, 1, 4),
(69, '5CG61411HZ', 'BU IDS UMA i5-6300U fWWAN 640 G2', 'L8U34AV', '2016-06-28', '2017-06-27', 'DELLAMONICA', 'Andrea', 0, 14, 1, 10),
(70, '5CG61411GW', 'BU IDS UMA i5-6300U fWWAN 640 G2', 'L8U34AV', '2016-06-28', '2019-06-27', '', 'Giorgio', 0, 14, 1, 1),
(71, 'CZC415200S', '800EDeS/i54570/500hq/4X/46k ALL', 'H5U03EA', '2014-04-12', '2011-05-11', 'Mon22', 'Andrea', 0, 14, 1, 1),
(72, 'CNC205Q9QV', 'HP CPQ LA2306x 23-In LED LCD ALL', 'XN375AT', '2012-03-22', '2015-04-20', 'Mon22', 'Andrea', 0, 14, 1, 1),
(73, 'I340LAN010068', '', 'DS213j', '0000-00-00', '0000-00-00', 'Synology2', '', 0, 14, 11, 8),
(74, 'Q154l21451', 'QNAP', 'TS-453 Pro', '0000-00-00', '0000-00-00', 'NAS1', 'In lavorazione da Jonathan', 0, 14, 13, 8),
(75, 'CZC3186M00', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client8841', '', 0, 17, 1, 2),
(76, 'CZC3186LZ4', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client8849', '', 0, 1, 1, 1),
(77, 'CZC5320HCR', 'HP EliteDesk 800 G1 SFF', 'C8N26AV', '2015-08-06', '2018-07-04', 'Client8877', '', 0, 17, 1, 2),
(78, 'CZC3186LT7', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client8848', '', 0, 17, 1, 2),
(79, 'CZC3186LT6', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client8864', '', 0, 17, 1, 2),
(80, 'CZC32016SL', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8865', '', 0, 17, 1, 2),
(81, 'CZC3186LT6', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'Client8844', '', 0, 17, 1, 2),
(82, 'CZC32016SB', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8846', '', 0, 17, 1, 2),
(83, 'CNC302PRQX', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'Monitor10', '', 0, 17, 1, 1),
(84, 'CNC302PTWG', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'Monitor12', '', 0, 17, 1, 1),
(85, 'CNC302PRSX', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'Monitor2', '', 0, 17, 1, 1),
(86, 'V6-B7240', 'ASSEMBLY L1951p Wide Monitor', '2448HC6', '2010-08-23', '2013-08-22', 'Mon11', '', 0, 17, 4, 1),
(87, 'V6-B7249', 'ASSEMBLY L1951p Wide Monitor', '2448HC6', '2010-08-23', '2013-08-23', 'Mon12', '', 0, 17, 4, 1),
(88, 'V6-98366', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'Mon10', '', 0, 17, 4, 1),
(89, 'V6-A0662', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'Mon9', '', 0, 17, 4, 1),
(90, 'V6-98365', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'Mon13', '', 0, 17, 4, 1),
(91, 'L8B4202006', 'TASKalfa 5551ci', '', '0000-00-00', '0000-00-00', 'AulaDocFOTCOP31', '', 0, 17, 7, 7),
(92, 'CNC302PRKV', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor9', '', 0, 2, 1, 1),
(93, 'CNC302PTLN', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor22', '', 0, 2, 1, 1),
(94, 'VLAGD40', 'ASSEMBLY L171P-9417 Monitor', '9417HC2', '2007-09-27', '2010-09-27', 'MonSeg1', '', 0, 2, 4, 1),
(95, 'CNC302PRFN', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor15', '', 0, 2, 1, 1),
(96, 'CNC302PTXP', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor27', '', 0, 2, 1, 1),
(97, '', '', '', '0000-00-00', '0000-00-00', '', '', 0, 2, 1, 1),
(98, 'CNC302PRT1', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor5', '', 0, 2, 1, 1),
(99, 'CNC302PTWL', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor26', '', 0, 2, 1, 1),
(100, 'CNC302PRW2', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor1', '', 0, 2, 1, 1),
(101, 'CNC302PTQ5', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor11', '', 0, 2, 1, 1),
(102, 'VLAGD49', 'ASSEMBLY L171P-9417 Monitor', '9417HC2', '2007-09-27', '2010-09-26', 'MON14', '', 0, 2, 4, 1),
(103, 'XEY0134151', 'FS-3920DN', 'FS-3920DN', '0000-00-00', '0000-00-00', 'aula6bn11', '', 0, 2, 7, 7),
(104, 'CZC1231L2G', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-07-08', 'HP Tower5', '', 0, 2, 1, 4),
(105, 'LMBHZP5', '', '9144Y1T', '0000-00-00', '0000-00-00', 'client8862', '', 0, 2, 4, 2),
(106, 'CN277S513N', '', '', '0000-00-00', '0000-00-00', '', '', 0, 2, 1, 11),
(107, 'CZC32016SY', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8852', '', 0, 2, 1, 2),
(108, 'CZC32016T1', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8869', '', 0, 2, 1, 2),
(109, 'LMVM1RR', '', '', '0000-00-00', '0000-00-00', '', 'PC scollegato', 0, 2, 14, 2),
(110, 'CZC3186LT8', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'client8860', '', 0, 2, 1, 2),
(111, 'CZC4151ZXB', '', 'H5U03EA', '0000-00-00', '0000-00-00', 'client8845', '', 0, 2, 1, 2),
(112, 'CZC32016S5', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8853', '', 0, 2, 1, 2),
(113, 'CZC32016SZ', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8851', '', 0, 2, 1, 2),
(114, 'CZC32016S7', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8850', '', 0, 2, 1, 2),
(115, 'CZC32016T9', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8873', '', 0, 2, 1, 2),
(116, 'CZC32016S8', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'Client8854', '', 0, 2, 1, 2),
(117, 'MJ17HSHXB12955D', '', 'MJ17BSTSQ/EDC', '0000-00-00', '0000-00-00', 'SPSE monitor18', '', 0, 2, 4, 1),
(118, 'V698360', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'MONITOR30', '', 0, 3, 4, 1),
(119, 'V6B7251', 'ASSEMBLY L1951p Wide Monitor', '2448HC6', '2010-08-23', '2013-08-22', 'Mon14', '', 0, 3, 4, 1),
(120, 'V698361', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'Mon25', '', 0, 3, 4, 1),
(121, '77882062-ES-A', '', '0FTD0401A5', '0000-00-00', '0000-00-00', 'SPSE monitor4', 'rimosso', 1, 3, 15, 1),
(122, 'V698466', 'ASSEMBLY L1951p Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'monitor30', '', 0, 3, 4, 1),
(123, 'CNC302PRSW', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor29', '', 0, 3, 1, 1),
(124, 'CNC302PRKZ', 'HP CPQ LA2006x 20-In LED LCD ALL', 'XN374AA', '2013-03-01', '2016-03-30', 'monitor28', '', 0, 3, 1, 1),
(125, 'F4JE00719', '', 'CP-AX3003', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 3, 8, 5),
(126, 'V1N6326414', '', '', '0000-00-00', '0000-00-00', 'Aula7ng', '', 0, 3, 7, 7),
(127, 'FXD77-B17395', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 1, 8, 6),
(128, 'CZC32016S2', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8859', '', 0, 3, 1, 2),
(129, 'CZC3186LTL', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'client8866', '', 0, 3, 1, 2),
(130, 'CZC3186LV6', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'client8855', '', 0, 3, 1, 2),
(131, 'CZC3186LZS', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-09', '2016-06-07', 'client8861', '', 0, 3, 1, 2),
(132, 'CZC32016TB', 'HP Compaq Elite 8300 SFF PC ALL', 'QV996AV', '2013-05-16', '2016-06-14', 'client8856', '', 0, 3, 1, 2),
(133, 'CZC3216NTR', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2013-06-23', '', '', 0, 3, 1, 4),
(134, 'VLAGD45', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'MON 17', '', 0, 4, 4, 1),
(135, 'CZC3216NTW', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2016-06-23', 'client8843', '', 0, 4, 1, 4),
(136, '', '', 'P1206P', '0000-00-00', '0000-00-00', '', '', 0, 4, 16, 5),
(137, 'FXT77 022497', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 4, 8, 6),
(138, '', '', '', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 4, 8, 5),
(139, '', 'FS-4100DN', 'FS-4100DN', '0000-00-00', '0000-00-00', 'aula21bn12', '', 0, 4, 7, 7),
(140, 'VLAGD37', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'MON 18', '', 0, 5, 4, 1),
(141, 'CZC1231L17', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-07-08', 'HP Tower 1/ client8858', '', 0, 1, 1, 4),
(142, '', '', 'P5271', '0000-00-00', '0000-00-00', 'BEAMER5', '', 0, 5, 16, 5),
(143, '', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 5, 8, 6),
(144, '', '', 'CP-A301N', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 5, 8, 5),
(145, 'XET9214445', 'FS-1350DN', 'FS-1350DN', '0000-00-00', '0000-00-00', 'aula22bn13', 'smaltito', 1, 5, 7, 7),
(146, 'VCY7252080', 'ECOsys P2040dn', 'P2040dn', '0000-00-00', '0000-00-00', 'aula22bn27', '', 0, 5, 7, 7),
(147, 'VLAGD39', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'MON 19', '', 0, 6, 4, 1),
(148, 'CZC3216NTQ', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2016-06-23', 'client8871', '', 0, 6, 1, 4),
(149, '', '', 'P5280', '0000-00-00', '0000-00-00', 'BEAMER7', '', 0, 6, 16, 5),
(150, '', '', 'CP-A300N', '0000-00-00', '0000-00-00', '', '', 0, 6, 8, 6),
(151, 'FXT77 022495', '', '', '0000-00-00', '0000-00-00', '', '', 0, 6, 8, 5),
(152, 'V1Q5326833', 'FS-4100DN', 'FS-4100DN', '0000-00-00', '0000-00-00', 'aula23bn14', '', 0, 6, 7, 7),
(153, 'VLAGD32', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'MON 20', '', 0, 7, 4, 1),
(154, 'CZC3216NTP', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2016-06-23', 'CLIENT8847', '', 0, 7, 1, 4),
(155, '', '', 'P5280', '0000-00-00', '0000-00-00', 'BEAMER8', '', 0, 7, 16, 5),
(156, '', '', 'CP-A300N', '0000-00-00', '0000-00-00', '', '', 0, 7, 8, 6),
(157, 'FXT77 022490', 'StarBoard', '', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 7, 8, 5),
(158, 'XEY0135086', 'FS-3920DN', 'FS-3920DN', '0000-00-00', '0000-00-00', 'aula24bn15', '', 0, 7, 7, 7),
(159, 'VLAGD48', 'ASSEMBLY L171P-9417 Monitor', '4438HB2', '2007-09-27', '2010-09-26', 'Mon2', '', 0, 8, 4, 1),
(160, 'CZC2197H2M', 'HP Compaq 8200 Elite CMT PC', 'XL508AV', '2012-05-14', '2015-06-12', 'client8867', '', 0, 8, 1, 4),
(161, 'XEY0135093', 'FS-3920DN', 'FS-3920DN', '0000-00-00', '0000-00-00', 'Aula31BN16', '', 0, 8, 7, 7),
(162, '', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 1, 8, 6),
(163, 'F0J021806', '', 'CP-A100', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 8, 8, 5),
(164, 'V698362', 'ThinkVision L1940p 19-inch Wide Monitor', '4424HB6', '2009-06-05', '2012-06-04', 'Mon15', '', 0, 9, 4, 1),
(165, 'CZC3216NTS', 'HP Compaq Elite 8300 CMT PC ALL', 'QV993AV', '2013-05-25', '2016-06-23', 'client8863', '', 0, 9, 1, 4),
(166, 'XEY0135928', 'FS-3920DN', 'FS-3920DN', '0000-00-00', '0000-00-00', 'aula32bn17', '', 0, 9, 7, 7),
(167, '', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 9, 8, 6),
(168, 'F01021623', '', 'CP-A100', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 9, 8, 5),
(169, 'VLAGD50', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '2007-09-27', '2010-09-26', 'Mon6', '', 0, 10, 4, 1),
(170, 'CZC1231L1V', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-06-08', 'HP Tower 3/ client8874', '', 0, 10, 1, 4),
(171, 'XLN7144235', 'FS-3900DN', 'FS-3900DN', '0000-00-00', '0000-00-00', 'aula35bn18', 'firmware rilasciato nel 2006', 0, 10, 7, 7),
(172, '', '', '', '0000-00-00', '0000-00-00', '', '', 0, 1, 8, 6),
(173, 'F4KE01568', '', 'CP-AX3003', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 10, 8, 5),
(174, 'V6B7247', 'ASSEMBLY L1951p Wide Monitor', '2448HC6', '2010-08-23', '2013-08-22', 'Mon16', '', 0, 11, 4, 1),
(175, 'CZC1231L0L', 'HP Compaq 8100 Elite CMT PC', 'AY031AV', '2011-06-09', '2014-07-08', 'HP Tower 4/ client8872', '', 0, 11, 1, 4),
(176, 'XEY0134918', 'FS-3920DN', 'FS-3920DN', '0000-00-00', '0000-00-00', 'Aula36BN26', '', 0, 11, 7, 7),
(177, '', '', '', '0000-00-00', '0000-00-00', '', '', 0, 11, 8, 6),
(178, 'F4KE015669', '', 'CP-AX3003', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 11, 8, 5),
(179, 'CZC2197H2P', 'HP Compaq 8200 Elite CMT PC', 'XL508AV', '2041-04-03', '0000-00-00', 'client8875', '', 0, 12, 1, 4),
(180, 'VLAGD42', 'ASSEMBLY L171P-9417 Monitor', '4439HB2', '0000-00-00', '0000-00-00', 'mon28', '', 0, 12, 4, 1),
(181, 'NUM2Z12797', 'FS-4100', 'FS-4100', '0000-00-00', '0000-00-00', 'aula37bn20', '', 0, 12, 7, 7),
(182, '', 'StarBoard', '', '0000-00-00', '0000-00-00', '', '', 0, 12, 8, 6),
(183, '', '', 'CP-A301N', '0000-00-00', '0000-00-00', '', 'beamer della LIM', 0, 12, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `MacAdress`
--

CREATE TABLE `MacAdress` (
  `idMacAdress` int(11) NOT NULL,
  `macadress` varchar(45) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `dispositivi_idDispositivi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MacAdress`
--

INSERT INTO `MacAdress` (`idMacAdress`, `macadress`, `note`, `dispositivi_idDispositivi`) VALUES
(39, '2c:27:d7:24:07:59', 'LAN', 26),
(40, '2c:27:d7:20:61:91', 'LAN', 35);

-- --------------------------------------------------------

--
-- Table structure for table `Marca`
--

CREATE TABLE `Marca` (
  `idMarca` int(11) NOT NULL,
  `marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Marca`
--

INSERT INTO `Marca` (`idMarca`, `marca`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'Epson'),
(4, 'Lenovo'),
(5, 'Logitech'),
(6, 'Asus'),
(7, 'Kyocera'),
(8, 'Hitachi'),
(9, 'Zyxel'),
(10, 'Compaq'),
(11, 'Synology'),
(12, 'SHARP'),
(13, 'QNAP'),
(14, 'IBM'),
(15, 'EIZO'),
(16, 'Acer');

-- --------------------------------------------------------

--
-- Table structure for table `Registro_accessi`
--

CREATE TABLE `Registro_accessi` (
  `idRegistro_accessi` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `Accesso_idAccesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Registro_accessi`
--

INSERT INTO `Registro_accessi` (`idRegistro_accessi`, `data`, `Accesso_idAccesso`) VALUES
(1, '2017-04-07 15:48:42', 1),
(2, '2017-04-07 16:05:02', 1),
(3, '2017-04-10 09:50:46', 1),
(4, '2017-04-10 10:20:05', 1),
(5, '2017-04-11 07:53:23', 1),
(6, '2017-04-11 09:15:31', 1),
(7, '2017-04-11 09:37:16', 1),
(8, '2017-04-11 10:46:10', 1),
(9, '2017-04-11 10:48:26', 1),
(10, '2017-04-11 10:49:07', 1),
(11, '2017-04-11 10:49:26', 1),
(12, '2017-04-11 10:50:07', 1),
(13, '2017-04-11 11:21:41', 1),
(14, '2017-04-11 11:22:14', 1),
(15, '2017-04-11 11:22:34', 1),
(16, '2017-04-11 13:01:32', 1),
(17, '2017-04-11 13:07:16', 1),
(18, '2017-04-11 13:09:00', 1),
(19, '2017-04-11 13:11:07', 1),
(20, '2017-04-11 13:12:35', 1),
(21, '2017-04-11 14:11:31', 1),
(22, '2017-04-11 14:18:39', 1),
(23, '2017-04-11 14:31:51', 1),
(24, '2017-04-11 14:32:02', 1),
(25, '2017-04-11 15:41:41', 1),
(26, '2017-04-12 08:16:02', 1),
(27, '2017-04-12 13:18:34', 1),
(28, '2017-04-12 13:28:18', 1),
(29, '2017-04-12 14:44:08', 1),
(30, '2017-04-12 14:52:54', 1),
(31, '2017-04-12 16:33:57', 1),
(32, '2017-04-12 16:34:10', 1),
(33, '2017-04-13 09:14:08', 1),
(34, '2017-04-13 09:15:46', 1),
(35, '2017-04-13 09:23:17', 1),
(36, '2017-04-13 10:17:59', 1),
(37, '2017-04-13 10:18:24', 1),
(38, '2017-04-13 13:03:15', 1),
(39, '2017-04-13 14:18:42', 1),
(40, '2017-04-13 14:34:05', 1),
(41, '2017-04-13 14:34:15', 1),
(42, '2017-04-13 14:34:24', 1),
(43, '2017-04-13 14:37:22', 1),
(44, '2017-04-13 20:21:06', 1),
(45, '2017-04-14 09:08:11', 1),
(46, '2017-04-14 09:08:21', 1),
(47, '2017-04-14 09:11:45', 1),
(48, '2017-04-14 11:16:55', 1),
(49, '2017-04-14 11:28:13', 1),
(50, '2017-04-14 12:53:22', 1),
(51, '2017-05-09 12:04:58', 1),
(52, '2017-05-09 12:05:21', 1),
(53, '2017-05-09 13:03:09', 1),
(54, '2017-05-09 13:17:10', 1),
(55, '2017-05-09 13:17:19', 1),
(56, '2017-05-09 13:17:25', 1),
(57, '2017-05-09 13:18:21', 1),
(58, '2017-05-09 13:18:29', 1),
(59, '2017-05-09 13:25:47', 1),
(60, '2017-05-09 13:25:52', 1),
(61, '2017-05-09 13:32:55', 1),
(62, '2017-05-09 13:37:17', 1),
(63, '2017-05-09 13:37:23', 1),
(64, '2017-05-09 13:46:36', 1),
(65, '2017-05-09 18:28:42', 1),
(66, '2017-05-10 12:42:44', 1),
(67, '2017-05-10 12:53:42', 1),
(68, '2017-05-10 13:36:16', 1),
(69, '2017-05-16 09:13:27', 1),
(70, '2017-05-16 09:14:26', 1),
(71, '2017-05-16 11:36:53', 1),
(72, '2017-05-16 13:10:28', 1),
(73, '2017-05-16 13:37:44', 1),
(74, '2017-05-16 15:39:15', 1),
(75, '2017-05-17 08:06:22', 1),
(76, '2017-05-17 09:33:20', 1),
(77, '2017-05-17 12:29:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `RichiesteScan`
--

CREATE TABLE `RichiesteScan` (
  `idRichiesteScan` int(11) NOT NULL,
  `key` varchar(45) NOT NULL,
  `data` datetime NOT NULL,
  `nome_cognome` varchar(45) NOT NULL,
  `versione_software` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RichiesteScan`
--

INSERT INTO `RichiesteScan` (`idRichiesteScan`, `key`, `data`, `nome_cognome`, `versione_software`, `ip`) VALUES
(1, 'auto', '0000-00-00 00:00:00', 'auto', NULL, NULL),
(2, '57fba5e2', '2016-04-05 00:00:00', 'samuel.martins', NULL, NULL),
(3, '67fba5e2', '2016-04-05 00:00:00', 'samuel.martins', NULL, NULL),
(4, '2c78f9f2', '2017-04-05 12:57:26', 'samuel.martins', 'Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0', '127.0.0.1'),
(5, '55f014d7', '2017-04-05 13:07:13', 'Mika.Doninelli', 'Mozilla/5.0 (Linux; Android 7.0; SM-G935F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.132 Mobile Safari/537.36', '192.168.43.67'),
(6, 'c8061624', '2017-04-06 07:55:27', 'Samuel.Samuel', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_2_1 like Mac OS X) AppleWebKit/602.4.6 (KHTML, like Gecko) Version/10.0 Mobile/14D27 Safari/602.1', '192.168.43.19'),
(7, '2d406d81', '2017-04-06 08:33:32', 'Mika.Doninelli', 'Mozilla/5.0 (Linux; Android 7.0; SM-G935F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.132 Mobile Safari/537.36', '192.168.43.67'),
(8, 'ee99b583', '2017-04-07 16:07:42', 'samuel.martins', 'Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0', '127.0.0.1'),
(9, 'ee99b583394641e5c48be2388c0c949c', '2017-04-07 16:49:23', 'samuel.martins', 'Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0', '127.0.0.1'),
(10, 'c33214b508fad187dbb461e6fd9b5451', '2017-04-11 07:53:01', 'samuel.martins', 'Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0', '127.0.0.1'),
(11, '3c1fe83ba9afa7865662c1e6835254f4', '2017-04-11 09:36:13', 'Samuel.Martins', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(12, '3c1fe83ba9afa7865662c1e6835254f4', '2017-04-11 09:36:51', 'Samu>el\\\'.Martins', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(13, '3c1fe83ba9afa7865662c1e6835254f4', '2017-04-11 14:11:19', 'samuel.martins', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(14, '1d8e6f3fe54a41f1fd2709029aca4559', '2017-04-12 13:24:22', 'samuel.martins', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(15, 'c2b779a31c3048a3a0b49b3d02c42add', '2017-04-12 14:45:39', 'Samuel.Martins', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_2_1 like Mac OS X) AppleWebKit/602.4.6 (KHTML, like Gecko) Version/10.0 Mobile/14D27 Safari/602.1', '192.168.43.19'),
(16, '1d8e6f3fe54a41f1fd2709029aca4559', '2017-04-12 14:48:45', 'samuel.sa', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(17, '1d8e6f3fe54a41f1fd2709029aca4559', '2017-04-12 14:51:29', 'samuel.sa', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '127.0.0.1'),
(18, 'c2b779a31c3048a3a0b49b3d02c42add', '2017-04-12 16:11:54', 'Sa.Ah', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_2_1 like Mac OS X) AppleWebKit/602.4.6 (KHTML, like Gecko) Version/10.0 Mobile/14D27 Safari/602.1', '192.168.43.19'),
(19, 'ec568f7f388872fe64a7241960626daa', '2017-04-13 09:21:29', 'Samuel.Martins', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', '178.197.227.230'),
(20, '74c0f4d974af4f722d83f154e2153ef7', '2017-04-13 14:38:48', 'marca.carta', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', '178.197.227.230'),
(21, '9a9fcbe3a68c81d4cd71febf5232cb4a', '2017-04-13 20:21:46', 'Ans.Jeu', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', '178.197.232.166'),
(22, '1fb729d370f3e93671c61b9848213d9d', '2017-04-14 11:14:37', 'Samuel.Martins', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', '178.197.232.166');

-- --------------------------------------------------------

--
-- Table structure for table `Tipo`
--

CREATE TABLE `Tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Tipo`
--

INSERT INTO `Tipo` (`idTipo`, `tipo`) VALUES
(1, 'Monitor'),
(2, 'Desktop'),
(3, 'Server'),
(4, 'Tower'),
(5, 'Beamer'),
(6, 'Lavagna multimediale'),
(7, 'Stampante'),
(8, 'NAS'),
(9, 'all-in-one'),
(10, 'portatile'),
(11, 'Scanner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accesso`
--
ALTER TABLE `Accesso`
  ADD PRIMARY KEY (`idAccesso`);

--
-- Indexes for table `Aula`
--
ALTER TABLE `Aula`
  ADD PRIMARY KEY (`idAula`);

--
-- Indexes for table `Consentiti`
--
ALTER TABLE `Consentiti`
  ADD PRIMARY KEY (`idConsentiti`),
  ADD KEY `fk_Consentiti_RichiesteScan1_idx` (`RichiesteScan_idRichiesteScan`);

--
-- Indexes for table `controllo`
--
ALTER TABLE `controllo`
  ADD PRIMARY KEY (`idControllo`),
  ADD KEY `fk_ultimo controllo_pc1_idx` (`Dispositivi_idDispositivi`),
  ADD KEY `fk_controllo_Consentiti1_idx` (`Consentiti_idConsentiti`);

--
-- Indexes for table `Dispositivi`
--
ALTER TABLE `Dispositivi`
  ADD PRIMARY KEY (`idDispositivi`),
  ADD KEY `fk_dispositivi_Aula_idx` (`Aula_idAula`),
  ADD KEY `fk_dispositivi_Marca1_idx` (`Marca_idMarca`),
  ADD KEY `fk_dispositivi_Tipo1_idx` (`Tipo_idTipo`);

--
-- Indexes for table `MacAdress`
--
ALTER TABLE `MacAdress`
  ADD PRIMARY KEY (`idMacAdress`),
  ADD KEY `fk_MacAdress_dispositivi1_idx` (`dispositivi_idDispositivi`);

--
-- Indexes for table `Marca`
--
ALTER TABLE `Marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indexes for table `Registro_accessi`
--
ALTER TABLE `Registro_accessi`
  ADD PRIMARY KEY (`idRegistro_accessi`),
  ADD KEY `fk_table1_Accesso1_idx` (`Accesso_idAccesso`);

--
-- Indexes for table `RichiesteScan`
--
ALTER TABLE `RichiesteScan`
  ADD PRIMARY KEY (`idRichiesteScan`);

--
-- Indexes for table `Tipo`
--
ALTER TABLE `Tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accesso`
--
ALTER TABLE `Accesso`
  MODIFY `idAccesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Aula`
--
ALTER TABLE `Aula`
  MODIFY `idAula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `Consentiti`
--
ALTER TABLE `Consentiti`
  MODIFY `idConsentiti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `controllo`
--
ALTER TABLE `controllo`
  MODIFY `idControllo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT for table `Dispositivi`
--
ALTER TABLE `Dispositivi`
  MODIFY `idDispositivi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT for table `MacAdress`
--
ALTER TABLE `MacAdress`
  MODIFY `idMacAdress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `Marca`
--
ALTER TABLE `Marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Registro_accessi`
--
ALTER TABLE `Registro_accessi`
  MODIFY `idRegistro_accessi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `RichiesteScan`
--
ALTER TABLE `RichiesteScan`
  MODIFY `idRichiesteScan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `Tipo`
--
ALTER TABLE `Tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Consentiti`
--
ALTER TABLE `Consentiti`
  ADD CONSTRAINT `fk_Consentiti_RichiesteScan1` FOREIGN KEY (`RichiesteScan_idRichiesteScan`) REFERENCES `RichiesteScan` (`idRichiesteScan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `controllo`
--
ALTER TABLE `controllo`
  ADD CONSTRAINT `fk_controllo_Consentiti1` FOREIGN KEY (`Consentiti_idConsentiti`) REFERENCES `Consentiti` (`idConsentiti`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ultimo controllo_pc1` FOREIGN KEY (`Dispositivi_idDispositivi`) REFERENCES `Dispositivi` (`idDispositivi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Dispositivi`
--
ALTER TABLE `Dispositivi`
  ADD CONSTRAINT `fk_dispositivi_Aula` FOREIGN KEY (`Aula_idAula`) REFERENCES `Aula` (`idAula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dispositivi_Marca1` FOREIGN KEY (`Marca_idMarca`) REFERENCES `Marca` (`idMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dispositivi_Tipo1` FOREIGN KEY (`Tipo_idTipo`) REFERENCES `Tipo` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MacAdress`
--
ALTER TABLE `MacAdress`
  ADD CONSTRAINT `fk_MacAdress_dispositivi1` FOREIGN KEY (`dispositivi_idDispositivi`) REFERENCES `Dispositivi` (`idDispositivi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Registro_accessi`
--
ALTER TABLE `Registro_accessi`
  ADD CONSTRAINT `fk_table1_Accesso1` FOREIGN KEY (`Accesso_idAccesso`) REFERENCES `Accesso` (`idAccesso`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
