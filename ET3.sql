-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2014 at 06:34 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.4-14+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ET3`
--
CREATE DATABASE IF NOT EXISTS `ET3` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ET3`;
-- --------------------------------------------------------

--
-- Table structure for table `AluEntregaTra`
--

CREATE TABLE IF NOT EXISTS `AluEntregaTra` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(40) NOT NULL,
  `codTrabajo` varchar(40) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `observaciones` varchar(256) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `calificacion` decimal(4,0),
  `portfolio` enum('T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`emailUsuario`,`codAsignatura`,`codTrabajo`),
  KEY `codAsignatura` (`codAsignatura`),
  KEY `codTrabajo` (`codTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AluInscritoAsi`
--

CREATE TABLE IF NOT EXISTS `AluInscritoAsi` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(40) NOT NULL,
  `anhoInscrito` number(4) NOT NULL,
  `aceptado` enum('T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`emailUsuario`,`codAsignatura`),
  KEY `codAsignatura` (`codAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Asignatura`
--

CREATE TABLE IF NOT EXISTS `Asignatura` (
  `codAsignatura` varchar(40) NOT NULL,
  `nomAsignatura` varchar(40) NOT NULL,
  `gradoAsignatura` varchar(40) NOT NULL,
  `cursoAsignatura` int(1) NOT NULL,
  PRIMARY KEY (`codAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProImparteAsi`
--

CREATE TABLE IF NOT EXISTS `ProImparteAsi` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(40) NOT NULL,
  `anhoImparte` date NOT NULL,
  PRIMARY KEY (`emailUsuario`,`codAsignatura`,`anhoImparte`),
  KEY `codAsignatura` (`codAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Trabajo`
--

CREATE TABLE IF NOT EXISTS `Trabajo` (
  `codTrabajo` varchar(40) NOT NULL,
  `codAsignatura` varchar(40) NOT NULL,
  `nombreTrabajo` varchar(40) NOT NULL,
  `fechaLimiteTrabajo` date NOT NULL,
  `descripcionTrabajo` varchar(256) NOT NULL,
  PRIMARY KEY (`codTrabajo`,`codAsignatura`),
  KEY `codAsignatura` (`codAsignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `emailUsuario` varchar(40) NOT NULL,
  `nombreUsuario` varchar(40) NOT NULL,
  `apellidoUsuario` varchar(40) NOT NULL,
  `passwordUsuario` varchar(80) NOT NULL,
  `correccionesUsuario` enum('T','F') NOT NULL DEFAULT 'F',
  `publicoUsuario` enum('T','F') NOT NULL DEFAULT 'F',
  `idiomaUsuario` enum('ESP','GAL','ENG','DEU') NOT NULL DEFAULT 'ESP',
  `tipoUsuario` enum('Alumno','Profesor','Administrador') NOT NULL DEFAULT 'Alumno',
  `dniUsuario` varchar(9) NOT NULL,
  PRIMARY KEY (`emailUsuario`),
  UNIQUE KEY `dniUsuario` (`dniUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`emailUsuario`, `nombreUsuario`, `apellidoUsuario`, `passwordUsuario`, `tipoUsuario`, `dniUsuario`) VALUES
('admin@admin.com', 'admin', 'admin', 'Admin1.', 'Administrador', '11111111X');

--
-- Constraints for dumped tables   
--

--
-- Constraints for table `AluEntregaTra`
--
ALTER TABLE `AluEntregaTra`
  ADD CONSTRAINT `AluEntregaTra_ibfk_2` FOREIGN KEY (`codTrabajo`,`codAsignatura`) REFERENCES `Trabajo` (`codTrabajo`,`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AluEntregaTra_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `AluInscritoAsi`
--
ALTER TABLE `AluInscritoAsi`
  ADD CONSTRAINT `AluInscritoAsi_ibfk_2` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AluInscritoAsi_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ProImparteAsi`
--
ALTER TABLE `ProImparteAsi`
  ADD CONSTRAINT `ProImparteAsi_ibfk_2` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProImparteAsi_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Trabajo`
--
ALTER TABLE `Trabajo`
  ADD CONSTRAINT `Trabajo_ibfk_1` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT USAGE ON *.* TO 'Administrador'@'localhost' IDENTIFIED BY 'Administrador' 
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; 
GRANT ALL PRIVILEGES ON `ET3`.* TO 'Administrador'@'localhost'WITH GRANT OPTION; 
