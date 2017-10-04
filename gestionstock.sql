-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2017 at 06:04 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestionstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Login` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Login`, `pwd`) VALUES
('Admin', 'Admin'),
('user1', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `ID` varchar(5) NOT NULL,
  `Libele` varchar(30) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`ID`, `Libele`) VALUES
('3', 'INFO'),
('1', 'RH'),
('2', 'B.O');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `Numserie` varchar(30) NOT NULL,
  `cin` varchar(15) NOT NULL,
  `dateaff` date NOT NULL,
  `etat` varchar(30) NOT NULL,
  `Typee` int(11) NOT NULL,
  UNIQUE KEY `dateaff` (`dateaff`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etatmat`
--

CREATE TABLE IF NOT EXISTS `etatmat` (
  `ID` int(11) NOT NULL,
  `Lib` varchar(20) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etatmat`
--

INSERT INTO `etatmat` (`ID`, `Lib`) VALUES
(1, 'Repare'),
(2, 'enRepa'),
(3, 'Reforme');

-- --------------------------------------------------------

--
-- Table structure for table `materiel`
--

CREATE TABLE IF NOT EXISTS `materiel` (
  `Nserie` varchar(15) NOT NULL,
  `Libele` varchar(30) NOT NULL,
  `Dateachat` date NOT NULL,
  `Typem` varchar(30) NOT NULL,
  `Nvnum` varchar(15) NOT NULL,
  `deploye` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `Nserie` (`Nserie`),
  UNIQUE KEY `Nvnum` (`Nvnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materiel`
--

INSERT INTO `materiel` (`Nserie`, `Libele`, `Dateachat`, `Typem`, `Nvnum`, `deploye`) VALUES
('qaz4587', 'CISCO', '2012-02-05', '2', 'a001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `matreforme`
--

CREATE TABLE IF NOT EXISTS `matreforme` (
  `Nserie` varchar(10) NOT NULL,
  UNIQUE KEY `Nserie` (`Nserie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pannes`
--

CREATE TABLE IF NOT EXISTS `pannes` (
  `SerieM` varchar(15) NOT NULL,
  `Datepanne` date NOT NULL,
  `etatMat` varchar(20) NOT NULL,
  UNIQUE KEY `SerieM` (`SerieM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `cin` varchar(10) NOT NULL,
  `Nomprenom` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `Nbureau` varchar(10) NOT NULL,
  `tel` varchar(12) NOT NULL,
  UNIQUE KEY `cin` (`cin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`cin`, `Nomprenom`, `dept`, `Nbureau`, `tel`) VALUES
('xa103241', 'ELATIF Nabil', '3', '12', '0659503111'),
('az47856', 'Test1 test1', '1', '01', '0303');

-- --------------------------------------------------------

--
-- Table structure for table `typematos`
--

CREATE TABLE IF NOT EXISTS `typematos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `typematos`
--

INSERT INTO `typematos` (`ID`, `type`) VALUES
(1, 'PC'),
(2, 'Serveur'),
(3, 'Imprimante / Scanner');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
