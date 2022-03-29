-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 03:21:38
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'MATERIAL DE CONSTRUCCION'),
(2, 'MATERIAL DE ELECTRICIDAD'),
(3, 'MAQUINARIAS DE CONSTRUCCION Y ELECTRICIDAD'),
(4, 'MATERIALES DE PINTURA'),
(5, 'MATERIALES DE CARPINTERIA'),
(6, 'MAQUINARIAS DE PINTURA Y CARPINTERIA'),
(7, 'MATERIALES DE PLOMERIA'),
(8, 'MATERIALES DE SOLDADURA'),
(9, 'MATERIALES DE PLOMERIA Y SOLDADURA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mtconstruccion`
--

CREATE TABLE `mtconstruccion` (
  `id_mt` int(11) NOT NULL,
  `name_mt` varchar(50) NOT NULL,
  `desc_mt` varchar(50) NOT NULL,
  `precio_mt` float NOT NULL,
  `stock_mt` int(11) NOT NULL,
  `peso_mt` float NOT NULL,
  `fecha_mt` date NOT NULL,
  `medida_mt` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mtconstruccion`
--

INSERT INTO `mtconstruccion` (`id_mt`, `name_mt`, `desc_mt`, `precio_mt`, `stock_mt`, `peso_mt`, `fecha_mt`, `medida_mt`) VALUES
(3, 'Ladrillo', 'Ladrillo de construccion 6 huecos', 850, 10000, 0, '2022-03-31', 0),
(7, 'Cemento Yura', 'Cemento Peruano', 43, 50, 48, '2022-05-28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mtelectricidad`
--

CREATE TABLE `mtelectricidad` (
  `id_mt` int(11) NOT NULL,
  `name_mt` varchar(50) NOT NULL,
  `desc_mt` varchar(50) NOT NULL,
  `precio_mt` float NOT NULL,
  `stock_mt` int(11) NOT NULL,
  `fecha_mt` date NOT NULL,
  `medida_mt` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mtelectricidad`
--

INSERT INTO `mtelectricidad` (`id_mt`, `name_mt`, `desc_mt`, `precio_mt`, `stock_mt`, `fecha_mt`, `medida_mt`) VALUES
(1, 'Cable 10mm', 'Cable eléctrico', 18, 50, '0000-00-00', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id_provider` int(11) NOT NULL,
  `categoria_provider` int(11) NOT NULL,
  `name_provider` varchar(20) NOT NULL,
  `nit_provider` int(10) NOT NULL,
  `telephone_provider` int(11) NOT NULL,
  `email_provider` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id_provider`, `categoria_provider`, `name_provider`, `nit_provider`, `telephone_provider`, `email_provider`) VALUES
(2, 4, 'San JosÃ© S.R.L', 789465, 76431509, 'sanjose@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(15) NOT NULL,
  `surname_user` varchar(20) NOT NULL,
  `ci_user` int(9) NOT NULL,
  `extci_user` varchar(3) DEFAULT NULL,
  `expci_user` varchar(2) NOT NULL,
  `birthdate_user` date DEFAULT NULL,
  `telephone_user` int(9) NOT NULL,
  `email_user` varchar(35) DEFAULT NULL,
  `user_user` varchar(15) NOT NULL,
  `password_user` varchar(10) NOT NULL,
  `access_user` tinyint(1) NOT NULL,
  `state_user` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `surname_user`, `ci_user`, `extci_user`, `expci_user`, `birthdate_user`, `telephone_user`, `email_user`, `user_user`, `password_user`, `access_user`, `state_user`) VALUES
(1, 'Ramiro', 'Molina Zeballos', 11111111, '', 'CB', '2022-03-01', 76431509, 'ramiromolinazeballos@gmail.com', 'ramiro.molina', '123456', 2, 'habilitado'),
(2, 'Jose Ademar', 'Sanchez Mejia', 99999999, NULL, 'CB', '2022-03-04', 98745873, 'joseademarsanchezmejia@gmail.com', 'jose.sanchez', '123abC', 2, 'deshabilitado'),
(11, 'Seydi', 'Guzman Lopez', 45784512, '', 'CB', '1993-02-28', 456132654, 'seydi@gmail.com', 'seydi.guzman', '123456', 1, 'habilitado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `mtconstruccion`
--
ALTER TABLE `mtconstruccion`
  ADD PRIMARY KEY (`id_mt`);

--
-- Indices de la tabla `mtelectricidad`
--
ALTER TABLE `mtelectricidad`
  ADD PRIMARY KEY (`id_mt`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id_provider`),
  ADD KEY `categoria_provider` (`categoria_provider`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mtconstruccion`
--
ALTER TABLE `mtconstruccion`
  MODIFY `id_mt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mtelectricidad`
--
ALTER TABLE `mtelectricidad`
  MODIFY `id_mt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id_provider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_ibfk_1` FOREIGN KEY (`categoria_provider`) REFERENCES `category` (`id_category`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
