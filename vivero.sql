-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2017 a las 01:25:38
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crearfc` (IN `idArticulo` VARCHAR(5), IN `idFactura` INT, IN `cantidad` INT, IN `precio_compra` INT, IN `precio_venta` INT, IN `precio` INT)  NO SQL
IF NOT EXISTS ( SELECT `idArticulo`, `idFactura`, `cantidad`, `precio_venta`, `descuento` 
FROM detalle_factura
WHERE detalle_factura.idArticulo = idArticulo and detalle_factura.idFactura=idFactura) THEN
INSERT INTO `detalle_factura`(`idArticulo`, `idFactura`, `cantidad`, `precio_venta`, `precio_compra`, `prom`) VALUES (idArticulo,idFactura,cantidad,precio_venta,precio_compra,precio);
ELSE
SELECT 'Este Detalle ya existe en la base de datos!';
END IF$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearfv` (IN `idArticulo` VARCHAR(5), IN `idFactura` INT, IN `cantidad` INT, IN `precio_venta` INT, IN `descuento` INT, IN `precio` INT)  NO SQL
IF NOT EXISTS ( SELECT `idArticulo`, `idFactura`, `cantidad`, `precio_venta`, `descuento` 
FROM detalle_factura
WHERE detalle_factura.idArticulo = idArticulo and detalle_factura.idFactura=idFactura) THEN
INSERT INTO `detalle_factura`(`idArticulo`, `idFactura`, `cantidad`, `precio_venta`, `descuento`, `prom`) VALUES (idArticulo,idFactura,cantidad,precio_venta,descuento,precio);
ELSE
SELECT 'Este Detalle ya existe en la base de datos!';
END IF$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idArticulos` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `nom_articulo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Categorias_idCategorias` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `maximo` int(11) DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `Estado` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Activo',
  `Precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idArticulos`, `nom_articulo`, `Categorias_idCategorias`, `stock`, `maximo`, `minimo`, `Estado`, `Precio_venta`) VALUES
('1234', 'Rosa', 2, 24, 30, 10, 'Activo', 0),
('233', 'Naranjo', 3, 10, 15, 2, 'Inactivo', 0),
('2335', 'Naranja Valencia', 3, 65, 80, 5, 'Activo', 0),
('234', 'Limon Tahiti', 3, 17, 15, 3, 'Activo', 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliar`
--

CREATE TABLE `auxiliar` (
  `id_aux` int(11) NOT NULL,
  `nom_aux` varchar(60) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `auxiliar`
--

INSERT INTO `auxiliar` (`id_aux`, `nom_aux`) VALUES
(1, 'Bancolombia'),
(2, 'Banco Caja Social'),
(3, 'Banco Agrario'),
(4, 'Banco de Bogota'),
(5, 'BBVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` int(11) NOT NULL,
  `Nombre_categoria` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` varchar(125) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`, `Nombre_categoria`, `Descripcion`) VALUES
(2, 'Ornamentales', 'Flores y arboles decorativos'),
(3, 'Citricos', 'Arboles con frutos agrios y con alta vitamina C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_puc`
--

CREATE TABLE `clase_puc` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clase_puc`
--

INSERT INTO `clase_puc` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Pasivo'),
(3, 'Patrimonio'),
(4, 'Ingreso'),
(5, 'Gasto'),
(6, 'Costo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `idcuentas` int(11) NOT NULL,
  `comprobante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `naturaleza` int(2) DEFAULT NULL,
  `cod_puc` int(11) NOT NULL,
  `id_aux` int(11) DEFAULT NULL,
  `cod_Descripcion` int(11) NOT NULL,
  `idArticulo` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idFactura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`idcuentas`, `comprobante`, `valor`, `fecha`, `naturaleza`, `cod_puc`, `id_aux`, `cod_Descripcion`, `idArticulo`, `idFactura`) VALUES
(108, 'Fv5', 6000, '2017-05-02 00:00:00', 0, 1105, NULL, 0, '234', 11),
(109, 'Fv5', 9720, '2017-05-02 00:00:00', 1, 4135, NULL, 0, '234', 11),
(110, 'Fv5', 2280, '2017-05-02 00:00:00', 1, 2408, NULL, 0, '234', 11),
(111, 'Fv5', 10400, '2017-05-02 00:00:00', 1, 14, NULL, 0, '234', 11),
(112, 'Fv5', 10400, '2017-05-02 00:00:00', 0, 61, NULL, 0, '234', 11),
(113, 'Fv5', 6000, '2017-05-02 00:00:00', 0, 1305, NULL, 0, '234', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_cuenta`
--

CREATE TABLE `descripcion_cuenta` (
  `idDescripcion_cuenta` int(11) NOT NULL,
  `Descripcion_cuenta` varchar(155) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `descripcion_cuenta`
--

INSERT INTO `descripcion_cuenta` (`idDescripcion_cuenta`, `Descripcion_cuenta`) VALUES
(0, NULL),
(1, 'hola'),
(2, 'kllk'),
(3, 'kllk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `idArticulo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_compra` int(11) DEFAULT NULL,
  `prom` int(11) NOT NULL,
  `precio_venta` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`idArticulo`, `idFactura`, `cantidad`, `precio_compra`, `prom`, `precio_venta`, `descuento`) VALUES
('234', 11, 8, NULL, 1300, 1500, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFacturas` int(11) NOT NULL,
  `Tipo_factura` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Num_factura` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `doc_persona` int(11) DEFAULT NULL,
  `Estado` varchar(12) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFacturas`, `Tipo_factura`, `Num_factura`, `fecha`, `doc_persona`, `Estado`) VALUES
(-1, 'Fc', NULL, NULL, NULL, 'no'),
(2, 'Fv', NULL, NULL, NULL, 'no'),
(3, 'Nc', 0, NULL, NULL, 'no'),
(4, 'Nd', 0, NULL, NULL, 'no'),
(11, 'Fv', 5, '2017-05-02 09:55:27', 12700123, 'Pagado');

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
(3, '2017_03_16_040510_entrust_setup_tables', 1);

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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'cuentas_manuales', 'Realizar cuentas manuales', 'El usuario podrá realizar cuentas manuales', '2017-03-21 00:33:11', '2017-03-21 00:33:11'),
(3, 'balance', 'Ver Balance de cuentas', 'El usuario podrá ver el balance de las cuentas', '2017-03-25 07:50:34', '2017-03-25 07:50:34'),
(4, 'crear-usuario', 'Crear Usuario', 'El usuario podrá crear usuarios', NULL, NULL),
(5, 'crear-rol', 'Crear Rol', 'El Usuario podrá crear roles de usuarios', '2017-03-29 03:27:12', '2017-03-29 03:27:12'),
(6, 'editar-rol', 'Editar rol', 'El usuario podrá editar los roles', NULL, NULL),
(7, 'editar-usuario', 'Editar usuario', 'El usuario podrá editar los usuarios', '2017-04-02 11:30:08', '2017-04-02 11:30:08'),
(8, 'administrar-puc', 'Administrar PUC', 'El usuario podrá administrar el Plan Único de Cuentas', '2017-04-23 22:51:50', '2017-04-23 22:51:50'),
(9, 'facturar-ventas', 'Facturar Ventas', 'El usuario podrá realizar las operaciones de Facturación de ventas', '2017-04-23 22:53:05', '2017-04-23 22:53:05'),
(10, 'facturar-compras', 'Facturar Compras', 'El usuario podrá generas Facturación de compras', '2017-04-23 22:54:13', '2017-04-23 22:54:13'),
(11, 'categoria', 'Administrar Catrgorias', 'El usuario podrá administrar las categorías de los productos', '2017-04-23 22:55:32', '2017-04-23 22:55:32'),
(12, 'articulo', 'Administrar Articulos', 'El usuario podrá Administrar los articulos', '2017-04-23 22:56:15', '2017-04-23 22:56:15'),
(13, 'ver-kardex', 'Ver Kardex', 'El usuario podrá ver el Kardex de los productos', '2017-04-25 03:22:55', '2017-04-25 03:22:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 3),
(12, 3),
(13, 2),
(13, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `doc_persona` int(11) NOT NULL,
  `nombre_persona` varchar(60) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(85) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(65) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Tipo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`doc_persona`, `nombre_persona`, `direccion`, `telefono`, `email`, `Tipo`) VALUES
(12700123, 'Asoviz', 'central', '8672277', 'asoviz@mail.com', 'Cliente'),
(23232323, 'Pepito Perez', 'Calle falsa 123', '232323', 'pepe@mail.com', 'Proveedor'),
(1003558472, 'Juan Carlos Pinzon', 'Balmoral-fusagasugá', '3204291637', 'juank11pin@hotmail.com', 'Cliente'),
(1069763203, 'Jorge Romero', 'Calle falsa 123', '3203771274', 'jromero199@gmail.com', 'Proveedor');

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
(14, 'Inventarios', 1),
(61, 'Costo de ventas y de prestación de servivios', 6),
(1105, 'Efectivo', 1),
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrador', NULL, NULL, NULL),
(2, 'contador', 'Contador', NULL, '2017-03-16 15:35:57', '2017-03-16 15:35:57'),
(3, 'control-total', 'Control Total', 'El usuario tendrá acceso total a la aplicacion', '2017-04-01 12:41:06', '2017-04-01 12:41:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jorge Enrique Romero', 'jromero199@gmail.com', '$2y$10$7wb2zXC7T4RISuJ0WguVke99LdwmYBzh244iCpSTVEIwDuFol6gFe', 'f2lLGKIBseLH1ChWEEbtOgAihkJG38VDuCVxGkzap6FmxHgxf6ahHOFtM2OB', '2017-03-16 15:21:57', '2017-03-16 15:21:57'),
(2, 'Jimeno Jimenez', 'yoryi1998@gmail.com', '$2y$10$Qf62isVLPeHUsy6T2.qqQuTRAIpzANahmAYP4OfItHO54X7Z0D1B2', 'B7E0WP9TAP8LKiuaxWlpXfpUqV6j5PD9v0tK4A2ugluALeGhHFsP4Tzt9f9M', '2017-03-16 15:36:49', '2017-03-16 15:36:49'),
(3, 'Control Total', 'gestor@gestor.com', '$2y$10$ZXblpoX/QUsx2rXvq.JVlece.aZf5B6nFJ9dsg/g0WRcndk.xTasG', 'oZJXokbZo6uIft0sBgC1klwqSznTfL5ExHV9NeBXd2036SeLXV2VeprMSwhU', '2017-04-01 13:28:48', '2017-04-01 13:28:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idArticulos`),
  ADD KEY `fk_Articulos_Categorias1_idx` (`Categorias_idCategorias`);

--
-- Indices de la tabla `auxiliar`
--
ALTER TABLE `auxiliar`
  ADD PRIMARY KEY (`id_aux`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategorias`);

--
-- Indices de la tabla `clase_puc`
--
ALTER TABLE `clase_puc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idcuentas`),
  ADD KEY `fk_cuentas_puc_idx` (`cod_puc`),
  ADD KEY `fk_cuentas_Auxiliares1_idx` (`id_aux`),
  ADD KEY `fk_cuentas_Descripcion_cuenta1_idx` (`cod_Descripcion`),
  ADD KEY `fk_cuentas_Detalle_Factura1_idx` (`idArticulo`,`idFactura`);

--
-- Indices de la tabla `descripcion_cuenta`
--
ALTER TABLE `descripcion_cuenta`
  ADD PRIMARY KEY (`idDescripcion_cuenta`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`idArticulo`,`idFactura`),
  ADD KEY `fk_Articulos_has_Facturas_Facturas1_idx` (`idFactura`),
  ADD KEY `fk_Articulos_has_Facturas_Articulos1_idx` (`idArticulo`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFacturas`),
  ADD KEY `fk_Facturas_Persona1_idx` (`doc_persona`);

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
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`doc_persona`);

--
-- Indices de la tabla `puc`
--
ALTER TABLE `puc`
  ADD PRIMARY KEY (`cod_puc`),
  ADD KEY `fk_puc_clase_puc1_idx` (`clase_puc`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT de la tabla `auxiliar`
--
ALTER TABLE `auxiliar`
  MODIFY `id_aux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clase_puc`
--
ALTER TABLE `clase_puc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idcuentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT de la tabla `descripcion_cuenta`
--
ALTER TABLE `descripcion_cuenta`
  MODIFY `idDescripcion_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFacturas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_Articulos_Categorias1` FOREIGN KEY (`Categorias_idCategorias`) REFERENCES `categorias` (`idCategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cuentas_Auxiliares1` FOREIGN KEY (`id_aux`) REFERENCES `auxiliares` (`id_aux`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuentas_Descripcion_cuenta1` FOREIGN KEY (`cod_Descripcion`) REFERENCES `descripcion_cuenta` (`idDescripcion_cuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuentas_Detalle_Factura1` FOREIGN KEY (`idArticulo`,`idFactura`) REFERENCES `detalle_factura` (`idArticulo`, `idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuentas_puc` FOREIGN KEY (`cod_puc`) REFERENCES `puc` (`cod_puc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `fk_Articulos_has_Facturas_Articulos1` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`idArticulos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Articulos_has_Facturas_Facturas1` FOREIGN KEY (`idFactura`) REFERENCES `facturas` (`idFacturas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_Facturas_Persona1` FOREIGN KEY (`doc_persona`) REFERENCES `persona` (`doc_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puc`
--
ALTER TABLE `puc`
  ADD CONSTRAINT `fk_puc_clase_puc1` FOREIGN KEY (`clase_puc`) REFERENCES `clase_puc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
