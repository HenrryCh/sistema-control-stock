-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-03-2024 a las 21:07:09
-- Versión del servidor: 10.11.7-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u682580569_uvstock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'campoFK',
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(10, 'Audio', 1),
(11, 'Cuerda', 1),
(12, 'Viento', 1),
(22, 'Percusión', 1),
(23, 'Iluminación', 1),
(24, 'Varios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_devoluciones`
--

CREATE TABLE `detalle_devoluciones` (
  `id` int(11) NOT NULL,
  `devolucion_id` int(11) NOT NULL COMMENT 'campoRefPadre',
  `producto_id` int(11) NOT NULL COMMENT 'campoReferencia',
  `cantidad` int(11) NOT NULL,
  `motivo_devolucion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_devoluciones`
--

INSERT INTO `detalle_devoluciones` (`id`, `devolucion_id`, `producto_id`, `cantidad`, `motivo_devolucion_id`) VALUES
(22, 18, 12, 1, 5),
(23, 19, 26, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingresos`
--

CREATE TABLE `detalle_ingresos` (
  `id` int(11) NOT NULL,
  `ingreso_id` int(11) NOT NULL COMMENT 'campoRefPadre',
  `producto_id` int(11) NOT NULL COMMENT 'campoReferencia',
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `detalle_ingresos`
--

INSERT INTO `detalle_ingresos` (`id`, `ingreso_id`, `producto_id`, `cantidad`, `precio_compra`, `subtotal`) VALUES
(62, 1, 12, 4, 160.00, 640.00),
(63, 1, 13, 5, 360.00, 1800.00),
(64, 1, 14, 30, 6.00, 180.00),
(65, 2, 15, 8, 25.00, 200.00),
(66, 2, 16, 3, 90.00, 270.00),
(67, 2, 18, 15, 16.00, 240.00),
(68, 3, 19, 5, 6.00, 30.00),
(69, 3, 20, 4, 165.00, 660.00),
(70, 3, 21, 4, 165.00, 660.00),
(71, 4, 22, 5, 121.00, 605.00),
(72, 5, 23, 10, 35.00, 350.00),
(73, 5, 28, 5, 3.00, 15.00),
(74, 6, 24, 5, 70.00, 350.00),
(75, 6, 25, 10, 8.00, 80.00),
(76, 7, 26, 3, 85.00, 255.00),
(77, 8, 27, 11, 2.75, 30.25),
(78, 9, 12, 5, 150.00, 750.00),
(79, 10, 12, 4, 120.00, 480.00),
(80, 11, 13, 5, 500.00, 2500.00),
(81, 12, 14, 5, 8.00, 40.00),
(82, 13, 13, 2, 100.00, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salidas`
--

CREATE TABLE `detalle_salidas` (
  `id` int(11) NOT NULL,
  `salida_id` int(11) NOT NULL COMMENT 'campoRefPadre',
  `producto_id` int(11) NOT NULL COMMENT 'campoReferencia',
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `descuento` decimal(12,2) DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL COMMENT 'campoSubtotal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `detalle_salidas`
--

INSERT INTO `detalle_salidas` (`id`, `salida_id`, `producto_id`, `cantidad`, `precio`, `descuento`, `subtotal`) VALUES
(92, 1, 12, 4, 200.00, 10.00, 790.00),
(93, 1, 13, 3, 400.00, 25.00, 1175.00),
(94, 1, 14, 5, 8.00, NULL, 40.00),
(95, 2, 15, 6, 35.00, NULL, 210.00),
(96, 2, 16, 2, 120.00, NULL, 240.00),
(97, 2, 18, 5, 22.00, NULL, 110.00),
(98, 3, 19, 5, 7.00, NULL, 35.00),
(99, 3, 20, 4, 175.00, NULL, 700.00),
(100, 4, 21, 3, 175.00, NULL, 525.00),
(101, 4, 22, 6, 160.00, NULL, 960.00),
(102, 5, 23, 9, 45.00, NULL, 405.00),
(103, 5, 24, 5, 90.00, NULL, 450.00),
(104, 6, 25, 4, 12.00, NULL, 48.00),
(105, 6, 26, 2, 120.00, 10.00, 230.00),
(106, 7, 27, 9, 12.00, NULL, 108.00),
(107, 7, 28, 14, 3.50, NULL, 49.00),
(108, 8, 28, 10, 3.50, NULL, 35.00),
(109, 8, 23, 10, 45.00, NULL, 450.00),
(110, 9, 24, 9, 90.00, NULL, 810.00),
(111, 9, 27, 5, 12.00, NULL, 60.00),
(112, 10, 25, 5, 12.00, NULL, 60.00),
(113, 10, 28, 15, 3.50, NULL, 52.50),
(114, 11, 12, 6, 200.00, NULL, 1200.00),
(115, 11, 22, 5, 160.00, NULL, 800.00),
(116, 12, 13, 1, 400.00, NULL, 400.00),
(117, 13, 14, 5, 8.00, NULL, 40.00),
(118, 14, 21, 2, 175.00, NULL, 350.00),
(119, 15, 20, 2, 175.00, NULL, 350.00),
(120, 16, 15, 5, 35.00, NULL, 175.00),
(121, 17, 19, 5, 7.00, NULL, 35.00),
(122, 18, 18, 15, 22.00, NULL, 330.00),
(123, 19, 21, 1, 175.00, NULL, 175.00),
(124, 20, 15, 2, 35.00, NULL, 70.00),
(125, 21, 26, 1, 120.00, NULL, 120.00),
(126, 22, 28, 5, 3.50, NULL, 17.50),
(127, 23, 25, 2, 12.00, NULL, 24.00),
(128, 24, 24, 5, 90.00, NULL, 450.00),
(129, 25, 20, 3, 175.00, NULL, 525.00),
(130, 26, 12, 2, 200.00, NULL, 400.00),
(131, 27, 13, 4, 400.00, NULL, 1600.00),
(132, 28, 14, 5, 8.00, NULL, 40.00),
(133, 29, 15, 2, 35.00, NULL, 70.00),
(134, 30, 12, 5, 200.00, NULL, 1000.00),
(135, 31, 20, 1, 175.00, NULL, 175.00),
(136, 32, 16, 2, 120.00, NULL, 240.00),
(137, 33, 12, 5, 200.00, NULL, 1000.00),
(138, 34, 14, 5, 8.00, NULL, 40.00),
(139, 35, 21, 2, 175.00, NULL, 350.00),
(140, 36, 23, 5, 45.00, NULL, 225.00),
(141, 37, 24, 12, 90.00, NULL, 1080.00),
(142, 38, 12, 1, 200.00, 5.00, 195.00),
(143, 39, 14, 5, 8.00, NULL, 40.00),
(144, 40, 14, 5, 8.00, NULL, 40.00),
(145, 40, 12, 2, 200.00, NULL, 400.00),
(146, 41, 12, 1, 200.00, 5.00, 195.00),
(147, 42, 12, 5, 200.00, NULL, 1000.00),
(148, 43, 13, 2, 400.00, NULL, 800.00),
(149, 44, 16, 2, 120.00, NULL, 240.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id`, `fecha`, `nombre`, `telefono`, `estado`) VALUES
(18, '2023-06-25', 'Alex Quicaliquin', '0982514979', 0),
(19, '2023-06-27', 'Alex', '09606189747', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL COMMENT 'campoFK',
  `estado` varchar(20) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Generar PDF';

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `fecha`, `estado`, `proveedor_id`, `total`, `created_at`, `updated_at`) VALUES
(1, '2023-01-10', '1', 3, 2620.00, '2023-06-23 23:09:47', NULL),
(2, '2023-02-15', '1', 9, 710.00, '2023-06-23 23:10:17', NULL),
(3, '2023-03-14', '1', 4, 1350.00, '2023-06-23 23:10:32', NULL),
(4, '2023-04-04', '1', 11, 605.00, '2023-06-23 23:10:55', NULL),
(5, '2023-04-20', '1', 4, 365.00, '2023-06-23 23:11:41', NULL),
(6, '2023-05-10', '1', 5, 430.00, '2023-06-23 23:11:56', NULL),
(7, '2023-05-23', '1', 6, 255.00, '2023-06-23 23:12:22', NULL),
(8, '2023-06-13', '1', 8, 30.25, '2023-06-23 23:12:36', NULL),
(9, '2023-06-15', '1', 3, 750.00, '2023-06-23 23:14:45', NULL),
(10, '2023-06-19', '1', 3, 480.00, '2023-06-23 23:15:11', NULL),
(11, '2023-06-21', '1', 4, 2500.00, '2023-06-23 23:16:48', NULL),
(12, '2023-06-23', '1', 3, 40.00, '2023-06-23 23:16:30', NULL),
(13, '2023-06-25', '1', 4, 200.00, '2023-06-25 21:00:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_20_031159_create_sessions_table', 1),
(7, '2023_01_22_155401_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 25),
(1, 'App\\Models\\User', 34),
(1, 'App\\Models\\User', 35),
(1, 'App\\Models\\User', 36),
(1, 'App\\Models\\User', 37),
(1, 'App\\Models\\User', 40),
(1, 'App\\Models\\User', 42),
(1, 'App\\Models\\User', 45),
(1, 'App\\Models\\User', 46),
(20, 'App\\Models\\User', 27),
(20, 'App\\Models\\User', 30),
(20, 'App\\Models\\User', 38),
(20, 'App\\Models\\User', 39),
(20, 'App\\Models\\User', 41),
(20, 'App\\Models\\User', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_devoluciones`
--

CREATE TABLE `motivo_devoluciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivo_devoluciones`
--

INSERT INTO `motivo_devoluciones` (`id`, `nombre`, `estado`) VALUES
(5, 'Presenta daños', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `id` int(11) NOT NULL,
  `nombre_negocio` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocio`
--

INSERT INTO `negocio` (`id`, `nombre_negocio`, `telefono`, `email`, `direccion`, `logo`) VALUES
(2, 'CAS MUSICAL uvs', '324343', NULL, NULL, 'public/negoci/3i5ParELJfzH5dlJ5J7l0lNb8Ds01jtC59gaBdWp.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('wverau@gmail.com', '$2y$10$Aof5C/XOblvgwF8vCdlPkOUHd1MeOoeGY/D6yJ9exv8EipFI0LV5O', '2023-03-17 15:44:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `tabla` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `tabla`, `created_at`, `updated_at`) VALUES
(1, 'dashboard categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(2, 'list categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(3, 'create categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(4, 'show categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(5, 'edit categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(6, 'delete categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(7, 'report categorias', 'web', 'categorias', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(8, 'dashboard motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(9, 'list motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(10, 'create motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(11, 'show motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(12, 'edit motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(13, 'delete motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(14, 'report motivo_devoluciones', 'web', 'motivo_devoluciones', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(15, 'dashboard negocio', 'web', 'negocio', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(16, 'list negocio', 'web', 'negocio', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(17, 'create negocio', 'web', 'negocio', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(18, 'show negocio', 'web', 'negocio', '2023-03-06 15:16:03', '2023-03-06 15:16:03'),
(19, 'edit negocio', 'web', 'negocio', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(20, 'delete negocio', 'web', 'negocio', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(21, 'report negocio', 'web', 'negocio', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(22, 'dashboard proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(23, 'list proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(24, 'create proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(25, 'show proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(26, 'edit proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(27, 'delete proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(28, 'report proveedores', 'web', 'proveedores', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(29, 'dashboard salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(30, 'list salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(31, 'create salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(32, 'show salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(33, 'edit salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(34, 'delete salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(35, 'report salidas', 'web', 'salidas', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(36, 'dashboard ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(37, 'list ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(38, 'create ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(39, 'show ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(40, 'edit ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(41, 'delete ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(42, 'report ingresos', 'web', 'ingresos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(43, 'dashboard devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(44, 'list devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(45, 'create devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(46, 'show devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(47, 'edit devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(48, 'delete devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(49, 'report devoluciones', 'web', 'devoluciones', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(50, 'dashboard productos', 'web', 'productos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(51, 'list productos', 'web', 'productos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(52, 'create productos', 'web', 'productos', '2023-03-06 15:16:04', '2023-03-06 15:16:04'),
(53, 'show productos', 'web', 'productos', '2023-03-06 15:16:05', '2023-03-06 15:16:05'),
(54, 'edit productos', 'web', 'productos', '2023-03-06 15:16:05', '2023-03-06 15:16:05'),
(55, 'delete productos', 'web', 'productos', '2023-03-06 15:16:05', '2023-03-06 15:16:05'),
(56, 'report productos', 'web', 'productos', '2023-03-06 15:16:05', '2023-03-06 15:16:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'campoFK',
  `descripcion` tinytext DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `precio_compra` decimal(12,2) NOT NULL,
  `precio_venta` decimal(12,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `marca`, `categoria_id`, `proveedor_id`, `precio_compra`, `precio_venta`, `cantidad`, `stock_minimo`, `estado`) VALUES
(12, '00441', 'Guitarra', 'Guitarra clásica', 'Fender', 11, 3, 139.70, 200.00, 8, 5, 1),
(13, '00141', 'Acordeón', 'Acordeón único en el país', 'Roland', 10, 4, 286.67, 400.00, 18, 1, 1),
(14, '01755', 'Flauta', 'Flauta de madera', 'Hohner', 12, 3, 6.07, 8.00, 15, 5, 1),
(15, '00185', 'Tambor', 'N/A', 'Griffin', 12, 5, 25.00, 35.00, 5, 4, 1),
(16, '00198', 'Batería', 'Batería eléctrica', 'Sonny', 10, 4, 87.50, 120.00, 0, 1, 1),
(18, '00614', 'Bobina', 'Para driver Thunder D11029', NULL, 24, 9, 15.50, 22.00, 10, 5, 1),
(19, '00778', 'Resistencia', 'Para diferente capacidad', NULL, 24, 7, 5.25, 7.00, 10, 10, 1),
(20, '00885', 'Super Driver', NULL, 'IBBOCX GDO19-E', 24, 6, 161.67, 175.00, 2, 4, 1),
(21, '00945', 'Timbal', NULL, 'Came', 22, 4, 161.82, 175.00, 3, 3, 1),
(22, '00101', 'Tornamesa', NULL, 'GMINI XL-BD10', 24, 11, 120.19, 160.00, 15, 1, 1),
(23, '00110', 'Luz Flash', 'Grande', NULL, 23, 12, 31.28, 45.00, 15, 1, 1),
(24, '00121', 'Parlante', NULL, 'Bumper 12', 10, 7, 70.00, 90.00, 4, 10, 1),
(25, '00135', 'Cable USB', 'Extensión A midi', NULL, 24, 5, 8.00, 12.00, 3, 5, 1),
(26, '01477', 'Guitarra', NULL, 'Fenix', 11, 6, 83.00, 120.00, 2, NULL, 1),
(27, '02001', 'Cable', 'Plug', 'BesserSound', 10, 8, 5.47, 12.00, 5, 4, 1),
(28, '01603', 'Plug', 'Conector 3.5', 'BesserSound', 10, 4, 2.64, 3.50, 10, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'campoFK',
  `encargado` varchar(100) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `encargado`, `ruc`, `telefono`, `correo`, `direccion`, `estado`) VALUES
(3, 'EQMUSIC', 'Freddy Saruma', '1768156470001', '0985632451', 'eqmusic@gmail.com', 'Ambato', 1),
(4, 'Sonika', 'Pedro Ramirez', '1760004650001', '0986245357', 'sonika@gmail.com', 'Guayaquil', 1),
(5, 'L & S Studio', 'Angel Guaman', '1768152560001', '0983256338', 'ls@gmail.com', 'Loja', 0),
(6, 'JC Instrumentos', 'Daniel Guzmán', '24851268420', '098546327', 'jc@gmail.com', 'Ambato', 1),
(7, 'Import Music', 'Alfredo Moran', '1248536479', '098542657', 'import@gmail.com', 'Quito', 1),
(8, 'Mas Musika UIO', 'Angel Galarza', '2453589632', '0956423538', 'uio@gmial.com', 'Quito', 1),
(9, 'DISTRIMUSIC', 'Pedro Albán', '1285436978', '0984632578', 'distrimusic@gmail.com', 'Guayaquil', 1),
(10, 'Electro Sonido FM', 'Antonio Guaman', '1578965329', '0986423567', 'electro@gmail.com', 'Tungurahua', 1),
(11, 'Prosonido', 'Jhonatan Flores', '1245789658', '0965478339', 'prosonido@gmail.com', 'Tungurahua', 1),
(12, 'Casa Brasil', 'Juan Montero', '12458962578', '09854336', 'casabrasil@gmail.com', 'Quito', 1),
(13, 'La Lira', 'Ana Peña', '12458896353', '0985466332', 'lalira@gmail.com', 'Ambato', 1),
(19, 'VALL PAR', 'PATRICIO', '0202145660', '0990163063', 'oscarchk90@gmail.com', 'quito sur', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Gerente', 'web', '2023-03-06 15:16:05', '2023-03-28 18:02:55'),
(20, 'Empleado', 'web', '2023-04-30 23:14:07', '2023-04-30 23:14:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 20),
(29, 20),
(30, 20),
(31, 20),
(32, 20),
(35, 20),
(36, 20),
(37, 20),
(38, 20),
(39, 20),
(42, 20),
(43, 20),
(44, 20),
(45, 20),
(46, 20),
(49, 20),
(50, 20),
(51, 20),
(53, 20),
(56, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int(11) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Generar PDF';

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `num_documento`, `fecha`, `cliente`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'x', '2023-01-05', 'Varios', 2005.00, '1', NULL, NULL),
(2, 'x', '2023-01-10', 'Varios', 560.00, '1', NULL, NULL),
(3, 'x', '2023-01-25', 'Varios', 735.00, '1', NULL, NULL),
(4, 'x', '2023-02-14', 'Varios', 1485.00, '1', NULL, NULL),
(5, 'x', '2023-03-08', 'Varios', 855.00, '1', NULL, NULL),
(6, 'x', '2023-03-29', 'Varios', 278.00, '1', NULL, NULL),
(7, 'x', '2023-04-04', 'Varios', 157.00, '1', NULL, NULL),
(8, 'x', '2023-04-25', 'Varios', 485.00, '1', NULL, NULL),
(9, 'x', '2023-05-10', 'Varios', 870.00, '1', NULL, NULL),
(10, 'x', '2023-05-24', 'Varios', 112.50, '1', NULL, NULL),
(11, 'x', '2023-06-04', 'Varios', 2000.00, '1', NULL, NULL),
(12, 'x', '2023-06-07', 'Varios', 400.00, '1', NULL, NULL),
(13, 'x', '2023-06-11', 'Varios', 40.00, '1', NULL, NULL),
(14, 'x', '2023-06-12', 'Varios', 350.00, '1', NULL, NULL),
(15, 'x', '2023-06-15', 'Varios', 350.00, '1', NULL, NULL),
(16, 'x', '2023-06-16', 'Varios', 175.00, '1', NULL, NULL),
(17, 'x', '2023-06-17', 'Varios', 35.00, '1', NULL, NULL),
(18, 'x', '2023-06-18', 'Varios', 330.00, '1', NULL, NULL),
(19, 'x', '2023-06-18', 'Varios', 175.00, '1', NULL, NULL),
(20, 'x', '2023-06-19', 'Varios', 70.00, '1', NULL, NULL),
(21, 'x', '2023-06-19', 'Varios', 120.00, '1', NULL, NULL),
(22, 'x', '2023-06-20', 'Varios', 17.50, '1', NULL, NULL),
(23, 'x', '2023-06-20', 'Varios', 24.00, '1', NULL, NULL),
(24, 'x', '2023-06-20', 'Varios', 450.00, '1', NULL, NULL),
(25, 'x', '2023-06-21', 'Varios', 525.00, '1', NULL, NULL),
(26, 'x', '2023-06-22', 'Varios', 400.00, '1', NULL, NULL),
(27, 'x', '2023-06-22', 'Varios', 1600.00, '1', NULL, NULL),
(28, 'x', '2023-06-23', 'Varios', 40.00, '1', NULL, NULL),
(29, 'x', '2023-06-23', 'Varios', 70.00, '1', NULL, NULL),
(30, 'x', '2023-06-24', 'Varios', 1000.00, '1', NULL, NULL),
(31, 'x', '2023-06-24', 'Varios', 175.00, '1', NULL, NULL),
(32, 'x', '2023-06-26', 'Varios', 240.00, '1', NULL, NULL),
(33, 'x', '2023-06-26', 'Varios', 1000.00, '1', NULL, NULL),
(34, 'x', '2023-06-26', 'Varios', 40.00, '1', NULL, NULL),
(35, 'x', '2023-06-27', 'Varios', 350.00, '1', NULL, NULL),
(36, 'x', '2023-06-27', 'Varios', 225.00, '1', NULL, NULL),
(37, 'x', '2023-06-27', 'Varios', 1080.00, '1', NULL, NULL),
(38, 'x', '2023-06-25', 'Varios', 195.00, '1', NULL, NULL),
(39, 'x', '2023-06-27', 'Varios', 40.00, '1', NULL, NULL),
(40, 'x', '2023-06-27', 'Varios', 440.00, '1', NULL, NULL),
(41, 'x', '2023-06-27', 'Varios', 195.00, '1', NULL, NULL),
(42, 'x', '2024-03-05', 'Varios', 1000.00, '1', NULL, NULL),
(43, 'x', '2024-03-05', 'Varios', 800.00, '1', NULL, NULL),
(44, 'x', '2024-03-05', 'Varios', 240.00, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cedula` varchar(20) NOT NULL COMMENT 'digits',
  `nombres` varchar(50) NOT NULL COMMENT 'alpha_spaces',
  `apellidos` varchar(50) NOT NULL COMMENT 'alpha_spaces',
  `celular` varchar(20) NOT NULL COMMENT 'digits',
  `estado` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `cedula`, `nombres`, `apellidos`, `celular`, `estado`, `deleted_at`) VALUES
(1, 'Henrry Chariguaman', 'henry.chariguaman@gmail.com', NULL, '$2y$10$fzstFIj/hTd6LFyNxbjgru9hsi90wN1FKbB7XVrFYTj8NtwRw9TBC', NULL, NULL, NULL, 'Ld0iIERJpagcZPtbo9bFJMlOfxJtmemPGbnDC9go8JXpZWcT6GqCecssVYfM', NULL, 'henrry-chariguaman_1686846659.jpeg', '2023-03-06 15:15:39', '2023-06-15 11:30:59', '025002057', 'Henrry', 'Chariguaman', '098545555', 1, NULL),
(40, 'Alex Joel Quicaliquin Rochina', 'joelalexqr@gmail.com', NULL, '$2y$10$IfitVCyA6EJJYqIV3jUid.MvzgdemgblhFy1ePlQz4KUpA.GmyHAS', NULL, NULL, NULL, '5C6GOwxJrNuiL8AqcX52rN9JJ6Ape5pCYwuflX0ImpOV5FPR2uX4n3RtgpHT', NULL, 'alex-joel-quicaliquin-rochina_1683941507.jpg', '2023-05-12 19:53:15', '2023-05-12 20:31:47', '0250256179', 'Alex Joel', 'Quicaliquin Rochina', '098379289', 1, NULL),
(44, 'Pedro Ninabanda', 'predo@gmail.com', NULL, '$2y$10$woKwD1xI4qWCpRcyx6TkjeEeMQjSXB6hsvxvouRwNaf8wePmg4fju', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 12:47:39', '2023-06-26 12:47:43', '0250045278', 'Pedro', 'Ninabanda', '0983546235', 1, '2023-06-26 12:47:43'),
(45, 'Oscar Chela', 'oscarchk@hotmail.com', NULL, '$2y$10$myK8a14S46KboghWRP7/Q.qzisr/SJeDwt1.ppXZIwpmuRPFX8.O2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-27 19:43:12', '2023-09-27 19:43:12', '01234567891', 'Oscar', 'Chela', '0985465339', 1, NULL),
(46, 'Admin Admin', 'admin@admin', NULL, '$2y$10$Q31S2b7V9qQtziVUKJArDuao/iwCQ4GzyzepnNV8Xg/gq1ZEDse1a', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-25 22:44:54', '2024-01-25 22:44:54', '00000', 'Admin', 'Admin', '0000000', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalle_devoluciones`
--
ALTER TABLE `detalle_devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_devoluciones_devoluciones1_idx` (`devolucion_id`),
  ADD KEY `fk_detalle_devoluciones_motivo_devoluciones1_idx` (`motivo_devolucion_id`),
  ADD KEY `fk_detalle_devoluciones_productos1_idx` (`producto_id`);

--
-- Indices de la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_ingreso_idx` (`ingreso_id`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`producto_id`);

--
-- Indices de la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`producto_id`),
  ADD KEY `fk_detalle_venta_idx` (`salida_id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ingreso_proveedor1_idx` (`proveedor_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `motivo_devoluciones`
--
ALTER TABLE `motivo_devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_negocio_UNIQUE` (`nombre_negocio`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_articulo_categoria_idx` (`categoria_id`),
  ADD KEY `fk_productos_proveedores1_idx` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `detalle_devoluciones`
--
ALTER TABLE `detalle_devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `motivo_devoluciones`
--
ALTER TABLE `motivo_devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `negocio`
--
ALTER TABLE `negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_devoluciones`
--
ALTER TABLE `detalle_devoluciones`
  ADD CONSTRAINT `fk_detalle_devoluciones_devoluciones1` FOREIGN KEY (`devolucion_id`) REFERENCES `devoluciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_devoluciones_motivo_devoluciones1` FOREIGN KEY (`motivo_devolucion_id`) REFERENCES `motivo_devoluciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_devoluciones_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  ADD CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`ingreso_id`) REFERENCES `ingresos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`salida_id`) REFERENCES `salidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingreso_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
