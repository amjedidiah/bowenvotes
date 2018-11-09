-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 04:07 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bowen`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `election` varchar(255) NOT NULL,
  `votes` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`name`, `faculty`) VALUES
('ec_ca_ec', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga'),
('li_in_na_ga_un_in_sa_ta_in_ca_sa', 'al_ra_ta_sa'),
('de_ec_na_ta_in_sa_ta_ra_ya', 'ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya'),
('pa_he_al_ra_ma_al_ca_ya', 'pa_he_al_ra_ma_al_ca_ya'),
('pa_he_ya_sa_in_ca_sa', 'pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa'),
('ec_ec_ec', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga'),
('he_in_sa_ta_os_ra_ya_cl_an_cl_in_na_ta_ec_ra_na_al_ta_in_os_na_al_li_cl_ra_ec_li_al_ta_in_os_na_sa', 'al_ra_ta_sa'),
('ma_ec_de_in_ca_in_na_ec', 'ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya'),
('ca_he_ec_ma_in_sa_ta_ra_ya', 'pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa');

-- --------------------------------------------------------

--
-- Table structure for table `ed6d1dbcfceec0db6d0989fb54528b99`
--

CREATE TABLE `ed6d1dbcfceec0db6d0989fb54528b99` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ed6d1dbcfceec0db6d0989fb54528b99`
--

INSERT INTO `ed6d1dbcfceec0db6d0989fb54528b99` (`id`, `user`, `pass`) VALUES
(1, 'ma_al_li_in_ca_in_al', '551b2e223a3cf467b51eb8fef56e81ed ');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(1500) NOT NULL,
  `class` varchar(1500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `name`, `type`, `class`) VALUES
(1, 'on_ze_ze_cl_li_cl_ec_li_ec_ca_ta_in_os_na', 'li_ec_vi_ec_li', 'fi_ze_ze'),
(2, 'li_ka_na_li_ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(3, 'li_al_ca_os_al_sa_li_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(4, 'li_ka_li_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(5, 'li_ka_na_al_li_ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(6, 'ma_cl', 'ga_ec_na_ec_ra_al_li', 'ze'),
(7, 'ba_ka_al', 'fa_al_ca_un_li_ta_ya', 'pa_he_al_ra_ma_al_ca_ya'),
(8, 'li_li_sa_ca_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(9, 'li_ka_ka_na_li_ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(10, 'na_ka_li_li_ka_na_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(11, 'al_ja_ka_ba_sa_ka_ja_sa_al_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(12, 'ka_ja_ja_ba_ja_ba_ja', 'ga_ec_na_ec_ra_al_li', 'ze'),
(13, 'ma_ze_na_al_ma_sa_li_sa_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(14, 'li_na_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(15, 'li_ka_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(16, 'ba_ma_ma', 'ga_ec_na_ec_ra_al_li', 'ze'),
(17, 'li_na_li_ba_ma_na_ma_ze', 'ga_ec_na_ec_ra_al_li', 'ze'),
(18, 'ka_ja_ga_ka_ja', 'ga_ec_na_ec_ra_al_li', 'ze'),
(19, 'ze_ba_do_na_do_ze_ze', 'ga_ec_na_ec_ra_al_li', 'ze'),
(20, 'li_na_al_li_al_sa_ca_al_sa', 'ga_ec_na_ec_ra_al_li', 'ze'),
(21, 'ka_li_na_ka_li_al_sa', 'ga_ec_na_ec_ra_al_li', 'ze'),
(22, 'na_ca_ma_sa_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(23, 'li_al_li_sa_al_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(24, 'li_al_sa_na_sa_al_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(25, 'li_na_ca_li_al_sa_na', 'ga_ec_na_ec_ra_al_li', 'ze'),
(26, 'na_sa_al_na', 'ga_ec_na_ec_ra_al_li', 'ze'),
(27, 'na_sa_al_ca', 'ga_ec_na_ec_ra_al_li', 'ze'),
(28, 'ka_ka_ja_li_na_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(29, 'de_ba_de_ka_vi', 'ga_ec_na_ec_ra_al_li', 'ze'),
(30, 'al_al_na_ca_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(31, 'li_ka_na_ca_sa_al_li', 'ga_ec_na_ec_ra_al_li', 'ze'),
(32, 'na_sa_al_ja_na_sa_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(33, 'ja_ja_he_ja_ze_ja_de_ec', 'ga_ec_na_ec_ra_al_li', 'ze'),
(34, 'ja_ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(35, 'ba_ja', 'ga_ec_na_ec_ra_al_li', 'ze'),
(36, 'ja_sa', 'ga_ec_na_ec_ra_al_li', 'ze'),
(37, 'ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(38, 'al_ja_sa_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(39, 'al_sa_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(40, 'sa_al_ja_na_sa_al', 'ga_ec_na_ec_ra_al_li', 'ze'),
(41, 'sa_al_ja_na_sa_al_ka', 'ga_ec_na_ec_ra_al_li', 'ze'),
(42, 'na_li_na_li_na_sa_ka_li_na', 'fa_al_ca_un_li_ta_ya', 'al_ra_ta_sa'),
(43, 'sa_li_na_sa_al_ca', 'ga_ec_na_ec_ra_al_li', 'ze');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`name`) VALUES
('al_ra_ta_sa'),
('ec_na_ga_in_na_ec_ec_ra_in_na_ga'),
('ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya'),
('pa_he_al_ra_ma_al_ca_ya'),
('pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`name`, `department`, `faculty`) VALUES
('fi_ze_ze', 'ec_ca_ec', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga'),
('fo_ze_ze', 'li_in_na_ga_un_in_sa_ta_in_ca_sa', 'al_ra_ta_sa'),
('th_ze_ze', 'pa_he_ya_sa_in_ca_sa', 'pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa'),
('tw_ze_ze', 'ec_ec_ec', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga'),
('si_ze_ze', 'ma_ec_de_in_ca_in_na_ec', 'ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `election` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `candidates` varchar(1500) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `pass`, `mail`, `valid`, `candidates`, `faculty`, `department`, `level`) VALUES
('on_tw_th_fo', '99e115c7f28adc76ce1a3d5c604f7e3b', 'a@yahoo.com', 1, '', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga', 'ec_ca_ec', 'tw_ze_ze'),
('on_tw_th_fo_fi', '8ecc5d1f7c9457d7c55a66c8f63ca620', 'al_ec_sa_ta_al_ra_ta_na_ga_at_ga_ma_al_in_li_do_ca_os_ma', 1, '', '', '', ''),
('tw_ze_on_fi_sl_on_ei_tw_ze_ni_th', '', '', 0, '', 'pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa', 'ca_he_ec_ma_in_sa_ta_ra_ya', 'fo_ze_ze'),
('tw_ze_on_fo_sl_on_tw_tw_th_si_on', '', '', 0, '', 'pa_he_al_ra_ma_al_ca_ya', 'pa_he_al_ra_ma_al_ca_ya', 'fi_ze_ze'),
('tw_ze_on_th_sl_on_ei_tw_th_fi_ze', '', '', 0, '', 'ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya', 'ma_ec_de_in_ca_in_na_ec', 'si_ze_ze'),
('tw_ze_on_fo_sl_on_ei_fo_si_si_fi', '', '', 0, '', 'ma_ec_de_in_ca_in_na_ec_cl_an_cl_sa_un_ra_ga_ec_ra_ya', 'de_ec_na_ta_in_sa_ta_ra_ya', 'fi_ze_ze'),
('tw_ze_on_tw_sl_on_ei_ei_se_tw_on', '', '', 0, '', 'al_ra_ta_sa', 'he_in_sa_ta_os_ra_ya_cl_an_cl_in_na_ta_ec_ra_na_al_ta_in_os_na_al_li_cl_ra_ec_li_al_ta_in_os_na_sa', 'fo_ze_ze'),
('tw_ze_on_se_sl_on_ze_ni_on_tw_on', '', '', 0, '', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga', 'ec_ec_ec', 'tw_ze_ze'),
('tw_ze_on_si_sl_on_ei_tw_on_si_on', '', '', 0, '', 'pa_he_ya_sa_in_ca_al_li_cl_sa_ca_in_ec_na_ca_ec_sa', 'pa_he_ya_sa_in_ca_sa', 'th_ze_ze'),
('tw_ze_on_fi_sl_on_ei_on_si_fi_on', '', '', 0, '', 'pa_he_al_ra_ma_al_ca_ya', 'pa_he_al_ra_ma_al_ca_ya', 'fo_ze_ze'),
('tw_ze_on_th_sl_se_tw_on_tw_ni_ei', '', '', 0, '', 'al_ra_ta_sa', 'li_in_na_ga_un_in_sa_ta_in_ca_sa', 'fo_ze_ze'),
('tw_ze_on_tw_sl_on_ei_tw_si_si_on', '', '', 0, '', 'ec_na_ga_in_na_ec_ec_ra_in_na_ga', 'ec_ca_ec', 'fi_ze_ze');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `ed6d1dbcfceec0db6d0989fb54528b99`
--
ALTER TABLE `ed6d1dbcfceec0db6d0989fb54528b99`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ed6d1dbcfceec0db6d0989fb54528b99`
--
ALTER TABLE `ed6d1dbcfceec0db6d0989fb54528b99`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
