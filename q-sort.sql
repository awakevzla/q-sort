-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-02-2016 a las 16:51:27
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
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  (12, '012', 'IMG-012', '2016-01-25 21:24:51', '2016-01-25 21:25:56', '2016-01-25 21:26:32', 3, 3, 0),
  (13, '001', 'LAB-001', '2016-02-03 15:54:49', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (14, '002', 'LAB-002', '2016-02-03 15:54:50', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (15, '003', 'LAB-003', '2016-02-03 15:54:50', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (16, '004', 'LAB-004', '2016-02-03 15:54:51', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (17, '005', 'LAB-005', '2016-02-03 15:55:09', '2016-02-03 16:08:03', NULL, 1, 2, 1),
  (18, '006', 'LAB-006', '2016-02-03 15:55:25', '0000-00-00 00:00:00', NULL, 1, 1, 1),
  (19, '007', 'LAB-007', '2016-02-03 15:55:52', '0000-00-00 00:00:00', NULL, 1, 1, 1),
  (20, '008', 'APS-008', '2016-02-03 17:22:37', '2016-02-03 17:35:08', '2016-02-03 17:35:35', 2, 3, 0),
  (21, '009', 'APS-009', '2016-02-03 17:22:43', '2016-02-03 17:35:35', '2016-02-03 17:57:53', 2, 3, 0),
  (22, '010', 'APS-010', '2016-02-03 17:37:37', '2016-02-03 17:45:53', '2016-02-03 17:58:30', 2, 3, 0),
  (23, '011', 'APS-011', '2016-02-03 17:37:38', '2016-02-03 17:57:53', '2016-02-03 17:59:40', 2, 3, 0),
  (24, '012', 'APS-012', '2016-02-03 17:37:38', '2016-02-03 17:58:30', '2016-02-03 18:14:12', 2, 3, 0),
  (25, '009', 'APS-009', '2016-02-03 17:57:53', '2016-02-03 18:16:11', '2016-02-03 18:16:25', 4, 3, 0),
  (26, '010', 'APS-010', '2016-02-03 17:58:30', '2016-02-03 18:16:25', '2016-02-03 19:24:19', 4, 3, 0),
  (27, '011', 'APS-011', '2016-02-03 17:59:40', '2016-02-03 19:24:19', '2016-02-03 19:52:39', 4, 3, 0),
  (28, '012', 'APS-012', '2016-02-03 18:14:12', '2016-02-03 19:51:23', '2016-02-03 19:53:03', 8, 3, 0),
  (29, '009', 'APS-009', '2016-02-03 18:16:25', '2016-02-03 19:09:04', '2016-02-03 19:09:46', 2, 3, 0),
  (30, '013', 'APS-013', '2016-02-03 19:08:44', '2016-02-03 19:09:46', '2016-02-03 19:10:08', 2, 3, 0),
  (31, '014', 'APS-014', '2016-02-03 19:08:44', '2016-02-03 19:10:08', '2016-02-03 19:10:20', 2, 3, 0),
  (32, '015', 'APS-015', '2016-02-03 19:08:44', '2016-02-03 19:10:20', '2016-02-03 19:10:27', 2, 3, 0),
  (33, '016', 'APS-016', '2016-02-03 19:10:39', '2016-02-03 19:10:45', '2016-02-03 19:12:00', 2, 3, 0),
  (34, '017', 'APS-017', '2016-02-03 19:12:05', '2016-02-03 19:12:08', '2016-02-03 20:06:55', 2, 3, 0),
  (35, '010', 'APS-010', '2016-02-03 19:24:19', '2016-02-03 20:06:55', NULL, 2, 2, 0),
  (36, '018', 'CON-018', '2016-02-03 19:51:59', '2016-02-03 19:52:39', '2016-02-03 19:54:28', 4, 3, 0),
  (37, '019', 'CON-019', '2016-02-03 19:52:00', '2016-02-03 19:53:04', '2016-02-03 19:54:39', 8, 3, 0),
  (38, '020', 'CON-020', '2016-02-03 19:52:01', '2016-02-03 19:54:28', '2016-02-03 20:00:20', 4, 3, 0),
  (39, '011', 'APS-011', '2016-02-03 19:52:39', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (40, '012', 'APS-012', '2016-02-03 19:53:03', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (41, '021', 'APS-021', '2016-02-03 19:54:12', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (42, '022', 'APS-022', '2016-02-03 19:54:12', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (43, '023', 'APS-023', '2016-02-03 19:54:12', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (44, '024', 'CON-024', '2016-02-03 19:54:15', '2016-02-03 19:54:39', '2016-02-03 20:25:40', 8, 3, 0),
  (45, '025', 'CON-025', '2016-02-03 19:54:15', '2016-02-03 20:05:10', '2016-02-03 20:05:19', 4, 3, 0),
  (46, '026', 'CON-026', '2016-02-03 19:54:16', '2016-02-03 20:05:53', '2016-02-03 20:06:21', 4, 3, 0),
  (47, '018', 'CON-018', '2016-02-03 19:54:28', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (48, '019', 'CON-019', '2016-02-03 19:54:39', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (49, '020', 'CON-020', '2016-02-03 20:00:20', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (50, '025', 'CON-025', '2016-02-03 20:05:19', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (51, '026', 'CON-026', '2016-02-03 20:06:21', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (52, '024', 'CON-024', '2016-02-03 20:25:40', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (53, '027', 'LAB-027', '2016-02-03 21:14:44', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (54, '001', 'APS-001', '2016-02-04 14:01:37', '2016-02-04 14:16:19', '2016-02-04 14:16:32', 2, 3, 0),
  (55, '002', 'APS-002', '2016-02-04 14:01:45', '2016-02-04 14:16:32', '2016-02-04 14:16:50', 2, 3, 0),
  (56, '003', 'APS-003', '2016-02-04 14:01:49', '2016-02-04 14:10:56', '2016-02-04 14:11:22', 2, 3, 1),
  (57, '004', 'APS-004', '2016-02-04 14:01:54', '2016-02-04 14:11:22', '2016-02-04 14:16:19', 2, 3, 1),
  (58, '005', 'APS-005', '2016-02-04 14:08:28', '2016-02-04 14:16:50', '2016-02-04 14:17:07', 2, 3, 0),
  (59, '006', 'APS-006', '2016-02-04 14:08:29', '2016-02-04 14:17:07', '2016-02-04 14:17:25', 2, 3, 0),
  (60, '007', 'APS-007', '2016-02-04 14:08:38', '2016-02-04 14:17:25', '2016-02-04 14:17:42', 2, 3, 0),
  (61, '008', 'LAB-008', '2016-02-04 14:09:18', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (62, '009', 'LAB-009', '2016-02-04 14:09:21', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (63, '010', 'LAB-010', '2016-02-04 14:09:22', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (64, '011', 'LAB-011', '2016-02-04 14:09:22', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (65, '012', 'LAB-012', '2016-02-04 14:09:23', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (66, '013', 'LAB-013', '2016-02-04 14:09:23', '0000-00-00 00:00:00', NULL, 1, 1, 0),
  (67, '014', 'LAB-014', '2016-02-04 14:09:26', '0000-00-00 00:00:00', NULL, 1, 1, 1),
  (68, '015', 'LAB-015', '2016-02-04 14:09:28', '0000-00-00 00:00:00', NULL, 1, 1, 1),
  (69, '016', 'IMG-016', '2016-02-04 14:09:32', '0000-00-00 00:00:00', NULL, 3, 1, 0),
  (70, '017', 'IMG-017', '2016-02-04 14:09:33', '0000-00-00 00:00:00', NULL, 3, 1, 0),
  (71, '018', 'IMG-018', '2016-02-04 14:09:33', '0000-00-00 00:00:00', NULL, 3, 1, 0),
  (72, '019', 'IMG-019', '2016-02-04 14:09:33', '0000-00-00 00:00:00', NULL, 3, 1, 0),
  (73, '020', 'IMG-020', '2016-02-04 14:09:35', '0000-00-00 00:00:00', NULL, 3, 1, 1),
  (74, '021', 'IMG-021', '2016-02-04 14:09:38', '0000-00-00 00:00:00', NULL, 3, 1, 1),
  (75, '022', 'CON-022', '2016-02-04 14:09:39', '2016-02-04 14:12:27', NULL, 4, 2, 0),
  (76, '023', 'CON-023', '2016-02-04 14:09:40', '2016-02-04 14:14:04', '2016-02-04 14:15:06', 8, 3, 0),
  (77, '024', 'CON-024', '2016-02-04 14:09:41', '2016-02-04 14:15:06', '2016-02-04 14:15:24', 8, 3, 0),
  (78, '025', 'CON-025', '2016-02-04 14:09:41', '2016-02-04 14:15:24', '2016-02-04 14:15:44', 8, 3, 0),
  (79, '026', 'CON-026', '2016-02-04 14:09:43', '2016-02-04 14:11:57', '2016-02-04 14:12:09', 4, 3, 1),
  (80, '027', 'CON-027', '2016-02-04 14:09:44', '2016-02-04 14:12:09', '2016-02-04 14:12:27', 4, 3, 1),
  (81, '026', 'CON-026', '2016-02-04 14:12:09', '2016-02-04 14:17:42', '2016-02-04 14:18:23', 2, 3, 0),
  (82, '027', 'CON-027', '2016-02-04 14:12:27', '2016-02-04 14:18:23', '2016-02-04 14:38:00', 2, 3, 0),
  (83, '023', 'CON-023', '2016-02-04 14:15:06', '2016-02-04 14:38:00', '2016-02-04 14:44:33', 2, 3, 0),
  (84, '024', 'CON-024', '2016-02-04 14:15:24', '2016-02-04 14:44:33', '2016-02-04 14:45:11', 2, 3, 0),
  (85, '025', 'CON-025', '2016-02-04 14:15:44', '2016-02-04 14:45:11', '2016-02-04 14:45:27', 2, 3, 0),
  (86, '028', 'CON-028', '2016-02-04 14:34:59', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (87, '029', 'CON-029', '2016-02-04 14:35:00', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (88, '030', 'CON-030', '2016-02-04 14:35:00', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (89, '031', 'CON-031', '2016-02-04 14:35:00', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (90, '032', 'CON-032', '2016-02-04 14:35:01', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (91, '033', 'CON-033', '2016-02-04 14:35:01', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (92, '034', 'CON-034', '2016-02-04 14:35:02', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (93, '035', 'CON-035', '2016-02-04 14:35:02', '0000-00-00 00:00:00', NULL, 4, 1, 0),
  (94, '001', 'APS-001', '2016-02-05 18:56:05', '2016-02-05 18:56:08', '2016-02-05 19:03:44', 2, 3, 0),
  (95, '002', 'APS-002', '2016-02-05 18:57:49', '2016-02-05 19:03:44', '2016-02-05 19:11:30', 2, 3, 0),
  (96, '003', 'APS-003', '2016-02-05 18:57:50', '2016-02-05 19:11:30', '2016-02-05 19:12:13', 2, 3, 0),
  (97, '004', 'APS-004', '2016-02-05 18:57:50', '2016-02-05 19:12:13', '2016-02-05 19:16:48', 2, 3, 0),
  (98, '005', 'APS-005', '2016-02-05 19:13:15', '2016-02-05 20:08:26', '2016-02-05 20:08:31', 2, 3, 0),
  (99, '006', 'APS-006', '2016-02-05 19:13:15', '2016-02-05 20:08:31', '2016-02-05 20:08:38', 2, 3, 0),
  (100, '007', 'APS-007', '2016-02-05 19:13:16', '2016-02-05 20:08:38', '2016-02-05 20:08:44', 2, 3, 0),
  (101, '008', 'APS-008', '2016-02-05 19:13:16', '2016-02-05 20:08:44', '2016-02-05 20:08:49', 2, 3, 0),
  (102, '009', 'APS-009', '2016-02-05 19:13:16', '2016-02-05 20:08:49', '2016-02-05 20:08:55', 2, 3, 0),
  (103, '010', 'APS-010', '2016-02-05 19:13:40', '2016-02-05 19:16:48', '2016-02-05 20:08:26', 2, 3, 1),
  (104, '011', 'APS-011', '2016-02-05 20:24:04', '2016-02-05 20:24:12', '2016-02-05 20:26:06', 2, 3, 0),
  (105, '012', 'APS-012', '2016-02-05 20:24:06', '2016-02-05 20:26:06', '2016-02-05 20:26:16', 2, 3, 0),
  (106, '013', 'APS-013', '2016-02-05 20:24:07', '2016-02-05 20:26:16', '2016-02-05 20:27:10', 2, 3, 0),
  (107, '014', 'APS-014', '2016-02-05 20:24:07', '2016-02-05 20:27:10', '2016-02-05 20:28:23', 2, 3, 0),
  (108, '015', 'APS-015', '2016-02-05 20:24:08', '2016-02-05 20:28:23', '2016-02-05 20:28:38', 2, 3, 0),
  (109, '016', 'APS-016', '2016-02-05 20:24:09', '2016-02-05 20:28:39', '2016-02-05 20:29:36', 2, 3, 0),
  (110, '017', 'APS-017', '2016-02-05 20:29:40', '2016-02-05 20:29:45', '2016-02-05 20:31:53', 2, 3, 0),
  (111, '018', 'APS-018', '2016-02-05 20:29:41', '2016-02-05 20:31:53', '2016-02-05 20:32:24', 2, 3, 0),
  (112, '019', 'APS-019', '2016-02-05 20:29:42', '2016-02-05 20:32:24', '2016-02-05 20:33:45', 2, 3, 0),
  (113, '020', 'APS-020', '2016-02-05 20:29:42', '2016-02-05 20:33:45', '2016-02-05 20:36:31', 2, 3, 0),
  (114, '021', 'APS-021', '2016-02-05 20:29:43', '2016-02-05 20:36:31', '2016-02-05 20:37:37', 2, 3, 0),
  (115, '022', 'APS-022', '2016-02-05 20:36:36', '2016-02-05 20:37:37', '2016-02-05 20:38:18', 2, 3, 0),
  (116, '023', 'APS-023', '2016-02-05 20:36:37', '2016-02-05 20:38:18', '2016-02-05 20:39:21', 2, 3, 0),
  (117, '024', 'APS-024', '2016-02-05 20:36:37', '2016-02-05 20:39:21', '2016-02-05 20:40:13', 2, 3, 0),
  (118, '025', 'APS-025', '2016-02-05 20:36:37', '2016-02-05 20:40:13', '2016-02-05 20:40:38', 2, 3, 0),
  (119, '026', 'APS-026', '2016-02-05 20:36:37', '2016-02-05 20:40:38', '2016-02-05 20:42:00', 2, 3, 0),
  (120, '027', 'APS-027', '2016-02-05 20:36:38', '2016-02-05 20:42:00', '2016-02-05 20:42:57', 2, 3, 0),
  (121, '028', 'APS-028', '2016-02-05 20:42:46', '2016-02-05 20:42:57', '2016-02-05 20:49:15', 2, 3, 0),
  (122, '029', 'APS-029', '2016-02-05 20:42:46', '2016-02-05 20:49:15', NULL, 2, 2, 0),
  (123, '030', 'APS-030', '2016-02-05 20:42:47', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (124, '031', 'APS-031', '2016-02-05 20:42:48', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (125, '032', 'APS-032', '2016-02-05 20:42:48', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (126, '033', 'APS-033', '2016-02-05 20:42:49', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (127, '034', 'APS-034', '2016-02-05 20:42:50', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (128, '035', 'APS-035', '2016-02-05 20:42:50', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (129, '036', 'APS-036', '2016-02-05 20:42:50', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (130, '037', 'APS-037', '2016-02-05 20:42:50', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (131, '038', 'APS-038', '2016-02-05 20:42:51', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (132, '039', 'APS-039', '2016-02-05 20:42:51', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (133, '040', 'APS-040', '2016-02-05 20:42:51', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (134, '041', 'APS-041', '2016-02-05 20:42:51', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (135, '042', 'APS-042', '2016-02-05 20:42:52', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (136, '043', 'APS-043', '2016-02-05 20:42:52', '0000-00-00 00:00:00', NULL, 2, 1, 0),
  (137, '044', 'APS-044', '2016-02-05 20:42:52', '0000-00-00 00:00:00', NULL, 2, 1, 0);

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
  `transferir_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `nombre`, `descripcion`, `prefijo`, `activo`, `id_padre`, `transferir_id`) VALUES
  (1, 'Laboratorio', 'Estación donde se realizan exámenes de sangre', 'LAB', 1, 0, 0),
  (2, 'APS', 'Atención Primaria de Salud', 'APS', 1, 0, 0),
  (3, 'Imagenologia', 'Estación para realizar exámenes de rayos x y otros.', 'IMG', 1, 0, 0),
  (4, 'Consultorio 1', 'Consultorio Médico 1', 'CON1', 1, 0, 2),
  (8, 'Consultorio 2', 'Consultorio Médico 2', 'CON2', 1, 4, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `descrip`, `desde`, `hasta`, `archivo`, `funcion`, `evento`, `tipo_id`, `intervalo`) VALUES
  (1, 'Publicidad Index', '06:00:00', '06:05:59', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 28000),
  (2, 'Lista de Espera', '06:06:00', '07:45:59', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (3, 'Publicidad Index', '07:46:00', '07:48:59', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 28000),
  (4, 'Lista de Espera', '07:49:01', '08:30:00', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (5, 'Publicidad Index', '08:31:01', '09:05:59', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 28000),
  (6, 'Lista de Espera', '09:06:01', '13:10:00', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (7, 'Publicidad Index', '13:10:01', '13:12:00', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 28000),
  (8, 'Lista de Espera', '13:13:01', '15:15:00', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (9, 'Publicidad Index', '15:16:01', '15:20:00', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 55000),
  (10, 'Lista de Espera', '15:21:01', '15:49:00', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (11, 'Publicidad Index', '15:50:01', '15:53:00', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 55000),
  (12, 'Lista de Espera', '15:54:01', '16:04:59', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (13, 'Publicidad Index', '16:45:30', '16:40:00', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 55000),
  (14, 'Lista de Espera', '16:50:01', '16:49:59', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20),
  (15, 'Publicidad Index', '16:50:30', '16:55:00', 'C:\\QSORT\\recursos\\video1.swf', '', 'VISIBLETV', 1, 55000),
  (16, 'Lista de Espera', '16:55:01', '22:49:59', '', 'thisform.cargaespera', 'MOVERLABEL', 2, 20);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos_2`
--

INSERT INTO `eventos_2` (`id`, `ruta`, `tipo_evento_id`, `duracion`, `mensaje`, `voz`) VALUES
  (1, 'http://192.168.100.125/~awakevzla/q-sort/recursos/2-FONDO-PANTALLA-AGUA-1366x768.png', 2, 10, NULL, 0),
  (3, 'http://192.168.100.125/~awakevzla/q-sort/recursos/InventarioTicLogo.avi', 1, 10, NULL, 0),
  (4, 'http://192.168.100.125/~awakevzla/q-sort/recursos/video1.swf', 1, 10, NULL, 0),
  (13, NULL, 3, NULL, NULL, 0),
  (14, 'http://192.168.100.125/~awakevzla/q-sort/recursos/High_Elo_Highlights_25.mp4', 1, 10, NULL, 0),
  (15, 'http://192.168.100.125/~awakevzla/q-sort/recursos/video1.swf', 1, 10, NULL, 0),
  (16, NULL, 4, NULL, 'Un saludo a pato de Efrain!', 1),
  (17, NULL, 4, NULL, 'Un saludo al gafo de Orlando', 0),
  (20, 'http://192.168.100.125/~awakevzla/q-sort/recursos/InventarioTicLogo.avi', 1, 10, NULL, 0);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `eventos_2`
--
ALTER TABLE `eventos_2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;