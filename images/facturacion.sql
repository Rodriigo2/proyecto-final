-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2022 a las 23:05:55
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `razonsocial_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_cliente` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit_cliente` bigint(20) NOT NULL,
  `email_cliente` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `cond_iva_cliente` int(11) NOT NULL,
  `estado_cliente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `razonsocial_cliente`, `direccion_cliente`, `cuit_cliente`, `email_cliente`, `cond_iva_cliente`, `estado_cliente`) VALUES
(1, 'Rodrigo Peralta', 'Av.Jauretche y calle 82', 20445412598, 'Rodrigoperaltaaaa@gmail.com', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `cod_comp` bigint(20) NOT NULL,
  `nro_comp` int(11) NOT NULL,
  `punto_vta` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT current_timestamp(),
  `cod_usuario` int(11) NOT NULL,
  `cod_letra` int(11) NOT NULL,
  `tipo_comp` int(11) NOT NULL,
  `cod_est_comp` int(11) NOT NULL,
  `total_comp` decimal(8,2) NOT NULL,
  `cod_cond_vta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cond_iva`
--

CREATE TABLE `cond_iva` (
  `id_iva` int(11) NOT NULL,
  `desc_iva` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cond_iva`
--

INSERT INTO `cond_iva` (`id_iva`, `desc_iva`) VALUES
(1, 'IVA Responsable Inscripto'),
(2, 'IVA Responsable no Inscripto'),
(3, 'IVA no Responsable'),
(4, 'IVA Sujeto Exento'),
(5, 'Consumidor Final'),
(6, 'Responsable Monotributo'),
(7, 'Sujeto no Categorizado'),
(8, 'Proveedor del Exterior'),
(9, 'Cliente del Exterior'),
(10, 'IVA Liberado – Ley Nº 19.640'),
(11, 'IVA Responsable Inscripto – Agente de Percepción'),
(12, 'Pequeño Contribuyente Eventual'),
(13, 'Monotributista Social'),
(14, 'Pequeño Contribuyente Eventual Social');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `desc_estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `desc_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `cuit` bigint(20) NOT NULL,
  `razon_social` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nro_telefeno` bigint(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cond_iva` int(11) NOT NULL,
  `website` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `negocio`
--

INSERT INTO `negocio` (`cuit`, `razon_social`, `fecha_inicio`, `direccion`, `nro_telefeno`, `email`, `cond_iva`, `website`) VALUES
(20445412598, 'Hipermercado Hugo', '20/10/2022', 'Av. Jauretche y calle 82', 3765055778, 'Hipermercadohugo@gmail.com', 1, 'Hipermercadohugo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_usuario` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `password_usuario` varchar(16) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `correo_usuario`, `password_usuario`) VALUES
(1, 'R0drigo', 'Rodrigoperaltaaaa18@gmail.com', '48977Rodri');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`cod_comp`);

--
-- Indices de la tabla `cond_iva`
--
ALTER TABLE `cond_iva`
  ADD PRIMARY KEY (`id_iva`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`cuit`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `cod_comp` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cond_iva`
--
ALTER TABLE `cond_iva`
  MODIFY `id_iva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
