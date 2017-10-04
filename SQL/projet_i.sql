-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 10:53 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projet_i`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence_retard`
--

CREATE TABLE IF NOT EXISTS `absence_retard` (
  `ID_Perso` varchar(10) NOT NULL,
  `Journee_A_R` date NOT NULL,
  `Type_A_R` varchar(10) NOT NULL,
  KEY `FK_Personnel_AbsRet` (`ID_Perso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `ID` varchar(5) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Mdp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `Mail`, `Mdp`) VALUES
('000x', 'Admin@mail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `ID` varchar(10) NOT NULL,
  `Date_emb` date NOT NULL,
  `Poste` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`Nom`, `Prenom`, `ID`, `Date_emb`, `Poste`) VALUES
('BAIDADA', 'MOHAMMAD', 'ze147', '1990-01-01', 'Professeur'),
('ELATIF', 'NABIL', 'XXX666', '1993-04-11', 'Game Dev'),
('Bensoulaiman', 'MANAR', 'vwx123', '1993-01-01', 'Ing.Elec'),
('Slyzerski', 'AndrÃ©', 'zr789', '1996-01-05', 'Technicien');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE IF NOT EXISTS `presence` (
  `ID` varchar(10) NOT NULL,
  `H_entree` varchar(10) NOT NULL,
  `H_sortie` varchar(10) NOT NULL,
  `Jour` date NOT NULL,
  KEY `FK_Personnel_Presence` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
