-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2025 a las 20:15:51
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
  `id_categoria` int(11) NOT NULL,
  `categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Autoayuda'),
(2, 'Novela de fantasía'),
(3, 'Novela Negra'),
(4, 'Novela contemporánea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `paginas` int(11) NOT NULL,
  `fecha_pub` date NOT NULL,
  `categoria` text NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `precio`, `paginas`, `fecha_pub`, `categoria`, `imagen`) VALUES
(1, 'Hábitos atómicos', 'James Clear', 23.9, 328, '2018-10-16', 'Autoayuda', 'HabitosAtomicos.jpg'),
(2, 'Alas de Sangre (Empíreo 1)', 'Rebeca Yarros', 26.9, 736, '2023-04-05', 'Novela de fantasía', 'AlasSangre1.jpg'),
(3, 'Un animal salvaje', 'Joël Dicker', 23.9, 448, '2024-04-04', 'Novela Negra', 'AnimalSalvaje.jpg'),
(4, 'La grieta del silencio', 'Javier Castillo', 12.95, 448, '2024-04-16', 'Novela contemporánea', 'GrietaDelSilencio.jpg'),
(5, 'Alas de hierro (Empíreo 2)', 'Rebeca Yarros', 26.9, 896, '2024-02-21', 'Novela de fantasía', 'AlasHierro2.jpg'),
(6, 'Recupera tu mente, reconquista tu vida', 'Marian Rojas Estapé', 20.9, 384, '2024-04-03', 'Autoayuda', 'RecuperaTuMente.jpg'),
(7, 'Las hijas de la criada', 'Sonsoles Ónega', 14.95, 480, '2023-11-08', 'Novela Negra', 'HijasCriada.jpg'),
(8, 'Cómo hacer que te pasen cosas buenas', 'Marian Rojas Estapé', 20.9, 232, '2018-10-09', 'Autoayuda', 'CosasBuenas.jpg'),
(9, 'El niño que perdió la guerra', 'Julia Navarro', 24.9, 640, '2024-09-05', 'Novela contemporánea', 'NiñoGuerra.jpg'),
(10, 'El señor de los anillos', 'J.R.R. Tolkien', 12.95, 1200, '1954-07-29', 'Novela de fantasía', 'LOTR1.jpg'),
(11, 'La historia interminable', 'Michael Ende', 15.95, 400, '1979-01-01', 'Novela de fantasía', 'HistoriaInterminable.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_categorias`
--

CREATE TABLE `libros_categorias` (
  `id_libro` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros_categorias`
--

INSERT INTO `libros_categorias` (`id_libro`, `id_categoria`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(6, 1),
(7, 3),
(8, 1),
(9, 4),
(10, 2),
(11, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD PRIMARY KEY (`id_libro`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD CONSTRAINT `libros_categorias_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `libros_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
