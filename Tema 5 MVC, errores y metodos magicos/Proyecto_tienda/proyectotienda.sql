-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2021 a las 14:56:09
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
-- Base de datos: `proyectotienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `nameProduct` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `imgProduct` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `priceProduct` int(11) NOT NULL,
  `quantityCart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numberProducts` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `date`, `numberProducts`, `totalPrice`) VALUES
(14, 3, '21-11-2021 17:50:12', 3, 340),
(18, 3, '21-11-2021 19:24:51', 1, 40),
(19, 3, '22-11-2021 14:37:55', 2, 95),
(20, 3, '22-11-2021 14:40:30', 2, 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productorder`
--

CREATE TABLE `productorder` (
  `id` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productorder`
--

INSERT INTO `productorder` (`id`, `idOrder`, `idProduct`, `quantity`) VALUES
(1, 14, 1, 1),
(2, 14, 3, 2),
(5, 18, 3, 1),
(6, 19, 4, 1),
(7, 19, 6, 1),
(8, 20, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `nameProduct` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descriptionProduct` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `imgProduct` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `priceProduct` double NOT NULL,
  `quantityProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`idProduct`, `nameProduct`, `descriptionProduct`, `imgProduct`, `priceProduct`, `quantityProduct`) VALUES
(1, 'Anakin Skywalker - Clone Wars', '1/6 scale', 'anakin.jpg', 260, 0),
(3, 'The Mandalorian beskar edition - Mandalorian', '6\'\' Black Series', 'mandobeskar.jpg', 40, 14),
(4, 'The Armorer - Mandalorian', '6\'\' Black Series', 'armera.jpg', 40, 7),
(5, 'Moff Gideon - Mandalorian', '6\'\' Black Series', 'moffgideon.jpg', 40, 5),
(6, 'Grogu - Mandalorian', 'Animatronic', 'grogu.jpg', 55, 8),
(8, 'Anakin & Obi-Wan - Diorama', '1/6 scale', 'anakinobi.jpg', 300, 6),
(11, 'Padme Amidala', '1/6 scale', 'padme.jpg', 375, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nameUser` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `nameUser`, `password`, `email`, `rol`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin', 2),
(3, 'hola', '4d186321c1a7f0f354b297e8914ab240', 'hola@hola.com', 1),
(4, 'adios', '6e6e2ddb6346ce143d19d79b3358c16a', 'adios@adios', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productorder`
--
ALTER TABLE `productorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productorder`
--
ALTER TABLE `productorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `productorder_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productorder_ibfk_2` FOREIGN KEY (`idOrder`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
