-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2025 a las 18:22:21
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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Autoayuda'),
(2, 'Novela de fantasia'),
(3, 'Novela Negra'),
(4, 'Novela contemporánea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `categoria` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `autor` text NOT NULL,
  `paginas` int(11) NOT NULL,
  `fecha pub` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`categoria`, `titulo`, `autor`, `paginas`, `fecha pub`) VALUES
(1, 'Hábitos atómicos', 'James Clear', 328, '2018-10-16'),
(2, 'Alas de Sangre (Empíreo 1)', 'Rebeca Yarros', 736, '2023-04-05'),
(3, 'Un animal salvaje', 'Joël Dicker', 448, '2024-04-04'),
(3, 'La grieta del silencio', 'Javier Castillo', 448, '2024-04-16'),
(2, 'Alas de hierro (Empíreo 2)', 'Rebeca Yarros', 896, '2024-02-21'),
(1, 'Recupera tu mente, reconquista tu vida', 'Marian Rojas Estapé', 384, '2024-04-03'),
(4, 'La asistenta', 'Freida McFadden', 344, '2023-10-05'),
(4, 'Las hijas de la criada', 'Sonsoles Ónega', 480, '2023-11-08'),
(1, 'Cómo hacer que te pasen cosas buenas', 'Marian Rojas Estapé', 232, '2018-10-09'),
(4, 'El niño que perdió la guerra', 'Julia Navarro', 640, '2024-09-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD KEY `fk_categoria` (`categoria`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
