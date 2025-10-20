-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2025 a las 16:23:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `institucional`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

CREATE TABLE `aviso` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` varchar(250) NOT NULL,
  `creador` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aviso`
--

INSERT INTO `aviso` (`id`, `titulo`, `contenido`, `creador`, `fecha`) VALUES
(1, 'Prueba aviso 1', 'jnasdkas lorem blablablabla', '', '2025-10-07'),
(2, 'Prueba titulo 2', 'lasnbdlknakslnmdlkas lorem asknkansmñdlmas lorem lorem', '', '2025-10-07'),
(3, 'titulo 3', 'sfasdfasdasdasdas', 'pepito', '2025-10-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso`
--
ALTER TABLE `aviso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
