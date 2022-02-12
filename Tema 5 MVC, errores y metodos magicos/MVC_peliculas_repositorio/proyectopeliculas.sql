-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2021 a las 16:18:46
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
-- Base de datos: `proyectopeliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'drama'),
(2, 'science-fiction'),
(3, 'historic'),
(4, 'fantasy'),
(5, 'terror'),
(6, 'action');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `director` varchar(100) NOT NULL,
  `actors` varchar(500) NOT NULL,
  `poster` varchar(100) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `films`
--

INSERT INTO `films` (`id`, `title`, `year`, `director`, `actors`, `poster`, `likes`) VALUES
(1, 'Star Wars Episode 2: Attack of the Clones', 2002, 'George Lucas', 'Ewan McGregor, Hayden Christensen, Natalie Portman, Samuel L. Jackson, Christopher Lee, Ian McDiarmid, Temuera Morrison, Frank Oz, Anthony Daniels and Kenny Baker.', 'img/episode2.jpg', 1),
(2, 'Star Wars Episode 3: Revenge of the Sith', 2005, 'George Lucas', 'Ewan McGregor, Hayden Christensen, Natalie Portman, Ian McDiarmid, Samuel L. Jackson, Christopher Lee, Frank Oz, Jimmy Smits, Temuera Morrison, Anthony Daniels, Kenny Baker, Amy Allen, Matt Sloan and Silas Carson.', 'img/episode3.jpg', 1),
(3, 'No Time To Die - 007', 2021, 'Cary Fukunaga', 'Daniel Craig, Lea Seydoux, Rami Malek, Ralph Fiennes, Naomie Harris, Rory Kinnear, Ben Whishaw, Jeffrey Wright, Ana de Armas, Lashana Lynch and Christoph Waltz.', 'img/007.jpg', 0),
(8, 'Allied', 2016, 'Robert Zemeckis', 'Brad Pitt, Marion Cotillard, Jared Harris, Matthew Goode, Lizzy Caplan, Anton Lesser, August Diehl, Camille Cottin,   Charlotte Hope, Marion Bailey, Simon McBurney, Daniel Betts and Thierry FrÃ©mont.', 'img/allied.png', 0),
(10, '47 ronin', 2013, 'Carl Rinsch', 'Keanu Reeves, Hiroyuki Sanada, Ko Shibasaki, Rinko Kikushi, Tadanobu Asano, Min Tanaka, Cary-Hiroyuki Tagawa, Masayoshi Haneda, Takata Yonemoto, Natsuki Kunimoto and Jin Akanishi.', 'img/ronin.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `films_category`
--

CREATE TABLE `films_category` (
  `id` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `films_category`
--

INSERT INTO `films_category` (`id`, `idPelicula`, `idCategory`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 6),
(4, 3, 1),
(7, 8, 1),
(10, 10, 3),
(11, 10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `valoration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id`, `idUser`, `idPelicula`, `valoration`) VALUES
(24, 1, 2, 1),
(25, 1, 3, 1),
(27, 1, 8, 1),
(29, 2, 8, 1),
(32, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `rol` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rol`, `email`) VALUES
(1, 'admin', 'admin', 2, 'admin@correo.es'),
(2, 'highground', 'highground', 1, 'highground@correo.es'),
(5, 'hola', 'hola', 1, 'hola@correo.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `films_category`
--
ALTER TABLE `films_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPelicula` (`idPelicula`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPelicula` (`idPelicula`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `films_category`
--
ALTER TABLE `films_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `films_category`
--
ALTER TABLE `films_category`
  ADD CONSTRAINT `films_category_ibfk_1` FOREIGN KEY (`idPelicula`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `films_category_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`idPelicula`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
