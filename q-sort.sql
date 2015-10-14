-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-10-2015 a las 16:49:54
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `q-sort`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cola`
--

CREATE TABLE IF NOT EXISTS `cola` (
`id` int(11) NOT NULL,
  `correlativo` varchar(3) COLLATE utf8_spanish2_ci NOT NULL,
  `ticket` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_hora_fin` timestamp NULL DEFAULT NULL,
  `estacion_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cola`
--

INSERT INTO `cola` (`id`, `correlativo`, `ticket`, `fecha_hora_inicio`, `fecha_hora_fin`, `estacion_id`, `estado_id`) VALUES
(1, '001', 'APS-001', '2015-10-07 15:48:53', NULL, 2, 3),
(2, '002', 'APS-002', '2015-10-07 15:49:20', NULL, 2, 3),
(3, '003', 'APS-003', '2015-10-07 15:50:57', NULL, 2, 3),
(4, '004', 'APS-004', '2015-10-07 15:51:05', NULL, 2, 3),
(5, '005', 'APS-005', '2015-10-07 16:19:36', NULL, 2, 3),
(6, '006', 'APS-006', '2015-10-07 16:19:38', NULL, 2, 3),
(7, '007', 'APS-007', '2015-10-07 16:19:39', NULL, 2, 3),
(8, '008', 'APS-008', '2015-10-07 16:19:41', NULL, 2, 3),
(9, '009', 'LAB-009', '2015-10-07 17:43:46', NULL, 1, 1),
(10, '010', 'APS-010', '2015-10-07 17:43:49', NULL, 2, 3),
(11, '011', 'IMG-011', '2015-10-07 17:43:50', NULL, 3, 1),
(12, '012', 'APS-012', '2015-10-07 17:43:51', NULL, 2, 3),
(13, '013', 'IMG-013', '2015-10-07 17:43:52', NULL, 3, 1),
(14, '014', 'LAB-014', '2015-10-07 17:43:52', NULL, 1, 1),
(15, '015', 'LAB-015', '2015-10-07 17:43:53', NULL, 1, 1),
(16, '016', 'IMG-016', '2015-10-07 17:43:54', NULL, 3, 1),
(17, '017', 'APS-017', '2015-10-07 17:43:54', NULL, 2, 3),
(18, '018', 'APS-018', '2015-10-07 17:43:54', NULL, 2, 3),
(19, '019', 'APS-019', '2015-10-07 17:43:55', NULL, 2, 3),
(20, '020', 'APS-020', '2015-10-07 17:43:55', NULL, 2, 3),
(21, '021', 'APS-021', '2015-10-07 17:43:55', NULL, 2, 3),
(22, '022', 'APS-022', '2015-10-07 17:43:56', NULL, 2, 3),
(23, '023', 'APS-023', '2015-10-07 17:43:56', NULL, 2, 3),
(24, '024', 'APS-024', '2015-10-07 17:43:56', NULL, 2, 3),
(25, '025', 'APS-025', '2015-10-07 17:43:56', NULL, 2, 3),
(26, '026', 'APS-026', '2015-10-07 17:46:06', NULL, 2, 3),
(27, '027', 'APS-027', '2015-10-07 17:46:07', NULL, 2, 3),
(28, '028', 'APS-028', '2015-10-07 17:46:08', NULL, 2, 3),
(29, '029', 'APS-029', '2015-10-07 17:46:09', NULL, 2, 3),
(30, '030', 'APS-030', '2015-10-07 17:46:10', NULL, 2, 3),
(31, '031', 'APS-031', '2015-10-07 17:55:00', NULL, 2, 3),
(32, '032', 'APS-032', '2015-10-07 17:55:01', NULL, 2, 3),
(33, '033', 'APS-033', '2015-10-07 17:55:02', NULL, 2, 3),
(34, '034', 'APS-034', '2015-10-07 17:56:09', NULL, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE IF NOT EXISTS `estaciones` (
`id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `prefijo` varchar(6) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `nombre`, `descripcion`, `prefijo`) VALUES
(1, 'Laboratorio', 'Estación donde se realizan exámenes de sangre', 'LAB'),
(2, 'APS', 'Atención Primaria de Salud', 'APS'),
(3, 'Imagenologia', 'Estación para realizar exámenes de rayos x y otros.', 'IMG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'En Cola'),
(2, 'Atendiendo'),
(3, 'Cerrado'),
(4, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `level` enum('a','d','r') DEFAULT NULL,
  `opciones` char(50) NOT NULL,
  `conectado` int(11) NOT NULL,
  `escaner` int(11) NOT NULL,
  `ocupado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `level`, `opciones`, `conectado`, `escaner`, `ocupado`) VALUES
(1, 'admin', '123456', 'a', '1,2,3 / 1,2,3,4,5', 1, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cola`
--
ALTER TABLE `cola`
 ADD PRIMARY KEY (`id`), ADD KEY `estado_id` (`estado_id`), ADD KEY `estacion_id` (`estacion_id`);

--
-- Indices de la tabla `estaciones`
--
ALTER TABLE `estaciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cola`
--
ALTER TABLE `cola`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cola`
--
ALTER TABLE `cola`
ADD CONSTRAINT `cola_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
ADD CONSTRAINT `cola_ibfk_2` FOREIGN KEY (`estacion_id`) REFERENCES `estaciones` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
