-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2022 a las 23:55:32
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hroute`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `ID` int(11) NOT NULL,
  `LUGAR` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`ID`, `LUGAR`) VALUES
(1, 'Urgencias'),
(2, 'Estación de Enfermería Cuarto Piso'),
(3, 'Estación de Enfermería Tercer Piso'),
(4, 'Estación de Enfermería Quinto Piso'),
(5, 'Estación de Enfermería Unidad de Pacientes Críticos'),
(6, 'Laboratorio'),
(7, 'Rayos'),
(8, 'Scaner'),
(9, 'Estacionamiento'),
(10, 'Pabellón'),
(11, 'Recuperación'),
(14, 'Central');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_prioridad`
--

CREATE TABLE `nivel_prioridad` (
  `ID` int(11) NOT NULL,
  `NIVEL` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nivel_prioridad`
--

INSERT INTO `nivel_prioridad` (`ID`, `NIVEL`) VALUES
(1, 'Alto'),
(2, 'Medio'),
(3, 'Bajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_traslados`
--

CREATE TABLE `tipo_traslados` (
  `ID` int(11) NOT NULL,
  `TIPO_TRASLADO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_traslados`
--

INSERT INTO `tipo_traslados` (`ID`, `TIPO_TRASLADO`) VALUES
(1, 'Traslado de Exámenes'),
(2, 'Traslado de Medicamentos'),
(3, 'Traslado de Medicamentos Express'),
(4, 'Traslado de Paciente en Cama'),
(5, 'Traslado de Paciente en Cama COVID-19'),
(6, 'Traslado de Paciente en Silla'),
(7, 'Traslado de Documentos'),
(8, 'Traslado de Paciente en Camilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `ID` int(11) NOT NULL,
  `TIPO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID`, `TIPO`) VALUES
(1, 'ADMIN'),
(2, 'TRABAJADOR'),
(3, 'PHOSPITAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslados`
--

CREATE TABLE `traslados` (
  `ID` int(11) NOT NULL,
  `ORIGEN` int(11) NOT NULL,
  `DESTINO` int(11) NOT NULL,
  `TIPO_TRASLADO` int(11) NOT NULL,
  `NIVEL_PRIORIDAD` int(11) NOT NULL,
  `FECHA` datetime NOT NULL DEFAULT current_timestamp(),
  `NOMBRE_TRABAJADOR` int(11) DEFAULT NULL,
  `NOMBRE_PERSONAL` varchar(30) NOT NULL,
  `NOMBRE_PACIENTE` varchar(30) DEFAULT NULL,
  `REALIZADA` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `USUARIO` varchar(20) NOT NULL,
  `CONTRASENA` varchar(30) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `TIPO_USUARIO` int(11) NOT NULL,
  `PISO` int(11) NOT NULL DEFAULT 14,
  `CONECTADO` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `USUARIO`, `CONTRASENA`, `NOMBRE`, `TIPO_USUARIO`, `PISO`, `CONECTADO`) VALUES
(1, 'admin', 'admin', 'Administrador', 1, 14, b'0'),
(2, 'generico', 'generico', 'Camillero sin asignar', 2, 14, b'0'),
(3, 'benalv', 'benalv', 'Benjamin Alvarez', 2, 14, b'0'),
(4, 'alfleo', 'alfleo', 'Alfredo Leonelli', 2, 14, b'0'),
(5, '3piso', '3piso', 'Enfermeria 3er Piso', 3, 3, b'0'),
(6, 'urgencias', 'urgencias', 'Urgencias', 3, 1, b'0'),
(7, '4piso', '4piso', 'Enfermeria 4to Piso', 3, 2, b'0'),
(8, '5piso', '6piso', 'Enfermeria 5to Piso', 3, 4, b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `nivel_prioridad`
--
ALTER TABLE `nivel_prioridad`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_traslados`
--
ALTER TABLE `tipo_traslados`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Origen` (`ORIGEN`),
  ADD KEY `FK_Destino` (`DESTINO`),
  ADD KEY `FK_TipoTraslado` (`TIPO_TRASLADO`),
  ADD KEY `FK_NombreTrabajador` (`NOMBRE_TRABAJADOR`),
  ADD KEY `FK_NivelPrioridad` (`NIVEL_PRIORIDAD`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_TipoUsuario` (`TIPO_USUARIO`),
  ADD KEY `FK_Piso` (`PISO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_traslados`
--
ALTER TABLE `tipo_traslados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `traslados`
--
ALTER TABLE `traslados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD CONSTRAINT `FK_Destino` FOREIGN KEY (`DESTINO`) REFERENCES `lugares` (`ID`),
  ADD CONSTRAINT `FK_NombreTrabajador` FOREIGN KEY (`NOMBRE_TRABAJADOR`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `FK_Origen` FOREIGN KEY (`ORIGEN`) REFERENCES `lugares` (`ID`),
  ADD CONSTRAINT `FK_TipoTraslado` FOREIGN KEY (`TIPO_TRASLADO`) REFERENCES `tipo_traslados` (`ID`),
  ADD CONSTRAINT `traslados_ibfk_1` FOREIGN KEY (`NIVEL_PRIORIDAD`) REFERENCES `nivel_prioridad` (`ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Piso` FOREIGN KEY (`PISO`) REFERENCES `lugares` (`ID`),
  ADD CONSTRAINT `FK_TipoUsuario` FOREIGN KEY (`TIPO_USUARIO`) REFERENCES `tipo_usuario` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
