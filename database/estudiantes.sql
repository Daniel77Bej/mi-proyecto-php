-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2026 a las 17:57:14
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
-- Base de datos: `estudiantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `ID` int(15) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `codigo_estudiantil` int(20) NOT NULL,
  `programa` varchar(25) NOT NULL,
  `semestre` int(5) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`ID`, `apellido`, `nombre`, `fecha_nacimiento`, `codigo_estudiantil`, `programa`, `semestre`, `correo`, `telefono`, `direccion`) VALUES
(124893749, 'mora', 'Danna', '2000-07-11', 394830, 'Ingeniería Informática', 6, 'mora@gmail.com', '300738923', 'avenida 20a, 3-45 barrio garab'),
(176085776, 'santos', 'Alejandro', '2004-10-29', 46578, 'Administración de Empresa', 3, 'compa23@gmail.com', '300430986', 'carrera 10a, 36-4 barrio mi ll'),
(112182045, 'espitia', 'sara', '1999-06-18', 22354, 'Administración de Empresa', 9, 'espitiaes@hotmail.com', '3003916337', 'calle 5a, 30-40 barrio estero'),
(1221846386, 'bejarano', 'carlos', '2003-06-27', 397730, 'Administración de Empresa', 4, 'ataucm@outlook.com', '3096434535', 'carrera 20, 20-36 vizcaya'),
(1221889326, 'granate', 'anastacia', '1996-10-08', 399930, 'Administración de Empresa', 8, 'granate@outlook.com', '3023434566', 'carrera 10, 21-30 vizcaya'),
(1221996386, 'bobadilla', 'Juan', '1996-07-08', 23755, 'Ingeniería Informática', 10, 'bobadilla@gmail.com', '3001317330', 'conjunto los almendros casa 3'),
(1231996377, 'alfonso', 'margarita', '1996-07-03', 23299, 'Ingeniería Informática', 6, 'alfonso2@gmail.com', '3011317399', 'conjunto los almendros casa 8'),
(1232976399, 'dasilva', 'lula', '2001-02-13', 23274, 'Ingeniería Informática', 8, 'dasilva45@gmail.com', '3011827397', 'carrera 8b, 10-3 porfia'),
(1232276393, 'mre', 'andres', '1994-07-20', 21275, 'Administración de Empresa', 10, 'mre5@gmail.com', '3011126397', 'carrera 10b, 24-3 porfia'),
(123222346, 'mora', 'andres', '1994-07-09', 21225, 'Administración de Empresa', 6, 'moraandr@gmail.com', '3011236386', 'carrera 11b, 27-3 mi llanura');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
