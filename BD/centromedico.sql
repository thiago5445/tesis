-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 00:23:58
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `centromedico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idcita` int(11) NOT NULL,
  `citfecha` date NOT NULL,
  `cithora` time NOT NULL,
  `citPaciente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `citMedico` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `citEspecialidades` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `citConsultorio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `citestado` enum('Pendiente','Atendido') COLLATE utf8_spanish_ci NOT NULL,
  `citobservaciones` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `consultorios_idConsultorio` int(11) DEFAULT NULL,
  `pacientes_idPaciente` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `medicos_idMedico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `citfecha`, `cithora`, `citPaciente`, `citMedico`, `citEspecialidades`, `citConsultorio`, `citestado`, `citobservaciones`, `consultorios_idConsultorio`, `pacientes_idPaciente`, `usuarios_id`, `medicos_idMedico`) VALUES
(24, '2020-06-18', '10:00:00', 'carlos jose intriago andaluz', 'adadadadad adadadadad', 'servicio 1', 'consultorio 1', 'Pendiente', 'ddadda', NULL, NULL, NULL, NULL),
(25, '2020-06-12', '10:00:00', 'carlos jose intriago andaluz', 'adadadadad adadadadad', 'servicio 1', 'consultorio 2', 'Pendiente', 'sdadsadadad', NULL, NULL, NULL, NULL),
(27, '2020-06-12', '10:00:00', 'carlos jose intriago andaluz', 'adadadadad adadadadad', 'servicio 1', 'consultorio 4', 'Pendiente', 'sdfffsfsfs', NULL, NULL, NULL, NULL),
(28, '2020-06-12', '10:00:00', 'rrrrrr rraaaaa', 'adadadadad adadadadad', 'servicio 1', 'consultorio 4', 'Pendiente', 'adadada', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `idConsultorio` int(11) NOT NULL,
  `conNombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`idConsultorio`, `conNombre`) VALUES
(6, 'consultorio 1'),
(7, 'consultorio 2'),
(8, 'consultorio 3'),
(9, 'consultorio 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `idespecialidad` int(11) NOT NULL,
  `espNombre` char(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idespecialidad`, `espNombre`) VALUES
(21, 'servicio 1'),
(22, 'servicio 2'),
(26, 'servicio 3'),
(27, 'servicio 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `idMedico` int(11) NOT NULL,
  `medidentificacion` char(13) COLLATE utf8_spanish_ci NOT NULL,
  `mednombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medapellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medEspecialidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medtelefono` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `medcorreo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_spanish_ci DEFAULT 'activo',
  `especialidades_idespecialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idMedico`, `medidentificacion`, `mednombres`, `medapellidos`, `medEspecialidad`, `medtelefono`, `medcorreo`, `estado`, `especialidades_idespecialidad`) VALUES
(10, '1111111111111', 'adadadadad', 'adadadadad', 'servicio 1', '5555555555', 'carlosjose5445@gamil.com', 'inactivo', NULL),
(12, '7777777777777', 'paola carolina', 'perez cordova', 'servicio 2', '5555555555', 'carlosjose5445@hotmail.com', 'activo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `idPaciente` int(11) NOT NULL,
  `pacIdentificacion` char(13) COLLATE utf8_spanish_ci NOT NULL,
  `pacNombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pacApellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pacFechaNacimiento` date NOT NULL,
  `pacSexo` enum('Femenino','Masculino') COLLATE utf8_spanish_ci NOT NULL,
  `pacTelefono` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `pacDireccion` varchar(254) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `pacIdentificacion`, `pacNombre`, `pacApellidos`, `pacFechaNacimiento`, `pacSexo`, `pacTelefono`, `pacDireccion`, `estado`) VALUES
(6, '1111111111111', 'carlos jose', 'intriago andaluz', '2020-06-05', 'Masculino', '1111111111', 'rosendo aviles y bab', 'inactivo'),
(8, '9999999999999', 'rrrrrr', 'rraaaaa', '2020-06-06', 'Masculino', '4444444444', 'adadadad adadadadad adadadada adadadadad adadadadad', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Roll` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `nombres`, `apellidos`, `Roll`) VALUES
(2, 'carlos', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'carlos', 'intriago', 'admin'),
(3, 'alex', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'alex', 'vasquez', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `cithora` (`cithora`),
  ADD KEY `idPaciente` (`citPaciente`),
  ADD KEY `idMedico` (`citMedico`),
  ADD KEY `idConsultorio` (`citConsultorio`),
  ADD KEY `fk_citas_pacientes1_idx` (`pacientes_idPaciente`),
  ADD KEY `fk_citas_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_citas_medicos1_idx` (`medicos_idMedico`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`idConsultorio`),
  ADD UNIQUE KEY `conNombre` (`conNombre`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`idespecialidad`),
  ADD UNIQUE KEY `espNombre` (`espNombre`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`idMedico`),
  ADD UNIQUE KEY `medidentificacion` (`medidentificacion`),
  ADD KEY `fk_medicos_especialidades1_idx` (`especialidades_idespecialidad`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`idPaciente`),
  ADD UNIQUE KEY `pacIdentificacion` (`pacIdentificacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `idConsultorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `idespecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `idMedico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_medicos1` FOREIGN KEY (`medicos_idMedico`) REFERENCES `medicos` (`idMedico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_citas_pacientes1` FOREIGN KEY (`pacientes_idPaciente`) REFERENCES `pacientes` (`idPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_citas_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `fk_medicos_especialidades1` FOREIGN KEY (`especialidades_idespecialidad`) REFERENCES `especialidades` (`idespecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
