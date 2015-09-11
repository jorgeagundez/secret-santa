-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2015 a las 22:48:48
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `secretsanta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
`idfriend` int(11) NOT NULL,
  `friendname` varchar(45) NOT NULL,
  `friendemail` varchar(45) NOT NULL,
  `game_idgame` int(11) NOT NULL,
  `gamekey` varchar(50) NOT NULL,
  `invitation` tinyint(1) NOT NULL,
  `confirmation` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `friend`
--

INSERT INTO `friend` (`idfriend`, `friendname`, `friendemail`, `game_idgame`, `gamekey`, `invitation`, `confirmation`) VALUES
(233, 'jorgito', 'jorgito@mail.com', 51, 'fe9fc289c3ff0af142b6d3bead98a923', 1, 1),
(234, 'laura', 'laura@mail.com', 51, 'fe9fc289c3ff0af142b6d3bead98a923', 1, 1),
(236, 'oscar', 'oscar@mail.com', 51, 'fe9fc289c3ff0af142b6d3bead98a923', 1, 1),
(265, 'pepito', 'prueba@mail.com', 51, 'fe9fc289c3ff0af142b6d3bead98a923', 1, 1),
(266, 'maria', 'maria@mail.com', 54, '93db85ed909c13838ff95ccfa94cebd9', 1, 0),
(267, 'Vera', 'vera@mail.com', 54, '93db85ed909c13838ff95ccfa94cebd9', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE IF NOT EXISTS `game` (
`idgame` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `user_idusuario` int(11) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `gamekey` varchar(50) NOT NULL,
  `ended` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`idgame`, `title`, `description`, `user_idusuario`, `confirmed`, `gamekey`, `ended`) VALUES
(51, 'Amigo Invisible Navidades 2015', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu tempus velit. Phasellus eu ex ut tellus rutrum vestibulum quis sed justo. Aliquam euismod tellus et purus lobortis vulputate. Praesent convallis accumsan risus. Maecenas mollis turpis consequat, dapibus sapien eu, consequat velit. Nam hendrerit metus et molestie vestibulum. Vestibulum placerat neque quam, vitae laoreet orci accumsan a. ', 83, 0, 'fe9fc289c3ff0af142b6d3bead98a923', 1),
(54, 'Amigo Invisible Armonicos!', 'Hola!! Esto es una prueba para el amigo invisible que podemos hacer el dia 24 de diciembre por la tarde. Os gustaria? Propongo 5 euros de media.\r\nBesitos!', 86, 0, '93db85ed909c13838ff95ccfa94cebd9', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`idusuario` int(11) NOT NULL,
  `nombreusuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cookie` varchar(40) DEFAULT NULL,
  `tempkey` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idusuario`, `nombreusuario`, `email`, `password`, `cookie`, `tempkey`) VALUES
(83, 'test', 'test@email.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(86, 'Jorge', 'jorge@mail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `friend`
--
ALTER TABLE `friend`
 ADD PRIMARY KEY (`idfriend`,`game_idgame`), ADD UNIQUE KEY `idfriend_UNIQUE` (`idfriend`), ADD KEY `fk_friend_game_idx` (`game_idgame`);

--
-- Indices de la tabla `game`
--
ALTER TABLE `game`
 ADD PRIMARY KEY (`idgame`), ADD UNIQUE KEY `idgame_UNIQUE` (`idgame`), ADD UNIQUE KEY `user_idusuario` (`user_idusuario`), ADD KEY `fk_game_user_idx` (`user_idusuario`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`idusuario`), ADD UNIQUE KEY `idusuario_UNIQUE` (`idusuario`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `friend`
--
ALTER TABLE `friend`
MODIFY `idfriend` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `friend`
--
ALTER TABLE `friend`
ADD CONSTRAINT `fk_friend_game` FOREIGN KEY (`game_idgame`) REFERENCES `game` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `game`
--
ALTER TABLE `game`
ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`user_idusuario`) REFERENCES `user` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
