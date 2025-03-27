-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2025 a las 12:12:38
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
  `id_libro` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `autor` text NOT NULL,
  `paginas` int(11) NOT NULL,
  `fecha_pub` date NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `paginas`, `fecha_pub`, `imagen`) VALUES
(1, 'Hábitos atómicos', 'James Clear', 328, '2018-10-16', 'HabitosAtomicos.jpg'),
(2, 'Alas de Sangre (Empíreo 1)', 'Rebeca Yarros', 736, '2023-04-05', 'AlasSangre1.jpg'),
(3, 'Un animal salvaje', 'Joël Dicker', 448, '2024-04-04', 'AnimalSalvaje.jpg'),
(4, 'La grieta del silencio', 'Javier Castillo', 448, '2024-04-16', 'GrietaDelSilencio.jpg'),
(5, 'Alas de hierro (Empíreo 2)', 'Rebeca Yarros', 896, '2024-02-21', 'AlasHierro2.jpg'),
(6, 'Recupera tu mente, reconquista tu vida', 'Marian Rojas Estapé', 384, '2024-04-03', 'RecuperaTuMente.jpg'),
(7, 'Las hijas de la criada', 'Sonsoles Ónega', 480, '2023-11-08', 'HijasCriada.jpg'),
(8, 'Cómo hacer que te pasen cosas buenas', 'Marian Rojas Estapé', 232, '2018-10-09', 'CosasBuenas.jpg'),
(9, 'El niño que perdió la guerra', 'Julia Navarro', 640, '2024-09-05', 'NiñoGuerra.jpg'),
(10, 'El señor de los anillos', 'J.R.R. Tolkien', 1200, '1954-07-29', 'LOTR1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_categorias`
--

CREATE TABLE `libros_categorias` (
  `libro` int(11) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD PRIMARY KEY (`libro`,`categoria`),
  ADD KEY `categoria` (`categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD CONSTRAINT `libros_categorias_ibfk_1` FOREIGN KEY (`libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `libros_categorias_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
