-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-02-2016 a las 09:06:00
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
  `fecha_hora_atencion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_hora_fin` timestamp NULL DEFAULT NULL,
  `estacion_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `vip` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cola`
--

INSERT INTO `cola` (`id`, `correlativo`, `ticket`, `fecha_hora_inicio`, `fecha_hora_atencion`, `fecha_hora_fin`, `estacion_id`, `estado_id`, `vip`) VALUES
(1, '001', 'LAB-001', '2016-01-25 21:08:53', '2016-01-25 21:10:05', '2016-01-25 21:14:00', 1, 3, 0),
(2, '002', 'LAB-002', '2016-01-25 21:08:54', '2016-01-25 21:22:54', '2016-01-25 21:23:02', 1, 3, 0),
(3, '003', 'LAB-003', '2016-01-25 21:08:55', '2016-01-25 21:23:02', '2016-01-25 21:23:07', 1, 3, 0),
(4, '004', 'APS-004', '2016-01-25 21:08:55', '2016-01-25 21:23:31', '2016-01-25 21:23:39', 2, 3, 0),
(5, '005', 'APS-005', '2016-01-25 21:08:55', '2016-01-25 21:23:41', '2016-01-25 21:23:51', 2, 3, 0),
(6, '006', 'IMG-006', '2016-01-25 21:08:56', '2016-01-25 21:22:12', '2016-01-25 21:22:26', 3, 3, 0),
(7, '007', 'IMG-007', '2016-01-25 21:08:56', '2016-01-25 21:22:26', '2016-01-25 21:22:34', 3, 3, 0),
(8, '008', 'IMG-008', '2016-01-25 21:08:56', '2016-01-25 21:22:34', '2016-01-25 21:22:42', 3, 3, 0),
(9, '009', 'LAB-009', '2016-01-25 21:09:07', '2016-01-25 21:14:00', '2016-01-25 21:22:54', 1, 3, 1),
(10, '010', 'APS-010', '2016-01-25 21:16:13', '2016-01-25 21:16:26', '2016-01-25 21:23:31', 2, 3, 1),
(11, '011', 'IMG-011', '2016-01-25 21:24:50', '2016-01-25 21:25:12', '2016-01-25 21:25:56', 3, 3, 0),
(12, '012', 'IMG-012', '2016-01-25 21:24:51', '2016-01-25 21:25:56', '2016-01-25 21:26:32', 3, 3, 0);

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
  `baneado` tinyint(1) NOT NULL DEFAULT '0',
  `vip` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `clave`, `nombre`, `apellido`, `tipo_id`, `estacion_id`, `intentos`, `baneado`, `vip`) VALUES
(1, 'plugo', 'e10adc3949ba59abbe56e057f20f883e', 'Pedro', 'Lugo', 1, 2, 0, 0, 1),
(2, 'efrain', 'e10adc3949ba59abbe56e057f20f883e', 'Efrain', 'Rodriguez', 1, 1, 0, 0, 1),
(3, 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'usuario', 'usuario', 2, 3, 0, 0, 0);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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