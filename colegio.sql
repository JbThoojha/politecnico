-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-08-2019 a las 19:01:41
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `Documento` int(20) NOT NULL,
  `Nombres` varchar(20) COLLATE utf8_bin NOT NULL,
  `Apellidos` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `Direccion` varchar(60) COLLATE utf8_bin NOT NULL,
  `Acudiente` varchar(20) COLLATE utf8_bin NOT NULL,
  `Telefono` int(15) NOT NULL,
  `Foto` varchar(225) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Documento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`Documento`, `Nombres`, `Apellidos`, `password`, `Direccion`, `Acudiente`, `Telefono`, `Foto`) VALUES
(232363, 'Maria', 'Caceres', '8cb2237d0679ca88db6464eac60da96345513964', 'nobsa', 'awesrdtfyghu', 1234455, '1566584496-7.PNG'),
(45212121, 'Juan', 'dnjm', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'chameza menor', 'jose', 6421, '1566482146-14.PNG'),
(123456, 'sebastian', 'medina', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'chameza menor', 'diana', 56235623, '1566489237-10.PNG'),
(121763, 'Santiago', 'Medina', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'chameza menor', 'diana', 123456789, '1566584875-3.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
