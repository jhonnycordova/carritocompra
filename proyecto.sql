-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-12-2013 a las 16:28:38
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.6-1ubuntu1.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `usuario_id` int(10) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `monto` double(8,2) NOT NULL,
  KEY `usuario_id` (`usuario_id`,`producto_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(6) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `precio` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `codigo`, `producto_id`, `cantidad`, `precio`) VALUES
(9, 37498, 1, 10, 400000.00),
(10, 37498, 2, 10, 250000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` text NOT NULL,
  `codigo` varchar(13) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `ruta`, `codigo`, `nombre`, `descripcion`, `status`) VALUES
(1, 'iphone5.jpeg', '2354354365464', 'IPhone 5', 'TelÃ©fono Inteligente de 4ta GeneraciÃ³n', 'Visible'),
(2, 'iphone5.jpeg', '4356576576876', 'Blackberry Z10', 'TelÃ©fono Inteligente de la RIM ', 'Visible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `precio` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 30, 40000.00),
(2, 2, 80, 25000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `clave` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `status`, `tipo`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'A', 'A'),
(5, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'A', 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) NOT NULL,
  `codigo_factura` int(6) NOT NULL,
  `total` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `codigo_factura` (`codigo_factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `usuario_id`, `codigo_factura`, `total`) VALUES
(1, 4, 37498, 650000.00);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `imagenes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `imagenes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`codigo_factura`) REFERENCES `facturas` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
