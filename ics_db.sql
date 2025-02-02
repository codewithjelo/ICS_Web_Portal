-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 25, 2024 at 05:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `user_password`, `role_id`) VALUES
('100000000001', '$2y$10$BhMG8S84gjHmebYEbZ9AQuaXDHvLZLLGyAJDz4tauSJzeeRuoq4Xe', 1),
('100000000002', '$2y$10$RplFkgdfGN9D43VHZana8OKogH1j9tOSFnF0S/aCBPg0qvcbepaOC', 1),
('100000000003', '$2y$10$CjzhnQkWem5Qbz/bMtsO8.mtUI37qpMKXjFwd.KXMf.Ug93uVGNMy', 1),
('100000000004', '$2y$10$aQppQqkupyVgsgG0SC./I.v1LdhUCba9N1qib28VqRLw7hergbuOS', 1),
('100000000005', '$2y$10$MRcbDqKsDt2INcS71pd1veFWfABnICthbD2hPmiZvk031pP7upU96', 1),
('100000000006', '$2y$10$6FKuim6pxUAHw4I3qNP9uOMd9mMV.VvOfKNIkOo74m9lathq2t3Nu', 1),
('100000000007', '$2y$10$pjwaMjodXZomKybnuHzvCOYnfvmf3bIDO.UM4jJz2Btq4GNMh0R/2', 1),
('100000000008', '$2y$10$/o9m.2OmvJ/KXlVM6yH86e0e2CDPfnAMLukohMkMg.6odFkTLEFnO', 1),
('100000000009', '$2y$10$FLOJzeJc2jBUnkh1zjApI.fQgNevOrFxGZ7tNsF7XaKPr9x1Do3Zq', 1),
('100000000010', '$2y$10$dUlE9tklddCbBx1cuPB5qOh0LA.hb21fqDw/1/PJSmEDUZiIfP9Jm', 1),
('100000000011', '$2y$10$zPos4pYcQh5c0hFcPN5DbuDljpkuxnxmQHhpoS4t7QccromFCma9K', 1),
('100000000012', '$2y$10$YQ90Nd/0bkBM4JforGNXHu8m9CFLb27H.3SogYJ/b5nm3hNWPuzXK', 1),
('100000000013', '$2y$10$vk3lkKTwWTWR0/i1xsy3meNPNt8F2fEzzvAjNt./BhS81MG6Nt6ou', 1),
('100000000014', '$2y$10$okIqUHL2lO/4CF7wh8.YSuZNb12bxmgAVLPCyCwbQuglLENooBVf2', 1),
('100000000015', '$2y$10$dePjILm2lDxfVKjT.lwHPeisv44HflBLu4iPlHT/REj/s116PNmZe', 1),
('100000000016', '$2y$10$ABSC6Rgat7FcJg3oplasnuFrNOGVxhbJn.QCQqCWAZoAaAgyLD99.', 1),
('100000000017', '$2y$10$aqTHCo8VrzkpzEN8isbaa.YK3pB783tGtf8wivhiZscm2EqgujntS', 1),
('100000000018', '$2y$10$sgFadQ6gs36KlFfvvAWduex0hJ5bX0/Zjj1O2DbDTFnh/3U48jKoW', 1),
('100000000019', '$2y$10$uZiNHcmeR4J0Mbaby/7I2eiHISAEbtBTCwVsFaIhPC62fURyISQFG', 1),
('100000000020', '$2y$10$bu/n/gi2pXhhNEz5F7.es.d9uoMuf9dQlhwAKL.GyWtVENr8meqvi', 1),
('100000000021', '$2y$10$cvvsf5A5EPay8ICZkU.7Iuzskq9DtA9AtFlowZikk3xzG2PZiCqsm', 1),
('100000000022', '$2y$10$zKu/MOEpYcPLCbrHmNWer.uLmM6uaETkd5ncwo3HatLlSr/5gzNja', 1),
('100000000023', '$2y$10$jwV6iCE3ucGdtUR.WWVkmOJ5AP8f6u4uTrdC1.7Mn5YpFvGGyxytu', 1),
('100000000024', '$2y$10$fY.jzQ3Vs1MeGv6VymrhXOTy9GrA98FvvsPT7hdEbf505Few2a4Nq', 1),
('100000000025', '$2y$10$xX7LmRkYh9f6TyoT408dHekskSqH9XvPLXiKWL.G9vu4QD.GTiOPC', 1),
('100000000026', '$2y$10$sBHanhwxh0aeC55ea7UWuOluaQzo64uybZ0jGYnsc/IzwByuNdNhC', 1),
('100000000027', '$2y$10$pgX/HddPugKuoSpfEpiPh.WaBKtRRzTolWyZ7HGDi/tsTuFQA5ZXm', 1),
('100000000028', '$2y$10$zZUltvElh35GJF.e35PUE.YQt0rMVWgxbClGl.DiD7cgBWF7ep8gO', 1),
('100000000029', '$2y$10$8dypi4iFnHg3IPfL1QzV0OUPXA9Lc7fgc8E.pahdCu8UMw4Wiyb/O', 1),
('100000000030', '$2y$10$ZF9dMZR//UzQmy4glWsHxOASyNbDtWGaNVS8NbGviMMt/PkXp677W', 1),
('100000000031', '$2y$10$YShVS6aTyueEBQX4D6fp8OMjxc8d8EIKIf9XC/Fy5E5YJyH6bllUq', 1),
('100000000032', '$2y$10$cNkpVLIj8NVETJ/NTTX9NeUvC/B0pHqfT6e7WLchMI8BgREvwGKqW', 1),
('100000000033', '$2y$10$vkgPPKcLQIanaovkGpCxfepRFpW9roYob.pnorBNUPH0qCpxmbhLy', 1),
('100000000034', '$2y$10$w//W6l1Qo.OSAzENZWxJoOJSofoNXRMuutqIyt1hdJsid49nxjRKW', 1),
('100000000035', '$2y$10$UoHgYK9eTOG3Sx44r8gFo.c66u8SwSJXC6Zuqn1sXIjxNorVsnrwe', 1),
('100000000036', '$2y$10$FOlOYIVAbAXc2LjY6D/PReGKrfN0pTQAL.NrbWt4z7DnnZxMGCavC', 1),
('100000000037', '$2y$10$arRbVVLHwjqYYh/En16wLeOLwB7Rg2JtWohQGROOJeFdn8DSiYgqe', 1),
('100000000038', '$2y$10$2tP6W9z70JauT5qpWux.gOo.ZnWDHFmuUZ5p8xP/HhiV7YUo9LSgK', 1),
('100000000039', '$2y$10$SWFJMj.6GKYgfb4ZAbxG6eAvsUt20lN3iBcJKeyoZq93pspHPCE8m', 1),
('100000000040', '$2y$10$7dihSO0h8nNvgPzJ4Fe6HuCHyLoPLHw.Xs.WZB4WBj6B92YP6SGBm', 1),
('100000000041', '$2y$10$YVOBrFzVFMfdmIWG5gAXzubN5zZTL4EQoqJ0crUjF0pL3OAFqwFBi', 1),
('100000000042', '$2y$10$gvzAcatf4E2E8b0z06pQf.W.wsx4hknvNauTxT4WTLVUehACsUU1e', 1),
('100000000043', '$2y$10$0oAFEgqehkYfPbMw/Bm3WucvcBxmZ5ZP59so764S7zQO77GI2vi2S', 1),
('100000000044', '$2y$10$UWEm.fyw2uM7wsxPMt1/F.2sxF2WLGABQg8r.jNyyWN/WqZrJujvC', 1),
('100000000045', '$2y$10$xsjOtbZfVzvj1DntnrDea./tK.AndIdGakLtAebyWEdp9z3ndMmm2', 1),
('100000000046', '$2y$10$6EB1Xby5rhY6xmaSLX2jKuEvTypU2fn2OK9JCghbqB/lbJk9pzgoe', 1),
('100000000047', '$2y$10$E40L3s/FnG6wSj7RdJeji.zUTeGvTtbfToFqBiwnDGACafmTHKc3.', 1),
('100000000048', '$2y$10$UJwlioS8V/FIGSwuF5kpFupjxMTqevQIM7dh3xMMyYLQubHcKoDJK', 1),
('100000000049', '$2y$10$1bsAlz5wzZPxWp2hzJloGuyB79izFqVK.zdNmoKHaDJNxVPfOZd8K', 1),
('100000000050', '$2y$10$Sh5bOn17JSvxlwxjKyXzKub7DpDVaLa/UWt8RCMlI566HbCX33gdq', 1),
('100000000051', '$2y$10$/Br9tmCAg4ldUeARw.5VOOiKgXb1omx1PdlXAQx4/0lQ8g1BlhKAi', 1),
('100000000052', '$2y$10$eaIG5BuU97THViwXq7xy8elisu0oeO2zUdfXmbggRXhi8HnSPWZ/S', 1),
('100000000053', '$2y$10$gIOgEQc8nUtR3uy0UXmsB.t.sJ5uwhbVN.K7VgAeGBFvrHUkZFuOa', 1),
('100000000054', '$2y$10$BeHlvQ9V31LLAbN4VQ39cOUtts1.Kd6M2TAjS4uneqTybZupiiI8e', 1),
('100000000060', '$2y$10$1E3j2C0Bnf3FZx.C96avWugTizRt5TbAXeN3Lb8b6kpGPFVtyAuAm', 1),
('123123123123', '$2y$10$uHATFlgEySn9SqUhlxRs.OyxHawMWDntVRvgk6cGSUMCnsH2EpSrm', 1),
('ICS-GUI4001', '$2y$10$6uIqfq6B2ERsVCcyK5Co4.yv7Wx0iB8DNrv35HHLq1pfcY1/9gKL2', 4),
('ICS-PDO6001', '$2y$10$7MqZFzFhjaY6yVOaRmPV9.3Dj8kvbuFqNh472hWAZ64Jb/i1BDuLS', 6),
('ICS-PRI5001', '$2y$10$QKNp82g47r0oFSx5oqLUve1ZOnrdFa26jhMV24kaoaO/e3Owp26rC', 5),
('ICS-TCH3001', '$2y$10$4sotJRcLVZg7xI1EJQzvWefgIIAjAlt7Kw2K7/7ceyAaDawZ27GHO', 3),
('ICS-TCH3002', '$2y$10$mZG81yqcD9csKnDlhnmxIOVVg8tSDdbJRLmKq6TcjIIcN0oRHmmNm', 3),
('ICS-TCH3003', '$2y$10$Zp6bPOTMxyNQjDft2wr7Qu3Zy86.egxp47RHetTyEi5FI7ShTgtAS', 3),
('ICS-TCH3004', '$2y$10$QCcJdujOHF4crENg9i/dEepp2amjjm5o38ZjCxRopTlAamy9jP4xi', 3),
('ICS-TCH3005', '$2y$10$c60lc9sm2z3xrcrmOFrjk.V/IUORvtuuWVuz.2g75PHau1G6TSjha', 3),
('ICS-TCH3006', '$2y$10$Du6wOwYMyQ83X97W64OHtuGOAelIRE6md2KqvoPygXIWLah.Mm1ge', 3),
('ICS-TCH3007', '$2y$10$vDgq3Nq0NAwVfAaZuT.PYexJ0Dy6EhN.InlrYJGvwhDHLh3f2SA0W', 3),
('ICS-TCH3008', '$2y$10$6PaHkHFIs3gqqeddt.svHO1v9bRwZuM79oSnP7bZPgI5G7XUoRTOO', 3),
('ICS-TCH3009', '$2y$10$YNfMLgovsTLjFBJe.Kad6eEPgiqCPEnNFrNwK9hjXIAnBsmlhNVQi', 3),
('ICS-TCH3010', '$2y$10$4iU1j0WlVZtSKyWtQW2kbevJ5wPViIYJ0TjsmAgX02hXOhUwQBABa', 3),
('ICS-TCH3011', '$2y$10$iG./1O7BUXgFJAeL5Jvrm.fvHuS2U5cajWwNsPzN/jJ5j5Lj0/1qS', 3),
('ICS-TCH3012', '$2y$10$KX.brFXCPfQogw2LFwxmTOkDtHptAuTVCqaC6z1ob.R1/5ByrpNPS', 3),
('ICS-TCH3013', '$2y$10$JpneWxzL2Ca1Dg4oT3TPNOWdwMmGd3WeqsBrl1uUJhRnDkI7KauKq', 3),
('ICS-TCH3014', '$2y$10$HfaZSdLZ0i.7JTL0aRv5je7sAyiUztoAmOOfRRcYlbzIdzYYcr4dO', 3),
('ICS-TCH3015', '$2y$10$WBI8iBq4egCBBTzcM4ye0Ol5gh.Apdg/xLeo2S3853j7mG0B.RZZW', 3),
('ICS-TCH3016', '$2y$10$4V3fkM7SWT9iXHPpz7BAzuF7OOsBSQFYE3vU8mP1nygoDfplCPTBi', 3),
('ICS-TCH3017', '$2y$10$yFBsfhPlwTOU0FSPzq0Pq.i/s05HD9rLl/sgXtxeU4aL1bk4o3ZCy', 3),
('ICS-TCH3018', '$2y$10$siBq0djeirXKtMCABudr5.CcAnx4QJEGwXgv001bdwJtgnrGd0huW', 3);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `announcement_text` text NOT NULL,
  `announcement_file` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `full_name` varchar(100) NOT NULL,
  `rank_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `class_schedule_id` int(11) NOT NULL,
  `class_time` varchar(10) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`class_schedule_id`, `class_time`, `subject_name`, `weekday`, `section_id`) VALUES
(31, '9:00 AM', 'Math', 'Monday', 31),
(32, '9:00 AM', 'Science', 'Tuesday', 31),
(33, '9:00 AM', 'History', 'Wednesday', 31),
(34, '9:00 AM', 'Literature', 'Thursday', 31),
(35, '9:00 AM', 'Art', 'Friday', 31),
(36, '10:00 AM', 'Chemistry', 'Monday', 31),
(37, '10:00 AM', 'Math', 'Tuesday', 31),
(38, '10:00 AM', 'Science', 'Wednesday', 31),
(39, '10:00 AM', 'History', 'Thursday', 31),
(40, '10:00 AM', 'Literature', 'Friday', 31),
(41, '11:00 AM', 'English', 'Monday', 31),
(42, '11:00 AM', 'Chemistry', 'Tuesday', 31),
(43, '11:00 AM', 'Math', 'Wednesday', 31),
(44, '11:00 AM', 'Science', 'Thursday', 31),
(45, '11:00 AM', 'History', 'Friday', 31),
(46, '12:00 PM', 'Physics', 'Monday', 31),
(47, '12:00 PM', 'English', 'Tuesday', 31),
(48, '12:00 PM', 'Chemistry', 'Wednesday', 31),
(49, '12:00 PM', 'Math', 'Thursday', 31),
(50, '12:00 PM', 'Science', 'Friday', 31),
(51, '1:00 PM', 'Literature', 'Monday', 31),
(52, '1:00 PM', 'Physics', 'Tuesday', 31),
(53, '1:00 PM', 'English', 'Wednesday', 31),
(54, '1:00 PM', 'Chemistry', 'Thursday', 31),
(55, '1:00 PM', 'Math', 'Friday', 31),
(56, '2:00 PM', 'Music', 'Monday', 31),
(57, '2:00 PM', 'Literature', 'Tuesday', 31),
(58, '2:00 PM', 'Physics', 'Wednesday', 31),
(59, '2:00 PM', 'English', 'Thursday', 31),
(60, '2:00 PM', 'Chemistry', 'Friday', 31),
(121, '9:00 AM', 'Math', 'Monday', 22),
(122, '9:00 AM', 'Science', 'Tuesday', 22),
(123, '9:00 AM', 'History', 'Wednesday', 22),
(124, '9:00 AM', 'Literature', 'Thursday', 22),
(125, '9:00 AM', 'Art', 'Friday', 22),
(126, '10:00 AM', 'Chemistry', 'Monday', 22),
(127, '10:00 AM', 'Math', 'Tuesday', 22),
(128, '10:00 AM', 'Science', 'Wednesday', 22),
(129, '10:00 AM', 'History', 'Thursday', 22),
(130, '10:00 AM', 'Literature', 'Friday', 22),
(131, '11:00 AM', 'English', 'Monday', 22),
(132, '11:00 AM', 'Chemistry', 'Tuesday', 22),
(133, '11:00 AM', 'Math', 'Wednesday', 22),
(134, '11:00 AM', 'Science', 'Thursday', 22),
(135, '11:00 AM', 'History', 'Friday', 22),
(136, '12:00 PM', 'Physics', 'Monday', 22),
(137, '12:00 PM', 'English', 'Tuesday', 22),
(138, '12:00 PM', 'Chemistry', 'Wednesday', 22),
(139, '12:00 PM', 'Math', 'Thursday', 22),
(140, '12:00 PM', 'Science', 'Friday', 22),
(141, '1:00 PM', 'Literature', 'Monday', 22),
(142, '1:00 PM', 'Physics', 'Tuesday', 22),
(143, '1:00 PM', 'English', 'Wednesday', 22),
(144, '1:00 PM', 'Chemistry', 'Thursday', 22),
(145, '1:00 PM', 'Math', 'Friday', 22),
(146, '2:00 PM', 'Music', 'Monday', 22),
(147, '2:00 PM', 'Literature', 'Tuesday', 22),
(148, '2:00 PM', 'Physics', 'Wednesday', 22),
(149, '2:00 PM', 'English', 'Thursday', 22),
(150, '2:00 PM', 'Chemistry', 'Friday', 22),
(151, '9:00 AM', 'Math', 'Monday', 1),
(152, '9:00 AM', 'Science', 'Tuesday', 1),
(153, '9:00 AM', 'History', 'Wednesday', 1),
(154, '9:00 AM', 'Literature', 'Thursday', 1),
(155, '9:00 AM', 'Art', 'Friday', 1),
(156, '10:00 AM', 'Chemistry', 'Monday', 1),
(157, '10:00 AM', 'Math', 'Tuesday', 1),
(158, '10:00 AM', 'Science', 'Wednesday', 1),
(159, '10:00 AM', 'History', 'Thursday', 1),
(160, '10:00 AM', 'Literature', 'Friday', 1),
(161, '11:00 AM', 'English', 'Monday', 1),
(162, '11:00 AM', 'Chemistry', 'Tuesday', 1),
(163, '11:00 AM', 'Math', 'Wednesday', 1),
(164, '11:00 AM', 'Science', 'Thursday', 1),
(165, '11:00 AM', 'History', 'Friday', 1),
(166, '12:00 PM', 'Physics', 'Monday', 1),
(167, '12:00 PM', 'English', 'Tuesday', 1),
(168, '12:00 PM', 'Chemistry', 'Wednesday', 1),
(169, '12:00 PM', 'Math', 'Thursday', 1),
(170, '12:00 PM', 'Science', 'Friday', 1),
(171, '1:00 PM', 'Literature', 'Monday', 1),
(172, '1:00 PM', 'Physics', 'Tuesday', 1),
(173, '1:00 PM', 'English', 'Wednesday', 1),
(174, '1:00 PM', 'Chemistry', 'Thursday', 1),
(175, '1:00 PM', 'Math', 'Friday', 1),
(176, '2:00 PM', 'Music', 'Monday', 1),
(177, '2:00 PM', 'Literature', 'Tuesday', 1),
(178, '2:00 PM', 'Physics', 'Wednesday', 1),
(179, '2:00 PM', 'English', 'Thursday', 1),
(180, '2:00 PM', 'Chemistry', 'Friday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule_archive`
--

CREATE TABLE `class_schedule_archive` (
  `archive_schedule_id` int(11) NOT NULL,
  `class_time` varchar(10) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedule_archive`
--

INSERT INTO `class_schedule_archive` (`archive_schedule_id`, `class_time`, `subject_name`, `weekday`, `section_id`) VALUES
(31, '9:00 AM', 'Math', 'Monday', 22),
(32, '9:00 AM', 'Science', 'Tuesday', 22),
(33, '9:00 AM', 'History', 'Wednesday', 22),
(34, '9:00 AM', 'Literature', 'Thursday', 22),
(35, '9:00 AM', 'Art', 'Friday', 22),
(36, '10:00 AM', 'Chemistry', 'Monday', 22),
(37, '10:00 AM', 'Math', 'Tuesday', 22),
(38, '10:00 AM', 'Science', 'Wednesday', 22),
(39, '10:00 AM', 'History', 'Thursday', 22),
(40, '10:00 AM', 'Literature', 'Friday', 22),
(41, '11:00 AM', 'English', 'Monday', 22),
(42, '11:00 AM', 'Chemistry', 'Tuesday', 22),
(43, '11:00 AM', 'Math', 'Wednesday', 22),
(44, '11:00 AM', 'Science', 'Thursday', 22),
(45, '11:00 AM', 'History', 'Friday', 22),
(46, '12:00 PM', 'Physics', 'Monday', 22),
(47, '12:00 PM', 'English', 'Tuesday', 22),
(48, '12:00 PM', 'Chemistry', 'Wednesday', 22),
(49, '12:00 PM', 'Math', 'Thursday', 22),
(50, '12:00 PM', 'Science', 'Friday', 22),
(51, '1:00 PM', 'Literature', 'Monday', 22),
(52, '1:00 PM', 'Physics', 'Tuesday', 22),
(53, '1:00 PM', 'English', 'Wednesday', 22),
(54, '1:00 PM', 'Chemistry', 'Thursday', 22),
(55, '1:00 PM', 'Math', 'Friday', 22),
(56, '2:00 PM', 'Music', 'Monday', 22),
(57, '2:00 PM', 'Literature', 'Tuesday', 22),
(58, '2:00 PM', 'Physics', 'Wednesday', 22),
(59, '2:00 PM', 'English', 'Thursday', 22),
(60, '2:00 PM', 'Chemistry', 'Friday', 22),
(62, '9:00 AM', 'Math', 'Monday', 22),
(63, '9:00 AM', 'Science', 'Tuesday', 22),
(64, '9:00 AM', 'History', 'Wednesday', 22),
(65, '9:00 AM', 'Literature', 'Thursday', 22),
(66, '9:00 AM', 'Art', 'Friday', 22),
(67, '10:00 AM', 'Chemistry', 'Monday', 22),
(68, '10:00 AM', 'Math', 'Tuesday', 22),
(69, '10:00 AM', 'Science', 'Wednesday', 22),
(70, '10:00 AM', 'History', 'Thursday', 22),
(71, '10:00 AM', 'Literature', 'Friday', 22),
(72, '11:00 AM', 'English', 'Monday', 22),
(73, '11:00 AM', 'Chemistry', 'Tuesday', 22),
(74, '11:00 AM', 'Math', 'Wednesday', 22),
(75, '11:00 AM', 'Science', 'Thursday', 22),
(76, '11:00 AM', 'History', 'Friday', 22),
(77, '12:00 PM', 'Physics', 'Monday', 22),
(78, '12:00 PM', 'English', 'Tuesday', 22),
(79, '12:00 PM', 'Chemistry', 'Wednesday', 22),
(80, '12:00 PM', 'Math', 'Thursday', 22),
(81, '12:00 PM', 'Science', 'Friday', 22),
(82, '1:00 PM', 'Literature', 'Monday', 22),
(83, '1:00 PM', 'Physics', 'Tuesday', 22),
(84, '1:00 PM', 'English', 'Wednesday', 22),
(85, '1:00 PM', 'Chemistry', 'Thursday', 22),
(86, '1:00 PM', 'Math', 'Friday', 22),
(87, '2:00 PM', 'Music', 'Monday', 22),
(88, '2:00 PM', 'Literature', 'Tuesday', 22),
(89, '2:00 PM', 'Physics', 'Wednesday', 22),
(90, '2:00 PM', 'English', 'Thursday', 22),
(91, '2:00 PM', 'Chemistry', 'Friday', 22),
(93, '9:00 AM', 'Math', 'Monday', 1),
(94, '9:00 AM', 'Science', 'Tuesday', 1),
(95, '9:00 AM', 'History', 'Wednesday', 1),
(96, '9:00 AM', 'Literature', 'Thursday', 1),
(97, '9:00 AM', 'Art', 'Friday', 1),
(98, '10:00 AM', 'Chemistry', 'Monday', 1),
(99, '10:00 AM', 'Math', 'Tuesday', 1),
(100, '10:00 AM', 'Science', 'Wednesday', 1),
(101, '10:00 AM', 'History', 'Thursday', 1),
(102, '10:00 AM', 'Literature', 'Friday', 1),
(103, '11:00 AM', 'English', 'Monday', 1),
(104, '11:00 AM', 'Chemistry', 'Tuesday', 1),
(105, '11:00 AM', 'Math', 'Wednesday', 1),
(106, '11:00 AM', 'Science', 'Thursday', 1),
(107, '11:00 AM', 'History', 'Friday', 1),
(108, '12:00 PM', 'Physics', 'Monday', 1),
(109, '12:00 PM', 'English', 'Tuesday', 1),
(110, '12:00 PM', 'Chemistry', 'Wednesday', 1),
(111, '12:00 PM', 'Math', 'Thursday', 1),
(112, '12:00 PM', 'Science', 'Friday', 1),
(113, '1:00 PM', 'Literature', 'Monday', 1),
(114, '1:00 PM', 'Physics', 'Tuesday', 1),
(115, '1:00 PM', 'English', 'Wednesday', 1),
(116, '1:00 PM', 'Chemistry', 'Thursday', 1),
(117, '1:00 PM', 'Math', 'Friday', 1),
(118, '2:00 PM', 'Music', 'Monday', 1),
(119, '2:00 PM', 'Literature', 'Tuesday', 1),
(120, '2:00 PM', 'Physics', 'Wednesday', 1),
(121, '2:00 PM', 'English', 'Thursday', 1),
(122, '2:00 PM', 'Chemistry', 'Friday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `e_certificate`
--

CREATE TABLE `e_certificate` (
  `e_certificate_id` int(11) NOT NULL,
  `e_certificate` text NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_certificate`
--

INSERT INTO `e_certificate` (`e_certificate_id`, `e_certificate`, `full_name`, `student_id`, `teacher_id`, `section_id`) VALUES
(11, '../student_certificate/certyyy.jpg', 'Dela Cruz, Elena D.', 1006, 3001, 2),
(12, '../student_certificate/certyyy.jpg', 'Dela Cruz, Andres D.', 1003, 3001, 1),
(13, '../student_certificate/certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1),
(14, '../student_certificate/certyyy.jpg', 'Dela Cruz, Gabriel D.', 1009, 3001, 3),
(16, '../student_certificate/certyyy.jpg', 'Delos Reyes, Samuel D.', 1014, 3001, 5),
(18, '../student_certificate/certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1),
(19, '../student_certificate/6743708c284da_certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1),
(20, '../student_certificate/6743708c284da_certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1),
(21, '../student_certificate/6743708c284da_certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1),
(22, '../student_certificate/6743708c284da_certyyy.jpg', 'Dela Cruz, Luis D.', 1001, 3001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `academic_year` varchar(10) DEFAULT NULL,
  `first_quarter` decimal(5,2) DEFAULT NULL,
  `second_quarter` decimal(5,2) DEFAULT NULL,
  `third_quarter` decimal(5,2) DEFAULT NULL,
  `fourth_quarter` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `student_id`, `subject_id`, `section_id`, `teacher_id`, `academic_year`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter`) VALUES
(14, 1001, 1, 1, 3001, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(15, 1002, 1, 1, 3001, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(16, 1003, 1, 1, 3001, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(17, 1001, 1, 3, 3001, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(18, 1002, 1, 3, 3001, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(19, 1003, 1, 3, 3001, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(20, 1001, 1, 7, 3001, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(21, 1002, 1, 7, 3001, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(22, 1003, 1, 7, 3001, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(23, 1001, 1, 6, 3001, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(24, 1002, 1, 6, 3001, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(25, 1003, 1, 6, 3001, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(26, 1001, 1, 4, 3001, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(27, 1002, 1, 4, 3001, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(28, 1003, 1, 4, 3001, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(29, 1001, 2, 1, 3002, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(30, 1002, 2, 1, 3002, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(31, 1003, 2, 1, 3002, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(32, 1001, 3, 1, 3003, '2022-2023', 97.00, 96.00, 96.00, 95.00),
(33, 1002, 3, 1, 3003, '2022-2023', 94.00, 94.00, 93.00, 93.00),
(34, 1003, 3, 1, 3003, '2022-2023', 93.00, 94.00, 94.00, 94.00),
(35, 1001, 4, 1, 3004, '2022-2023', 97.00, 96.00, 96.00, 95.00),
(36, 1002, 4, 1, 3004, '2022-2023', 94.00, 94.00, 93.00, 93.00),
(37, 1003, 4, 1, 3004, '2022-2023', 93.00, 94.00, 94.00, 94.00),
(38, 1001, 5, 1, 3005, '2022-2023', 84.00, 86.00, 97.00, 94.00),
(39, 1002, 5, 1, 3005, '2022-2023', 85.00, 97.00, 90.00, 95.00),
(40, 1003, 5, 1, 3005, '2022-2023', 87.00, 77.00, 96.00, 90.00),
(41, 1031, 1, 1, 3001, '2021-2022', 88.92, 90.22, 92.21, 93.10),
(42, 1031, 2, 1, 3002, '2021-2022', 84.92, 91.22, 87.21, 89.10),
(43, 1031, 3, 1, 3003, '2021-2022', 92.92, 91.22, 97.21, 97.10),
(44, 1031, 4, 1, 3004, '2021-2022', 95.92, 89.22, 90.21, 93.10),
(45, 1031, 5, 1, 3005, '2021-2022', 94.92, 89.22, 87.21, 84.10),
(46, 1032, 1, 1, 3001, '2021-2022', 94.92, 89.22, 87.21, 84.10),
(47, 1032, 2, 1, 3002, '2021-2022', 92.92, 91.22, 97.21, 97.10),
(48, 1032, 3, 1, 3003, '2021-2022', 88.92, 90.22, 92.21, 93.10),
(49, 1032, 4, 1, 3004, '2021-2022', 84.92, 91.22, 87.21, 89.10),
(50, 1032, 5, 1, 3005, '2021-2022', 95.92, 89.22, 90.21, 93.10),
(51, 1033, 1, 1, 3001, '2021-2022', 94.92, 89.22, 87.21, 84.10),
(52, 1033, 2, 1, 3002, '2021-2022', 84.92, 91.22, 87.21, 89.10),
(53, 1033, 3, 1, 3003, '2021-2022', 92.92, 91.22, 97.21, 97.10),
(54, 1033, 4, 1, 3004, '2021-2022', 95.92, 89.22, 90.21, 93.10),
(55, 1033, 5, 1, 3005, '2021-2022', 88.92, 90.22, 92.21, 93.10);

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `grade_level_id` int(11) NOT NULL,
  `grade_level` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`grade_level_id`, `grade_level`) VALUES
(1, 'Kinder'),
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5'),
(7, '6');

-- --------------------------------------------------------

--
-- Table structure for table `guidance`
--

CREATE TABLE `guidance` (
  `guidance_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guidance`
--

INSERT INTO `guidance` (`guidance_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(4001, 'Alvin Jan Josef', 'Zara', 'Espino', 'alvinespino@gmail.com', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone_number`, `address`, `civil_status`, `role_id`) VALUES
(2001, 'Juan', 'Andres', 'Dela Cruz', 'juan.delacruz@example.com', '09123456789', 'Brgy. Batangas City, Batangas', 'Married', 2),
(2002, 'Maria', 'Santos', 'Reyes', 'maria.reyes@example.com', '09123456780', 'Brgy. San Jose, Batangas City', 'Married', 2),
(2003, 'Jose', 'Lopez', 'Flores', 'jose.flores@example.com', '09123456781', 'Brgy. Wawa, Batangas City', 'Married', 2),
(2004, 'Ana', 'Dela Torre', 'Mendoza', 'ana.mendoza@example.com', '09123456782', 'Brgy. Alangilan, Batangas City', 'Married', 2),
(2005, 'David', 'Mercado', 'Gonzalez', 'david.gonzalez@example.com', '09123456783', 'Brgy. San Luis, Batangas City', 'Married', 2),
(2006, 'Jessica', 'Luna', 'Torres', 'jessica.torres@example.com', '09123456784', 'Brgy. Pallocan, Batangas City', 'Married', 2),
(2007, 'Robert', 'Salvador', 'Bautista', 'robert.bautista@example.com', '09123456785', 'Brgy. Gulod, Batangas City', 'Married', 2),
(2008, 'Laura', 'Buenaventura', 'Aquino', 'laura.aquino@example.com', '09123456786', 'Brgy. Libjo, Batangas City', 'Married', 2),
(2009, 'James', 'Cabrera', 'Ramos', 'james.ramos@example.com', '09123456787', 'Brgy. Sta. Clara, Batangas City', 'Married', 2),
(2010, 'Linda', 'Garcia', 'Villanueva', 'linda.villanueva@example.com', '09123456788', 'Brgy. Balagtas, Batangas City', 'Married', 2),
(2011, 'Mark', 'Diaz', 'Delos Santos', 'mark.delossantos@example.com', '09123456789', 'Brgy. San Pascual, Batangas City', 'Married', 2),
(2012, 'Anna', 'Pascual', 'Gomez', 'anna.gomez@example.com', '09123456790', 'Brgy. Calicanto, Batangas City', 'Married', 2),
(2013, 'Brian', 'Manalang', 'Padilla', 'brian.padilla@example.com', '09123456791', 'Brgy. Concepcion, Batangas City', 'Married', 2),
(2014, 'Elizabeth', 'Soriano', 'Castro', 'elizabeth.castro@example.com', '09123456792', 'Brgy. San Carlos, Batangas City', 'Married', 2),
(2015, 'Steven', 'Navarro', 'Rivera', 'steven.rivera@example.com', '09123456793', 'Brgy. Loma, Batangas City', 'Married', 2),
(2016, 'Amy', 'Fernandez', 'Ortega', 'amy.ortega@example.com', '09123456794', 'Brgy. Mataasnakahoy, Batangas City', 'Married', 2),
(2017, 'Joshua', 'Marasigan', 'Lazaro', 'joshua.lazaro@example.com', '09123456795', 'Brgy. Sico, Batangas City', 'Married', 2),
(2018, 'Sophia', 'Ramos', 'Santiago', 'sophia.santiago@example.com', '09123456796', 'Brgy. Taal, Batangas City', 'Married', 2),
(2019, 'Carlos', 'Ocampo', 'Alvarez', 'carlos.alvarez@example.com', '09123456797', 'Brgy. Libis, Batangas City', 'Married', 2),
(2020, 'Rebecca', 'Ibarra', 'Cruz', 'rebecca.cruz@example.com', '09123456798', 'Brgy. Bagong Silang, Batangas City', 'Married', 2),
(2021, 'Michael', 'Cuenca', 'Bautista', 'michael.bautista@example.com', '09123456799', 'Brgy. Ilijan, Batangas City', 'Married', 2),
(2022, 'Nina', 'Llamas', 'Magsaysay', 'nina.magsaysay@example.com', '09123456800', 'Brgy. San Isidro, Batangas City', 'Married', 2),
(2023, 'Rafael', 'Velasco', 'Cordero', 'rafael.cordero@example.com', '09123456801', 'Brgy. San Antonio, Batangas City', 'Married', 2),
(2024, 'Julia', 'Alcantara', 'Morales', 'julia.morales@example.com', '09123456802', 'Brgy. Bolbok, Batangas City', 'Married', 2),
(2025, 'Pedro', 'Bacani', 'Diokno', 'pedro.diokno@example.com', '09123456803', 'Brgy. San Vicente, Batangas City', 'Married', 2),
(2026, 'Claudia', 'Cruz', 'Nieves', 'claudia.nieves@example.com', '09123456804', 'Brgy. Banay-Banay, Batangas City', 'Married', 2),
(2027, 'Victor', 'Estrada', 'Salvador', 'victor.salvador@example.com', '09123456805', 'Brgy. Malitam, Batangas City', 'Married', 2),
(2028, 'Isabel', 'Marquez', 'Paz', 'isabel.paz@example.com', '09123456806', 'Brgy. Marawoy, Batangas City', 'Married', 2),
(2029, 'Leo', 'Tan', 'Pascual', 'leo.pascual@example.com', '09123456807', 'Brgy. San Juan, Batangas City', 'Married', 2),
(2030, 'Carmen', 'Aguilar', 'Sison', 'carmen.sison@example.com', '09123456808', 'Brgy. Batangas, Batangas City', 'Married', 2),
(2031, 'Wendy', 'Bautista', 'Ferrer', 'wendy.ferrer@example.com', '09123456809', 'Brgy. Buli, Batangas City', 'Married', 2),
(2032, 'Evelyn', 'Lim', 'Pineda', 'evelyn.pineda@example.com', '09123456810', 'Brgy. Biga, Batangas City', 'Married', 2),
(2033, 'Ramon', 'Quinto', 'Toribio', 'ramon.toribio@example.com', '09123456811', 'Brgy. Lower Bicutan, Batangas City', 'Married', 2),
(2034, 'Ella', 'Rosales', 'Alfaro', 'ella.alfaro@example.com', '09123456812', 'Brgy. Banga, Batangas City', 'Married', 2),
(2035, 'Carlos', 'Rizal', 'Quintero', 'carlos.quintero@example.com', '09123456813', 'Brgy. San Miguel, Batangas City', 'Married', 2),
(2036, 'Nina', 'De Guzman', 'Guevarra', 'nina.guevarra@example.com', '09123456814', 'Brgy. Sitio Pook, Batangas City', 'Married', 2),
(2037, 'Marco', 'Manalo', 'Castro', 'marco.castro@example.com', '09123456815', 'Brgy. Brgy. 6, Batangas City', 'Married', 2),
(2038, 'Bela', 'Padua', 'Manalaysay', 'bela.manalaysay@example.com', '09123456816', 'Brgy. San Luis, Batangas City', 'Married', 2),
(2039, 'Lara', 'Almoite', 'Alcantara', 'lara.alcantara@example.com', '09123456817', 'Brgy. 11, Batangas City', 'Married', 2),
(2040, 'Gina', 'Dizon', 'Bongat', 'gina.bongat@example.com', '09123456818', 'Brgy. 4, Batangas City', 'Married', 2),
(2041, 'Henry', 'Cruz', 'Bilaro', 'henry.bilaro@example.com', '09123456819', 'Brgy. 2, Batangas City', 'Married', 2),
(2042, 'Daisy', 'Aguilar', 'Lalangan', 'daisy.lalangan@example.com', '09123456820', 'Brgy. 9, Batangas City', 'Married', 2),
(2043, 'Joey', 'Enriquez', 'Gamboa', 'joey.gamboa@example.com', '09123456821', 'Brgy. 10, Batangas City', 'Married', 2),
(2044, 'Flora', 'Resurreccion', 'Anacore', 'flora.anacore@example.com', '09123456822', 'Brgy. 3, Batangas City', 'Married', 2),
(2045, 'Tina', 'Sabino', 'Ocampo', 'tina.ocampo@example.com', '09123456823', 'Brgy. 1, Batangas City', 'Married', 2),
(2046, 'Henry', 'Soriano', 'De Vera', 'henry.devera@example.com', '09123456824', 'Brgy. 5, Batangas City', 'Married', 2),
(2047, 'Ronald', 'Ferrer', 'Manalo', 'ronald.manalo@example.com', '09123456825', 'Brgy. 8, Batangas City', 'Married', 2),
(2048, 'Christine', 'Bautista', 'Alvarado', 'christine.alvarado@example.com', '09123456826', 'Brgy. Manggahan, Batangas City', 'Married', 2),
(2049, 'Arnel', 'Riviera', 'Pablo', 'arnel.pablo@example.com', '09123456827', 'Brgy. Maricaban, Batangas City', 'Married', 2),
(2050, 'Sharon', 'Valdez', 'Delos Santos', 'sharon.delossantos@example.com', '09123456828', 'Brgy. As-Is, Batangas City', 'Married', 2),
(2051, 'Greg', 'Tan', 'Quezada', 'greg.quezada@example.com', '09123456829', 'Brgy. San Pedro, Batangas City', 'Married', 2),
(2052, 'Grace', 'Gonzalez', 'Martinez', 'grace.martinez@example.com', '09123456830', 'Brgy. Pook, Batangas City', 'Married', 2),
(2053, 'Ferdinand', 'Cruz', 'Alarcon', 'ferdinand.alarcon@example.com', '09123456831', 'Brgy. Santo Niño, Batangas City', 'Married', 2),
(2054, 'Angelica', 'Bautista', 'Pineda', 'angelica.pineda@example.com', '09123456832', 'Brgy. Tinga Labac, Batangas City', 'Married', 2),
(2055, 'Burnik', '', 'Panaligan', 'jannangelodimaano@gmail.com', '9454210467', 'Wawa, Batangas City', 'Married', 2),
(2056, 'sdadasda', '', 'sdadasdas', 'ken@gmail.com', '9319511199', 'san jose', 'Married', 2),
(2057, 'sdadasda', '', 'asdadsdad', 'ken@gmail.com', '9319511199', 'sanjose', 'Married', 2),
(2058, 'Janet', '', 'Dimaano', 'janetdimaano@gmail.com', '9454210467', '8 C. Tirona Street, Barangay 10, Batangas City, Batangas', 'Married', 2),
(2059, 'Angelo', '', 'Panaligan', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2),
(2060, 'Janet', '', 'Panaligan', 'jannangelodimaano@gmail.com', '09454210467', '', 'Married', 2),
(2061, 'Warlock', '', 'War', 'jannangelodimaano@gmail.com', '09454210467', '', 'Married', 2),
(2062, 'Selo', '', 'Panaligan', 'jannangelodimaano@gmail.com', '09454210467', '', 'Married', 2),
(2063, 'Janet', '', 'Dimaano', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2),
(2064, 'Janet', '', 'Maranan', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2),
(2065, 'Janet', '', 'Dimaano', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2),
(2066, 'Janet', '', 'Dimaano', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2),
(2067, 'Janet', '', 'Dimaano', 'jannangelodimaano@gmail.com', '9454210467', '', 'Married', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pdo`
--

CREATE TABLE `pdo` (
  `pdo_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdo`
--

INSERT INTO `pdo` (`pdo_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(6001, 'John', 'Zara', 'Smith', 'juan@gmail.com', 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(5001, 'Angelo', 'Quintano', 'Bartolome', 'bartolome_angelo@gmail.com', 5, 17);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`) VALUES
(1, 'Teacher I'),
(2, 'Teacher II'),
(3, 'Teacher III'),
(4, 'Teacher IV'),
(5, 'Teacher V'),
(6, 'Teacher VI'),
(7, 'Teacher VII'),
(8, 'Teacher VIII'),
(9, 'Master Teacher I'),
(10, 'Master Teacher II'),
(11, 'Master Teacher III'),
(12, 'Master Teacher IV'),
(13, 'Master Teacher V'),
(14, 'Principal I'),
(15, 'Principal II'),
(16, 'Principal III'),
(17, 'Principal IV'),
(18, 'Guidance Counselor'),
(19, 'Project Development Office');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Student'),
(2, 'Parent'),
(3, 'Teacher'),
(4, 'Guidance'),
(5, 'Principal'),
(6, 'PDO');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(7, 'dasdada', 'dadadacadaa', '2024-09-27 21:50:00', '2024-09-29 23:51:00'),
(8, 'dasdadadada', 'dadadacadaadasdad', '2024-09-27 21:50:00', '2024-09-29 23:51:00'),
(9, 'dasda', 'dasfasfxacac', '2024-09-23 22:15:00', '2024-09-23 12:15:00'),
(10, 'midterm_exam', 'bagsakan na', '2024-10-28 15:47:00', '2024-10-30 15:47:00'),
(11, 'VCT Champions', 'Valorant Tournament in Berlin', '2024-11-30 13:00:00', '2024-11-22 22:00:00'),
(12, 'Jelo', 'Jelo Event', '2024-11-06 09:00:00', '2024-11-06 10:00:00'),
(13, 'Hallo', 'Dimaano', '2024-11-07 09:00:00', '2024-11-08 10:00:00'),
(14, 'adsa', 'adsada', '2024-11-04 09:00:00', '2024-11-04 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `school_materials`
--

CREATE TABLE `school_materials` (
  `school_materials_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `school_materials` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_materials`
--

INSERT INTO `school_materials` (`school_materials_id`, `teacher_id`, `section_id`, `school_materials`) VALUES
(11, 3001, 3, '../school_materials/JANN ANGELO DIMAANO - Part-2-IT-414-MIDTERM-EXAMINATION.pdf'),
(12, 3001, 2, '../school_materials/ics_data.xlsx'),
(14, 3005, 4, '../school_materials/ics_data.xlsx'),
(15, 3001, 1, '../school_materials/Dimaano_Automated Testing Activity.pdf'),
(16, 3001, 1, '../school_materials/AIAS Reviewer.pdf'),
(17, 3001, 2, '../school_materials/Maranan-4103-AIAS-Exercises-Questionnaire.pdf'),
(18, 3001, 2, '../school_materials/AIAS Reviewer (2).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(100) DEFAULT NULL,
  `grade_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `grade_level_id`) VALUES
(1, 'Yellow', 1),
(2, 'White', 1),
(3, 'Violet', 1),
(4, 'Red', 1),
(5, 'Orange', 1),
(6, 'Green', 1),
(7, 'Blue', 1),
(8, 'Farkleberry', 2),
(9, 'Evergreen', 2),
(10, 'Dalandan', 2),
(11, 'Cherry', 2),
(12, 'Blueberry', 2),
(13, 'Apple', 2),
(14, 'Recto', 3),
(15, 'Malvar', 3),
(16, 'Mabini', 3),
(17, 'Laurel', 3),
(18, 'Kalaw', 3),
(19, 'Diokno', 3),
(20, 'Patience', 4),
(21, 'Love', 4),
(22, 'Hope', 4),
(23, 'Faith', 4),
(24, 'Courage', 4),
(25, 'Yakal', 5),
(26, 'Narra', 5),
(27, 'Molave', 5),
(28, 'Mahogany', 5),
(29, 'Iba', 5),
(30, 'Acacia', 5),
(31, 'Matthew', 6),
(32, 'Luke', 6),
(33, 'John', 6),
(34, 'James', 6),
(35, 'Mark', 6),
(36, 'Rose', 7),
(37, 'Sampaguita', 7),
(38, 'Orchid', 7),
(39, 'Camia', 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `lrn` bigint(12) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `current_status` varchar(20) NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `lrn`, `first_name`, `middle_name`, `last_name`, `sex`, `date_of_birth`, `current_status`, `academic_year`, `parent_id`, `grade_level_id`, `section_id`, `role_id`) VALUES
(1001, 100000000001, 'Luis', 'Dela Cruz', 'Dela Cruz', 'Male', '2013-01-15', 'Enrolled', '2022-2023', 2001, 1, 1, 1),
(1002, 100000000002, 'Maria', 'Dela Cruz', 'Dela Cruz', 'Female', '2013-02-20', 'Enrolled', '2022-2023', 2002, 1, 1, 1),
(1003, 100000000003, 'Andres', 'Dela Cruz', 'Dela Cruz', 'Male', '2013-03-12', 'Enrolled', '2022-2023', 2003, 1, 1, 1),
(1004, 100000000004, 'Carmen', 'Dela Cruz', 'Dela Cruz', 'Female', '2013-04-05', 'Enrolled', '2022-2023', 2004, 1, 2, 1),
(1005, 100000000005, 'Jose', 'Dela Cruz', 'Dela Cruz', 'Male', '2013-05-10', 'Enrolled', '2022-2023', 2005, 1, 2, 1),
(1006, 100000000006, 'Elena', 'Dela Cruz', 'Dela Cruz', 'Female', '2013-06-25', 'Enrolled', '2022-2023', 2006, 1, 2, 1),
(1007, 100000000007, 'Fernando', 'Dela Cruz', 'Dela Cruz', 'Male', '2013-07-30', 'Enrolled', '2022-2023', 2007, 1, 3, 1),
(1008, 100000000008, 'Raquel', 'Dela Cruz', 'Dela Cruz', 'Female', '2013-08-15', 'Enrolled', '2022-2023', 2008, 1, 3, 1),
(1009, 100000000009, 'Gabriel', 'Dela Cruz', 'Dela Cruz', 'Male', '2013-09-05', 'Enrolled', '2022-2023', 2009, 1, 3, 1),
(1010, 100000000010, 'Pedro', 'Delos Reyes', 'Delos Reyes', 'Male', '2014-01-11', 'Enrolled', '2022-2023', 2010, 1, 4, 1),
(1011, 100000000011, 'Sofia', 'Delos Reyes', 'Delos Reyes', 'Female', '2014-02-14', 'Enrolled', '2022-2023', 2011, 1, 4, 1),
(1012, 100000000012, 'Rico', 'Delos Reyes', 'Delos Reyes', 'Male', '2014-03-20', 'Enrolled', '2022-2023', 2012, 1, 4, 1),
(1013, 100000000013, 'Lia', 'Delos Reyes', 'Delos Reyes', 'Female', '2014-04-18', 'Enrolled', '2022-2023', 2013, 1, 5, 1),
(1014, 100000000014, 'Samuel', 'Delos Reyes', 'Delos Reyes', 'Male', '2014-05-25', 'Enrolled', '2022-2023', 2014, 1, 5, 1),
(1015, 100000000015, 'Nina', 'Delos Reyes', 'Delos Reyes', 'Female', '2014-06-30', 'Enrolled', '2022-2023', 2015, 1, 5, 1),
(1016, 100000000016, 'Miguel', 'Delos Reyes', 'Delos Reyes', 'Male', '2014-07-15', 'Enrolled', '2022-2023', 2016, 1, 6, 1),
(1017, 100000000017, 'Marisol', 'Delos Reyes', 'Delos Reyes', 'Female', '2014-08-10', 'Enrolled', '2022-2023', 2017, 1, 6, 1),
(1018, 100000000018, 'Hector', 'Delos Reyes', 'Delos Reyes', 'Male', '2014-09-25', 'Enrolled', '2022-2023', 2018, 1, 6, 1),
(1019, 100000000019, 'Daniel', 'Bautista', 'Bautista', 'Male', '2015-01-19', 'Enrolled', '2022-2023', 2019, 1, 7, 1),
(1020, 100000000020, 'Liza', 'Bautista', 'Bautista', 'Female', '2015-02-22', 'Enrolled', '2022-2023', 2020, 1, 7, 1),
(1021, 100000000021, 'Jorge', 'Bautista', 'Bautista', 'Male', '2015-03-15', 'Enrolled', '2022-2023', 2021, 1, 7, 1),
(1022, 100000000022, 'Vivian', 'Bautista', 'Bautista', 'Female', '2015-04-08', 'Enrolled', '2022-2023', 2022, 2, 8, 1),
(1023, 100000000023, 'Eric', 'Bautista', 'Bautista', 'Male', '2015-05-23', 'Enrolled', '2022-2023', 2023, 2, 8, 1),
(1024, 100000000024, 'Raquel', 'Bautista', 'Bautista', 'Female', '2015-06-30', 'Enrolled', '2022-2023', 2024, 2, 8, 1),
(1025, 100000000025, 'Alvin', 'Bautista', 'Bautista', 'Male', '2015-07-15', 'Enrolled', '2022-2023', 2025, 2, 9, 1),
(1026, 100000000026, 'Giselle', 'Bautista', 'Bautista', 'Female', '2015-08-12', 'Enrolled', '2022-2023', 2026, 2, 9, 1),
(1027, 100000000027, 'Felipe', 'Bautista', 'Bautista', 'Male', '2015-09-11', 'Enrolled', '2022-2023', 2027, 2, 9, 1),
(1028, 100000000028, 'Carlos', 'Cruz', 'Cruz', 'Male', '2016-01-01', 'Enrolled', '2022-2023', 2028, 2, 10, 1),
(1029, 100000000029, 'Daisy', 'Cruz', 'Cruz', 'Female', '2016-02-10', 'Enrolled', '2022-2023', 2029, 2, 10, 1),
(1030, 100000000030, 'Antonio', 'Cruz', 'Cruz', 'Male', '2016-03-22', 'Enrolled', '2022-2023', 2030, 2, 10, 1),
(1031, 100000000031, 'Cecilia', 'Cruz', 'Cruz', 'Female', '2016-04-12', 'Enrolled', '2022-2023', 2031, 2, 11, 1),
(1032, 100000000032, 'Greg', 'Cruz', 'Cruz', 'Male', '2016-05-30', 'Enrolled', '2022-2023', 2032, 2, 11, 1),
(1033, 100000000033, 'Lia', 'Cruz', 'Cruz', 'Female', '2016-06-15', 'Enrolled', '2022-2023', 2033, 2, 11, 1),
(1034, 100000000034, 'Alvin', 'Cruz', 'Cruz', 'Male', '2016-07-21', 'Enrolled', '2022-2023', 2034, 2, 12, 1),
(1035, 100000000035, 'Ivy', 'Cruz', 'Cruz', 'Female', '2016-08-11', 'Enrolled', '2022-2023', 2035, 2, 12, 1),
(1036, 100000000036, 'Nico', 'Cruz', 'Cruz', 'Male', '2016-09-18', 'Enrolled', '2022-2023', 2036, 2, 12, 1),
(1037, 100000000037, 'David', 'Santos', 'Santos', 'Male', '2017-01-14', 'Enrolled', '2022-2023', 2037, 2, 13, 1),
(1038, 100000000038, 'Rita', 'Santos', 'Santos', 'Female', '2017-02-20', 'Enrolled', '2022-2023', 2038, 2, 13, 1),
(1039, 100000000039, 'Hugo', 'Santos', 'Santos', 'Male', '2017-03-05', 'Enrolled', '2022-2023', 2039, 2, 13, 1),
(1040, 100000000040, 'Tina', 'Santos', 'Santos', 'Female', '2017-04-27', 'Enrolled', '2022-2023', 2040, 3, 14, 1),
(1041, 100000000041, 'Paul', 'Santos', 'Santos', 'Male', '2017-05-17', 'Enrolled', '2022-2023', 2041, 3, 14, 1),
(1042, 100000000042, 'Clara', 'Santos', 'Santos', 'Female', '2017-06-21', 'Enrolled', '2022-2023', 2042, 3, 14, 1),
(1043, 100000000043, 'Ben', 'Santos', 'Santos', 'Male', '2017-07-10', 'Enrolled', '2022-2023', 2043, 3, 15, 1),
(1044, 100000000044, 'Ella', 'Santos', 'Santos', 'Female', '2017-08-16', 'Enrolled', '2022-2023', 2044, 3, 15, 1),
(1045, 100000000045, 'Ramon', 'Santos', 'Santos', 'Male', '2017-09-15', 'Enrolled', '2022-2023', 2045, 3, 15, 1),
(1046, 100000000046, 'Faye', 'Luna', 'Luna', 'Female', '2018-01-25', 'Enrolled', '2022-2023', 2046, 3, 16, 1),
(1047, 100000000047, 'Manny', 'Luna', 'Luna', 'Male', '2018-02-13', 'Enrolled', '2022-2023', 2047, 3, 16, 1),
(1048, 100000000048, 'Lily', 'Luna', 'Luna', 'Female', '2018-03-14', 'Enrolled', '2022-2023', 2048, 3, 16, 1),
(1049, 100000000049, 'Marco', 'Luna', 'Luna', 'Male', '2018-04-22', 'Enrolled', '2022-2023', 2049, 3, 17, 1),
(1050, 100000000050, 'Zara', 'Luna', 'Luna', 'Female', '2018-05-30', 'Enrolled', '2022-2023', 2050, 3, 17, 1),
(1051, 100000000051, 'Leo', 'Luna', 'Luna', 'Male', '2018-06-15', 'Enrolled', '2022-2023', 2051, 3, 17, 1),
(1052, 100000000052, 'Cathy', 'Luna', 'Luna', 'Female', '2018-08-18', 'Enrolled', '2022-2023', 2052, 3, 18, 1),
(1053, 100000000053, 'Jay', 'Luna', 'Luna', 'Male', '2018-09-27', 'Enrolled', '2022-2023', 2053, 3, 18, 1),
(1054, 100000000054, 'Nina', 'Luna', 'Luna', 'Female', '2018-10-05', 'Enrolled', '2022-2023', 2054, 3, 18, 1),
(1055, NULL, 'Laurence', 'Mendoza', 'Panaligan', 'Male', '2002-10-21', 'Enrolled', '2022-2023', 2055, 3, 17, 1),
(1056, NULL, 'ken', 'laurence', 'mercado', 'Male', '2004-02-12', 'Enrolled', '2022-2023', 2056, 1, 1, 1),
(1057, NULL, 'ken laurence ', 'Mercado', 'dumara-og', 'Male', '2024-11-06', 'Enrolled', '2022-2023', 2057, 1, 1, 1),
(1058, 100000000060, 'Jann Angelo', 'Calalo', 'Dimaano', 'Male', '2015-07-10', 'Enrolled', '2022-2023', 2058, 4, 22, 1),
(1059, NULL, 'Laurence', 'Calalo', 'Dimaano', 'Male', '2000-07-10', 'Enrolled', '2022-2023', 2059, 1, 1, 1),
(1060, 123123123123, 'Jann', 'Mendoza', 'Panaligan', 'Male', '2000-01-01', 'Enrolled', '2022-2023', 2060, 1, 1, 1),
(1061, NULL, 'Alvin', 'Zara', 'Espino', 'Male', '2003-03-01', 'Enrolled', '2022-2023', 2061, 1, 1, 1),
(1062, NULL, 'Bien', 'Calalo', 'Panaligan', 'Male', '2000-07-10', 'Enrolled', '2022-2023', 2062, 1, 2, 1),
(1063, NULL, 'Cristina', 'Mendoza', 'Punzalan', 'Male', '2003-07-10', 'Enrolled', '2022-2023', 2063, 1, 1, 1),
(1064, NULL, 'Laurence', 'Zara', 'Maranan', 'Male', '2005-01-01', 'Enrolled', '2022-2023', 2064, 1, 3, 1),
(1065, NULL, 'Laurence', 'Maranan', 'Zara', 'Female', '2003-02-03', 'Enrolled', '2022-2023', 2065, 1, 1, 1),
(1066, NULL, 'Laurence', 'Calalo', 'Untalan', 'Male', '2003-07-10', 'Enrolled', '2022-2023', 2066, 1, 1, 1),
(1067, NULL, 'Jelo', 'Calalo', 'Dimaano', 'Male', '2003-07-10', 'Enrolled', '2022-2023', 2067, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_archives`
--

CREATE TABLE `student_archives` (
  `archive_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lrn` bigint(12) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `current_status` varchar(20) NOT NULL,
  `academic_year` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_archives`
--

INSERT INTO `student_archives` (`archive_id`, `student_id`, `lrn`, `first_name`, `middle_name`, `last_name`, `sex`, `date_of_birth`, `current_status`, `academic_year`, `parent_id`, `grade_level_id`, `section_id`) VALUES
(1, 1019, 100000000019, 'Daniel', 'Bautista', 'Bautista', 'Male', '2015-01-19', 'Passed', '2021-2022', 2019, 3, 7),
(2, 1020, 100000000020, 'Liza', 'Bautista', 'Bautista', 'Female', '2015-02-22', 'Passed', '2021-2022', 2020, 3, 7),
(3, 1021, 100000000021, 'Jorge', 'Bautista', 'Bautista', 'Male', '2015-03-15', 'Passed', '2021-2022', 2021, 3, 7),
(4, 1022, 100000000022, 'Vivian', 'Bautista', 'Bautista', 'Female', '2015-04-08', 'Passed', '2021-2022', 2022, 3, 8),
(5, 1023, 100000000023, 'Eric', 'Bautista', 'Bautista', 'Male', '2015-05-23', 'Passed', '2021-2022', 2023, 3, 8),
(6, 1024, 100000000024, 'Raquel', 'Bautista', 'Bautista', 'Female', '2015-06-30', 'Passed', '2021-2022', 2024, 3, 8),
(7, 1025, 100000000025, 'Alvin', 'Bautista', 'Bautista', 'Male', '2015-07-15', 'Passed', '2021-2022', 2025, 3, 9),
(8, 1026, 100000000026, 'Giselle', 'Bautista', 'Bautista', 'Female', '2015-08-12', 'Passed', '2021-2022', 2026, 3, 9),
(9, 1027, 100000000027, 'Felipe', 'Bautista', 'Bautista', 'Male', '2015-09-11', 'Passed', '2021-2022', 2027, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `student_file`
--

CREATE TABLE `student_file` (
  `student_file_id` int(11) NOT NULL,
  `student_picture` varchar(100) NOT NULL,
  `psa_birth_certificate` varchar(100) DEFAULT NULL,
  `progress_report_card` varchar(100) DEFAULT NULL,
  `medical_assessment` varchar(100) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_file`
--

INSERT INTO `student_file` (`student_file_id`, `student_picture`, `psa_birth_certificate`, `progress_report_card`, `medical_assessment`, `student_id`) VALUES
(1, '../uploads/casual_white.jpg', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', 1001),
(2, '../uploads/wallpaperflare.com_wallpaper (5).jpg', '../uploads/AIAS Exercises - Questionnaire.pdf', '../uploads/AIAS Exercises - Questionnaire.pdf', '../uploads/AIAS Exercises - Questionnaire.pdf', 1002),
(3, '../uploads/465108667_1109069934111600_7000308353688477088_n.jpg', '../uploads/AIAS Exercises - Questionnaire.pdf', '../uploads/AIAS Exercises - Questionnaire.pdf', '../uploads/AIAS Exercises - Questionnaire.pdf', 1003),
(4, '../uploads/simple_white.jpg', '../uploads/Copy of test-strategy-template.docx', '../uploads/Statistical-Process-Control (1).pdf', '../uploads/Maranan-4103-AIAS-Exercises-Questionnaire.pdf', 1004),
(5, '../uploads/', '../uploads/certyyy.jpg', '../uploads/casual_white.jpg', '../uploads/Copy of test-strategy-template.docx', 1059),
(6, '../uploads/6743708c280ad_casual_white.jpg', '../uploads/6743708c28233_certyyy.jpg', '../uploads/6743708c28397_certyyy.jpg', '../uploads/6743708c284da_certyyy.jpg', 1060),
(7, 'file_67437392e476a2.49577059.jpg', 'file_67437392e49579.60161203.jpg', 'file_67437392e4bbb3.54033482.jpg', 'file_67437392e4d354.27700014.pdf', 1061),
(8, 'file_67437650965fa8.07261291.jpg', 'file_67437650967d86.09846614.docx', 'file_67437650969f46.01920518.pdf', 'file_67437650988d02.29637169.pdf', 1062),
(9, 'casual_white.jpg', 'AIAS Reviewer (2).pdf', 'LRN_Quarter_Grades - Copy.xlsx', 'SQA-For-no-choice-moments (1).pdf', 1063),
(10, '../uploads/casual_white.jpg', '../uploads/LRN_Quarter_Grades - Copy.xlsx', '../uploads/SQA-For-no-choice-moments (1).pdf', '../uploads/Dimaano_JannAngelo_IT4103_MidtermLab.docx', 1064),
(11, '../uploads/casual_white.jpg', '../uploads/SQA-For-no-choice-moments (1).pdf', '../uploads/Dimaano_JannAngelo_IT4103_MidtermLab.docx', '../uploads/AIAS Reviewer (2).pdf', 1065),
(12, '../uploads/student_67437d20aa7ec.jpg', '../uploads/psa_67437d20aa7f2.pdf', '../uploads/report_67437d20aa7f3.pdf', '../uploads/medical_67437d20aa7f5.xlsx', 1066),
(13, '../uploads/student_67437f19d0bee.jpg', '../uploads/psa_67437f19d0bf4.pdf', '../uploads/report_67437f19d0bf7.xlsx', '../uploads/medical_67437f19d0bf9.pdf', 1067);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `grade_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `grade_level_id`) VALUES
(1, 'Mother Tounge-Based', 1),
(2, 'Filipino', 1),
(3, 'English', 1),
(4, 'Mathematics', 1),
(5, 'Science', 1),
(6, 'Filipino', 2),
(7, 'English', 2),
(8, 'Mathematics', 2),
(9, 'Science', 2),
(10, 'Music', 2),
(11, 'Arts', 2),
(12, 'Physical Education', 2),
(13, 'Health', 2),
(14, 'Araling Panlipunan', 2),
(15, 'ESP', 2),
(16, 'Filipino', 3),
(17, 'English', 3),
(18, 'Mathematics', 3),
(19, 'Science', 3),
(20, 'Music', 3),
(21, 'Arts', 3),
(22, 'Physical Education', 3),
(23, 'Health', 3),
(24, 'Araling Panlipunan', 3),
(25, 'ESP', 3),
(26, 'Filipino', 4),
(27, 'English', 4),
(28, 'Mathematics', 4),
(29, 'Science', 4),
(30, 'Music', 4),
(31, 'Arts', 4),
(32, 'Physical Education', 4),
(33, 'Health', 4),
(34, 'Araling Panlipunan', 4),
(35, 'ESP', 4),
(36, 'Filipino', 5),
(37, 'English', 5),
(38, 'Mathematics', 5),
(39, 'Science', 5),
(40, 'Music', 5),
(41, 'Arts', 5),
(42, 'Physical Education', 5),
(43, 'Health', 5),
(44, 'Araling Panlipunan', 5),
(45, 'ESP', 5),
(46, 'Filipino', 6),
(47, 'English', 6),
(48, 'Mathematics', 6),
(49, 'Science', 6),
(50, 'Music', 6),
(51, 'Arts', 6),
(52, 'Physical Education', 6),
(53, 'Health', 6),
(54, 'Araling Panlipunan', 6),
(55, 'ESP', 6),
(56, 'EPP', 6),
(57, 'Filipino', 7),
(58, 'English', 7),
(59, 'Mathematics', 7),
(60, 'Science', 7),
(61, 'Music', 7),
(62, 'Arts', 7),
(63, 'Physical Education', 7),
(64, 'Health', 7),
(65, 'Araling Panlipunan', 7),
(66, 'ESP', 7),
(67, 'TLE', 7);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(3001, 'Jann', 'Naruto', 'Uzumaki', 'naruto@gmail.com', 3, 10),
(3002, 'Emily', 'Santos', 'Reyes', 'emily.reyes@example.com', 3, 1),
(3003, 'Michael', 'Lopez', 'Flores', 'michael.flores@example.com', 3, 3),
(3004, 'Sarah', 'Dela Cruz', 'Mendoza', 'sarah.mendoza@example.com', 3, 9),
(3005, 'David', 'Mercado', 'Gonzalez', 'david.gonzalez@example.com', 3, 11),
(3006, 'Jessica', 'Luna', 'Torres', 'jessica.torres@example.com', 3, 3),
(3007, 'Robert', 'Salvador', 'Bautista', 'robert.bautista@example.com', 3, 5),
(3008, 'Laura', 'Buenaventura', 'Aquino', 'laura.aquino@example.com', 3, 3),
(3009, 'James', 'Cabrera', 'Ramos', 'james.ramos@example.com', 3, 13),
(3010, 'Linda', 'Garcia', 'Villanueva', 'linda.villanueva@example.com', 3, 3),
(3011, 'Mark', 'Diaz', 'Delos Santos', 'mark.delossantos@example.com', 3, 13),
(3012, 'Anna', 'Pascual', 'Gomez', 'anna.gomez@example.com', 3, 4),
(3013, 'Brian', 'Manalang', 'Padilla', 'brian.padilla@example.com', 3, 6),
(3014, 'Elizabeth', 'Soriano', 'Castro', 'elizabeth.castro@example.com', 3, 5),
(3015, 'Steven', 'Navarro', 'Rivera', 'steven.rivera@example.com', 3, 7),
(3016, 'Amy', 'Fernandez', 'Ortega', 'amy.ortega@example.com', 3, 7),
(3017, 'Joshua', 'Marasigan', 'Lazaro', 'joshua.lazaro@example.com', 3, 1),
(3018, 'Sophia', 'Ramos', 'Santiago', 'sophia.santiago@example.com', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_section`
--

CREATE TABLE `teacher_section` (
  `teacher_section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_section`
--

INSERT INTO `teacher_section` (`teacher_section_id`, `teacher_id`, `section_id`) VALUES
(1, 3001, 1),
(2, 3001, 2),
(3, 3001, 3),
(4, 3001, 4),
(5, 3001, 5),
(6, 3001, 6),
(7, 3001, 7),
(8, 3002, 1),
(9, 3002, 2),
(10, 3002, 3),
(11, 3002, 4),
(12, 3002, 5),
(13, 3002, 6),
(14, 3002, 7),
(15, 3005, 6),
(16, 3006, 4),
(17, 3006, 5),
(18, 3006, 6),
(19, 3007, 7),
(20, 3007, 8),
(21, 3007, 9),
(22, 3008, 7),
(23, 3008, 8),
(24, 3008, 9),
(25, 3009, 7),
(26, 3009, 8),
(27, 3009, 9),
(28, 3010, 10),
(29, 3010, 11),
(30, 3010, 12),
(31, 3011, 10),
(32, 3011, 11),
(33, 3011, 12),
(34, 3012, 10),
(35, 3012, 11),
(36, 3012, 12),
(37, 3013, 13),
(38, 3013, 14),
(39, 3013, 15),
(40, 3014, 13),
(41, 3014, 14),
(42, 3014, 15),
(43, 3015, 13),
(44, 3015, 14),
(45, 3015, 15),
(46, 3016, 16),
(47, 3016, 17),
(48, 3016, 18),
(49, 3017, 16),
(50, 3017, 17),
(51, 3017, 18),
(52, 3018, 16),
(53, 3018, 17),
(54, 3018, 18),
(55, 3003, 1),
(56, 3003, 2),
(57, 3003, 3),
(58, 3003, 4),
(59, 3003, 5),
(60, 3003, 6),
(61, 3003, 7),
(62, 3004, 1),
(63, 3004, 2),
(64, 3004, 3),
(65, 3004, 4),
(66, 3004, 5),
(67, 3004, 6),
(68, 3004, 7),
(70, 3005, 2),
(71, 3005, 3),
(72, 3005, 4),
(73, 3005, 5),
(74, 3005, 6),
(75, 3005, 7),
(76, 3005, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_subject_id`, `teacher_id`, `subject_id`) VALUES
(1, 3001, 1),
(2, 3002, 2),
(3, 3003, 3),
(4, 3004, 4),
(5, 3005, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`class_schedule_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  ADD PRIMARY KEY (`archive_schedule_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `e_certificate`
--
ALTER TABLE `e_certificate`
  ADD PRIMARY KEY (`e_certificate_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`guidance_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `pdo`
--
ALTER TABLE `pdo`
  ADD PRIMARY KEY (`pdo_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_materials`
--
ALTER TABLE `school_materials`
  ADD PRIMARY KEY (`school_materials_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `student_archives`
--
ALTER TABLE `student_archives`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_file`
--
ALTER TABLE `student_file`
  ADD PRIMARY KEY (`student_file_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `teacher_section`
--
ALTER TABLE `teacher_section`
  ADD PRIMARY KEY (`teacher_section_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `class_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  MODIFY `archive_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `e_certificate`
--
ALTER TABLE `e_certificate`
  MODIFY `e_certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guidance`
--
ALTER TABLE `guidance`
  MODIFY `guidance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4002;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2068;

--
-- AUTO_INCREMENT for table `pdo`
--
ALTER TABLE `pdo`
  MODIFY `pdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6002;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `principal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `school_materials`
--
ALTER TABLE `school_materials`
  MODIFY `school_materials_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1068;

--
-- AUTO_INCREMENT for table `student_archives`
--
ALTER TABLE `student_archives`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_file`
--
ALTER TABLE `student_file`
  MODIFY `student_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3019;

--
-- AUTO_INCREMENT for table `teacher_section`
--
ALTER TABLE `teacher_section`
  MODIFY `teacher_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `teacher_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD CONSTRAINT `class_schedule_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  ADD CONSTRAINT `class_schedule_archive_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
