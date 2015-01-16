-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2014 a las 19:24:33
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `et3`
--
CREATE DATABASE IF NOT EXISTS `ET3` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ET3`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AluEntregaTra`
--

CREATE TABLE IF NOT EXISTS `AluEntregaTra` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(80) NOT NULL,
  `codTrabajo` varchar(80) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `observaciones` varchar(256) DEFAULT NULL,
  `titulo` varchar(80) NOT NULL,
  `calificacion` float DEFAULT NULL,
  `portfolio` enum('T','F') NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `AluEntregaTra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AluInscritoAsi`
--

CREATE TABLE IF NOT EXISTS `AluInscritoAsi` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(80) NOT NULL,
  `anhoInscrito` int(1) NOT NULL,
  `aceptado` enum('T','F') NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `AluInscritoAsi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asignatura`
--

CREATE TABLE IF NOT EXISTS `Asignatura` (
  `codAsignatura` varchar(80) NOT NULL,
  `nomAsignatura` varchar(40) NOT NULL,
  `gradoAsignatura` varchar(40) NOT NULL,
  `cursoAsignatura` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Asignatura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProImparteAsi`
--

CREATE TABLE IF NOT EXISTS `ProImparteAsi` (
  `emailUsuario` varchar(40) NOT NULL,
  `codAsignatura` varchar(80) NOT NULL,
  `anhoImparte` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajo`
--

CREATE TABLE IF NOT EXISTS `Trabajo` (
  `codTrabajo` varchar(80) NOT NULL,
  `codAsignatura` varchar(80) NOT NULL,
  `nombreTrabajo` varchar(40) NOT NULL,
  `fechaLimiteTrabajo` date NOT NULL,
  `descripcionTrabajo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
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
  `dniUsuario` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
-- Contraseña admin: Admin1. --> 530e6cc7d2affa1dc1b38a0716e12e97
-- Contraseña de los demas --> bfd59291e825b5f2bbf1eb76569f8fe7
--

INSERT INTO `Usuario` (`emailUsuario`, `nombreUsuario`, `apellidoUsuario`, `passwordUsuario`, `correccionesUsuario`, `publicoUsuario`, `idiomaUsuario`, `tipoUsuario`, `dniUsuario`) VALUES
('admin@admin.com', 'Administrador', 'Admin Admin', '530e6cc7d2affa1dc1b38a0716e12e97', 'F', 'F', 'ESP', 'Administrador', '11111111H'),
('asd@asd.com', 'User', 'Torres Garrido', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'T', 'T', 'ESP', 'Alumno', '44655485L'),
('prof@prof.com', 'Prof', 'Ojea Martinez', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'F', 'F', 'ESP', 'Profesor', '22222222J');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AluEntregaTra`
--
ALTER TABLE `AluEntregaTra`
 ADD PRIMARY KEY (`emailUsuario`,`codAsignatura`,`codTrabajo`), ADD KEY `codAsignatura` (`codAsignatura`), ADD KEY `codTrabajo` (`codTrabajo`), ADD KEY `AluEntregaTra_ibfk_2` (`codTrabajo`,`codAsignatura`);

--
-- Indices de la tabla `AluInscritoAsi`
--
ALTER TABLE `AluInscritoAsi`
 ADD PRIMARY KEY (`emailUsuario`,`codAsignatura`,`anhoInscrito`), ADD KEY `codAsignatura` (`codAsignatura`);

--
-- Indices de la tabla `Asignatura`
--
ALTER TABLE `Asignatura`
 ADD PRIMARY KEY (`codAsignatura`);

--
-- Indices de la tabla `ProImparteAsi`
--
ALTER TABLE `ProImparteAsi`
 ADD PRIMARY KEY (`emailUsuario`,`codAsignatura`,`anhoImparte`), ADD KEY `codAsignatura` (`codAsignatura`);

--
-- Indices de la tabla `Trabajo`
--
ALTER TABLE `Trabajo`
 ADD PRIMARY KEY (`codTrabajo`,`codAsignatura`), ADD KEY `codAsignatura` (`codAsignatura`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
 ADD PRIMARY KEY (`emailUsuario`), ADD UNIQUE KEY `dniUsuario` (`dniUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `AluEntregaTra`
--
ALTER TABLE `AluEntregaTra`
ADD CONSTRAINT `AluEntregaTra_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `AluEntregaTra_ibfk_2` FOREIGN KEY (`codTrabajo`, `codAsignatura`) REFERENCES `Trabajo` (`codTrabajo`, `codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `AluInscritoAsi`
--
ALTER TABLE `AluInscritoAsi`
ADD CONSTRAINT `AluInscritoAsi_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `AluInscritoAsi_ibfk_2` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ProImparteAsi`
--
ALTER TABLE `ProImparteAsi`
ADD CONSTRAINT `ProImparteAsi_ibfk_1` FOREIGN KEY (`emailUsuario`) REFERENCES `Usuario` (`emailUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ProImparteAsi_ibfk_2` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Trabajo`
--
ALTER TABLE `Trabajo`
ADD CONSTRAINT `Trabajo_ibfk_1` FOREIGN KEY (`codAsignatura`) REFERENCES `Asignatura` (`codAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT USAGE ON *.* TO 'Administrador'@'localhost' IDENTIFIED BY 'Administrador' 
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; 
GRANT ALL PRIVILEGES ON `ET3`.* TO 'Administrador'@'localhost'WITH GRANT OPTION; 