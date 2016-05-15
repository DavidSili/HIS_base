-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2016 at 02:50 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hisbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `imenik`
--

DROP TABLE IF EXISTS `imenik`;
CREATE TABLE IF NOT EXISTS `imenik` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datrod` date DEFAULT NULL,
  `mestorod` varchar(50) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `mestoziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `pobroj` int(6) DEFAULT NULL,
  `adresa` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `telefon` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `mobilni` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `krvna` varchar(3) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `plivac` varchar(2) COLLATE utf8_slovenian_ci NOT NULL DEFAULT 'ne',
  `vegan` varchar(2) COLLATE utf8_slovenian_ci NOT NULL DEFAULT 'ne',
  `alergije` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `hronicnebol` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `lekovi` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `ostaleinfo` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `datprim` date DEFAULT NULL,
  `datisk` date DEFAULT NULL,
  `odred` int(5) DEFAULT NULL,
  `nesime` varchar(50) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `nesadr` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `nestel` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otime` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otprezime` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otteldan` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `ottelnoc` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otadresa` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otmobilni` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `otemail` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `maime` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `maprezime` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `mateldan` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `matelnoc` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `maadresa` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `mamobilni` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `maemail` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `funkcije` varchar(30) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `cinovi` varchar(1000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `vestine` varchar(1000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `clanarine` varchar(300) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `komentar` text COLLATE utf8_slovenian_ci,
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kampovi`
--

DROP TABLE IF EXISTS `kampovi`;
CREATE TABLE IF NOT EXISTS `kampovi` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datpoc` date NOT NULL,
  `datkraj` date NOT NULL,
  `mesto` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `drzava` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `naziv` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `funkcije` varchar(300) COLLATE utf8_slovenian_ci NOT NULL,
  `tip` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `organizator` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `prisutni` varchar(5000) COLLATE utf8_slovenian_ci NOT NULL,
  `komentar` text COLLATE utf8_slovenian_ci,
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine`
--

DROP TABLE IF EXISTS `narudzbine`;
CREATE TABLE IF NOT EXISTS `narudzbine` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `narucio` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datnar` date NOT NULL,
  `datproc` date DEFAULT NULL,
  `datpos` date DEFAULT NULL,
  `datprim` date DEFAULT NULL,
  `predmeti` varchar(5000) COLLATE utf8_slovenian_ci NOT NULL,
  `komentar` text COLLATE utf8_slovenian_ci,
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obuke`
--

DROP TABLE IF EXISTS `obuke`;
CREATE TABLE IF NOT EXISTS `obuke` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datpoc` date NOT NULL,
  `datkraj` date NOT NULL,
  `mesto` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `tip` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `drzava` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `instruktori` varchar(300) COLLATE utf8_slovenian_ci NOT NULL,
  `prisutni` varchar(5000) COLLATE utf8_slovenian_ci NOT NULL,
  `komentar` text COLLATE utf8_slovenian_ci,
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `odredi`
--

DROP TABLE IF EXISTS `odredi`;
CREATE TABLE IF NOT EXISTS `odredi` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `mesto` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datosn` date DEFAULT NULL,
  `datrasp` date DEFAULT NULL,
  `stranica` varchar(150) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `adresa` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

DROP TABLE IF EXISTS `predmeti`;
CREATE TABLE IF NOT EXISTS `predmeti` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tip` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `predmet` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `cena` decimal(20,2) NOT NULL,
  `opis` text COLLATE utf8_slovenian_ci,
  `nalageru` int(20) NOT NULL DEFAULT '0',
  `uneo` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `menjali` varchar(3000) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_slovenian_ci NOT NULL,
  `salt` varchar(11) COLLATE utf8_slovenian_ci NOT NULL,
  `level` int(1) NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `funkcija` int(1) DEFAULT NULL,
  `zaodred` int(3) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vestine`
--

DROP TABLE IF EXISTS `vestine`;
CREATE TABLE IF NOT EXISTS `vestine` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `fajl` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
