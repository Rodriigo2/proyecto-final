-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2022 a las 22:31:52
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
(1, 'Kiosco Irma', 'Av.Jauretche y calle 82', 20445412546, 'kioscoirma@gmail.com', 6, 1),
(2, 'Distribuidora axion', 'Calle 22', 20124563459, 'Distribuidoraaxion@hotmail.com', 1, 1),
(3, 'Chango Mas', 'Av. Tambor de Tacuarí 5158', 30641844140, 'changomas@hotmail.com', 1, 1),
(4, 'Negocio el cuervo', 'av. tambor de tacuari', 2012344542, 'negocioelcuervo@gmail.com', 6, 1),
(5, 'Negocio la esquina', 'Av. jaurteche', 2134567890, 'negociolaesquina@gmail.com', 13, 1);

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

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`cod_comp`, `nro_comp`, `punto_vta`, `cod_cliente`, `fecha_emision`, `cod_usuario`, `cod_letra`, `tipo_comp`, `cod_est_comp`, `total_comp`, `cod_cond_vta`) VALUES
(1, 1, 1, 1, '2022-11-17 18:59:17', 1, 1, 1, 1, '1200.00', 1),
(2, 2, 1, 2, '2022-12-06 18:20:41', 1, 1, 1, 1, '0.00', 4),
(3, 3, 1, 3, '2022-12-07 17:24:57', 1, 1, 1, 1, '800.00', 5),
(4, 4, 1, 2, '2022-12-07 17:28:15', 1, 1, 1, 1, '0.00', 1),
(5, 5, 1, 3, '2022-12-07 18:15:22', 3, 1, 1, 1, '0.00', 1),
(6, 6, 1, 4, '2022-12-07 18:15:49', 3, 1, 1, 1, '662.00', 1),
(7, 7, 1, 3, '2022-12-07 18:17:08', 3, 1, 1, 1, '2787.00', 5),
(8, 8, 1, 3, '2022-12-07 18:26:40', 3, 1, 1, 1, '100.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_detalle`
--

CREATE TABLE `comprobante_detalle` (
  `cod_comp` bigint(20) NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprobante_detalle`
--

INSERT INTO `comprobante_detalle` (`cod_comp`, `cod_prod`, `cantidad`, `precio`, `subtotal`) VALUES
(1, 4, '6.00', '200.00', '1200.00'),
(3, 4, '2.00', '200.00', '400.00'),
(3, 3, '1.00', '200.00', '200.00'),
(3, 20, '2.00', '100.00', '200.00'),
(6, 3, '1.00', '512.00', '512.00'),
(6, 24, '1.00', '150.00', '150.00'),
(7, 14, '1.00', '227.00', '227.00'),
(7, 3, '5.00', '512.00', '2560.00'),
(8, 18, '2.00', '50.00', '100.00');

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
-- Estructura de tabla para la tabla `cond_vta`
--

CREATE TABLE `cond_vta` (
  `cod_cv` int(11) NOT NULL,
  `desc_cv` varchar(30) NOT NULL,
  `estado_cv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cond_vta`
--

INSERT INTO `cond_vta` (`cod_cv`, `desc_cv`, `estado_cv`) VALUES
(1, 'Contado', 1),
(2, 'Tarjeta Débito', 1),
(3, 'QR', 1),
(4, 'Cheque', 1),
(5, 'Cta. Corriente', 1),
(6, 'Transferencia', 1);

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
-- Estructura de tabla para la tabla `estado_comp`
--

CREATE TABLE `estado_comp` (
  `cod_estado_comp` int(11) NOT NULL,
  `desc_estado_comp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_comp`
--

INSERT INTO `estado_comp` (`cod_estado_comp`, `desc_estado_comp`) VALUES
(1, 'Emitido'),
(2, 'Pagado'),
(3, 'Anulado'),
(4, 'Judicializado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `letras_comp`
--

CREATE TABLE `letras_comp` (
  `cod_letra` int(11) NOT NULL,
  `desc_letra` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `letras_comp`
--

INSERT INTO `letras_comp` (`cod_letra`, `desc_letra`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'E'),
(5, 'D'),
(6, 'X'),
(7, 'R'),
(8, 'M');

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
(20445412596, 'Hipermercado gaston', '20/10/2022', 'Av. Jauretche y calle 82', 3765055767, 'Hipermercadogaston@gmail.com', 6, 'Hipermercadogaston.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod_producto` int(11) NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `peso` decimal(8,2) NOT NULL,
  `u_medida` int(11) NOT NULL,
  `cod_tipo` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `cod_barra` bigint(20) DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_producto`, `nombre`, `peso`, `u_medida`, `cod_tipo`, `stock`, `precio`, `cod_barra`, `imagen`, `descripcion`) VALUES
(3, 'Coca Cola', '3.00', 8, 6, 30, '543.07', 32132, '../img/3.png', 'Coca cola refrescante'),
(4, 'Fanta 500', '3.00', 8, 6, 200, '181.03', 2313, '../img/4.png', 'Bebida gasificada sin alcohol'),
(5, 'Lavandina', '2.00', 8, 5, 100, '0.00', 23123, '../img/5.png', 'a'),
(6, 'Galletita', '150.00', 10, 4, 30, '477.00', 12313, '../img/6.png', 'Surtido de galletitas'),
(22, 'Caja lápiz de colores', '120.00', 11, 7, 60, '1166.00', 7795513049594, '../img/22.png', 'Caja de lápiz de colores'),
(21, 'Pollo', '2.00', 10, 3, 20, '1272.00', 1232135234, '../img/21.png', 'Pollo entero'),
(18, 'Jugo en Sobre tang', '1.00', 8, 6, 50, '47.70', 312312312, '../img/18.png', 'Jugo en sobre con sabor a manzana'),
(19, 'Hamburguesa paty', '320.00', 11, 4, 100, '1272.00', 3123213, '../img/19.png', 'Paquete de 6 hamburguesas'),
(20, 'Actron ibuprofeno', '400.00', 12, 1, 40, '684.76', 123123123, '../img/20.png', '10 cápsulas blandas de gelatina'),
(14, 'Gaseosa Manaos', '3.00', 8, 6, 300, '241.36', 21312312, '../img/14.png', 'Bebida gasificada sin alcohol'),
(23, 'Tomate', '1.00', 10, 2, 100, '127.20', 534534567, '../img/23.png', 'Tomates redondos'),
(24, 'fideos', '500.00', 12, 4, 20, '159.00', 4231234, '../img/24.png', 'fideos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ptos_venta`
--

CREATE TABLE `ptos_venta` (
  `cod_ptoventa` int(11) NOT NULL,
  `nro_punto` int(11) NOT NULL,
  `cod_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ptos_venta`
--

INSERT INTO `ptos_venta` (`cod_ptoventa`, `nro_punto`, `cod_estado`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `cod_reg` int(11) NOT NULL,
  `cod_us` int(11) DEFAULT NULL,
  `cod_producto` int(11) NOT NULL,
  `cant` decimal(10,2) NOT NULL,
  `tipo_mov` tinyint(11) NOT NULL,
  `motivo` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`cod_reg`, `cod_us`, `cod_producto`, `cant`, `tipo_mov`, `motivo`, `fecha`) VALUES
(1, NULL, 3, '10.00', 0, 'DaÃ±ado', '2022-09-14 19:43:18'),
(2, NULL, 3, '20.00', 0, 'dasd', '2022-09-14 19:45:34'),
(3, NULL, 3, '15.00', 0, 'DaÃ±ado', '2022-09-14 19:48:47'),
(4, NULL, 3, '5.00', 0, 'daÃ±ado', '2022-09-14 19:49:20'),
(5, NULL, 3, '40.00', 0, 'daÃ±ado', '2022-09-14 19:49:50'),
(6, NULL, 3, '20.00', 0, 'daÃ±ado', '2022-09-14 19:50:07'),
(7, NULL, 3, '15.00', 0, 'robo', '2022-09-14 19:54:02'),
(8, NULL, 3, '20.00', 1, 'Ingreso', '2022-09-14 19:54:25'),
(9, NULL, 5, '50.00', 1, 'asdasd', '2022-09-14 20:03:12'),
(10, NULL, 3, '1.00', 1, 'a', '2022-10-05 01:56:01'),
(11, NULL, 3, '6.00', 0, 'rotura', '2022-12-07 18:11:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `cod_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`cod_tipo`, `desc_tipo`) VALUES
(1, 'Farmacia'),
(2, 'Verduleria'),
(3, 'Carniceria'),
(4, 'Alimentos'),
(6, 'Bebidas'),
(7, 'Libreria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comp`
--

CREATE TABLE `tipo_comp` (
  `cod_comp` int(11) NOT NULL,
  `desc_comp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_comp`
--

INSERT INTO `tipo_comp` (`cod_comp`, `desc_comp`) VALUES
(1, 'Factura'),
(2, 'Débito'),
(3, 'Crédito'),
(4, 'Remito'),
(5, 'Recibo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `umedida`
--

CREATE TABLE `umedida` (
  `cod_um` int(11) NOT NULL,
  `desc_um` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `abrev_um` varchar(4) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `umedida`
--

INSERT INTO `umedida` (`cod_um`, `desc_um`, `abrev_um`) VALUES
(1, 'metro', 'm.'),
(8, 'Litro', 'L.'),
(9, 'Metro Cuadrado', 'm2'),
(7, 'Kilometro', 'Km.'),
(10, 'Kilogramo', 'K.'),
(11, 'Gramo', 'g'),
(12, 'Miligramo', 'mg');

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
(1, 'R0drigo', 'Rodrigoperaltaaaa18@gmail.com', '48977Rodri'),
(2, 'Rodrigo_peralta', 'Rodrigoperaltaaaa@hotmail.com', '48977Rodri'),
(3, 'rodri2002', 'rodrigoperalta@gmail.com', '48977Rodri');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(8) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nombre`, `email`, `clave`) VALUES
(1, 'Rodrigo', 'Rodrigoperaltaaaa18@gmail.com', '48977');

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
-- Indices de la tabla `cond_vta`
--
ALTER TABLE `cond_vta`
  ADD PRIMARY KEY (`cod_cv`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estado_comp`
--
ALTER TABLE `estado_comp`
  ADD PRIMARY KEY (`cod_estado_comp`);

--
-- Indices de la tabla `letras_comp`
--
ALTER TABLE `letras_comp`
  ADD PRIMARY KEY (`cod_letra`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`cuit`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_producto`);

--
-- Indices de la tabla `ptos_venta`
--
ALTER TABLE `ptos_venta`
  ADD PRIMARY KEY (`cod_ptoventa`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`cod_reg`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`cod_tipo`);

--
-- Indices de la tabla `tipo_comp`
--
ALTER TABLE `tipo_comp`
  ADD PRIMARY KEY (`cod_comp`);

--
-- Indices de la tabla `umedida`
--
ALTER TABLE `umedida`
  ADD PRIMARY KEY (`cod_um`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `cod_comp` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cond_iva`
--
ALTER TABLE `cond_iva`
  MODIFY `id_iva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cond_vta`
--
ALTER TABLE `cond_vta`
  MODIFY `cod_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_comp`
--
ALTER TABLE `estado_comp`
  MODIFY `cod_estado_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `letras_comp`
--
ALTER TABLE `letras_comp`
  MODIFY `cod_letra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `cod_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ptos_venta`
--
ALTER TABLE `ptos_venta`
  MODIFY `cod_ptoventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `cod_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `cod_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_comp`
--
ALTER TABLE `tipo_comp`
  MODIFY `cod_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `umedida`
--
ALTER TABLE `umedida`
  MODIFY `cod_um` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
