-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-02-2016 a las 17:18:39
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE IF NOT EXISTS `estaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `prefijo` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `transferir_id` int(11) NOT NULL DEFAULT '0',
  `prioridad` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `nombre`, `descripcion`, `prefijo`, `activo`, `id_padre`, `transferir_id`, `prioridad`) VALUES
  (1, 'Laboratorio', 'Estación donde se realizan exámenes de sangre', 'LAB', 1, 0, 0, 0),
  (2, 'APS', 'Atención Primaria de Salud', 'APS', 1, 0, 4, 0),
  (3, 'Imagenologia', 'Estación para realizar exámenes de rayos x y otros.', 'IMG', 1, 0, 0, 0),
  (4, 'Consultorio 1', 'Consultorio Médico 1', 'CON1', 1, 0, 2, 1),
  (8, 'Consultorio 2', 'Consultorio Médico 2', 'CON2', 1, 4, 2, 0);

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
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL,
  `descrip` char(50) NOT NULL,
  `desde` char(8) NOT NULL,
  `hasta` char(8) NOT NULL,
  `archivo` char(250) NOT NULL,
  `funcion` char(30) NOT NULL,
  `evento` char(50) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `intervalo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_2`
--

CREATE TABLE IF NOT EXISTS `eventos_2` (
  `id` int(11) NOT NULL,
  `ruta` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_evento_id` int(11) NOT NULL,
  `duracion` int(11) DEFAULT NULL,
  `mensaje` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `voz` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos_2`
--

INSERT INTO `eventos_2` (`id`, `ruta`, `tipo_evento_id`, `duracion`, `mensaje`, `voz`) VALUES
  (4, 'http://localhost/q-sort/recursos/Perdida.www.peliculasputlocker.net.avi', 1, 1380, NULL, 0);

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
-- Estructura de tabla para la tabla `tipos_eventos`
--

CREATE TABLE IF NOT EXISTS `tipos_eventos` (
  `id` int(11) NOT NULL,
  `nombre` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_eventos`
--

INSERT INTO `tipos_eventos` (`id`, `nombre`) VALUES
  (1, 'VIDEO'),
  (2, 'FUNCION');

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `registro_log` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_operaciones`
--

CREATE TABLE IF NOT EXISTS `registro_operaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_evento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `evento` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


--
-- Estructura de tabla para la tabla `tipos_eventos_2`
--

CREATE TABLE IF NOT EXISTS `tipos_eventos_2` (
  `id` int(11) NOT NULL,
  `evento` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipos_eventos_2`
--

INSERT INTO `tipos_eventos_2` (`id`, `evento`) VALUES
  (1, 'VIDEOS'),
  (2, 'IMAGENES'),
  (3, 'LISTAS'),
  (4, 'MENSAJES');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `clave`, `nombre`, `apellido`, `tipo_id`, `estacion_id`, `intentos`, `baneado`, `vip`) VALUES
  (1, 'plugo', 'e10adc3949ba59abbe56e057f20f883e', 'Pedro', 'Lugo', 1, 2, 0, 0, 1),
  (2, 'efrain', 'e10adc3949ba59abbe56e057f20f883e', 'Efrain', 'Rodriguez', 1, 1, 1, 0, 1),
  (3, 'usuario', '4297f44b13955235245b2497399d7a93', 'usuario', 'usuario', 2, 3, 0, 0, 0),
  (5, 'test', '4297f44b13955235245b2497399d7a93', 'test', 'test', 1, 4, 0, 0, 1),
  (6, 'consultorio2', '4297f44b13955235245b2497399d7a93', 'consultorio', '2', 2, 8, 0, 0, 0);

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
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
ADD PRIMARY KEY (`id`), ADD KEY `eventos_id` (`tipo_id`);

--
-- Indices de la tabla `eventos_2`
--
ALTER TABLE `eventos_2`
ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_eventos`
--
ALTER TABLE `tipos_eventos`
ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_eventos_2`
--
ALTER TABLE `tipos_eventos_2`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos_2`
--
ALTER TABLE `eventos_2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipos_eventos_2`
--
ALTER TABLE `tipos_eventos_2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cola`
--
ALTER TABLE `cola`
ADD CONSTRAINT `cola_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
ADD CONSTRAINT `cola_ibfk_2` FOREIGN KEY (`estacion_id`) REFERENCES `estaciones` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
ADD CONSTRAINT `eventos_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_eventos` (`id`);


--
-- Indices de la tabla `registro_log`
--
ALTER TABLE `registro_log`
ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_operaciones`
--
ALTER TABLE `registro_operaciones`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro_log`
--
ALTER TABLE `registro_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `registro_operaciones`
--
ALTER TABLE `registro_operaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;