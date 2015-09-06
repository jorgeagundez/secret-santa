-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2015 a las 01:10:16
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
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `friend`
--

INSERT INTO `friend` (`idfriend`, `friendname`, `friendemail`, `game_idgame`, `gamekey`, `invitation`, `confirmation`) VALUES
(96, 'adria', 'secretsanta.adria@gmail.com', 36, 'ea5d2f1c4608232e07d3aa3d998e5135', 1, 1),
(97, 'Clara', 'secretsanta.clara@gmail.com', 36, 'ea5d2f1c4608232e07d3aa3d998e5135', 1, 1),
(98, 'Keyvan', 'secretsanta.keyvan@gmail.com', 36, 'ea5d2f1c4608232e07d3aa3d998e5135', 1, 1),
(99, 'amigo1', 'amigo1@mail.com', 37, 'fc490ca45c00b1249bbe3554a4fdf6fb', 1, 1),
(100, 'amigo2', 'amigo2@mail.com', 37, 'fc490ca45c00b1249bbe3554a4fdf6fb', 1, 1),
(103, 'aaaaa', 'aaaaaa@gmail.com', 38, '3295c76acbf4caaed33c36b1b5fc2cb1', 0, 1),
(104, 'bbbbb', 'bbbbbb@gmail.com', 38, '3295c76acbf4caaed33c36b1b5fc2cb1', 0, 0),
(105, 'ccccc', 'ccccccc@gmail.com', 38, '3295c76acbf4caaed33c36b1b5fc2cb1', 0, 0),
(124, 'sola1', 'sola1@gmail.com', 49, '28dd2c7955ce926456240b2ff0100bde', 1, 0),
(125, 'sola2', 'sola2@gmail.com', 49, '28dd2c7955ce926456240b2ff0100bde', 1, 1),
(126, 'prueba1', 'prueba1@gmail.com', 50, '35f4a8d465e6e1edc05f3d8ab658c551', 1, 1),
(127, 'prueba2', 'prueba2@gmail.com', 50, '35f4a8d465e6e1edc05f3d8ab658c551', 1, 1),
(128, 'prueba3', 'prueba3@gmail.com', 50, '35f4a8d465e6e1edc05f3d8ab658c551', 1, 1),
(139, 'barbateno1', 'barbateno1@gmail.com', 53, '9778d5d219c5080b9a6a17bef029331c', 1, 0),
(140, 'barbateno2', 'barbateno2@gmail.com', 53, '9778d5d219c5080b9a6a17bef029331c', 1, 1),
(142, 'barbateno4', 'barbateno4@gmail.com', 53, '9778d5d219c5080b9a6a17bef029331c', 1, 0),
(146, 'rosa1', 'rosa1@gmail.com', 56, '3ef815416f775098fe977004015c6193', 1, 1),
(147, 'rosa2', 'rosa2@gmail.com', 56, '3ef815416f775098fe977004015c6193', 1, 1),
(149, 'pedro1', 'pedro1@gmail.com', 57, '93db85ed909c13838ff95ccfa94cebd9', 1, 1),
(150, 'pedro2', 'pedro2@gmail.com', 57, '93db85ed909c13838ff95ccfa94cebd9', 1, 1),
(151, 'pedro3', 'pedro3@gmail.com', 57, '93db85ed909c13838ff95ccfa94cebd9', 1, 1),
(152, 'pedro4', 'pedro4@gmail.com', 57, '93db85ed909c13838ff95ccfa94cebd9', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE IF NOT EXISTS `game` (
`idgame` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `gameplace` varchar(45) NOT NULL,
  `gamedate` date NOT NULL,
  `user_idusuario` int(11) DEFAULT NULL,
  `gamenumberfriends` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `gamekey` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`idgame`, `title`, `description`, `price`, `gameplace`, `gamedate`, `user_idusuario`, `gamenumberfriends`, `confirmed`, `gamekey`) VALUES
(36, 'Juego de Jorge', 'Juego bla bla bla bla', 5, 'London', '2015-04-25', '2015-04-25', 64, 3, 1, 'ea5d2f1c4608232e07d3aa3d998e5135'),
(37, 'Juego de Carlos', 'Juego bla bla bla bla', 5, 'London', '2015-04-26', '2015-04-18', 65, 2, 1, 'fc490ca45c00b1249bbe3554a4fdf6fb'),
(38, 'Juego de Mario', 'Juego bla bla bla bla', 3, 'London', '2015-04-25', '2015-04-26', 66, 3, 0, '3295c76acbf4caaed33c36b1b5fc2cb1'),
(49, 'Juego de Maria', 'Juego bla bla bla bla', 2, 'al;ksjdf', '2015-04-17', '2015-04-30', 77, 2, 0, '28dd2c7955ce926456240b2ff0100bde'),
(50, 'Juego de Prueba', 'bla bla bla', 2, 'prueba city', '2015-04-26', '2015-04-30', 78, 3, 1, '35f4a8d465e6e1edc05f3d8ab658c551'),
(53, 'Juego de Gloria', 'Juego bla bla bla bla', 5, 'Barbate', '2015-04-26', '2015-04-23', 82, 3, 0, '9778d5d219c5080b9a6a17bef029331c'),
(56, 'Juego de Rosa', 'Juego bla bla bla bla', 5, 'Girona', '2015-04-24', '2015-04-29', 85, 2, 1, '3ef815416f775098fe977004015c6193'),
(57, 'Juego de Pedro', 'Juego bla bla bla bla', 2, 'Badajoz', '2015-04-26', '2015-04-30', 86, 4, 1, '93db85ed909c13838ff95ccfa94cebd9');

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
(64, 'jorge', 'jorge@mail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(65, 'carlos', 'carlos@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(66, 'Mario', 'mario@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(77, 'maria', 'maria@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(78, 'prueba', 'prueba@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(82, 'gloria', 'gloria@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(85, 'Rosadiez', 'rosa@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL),
(86, 'Pedro', 'pedro@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, NULL);

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
 ADD PRIMARY KEY (`idusuario`), ADD UNIQUE KEY `idusuario_UNIQUE` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `friend`
--
ALTER TABLE `friend`
MODIFY `idfriend` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
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
