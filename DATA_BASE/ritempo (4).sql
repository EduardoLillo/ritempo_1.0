-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2017 a las 21:41:34
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ritempo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Categoria_1', 'descripcion categoria_1'),
(3, 'Categoria_3', 'descripcion categoria_3'),
(5, 'Categoria_2', 'categoria 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id_cotizacion` smallint(6) NOT NULL,
  `id_producto` smallint(6) NOT NULL,
  `nombre_cliente` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `consulta` varchar(200) DEFAULT NULL,
  `estado` enum('cotizado','no cotizado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` smallint(6) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `imagen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenpag`
--

CREATE TABLE `imagenpag` (
  `id_imagen` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_has_producto`
--

CREATE TABLE `imagen_has_producto` (
  `imagen_id_imagen` smallint(6) NOT NULL,
  `producto_id_productos` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `id_subcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `id_categoria` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `nombre`, `descripcion`, `id_categoria`) VALUES
(4, 'Subcategoria_1', 'sdaas', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id_cotizacion`),
  ADD KEY `fk_cotizacion_producto_idx` (`id_producto`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `imagenpag`
--
ALTER TABLE `imagenpag`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `imagen_has_producto`
--
ALTER TABLE `imagen_has_producto`
  ADD PRIMARY KEY (`imagen_id_imagen`,`producto_id_productos`),
  ADD KEY `fk_imagen_has_producto_producto1_idx` (`producto_id_productos`),
  ADD KEY `fk_imagen_has_producto_imagen1_idx` (`imagen_id_imagen`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`,`id_subcategoria`),
  ADD KEY `fk_productos_subcategorias1_idx` (`id_subcategoria`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `fk_subcategorias_categorias1_idx` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id_cotizacion` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenpag`
--
ALTER TABLE `imagenpag`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `fk_cotizacion_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen_has_producto`
--
ALTER TABLE `imagen_has_producto`
  ADD CONSTRAINT `fk_imagen_has_producto_imagen1` FOREIGN KEY (`imagen_id_imagen`) REFERENCES `imagenes` (`id_imagen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_imagen_has_producto_producto1` FOREIGN KEY (`producto_id_productos`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_subcategorias1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategorias_categorias1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
