-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2021 a las 20:38:34
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blogphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `autor` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `comentario` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `autor`, `fecha`, `idArticulo`, `comentario`) VALUES
(1, 'admin', '2021-12-10', 1, 'La mejor pelicula de la saga, deseando leerlo!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `texto` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `img` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `texto`, `autor`, `fecha`, `img`) VALUES
(1, 'Star Wars episode 3: Revenge of the Sith', '\"Has escuchado alguna vez la tragedia de Darth Plagueis el Sabio?\"', 'Matthew Stover', '2005', 'img/episodio3.jpg'),
(2, 'La senda jedi', 'High ground', 'Daniel Wallace', '2011', 'img/senda_jedi.jpg'),
(3, 'El libro de los Sith', 'Escritos Sith reunidos por Palpatine', 'Daniel Wallace', '2012', 'img/libro_sith.jpg'),
(4, 'Revan', 'Tras los acontecimientos de Caballeros de la Antigua Republica', 'Drew Karpyshyn', '2013', 'img/revan.jpg'),
(5, 'Cronicas de la Torre: Fenris el elfo', 'Junto a 3 libros mas forman la saga Cronicas de la Torre', 'Laura Gallego Garcia', '2004', 'img/fenris.jpg'),
(6, 'La leyenda del segundo feretro', 'Terror', 'Jose Maria LaTorre', '1997', 'img/segundo_feretro.jpg'),
(7, 'Deceived', 'Junto a 3 libros mas forman la saga de novelas Star Wars The Old Republic', 'Paul S. Kemp', '2011', 'img/deceived.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `password`, `rol`) VALUES
(1, 'admin', 'admin', 2),
(2, 'user1', 'user1', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
