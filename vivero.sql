-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2017 a las 18:01:11
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vivero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `idcuentas` int(11) NOT NULL,
  `cod_puc` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `naturaleza` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_07_07_223315_crear_tabla_tipos_usuario', 1),
(4, '2016_07_07_225615_update_table_users_V2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puc`
--

CREATE TABLE `puc` (
  `cod_puc` int(11) NOT NULL,
  `nom_puc` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `clase_puc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `puc`
--

INSERT INTO `puc` (`cod_puc`, `nom_puc`, `clase_puc`) VALUES
(1105, 'Caja', 1),
(1110, 'Bancos', 1),
(1120, 'Cuentas de ahorro', 1),
(1305, 'Clientes', 1),
(1435, 'Mercancías no fabricadas por la empresa', 1),
(1605, 'Crédito mercantil', 1),
(2205, 'Proveedores', 2),
(2408, 'IVA', 2),
(3310, 'Reservas estatutarias', 3),
(3315, 'Reservas ocasionales', 3),
(3605, 'Utilidad del ejercicio', 3),
(3705, 'Utilidades acumuladas', 3),
(3710, 'Pérdidas acumuladas', 3),
(3805, 'De inversiones', 3),
(4135, 'Comercio al por mayor y al por menor', 4),
(4175, 'Devoluciones en ventas ', 4),
(6135, 'Costo de Mercancia Vendida', 6),
(139905, 'Clientes', 1),
(159245, 'Flota y equipo aéreo', 1),
(236505, 'Salarios y pagos laborales', 2),
(237005, 'Aportes a entidades promotoras de salud, EPS', 2),
(237006, 'Aportes a administradoras de riesgos profesio', 2),
(237025, 'Embargos judiciales', 2),
(237030, 'Libranzas', 2),
(237095, 'Otros', 2),
(238030, 'Fondos de cesantías y/o pensiones', 2),
(320515, 'Prima en colocación de cuota', 3),
(330505, 'Reserva legal', 3),
(470570, 'Ingresos no operacionales', 4),
(470575, 'Gastos operacionales de administración', 4),
(470580, 'Gastos operacionales de ventas', 4),
(470585, 'Gastos no operacionales', 4),
(510506, 'Sueldos', 5),
(510515, 'Horas extras y recargos', 5),
(510518, 'Comisiones', 5),
(510527, 'Auxilio de transporte', 5),
(510545, 'Auxilios', 5),
(510548, 'Bonificaciones', 5),
(516035, 'Flota y equipo de transporte', 5),
(519910, 'Deudores', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR', NULL, NULL),
(2, 'ESTANDAR', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipoUsuario` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `tipoUsuario`) VALUES
(1, 'Jorge Enrique Romero', 'jromero199@gmail.com', '$2y$10$6dXbCLp3ho5B24ti53f3xuuL7YTHo2IxuauEAa3SfzWTtAXiDNkri', 'UHF64pUPejVyGK5Ens50FSKXYdukO44RmCZWWOyuGBCcALvd4pe58kShx8Pc', '2017-03-06 21:55:52', '2017-03-06 21:55:52', 2),
(2, 'jimeno jimenez', 'yoryi1998@gmail.com', '$2y$10$y3nyfs8pewEN3eXnqWEl4.Hvqq24OkCzYLhh/b52EcjM.eSMe96tO', 'xfq0h9EYVkL3n2oa5MoYYZehe3tX8q2uo0ltN6n6O0Yn7eXqYY9dOycvx9ax', '2017-03-08 23:12:22', '2017-03-08 23:12:22', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idcuentas`),
  ADD KEY `fk_cuentas_puc_idx` (`cod_puc`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `puc`
--
ALTER TABLE `puc`
  ADD PRIMARY KEY (`cod_puc`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idcuentas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cuentas_puc` FOREIGN KEY (`cod_puc`) REFERENCES `puc` (`cod_puc`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
