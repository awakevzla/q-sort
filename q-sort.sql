-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2015 a las 17:02:14
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cola`
--

INSERT INTO `cola` (`id`, `correlativo`, `ticket`, `fecha_hora_inicio`, `fecha_hora_fin`, `estacion_id`, `estado_id`) VALUES
(1, '001', 'APS-001', '2015-10-22 19:45:36', NULL, 2, 3),
(2, '002', 'APS-002', '2015-10-22 19:45:37', NULL, 2, 3),
(3, '003', 'APS-003', '2015-10-22 19:45:37', NULL, 2, 3),
(4, '004', 'APS-004', '2015-10-22 19:45:38', NULL, 2, 3),
(5, '005', 'IMG-005', '2015-10-22 19:52:52', NULL, 3, 1),
(6, '006', 'IMG-006', '2015-10-22 19:52:53', NULL, 3, 1),
(7, '007', 'IMG-007', '2015-10-22 19:52:53', NULL, 3, 1),
(8, '008', 'IMG-008', '2015-10-22 19:52:53', NULL, 3, 1),
(9, '009', 'APS-009', '2015-10-22 19:53:02', NULL, 2, 2),
(10, '010', 'APS-010', '2015-10-22 19:53:03', NULL, 2, 1),
(11, '011', 'APS-011', '2015-10-22 19:53:03', NULL, 2, 1),
(12, '012', 'APS-012', '2015-10-22 19:53:14', NULL, 2, 1),
(13, '013', 'APS-013', '2015-10-22 19:53:15', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE IF NOT EXISTS `estaciones` (
`id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `prefijo` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `nombre`, `descripcion`, `prefijo`, `activo`) VALUES
(1, 'Laboratorio', 'Estación donde se realizan exámenes de sangre', 'LAB', 1),
(2, 'APS', 'Atención Primaria de Salud', 'APS', 1),
(3, 'Imagenologia', 'Estación para realizar exámenes de rayos x y otros.', 'IMG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'En Cola'),
(2, 'Atendiendo'),
(3, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `estacion_id` int(11) DEFAULT NULL,
  `intentos` int(11) NOT NULL DEFAULT '0',
  `baneado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `clave`, `nombre`, `apellido`, `tipo_id`, `estacion_id`, `intentos`, `baneado`) VALUES
(1, 'plugo', 'e10adc3949ba59abbe56e057f20f883e', 'Pedro', 'Lugo', 1, 2, 0, 0),
(2, 'efrain', 'e10adc3949ba59abbe56e057f20f883e', 'Efrain', 'Rodriguez', 1, 1, 0, 0),
(3, 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'usuario', 'usuario', 2, 3, 0, 0);

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
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cola`
--
ALTER TABLE `cola`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
