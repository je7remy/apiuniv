-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2024 a las 23:34:03
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
-- Base de datos: `instituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idestudiante` int(11) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `carrera` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idestudiante`, `matricula`, `nombre`, `apellidos`, `direccion`, `telefono`, `carrera`, `estado`) VALUES
(1, '31-0565', 'Rafael', 'De La Rosa', 'Santiago', '(829) 522-1766', 'Informatica', 'A'),
(2, '210266', 'Jeremy', 'De La Cruz', 'Las Martinez', '8295221765', 'Informatica', 'A'),
(3, '210266', 'Jeremy', 'De La Cruz', 'Las Martinez', '8295221765', 'Informatica', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `idmaestro` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `especialidad` varchar(500) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`idmaestro`, `nombre`, `apellidos`, `telefono`, `especialidad`, `estado`) VALUES
(1, 'Jose Ramon', 'De La Cruz', '8295221765', 'Maestro', 'A'),
(2, 'Jose Rodrigues', 'De La Rosas', '8295223434', 'Maestros', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idmateria` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `codigomateria` varchar(50) NOT NULL,
  `horario` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `aula` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmateria`, `descripcion`, `codigomateria`, `horario`, `estado`, `aula`) VALUES
(1, 'Programacion', 'CS101', '9:00 AM - 10:30 AM', 'I', '102'),
(2, 'Programacion', 'CS101', '9:00 AM - 10:30 AM', 'A', '101');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiaxestudiante`
--

CREATE TABLE `materiaxestudiante` (
  `matricula` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `idmaestro` int(11) NOT NULL,
  `idperiodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiaxestudiante`
--

INSERT INTO `materiaxestudiante` (`matricula`, `idmateria`, `idmaestro`, `idperiodo`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiaxmaestro`
--

CREATE TABLE `materiaxmaestro` (
  `idmaestro` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `idperiodo` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `cuatrimestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiaxmaestro`
--

INSERT INTO `materiaxmaestro` (`idmaestro`, `idmateria`, `idperiodo`, `anio`, `cuatrimestre`) VALUES
(1, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos_academicos`
--

CREATE TABLE `periodos_academicos` (
  `idperiodo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos_academicos`
--

INSERT INTO `periodos_academicos` (`idperiodo`, `descripcion`, `estado`) VALUES
(1, 'periodo genial', 'I'),
(2, 'periodo Oscuro', 'A'),
(3, 'periodo Oscuro', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(500) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `clave`, `tipo`, `estado`) VALUES
(1, 'lisa', 'lisa', '123', 'ADM', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idestudiante`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`idmaestro`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indices de la tabla `materiaxestudiante`
--
ALTER TABLE `materiaxestudiante`
  ADD PRIMARY KEY (`matricula`,`idmateria`,`idperiodo`),
  ADD KEY `idmateria` (`idmateria`),
  ADD KEY `idmaestro` (`idmaestro`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `materiaxmaestro`
--
ALTER TABLE `materiaxmaestro`
  ADD PRIMARY KEY (`idmaestro`,`idmateria`,`idperiodo`),
  ADD KEY `idmateria` (`idmateria`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  ADD PRIMARY KEY (`idperiodo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `idmaestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materiaxestudiante`
--
ALTER TABLE `materiaxestudiante`
  MODIFY `matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materiaxmaestro`
--
ALTER TABLE `materiaxmaestro`
  MODIFY `idmaestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  MODIFY `idperiodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materiaxestudiante`
--
ALTER TABLE `materiaxestudiante`
  ADD CONSTRAINT `materiaxestudiante_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `estudiantes` (`idestudiante`),
  ADD CONSTRAINT `materiaxestudiante_ibfk_2` FOREIGN KEY (`idmateria`) REFERENCES `materias` (`idmateria`),
  ADD CONSTRAINT `materiaxestudiante_ibfk_3` FOREIGN KEY (`idmaestro`) REFERENCES `maestros` (`idmaestro`),
  ADD CONSTRAINT `materiaxestudiante_ibfk_4` FOREIGN KEY (`idperiodo`) REFERENCES `periodos_academicos` (`idperiodo`);

--
-- Filtros para la tabla `materiaxmaestro`
--
ALTER TABLE `materiaxmaestro`
  ADD CONSTRAINT `materiaxmaestro_ibfk_1` FOREIGN KEY (`idmaestro`) REFERENCES `maestros` (`idmaestro`),
  ADD CONSTRAINT `materiaxmaestro_ibfk_2` FOREIGN KEY (`idmateria`) REFERENCES `materias` (`idmateria`),
  ADD CONSTRAINT `materiaxmaestro_ibfk_3` FOREIGN KEY (`idperiodo`) REFERENCES `periodos_academicos` (`idperiodo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
