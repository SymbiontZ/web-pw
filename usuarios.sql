-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2025 a las 13:07:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_libros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Contraseña` varchar(66) NOT NULL,
  `Administrador` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Usuario`, `Contraseña`, `Administrador`) VALUES
(1, 'Mario', '$2y$10$A0nJDUUPB5uU/2djM.9KtenBxJGoYgXTNUCVd7cBlvJw/AaMxORRe', 1),
(2, 'Julia', '$2y$10$46cN0TT4mEFAZM3zxZo9qelpG/.QY4iR0LB.ONAgMtZ/BmENdqCPe', 1),
(3, 'Fabio', '$2y$10$TDl.GgYEg0SKB9S2X6yB6OF8p0xee7cKq0EmsNrjVDNXPa2N31.gC', 1),
(4, 'Usuario', '$2y$10$LiMBsX7EDLup8IJTyZUVJuFZug7FpqPsEVzPkoGdK3zpztsi.tyre', 0),
(13, 'Usuario1', '$2y$10$42roZu8oMWbYqIFD3U691ODvHVUQ/JhHMItQ7fRm4en/uw3cLnTwy', 0),
(14, 'Usuario2', '$2y$10$KQN00b2WNs.94Nfa/pJvLuVZu7qmkaKQeRmR9tB9bOddsh1rm9VDW', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
