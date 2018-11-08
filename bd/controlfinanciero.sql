-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-11-2018 a las 16:27:08
-- Versión del servidor: 10.3.10-MariaDB-1:10.3.10+maria~stretch
-- Versión de PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlfinanciero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bautizo`
--

CREATE TABLE `bautizo` (
  `idBautizo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `miembro_idMiembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCaja` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `total`, `fecha`, `Usuario_idUsuario`) VALUES
(1, 0, '2018-10-25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inoutcaja`
--

CREATE TABLE `inoutcaja` (
  `idIngreso` int(11) NOT NULL,
  `descripcion` varchar(4000) DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `caja_idCaja` int(11) NOT NULL,
  `tipotransaccion_idtipotransaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liderministerio`
--

CREATE TABLE `liderministerio` (
  `idliderministerio` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `ministerio_idMinisterio` int(11) NOT NULL,
  `miembro_idMiembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `liderministerio`
--

INSERT INTO `liderministerio` (`idliderministerio`, `estado`, `ministerio_idMinisterio`, `miembro_idMiembro`) VALUES
(1, 0, 1, 1),
(2, 0, 1, 2),
(3, 0, 1, 3),
(4, 0, 1, 1),
(5, 0, 1, 1),
(6, 0, 1, 1),
(7, 0, 1, 1),
(8, 0, 1, 1),
(9, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

CREATE TABLE `miembro` (
  `idMiembro` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `estadoCivil` varchar(10) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefonoFijo` varchar(20) DEFAULT NULL,
  `telefonoMovil` varchar(20) DEFAULT NULL,
  `nacionalidad` varchar(45) DEFAULT NULL,
  `profesion` varchar(45) DEFAULT NULL,
  `fechaAceptacion` date DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `ministerio_idMinisterio` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`idMiembro`, `nombres`, `apellidos`, `estadoCivil`, `fechaNac`, `genero`, `email`, `direccion`, `telefonoFijo`, `telefonoMovil`, `nacionalidad`, `profesion`, `fechaAceptacion`, `Usuario_idUsuario`, `ministerio_idMinisterio`, `estado`) VALUES
(1, 'manuel', 'escobar', 'soltero', '2010-07-09', 'Masculino', NULL, 'ciudad', '79879482379', '879879879', 'guatemala', 'vago', '2018-11-08', 1, 1, 1),
(2, 'pablo', 'sosa', 'soltero', '1992-06-02', 'Masculino', NULL, 'ciudad', '79879', '7987987', 'guatemala', 'trabajador', '2018-11-08', 1, NULL, 1),
(3, 'yubini', 'lkjlk', 'casado', '1987-05-10', 'Masculino', NULL, 'ciudad', '98798', '798798', 'guatemala', 'estudiante', '2018-11-08', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ministerio`
--

CREATE TABLE `ministerio` (
  `idMinisterio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ministerio`
--

INSERT INTO `ministerio` (`idMinisterio`, `nombre`, `fecha`, `descripcion`) VALUES
(1, 'Ministerio 1', '2018-10-27', 'Ministerio uno'),
(2, 'Ministerio 2', '2018-10-25', 'Ministerio 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `idPresentacion` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `nombresPapa` varchar(50) DEFAULT NULL,
  `nombresMama` varchar(50) DEFAULT NULL,
  `fechaPresentacion` date DEFAULT NULL,
  `usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotransaccion`
--

CREATE TABLE `tipotransaccion` (
  `idtipotransaccion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `username`, `password`, `rol`) VALUES
(1, 'admin', '$2a$04$30WIdXwaG23gJd0aqPJVTO.x4ngZ9tSfC4P/6GHnPn9Ej599b7l4u', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bautizo`
--
ALTER TABLE `bautizo`
  ADD PRIMARY KEY (`idBautizo`),
  ADD KEY `fk_Bautizo_miembro1_idx` (`miembro_idMiembro`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCaja`),
  ADD KEY `fk_Caja_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `inoutcaja`
--
ALTER TABLE `inoutcaja`
  ADD PRIMARY KEY (`idIngreso`),
  ADD KEY `fk_inoutcaja_caja1_idx` (`caja_idCaja`),
  ADD KEY `fk_inoutcaja_tipotransaccion1_idx` (`tipotransaccion_idtipotransaccion`);

--
-- Indices de la tabla `liderministerio`
--
ALTER TABLE `liderministerio`
  ADD PRIMARY KEY (`idliderministerio`),
  ADD KEY `fk_liderministerio_ministerio1_idx` (`ministerio_idMinisterio`),
  ADD KEY `fk_liderministerio_miembro1_idx` (`miembro_idMiembro`);

--
-- Indices de la tabla `miembro`
--
ALTER TABLE `miembro`
  ADD PRIMARY KEY (`idMiembro`),
  ADD KEY `fk_RegistroMiembro_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_miembro_ministerio1_idx` (`ministerio_idMinisterio`);

--
-- Indices de la tabla `ministerio`
--
ALTER TABLE `ministerio`
  ADD PRIMARY KEY (`idMinisterio`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`idPresentacion`),
  ADD KEY `fk_presentacion_usuario1_idx` (`usuario_idUsuario`);

--
-- Indices de la tabla `tipotransaccion`
--
ALTER TABLE `tipotransaccion`
  ADD PRIMARY KEY (`idtipotransaccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bautizo`
--
ALTER TABLE `bautizo`
  MODIFY `idBautizo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `inoutcaja`
--
ALTER TABLE `inoutcaja`
  MODIFY `idIngreso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `liderministerio`
--
ALTER TABLE `liderministerio`
  MODIFY `idliderministerio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `miembro`
--
ALTER TABLE `miembro`
  MODIFY `idMiembro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ministerio`
--
ALTER TABLE `ministerio`
  MODIFY `idMinisterio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `idPresentacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipotransaccion`
--
ALTER TABLE `tipotransaccion`
  MODIFY `idtipotransaccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bautizo`
--
ALTER TABLE `bautizo`
  ADD CONSTRAINT `fk_Bautizo_miembro1` FOREIGN KEY (`miembro_idMiembro`) REFERENCES `miembro` (`idMiembro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `fk_Caja_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inoutcaja`
--
ALTER TABLE `inoutcaja`
  ADD CONSTRAINT `fk_inoutcaja_caja1` FOREIGN KEY (`caja_idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inoutcaja_tipotransaccion1` FOREIGN KEY (`tipotransaccion_idtipotransaccion`) REFERENCES `tipotransaccion` (`idtipotransaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `liderministerio`
--
ALTER TABLE `liderministerio`
  ADD CONSTRAINT `fk_liderministerio_miembro1` FOREIGN KEY (`miembro_idMiembro`) REFERENCES `miembro` (`idMiembro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_liderministerio_ministerio1` FOREIGN KEY (`ministerio_idMinisterio`) REFERENCES `ministerio` (`idMinisterio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `miembro`
--
ALTER TABLE `miembro`
  ADD CONSTRAINT `fk_RegistroMiembro_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_miembro_ministerio1` FOREIGN KEY (`ministerio_idMinisterio`) REFERENCES `ministerio` (`idMinisterio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD CONSTRAINT `fk_presentacion_usuario1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
