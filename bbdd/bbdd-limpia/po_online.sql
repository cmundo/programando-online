-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2012 a las 23:14:59
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `po_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_archivo`
--

CREATE TABLE IF NOT EXISTS `po_archivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `idseccion` int(10) unsigned NOT NULL,
  `idquien` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_categoria`
--

CREATE TABLE IF NOT EXISTS `po_categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `mostrar_breadcrumb` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `po_categoria`
--

INSERT INTO `po_categoria` (`id`, `nom`, `imagen`, `orden`, `mostrar_breadcrumb`, `description`, `keywords`) VALUES
(1, 'inicio', 'home.png', 1, 0, '', ''),
(2, 'programación', 'php.png', 3, 1, '', ''),
(3, 'linux', 'debian.png', 4, 1, '', ''),
(4, 'noticias', 'noticia.png', 2, 1, '', ''),
(5, 'contacto', 'contacto.png', 7, 0, '', ''),
(6, 'windows', 'windows.png', 6, 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_comentario`
--

CREATE TABLE IF NOT EXISTS `po_comentario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `texto` text NOT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '0',
  `idcontenido` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_contenido`
--

CREATE TABLE IF NOT EXISTS `po_contenido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `texto` text NOT NULL,
  `activo` int(1) unsigned NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `orden` int(11) NOT NULL,
  `idsubcategoria` int(10) unsigned NOT NULL,
  `idtipo` int(10) unsigned NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_enlace`
--

CREATE TABLE IF NOT EXISTS `po_enlace` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `idseccion` int(11) NOT NULL DEFAULT '0',
  `idquien` int(10) unsigned NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_seccion`
--

CREATE TABLE IF NOT EXISTS `po_seccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_subcategoria`
--

CREATE TABLE IF NOT EXISTS `po_subcategoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `idcategoria` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_usuario`
--

CREATE TABLE IF NOT EXISTS `po_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(200) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `ape` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `po_usuario`
--

INSERT INTO `po_usuario` (`id`, `login`, `clave`, `nom`, `ape`) VALUES
(1, 'rubenppg', '5805', 'Rubén', 'González Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_video`
--

CREATE TABLE IF NOT EXISTS `po_video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `po_video`
--

INSERT INTO `po_video` (`id`, `nom`, `ruta`, `orden`) VALUES
(33, 'Instalación de Ubuntu 10.04 desde 0', 'OkOuMSsZTsg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
