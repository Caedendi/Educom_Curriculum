-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2019 at 02:23 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bartcommandeur_symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `artiest`
--

CREATE TABLE `artiest` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `omschrijving` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afbeelding_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artiest`
--

INSERT INTO `artiest` (`id`, `naam`, `genre`, `omschrijving`, `afbeelding_url`, `website`) VALUES
(1, 'AC/DC', 'Rock', NULL, NULL, NULL),
(2, 'Metallica', 'Thrash Metal', NULL, NULL, NULL),
(3, 'Guns N\' Roses', 'Hard Rock', NULL, NULL, NULL),
(4, 'Aerosmith', 'Rock', NULL, NULL, NULL),
(5, 'The Rolling Stones', 'Rock', NULL, NULL, NULL),
(6, 'Behemoth', 'Blackened Death Metal', NULL, NULL, NULL),
(7, 'Bloodbath', 'Death Metal', NULL, NULL, NULL),
(8, 'The Black Dahlia Murder', 'Melodic Death Metal', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191122104834', '2019-11-22 10:48:55'),
('20191122111059', '2019-11-22 11:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `optreden`
--

CREATE TABLE `optreden` (
  `id` int(11) NOT NULL,
  `poppodium_id` int(11) NOT NULL,
  `artiest_id` int(11) NOT NULL,
  `omschrijving` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum` datetime NOT NULL,
  `prijs` decimal(8,2) NOT NULL,
  `ticket_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afbeelding_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `optreden`
--

INSERT INTO `optreden` (`id`, `poppodium_id`, `artiest_id`, `omschrijving`, `datum`, `prijs`, `ticket_url`, `afbeelding_url`) VALUES
(1, 1, 6, 'Op zaterdag 30 mei 2020 keert de Poolse blackened death metal band Behemoth terug naar Utrecht voor weer een van hun beroemde theatrale shows.\r\n\r\nTer support niemand minder dan The Black Dahlia Murder en Bloodbath.', '2020-05-30 19:00:00', '35.00', NULL, NULL),
(3, 1, 2, 'Optreden van Metallica met in het voorprogramma AC/DC en Aerosmith.', '2020-06-01 19:00:00', '70.00', '', ''),
(4, 1, 2, 'Optreden van Metallica met in het voorprogramma AC/DC en Aerosmith.', '2020-06-01 19:00:00', '70.00', '', ''),
(5, 1, 2, 'Optreden van Metallica met in het voorprogramma AC/DC en Aerosmith.', '2020-06-01 19:00:00', '70.00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `poppodium`
--

CREATE TABLE `poppodium` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `woonplaats` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefoonnummer` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afbeelding_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poppodium`
--

INSERT INTO `poppodium` (`id`, `naam`, `adres`, `postcode`, `woonplaats`, `telefoonnummer`, `email`, `website`, `logo_url`, `afbeelding_url`) VALUES
(1, 'TivoliVredenburg', 'Vlaamse Toren 7', '3511 WB', 'Utrecht', '0307606777', 'info@tivolivredenburg.nl', 'https://www.tivolivredenburg.nl/', NULL, NULL),
(2, 'Ziggo Dome', 'De Passage 100', '1101 AX', 'Amsterdam', '09002353663', 'info@ziggodome.nl', 'https://www.ziggodome.nl/', NULL, NULL),
(3, '013', 'Veemarktstraat 44', '5038 CV', 'Tilburg', '0134609500', 'info@013.nl', 'https://www.013.nl/', NULL, NULL),
(4, 'Melkweg', 'Lijnbaansgracht 234a', '1017 PH', 'Amsterdam', '0205318181', 'info@melkweg.nl', 'https://www.melkweg.nl/', NULL, NULL),
(5, 'Paradiso', 'Weteringschans 6-8', '1017 SG', 'Amsterdam', '0206264521', 'info@paradiso.nl', 'https://www.paradiso.nl/', NULL, NULL),
(6, 'AFAS Live', 'ArenA Boulevard 590', '1101 DS', 'Amsterdam', '09006874242', 'info@afaslive.nl', 'https://www.afaslive.nl/', NULL, NULL),
(15, 'Nieuwe Nor', 'Pancratiusstraat 30', '6411KC', 'Heerlen', '454009100', NULL, 'https://nieuwenor.nl/', 'https://www.nieuwenor.nl/img/logo-white-sm.png/', '');

-- --------------------------------------------------------

--
-- Table structure for table `voorprogramma`
--

CREATE TABLE `voorprogramma` (
  `optreden_id` int(11) NOT NULL,
  `artiest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voorprogramma`
--

INSERT INTO `voorprogramma` (`optreden_id`, `artiest_id`) VALUES
(3, 1),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(5, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artiest`
--
ALTER TABLE `artiest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naam` (`naam`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `optreden`
--
ALTER TABLE `optreden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6286F65DA2EEBB18` (`poppodium_id`),
  ADD KEY `IDX_6286F65DAED85528` (`artiest_id`);

--
-- Indexes for table `poppodium`
--
ALTER TABLE `poppodium`
  ADD PRIMARY KEY (`id`),
  ADD KEY `naam` (`naam`);

--
-- Indexes for table `voorprogramma`
--
ALTER TABLE `voorprogramma`
  ADD PRIMARY KEY (`optreden_id`,`artiest_id`),
  ADD KEY `IDX_378387D94418189F` (`optreden_id`),
  ADD KEY `IDX_378387D9AED85528` (`artiest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artiest`
--
ALTER TABLE `artiest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `optreden`
--
ALTER TABLE `optreden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poppodium`
--
ALTER TABLE `poppodium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `optreden`
--
ALTER TABLE `optreden`
  ADD CONSTRAINT `FK_6286F65DA2EEBB18` FOREIGN KEY (`poppodium_id`) REFERENCES `poppodium` (`id`),
  ADD CONSTRAINT `FK_6286F65DAED85528` FOREIGN KEY (`artiest_id`) REFERENCES `artiest` (`id`);

--
-- Constraints for table `voorprogramma`
--
ALTER TABLE `voorprogramma`
  ADD CONSTRAINT `FK_378387D94418189F` FOREIGN KEY (`optreden_id`) REFERENCES `optreden` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_378387D9AED85528` FOREIGN KEY (`artiest_id`) REFERENCES `artiest` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
