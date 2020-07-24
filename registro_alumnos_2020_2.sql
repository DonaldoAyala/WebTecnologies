-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2020 a las 21:35:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro_alumnos_2020_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--
drop database if exists aux;
create database aux;
use aux;
drop database if exists registro_alumnos_2020_2;
create database registro_alumnos_2020_2;
drop database if exists aux;
use registro_alumnos_2020_2;

CREATE TABLE `admin` (
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`usuario`, `contrasena`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `curp` varchar(50) NOT NULL,
  `boleta` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `codigo_postal` int(11) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `escuela` varchar(50) DEFAULT NULL,
  `entidad_federativa` varchar(50) DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  `opcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`curp`, `boleta`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `sexo`, `correo`, `colonia`, `calle`, `numero`, `codigo_postal`, `telefono`, `escuela`, `entidad_federativa`, `promedio`, `opcion`) VALUES
('AASD000913HMCYGNA5', '2019630415', 'Donaldo', 'Ayala', 'Segoviano', '2000-09-13', 'Masculino', 'ayala.segoviano.donaldo@gmail.com', 'Valle de Aragón', 'Valle de Guadiana', 110, 55280, '5523830649', 'Secundaria Técnica 56', 'México', 8.67, 'Primera'),
('AASN011108MMCYGLA9', '1232890913', 'Nailea Valeria', 'Ayala ', 'Segoviano', '2001-11-08', 'Femenino', 'ayala.segoviano.nailea@gmail.com', 'Valle de Aragón 3ra.', 'Valle de Guadiana', 110, 55290, '5557836491', 'CEC y T # 10 CARLOS VALLEJO MÁRQUEZ', 'Distrito Federal', 9.6, 'Primera'),
('EAMP840901MDFSRT02', 'PP12345678', 'Patricia', 'Escamilla', 'Miranda', '1984-09-01', 'Femenino', 'pescamillam84@hotmail.com', 'XYZ', 'QWERTY', 45, 50000, '5656565656', 'CEC y T # 10 CARLOS VALLEJO MÁRQUEZ', 'Colima', 9.16, 'Primera'),
('LORO000603HDFZVWO9', '2019630400', 'Oscar', 'Lozano', 'Rivera', '2000-06-03', 'Masculino', 'oscarcrema0603@gmail.com', 'Gabriel Hernández', 'Cabo Hornos', 45, 70800, '5512345678', 'Vocacional 8', 'Distrito Federal', 9.7, 'Primera');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`curp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
