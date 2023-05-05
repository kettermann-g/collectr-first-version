-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Maio-2023 às 22:50
-- Versão do servidor: 5.7.40
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `collectr`
--
CREATE DATABASE IF NOT EXISTS `collectr` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `collectr`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `artistamu`
--

DROP TABLE IF EXISTS `artistamu`;
CREATE TABLE IF NOT EXISTS `artistamu` (
  `idArMu` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArMu` varchar(255) NOT NULL,
  `tipoArMu` int(11) NOT NULL,
  `diaFormacNas` int(11) DEFAULT NULL,
  `mesFormacNas` int(11) DEFAULT NULL,
  `anoFormacNas` int(11) DEFAULT NULL,
  `diaFimMorte` int(11) DEFAULT NULL,
  `mesFimMorte` int(11) DEFAULT NULL,
  `anoFimMorte` int(11) DEFAULT NULL,
  `addUserArMu` int(10) NOT NULL,
  PRIMARY KEY (`idArMu`),
  KEY `FK_idUserArtistaMu` (`addUserArMu`),
  KEY `FK_tipoArtista` (`tipoArMu`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `artistamu`
--

INSERT INTO `artistamu` (`idArMu`, `nomeArMu`, `tipoArMu`, `diaFormacNas`, `mesFormacNas`, `anoFormacNas`, `diaFimMorte`, `mesFimMorte`, `anoFimMorte`, `addUserArMu`) VALUES
(12, 'Arctic Monkeys', 2, NULL, NULL, 2002, NULL, NULL, NULL, 4),
(14, 'Carly Rae Jepsen', 1, 21, 11, 1985, NULL, NULL, NULL, 4),
(15, 'Bob Dylan', 1, 24, 5, 1941, NULL, NULL, NULL, 4),
(16, 'Queens of the Stone Age', 2, NULL, NULL, 1996, NULL, NULL, NULL, 4),
(17, 'Kyuss', 2, NULL, NULL, 1987, NULL, NULL, 1995, 4),
(19, 'black midi', 2, NULL, NULL, 2017, NULL, NULL, NULL, 4),
(20, 'David Bowie', 1, 8, 1, 1947, 10, 1, 2016, 4),
(23, 'Milton Nascimento', 1, 20, 6, 1942, NULL, NULL, NULL, 4),
(24, 'Interpol', 2, NULL, NULL, 1997, NULL, NULL, NULL, 4),
(25, 'Placebo', 2, NULL, NULL, 1994, NULL, NULL, NULL, 4),
(27, 'Rammstein', 2, NULL, 1, 1994, NULL, NULL, NULL, 4),
(28, 'System Of a Down', 2, NULL, NULL, 1992, NULL, NULL, NULL, 4),
(29, 'Nirvana', 2, NULL, NULL, 1987, 8, 4, 1994, 4),
(32, 'PJ Harvey', 1, 9, 10, 1969, NULL, NULL, NULL, 4),
(34, 'Mastodon', 2, NULL, 1, 2000, NULL, NULL, NULL, 4),
(35, 'Jimmy Eat World', 2, NULL, NULL, 1993, NULL, NULL, NULL, 4),
(36, 'The Strokes', 2, NULL, NULL, 1998, NULL, NULL, NULL, 4),
(37, 'Nine Inch Nails', 1, NULL, NULL, 1988, NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `artistavi`
--

DROP TABLE IF EXISTS `artistavi`;
CREATE TABLE IF NOT EXISTS `artistavi` (
  `idArVi` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArVi` varchar(255) NOT NULL,
  `diaNascArVi` int(11) DEFAULT NULL,
  `mesNascArVi` int(11) DEFAULT NULL,
  `anoNascArVi` int(11) DEFAULT NULL,
  `diaFalecArVi` int(11) DEFAULT NULL,
  `mesFalecArVi` int(11) DEFAULT NULL,
  `anoFalecArVi` int(11) DEFAULT NULL,
  `addUserArVi` int(10) DEFAULT NULL,
  PRIMARY KEY (`idArVi`),
  KEY `FK_idUserArtistaVi` (`addUserArVi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `artistavi`
--

INSERT INTO `artistavi` (`idArVi`, `nomeArVi`, `diaNascArVi`, `mesNascArVi`, `anoNascArVi`, `diaFalecArVi`, `mesFalecArVi`, `anoFalecArVi`, `addUserArVi`) VALUES
(2, 'Marcel Duchamp', 28, 7, 1887, 2, 10, 1968, 9),
(3, 'Romero Britto', 6, 10, 1963, NULL, NULL, NULL, 9),
(4, 'Gustavo Tondin Ramos', 30, 7, 2003, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecav`
--

DROP TABLE IF EXISTS `colecav`;
CREATE TABLE IF NOT EXISTS `colecav` (
  `idPecAv` int(11) NOT NULL AUTO_INCREMENT,
  `idObAvColec` int(11) NOT NULL,
  `idUserAdqAv` int(11) NOT NULL,
  `dataAdqObraAv` datetime DEFAULT NULL,
  PRIMARY KEY (`idPecAv`),
  KEY `FK_idObAv` (`idObAvColec`),
  KEY `FK_idUserColecAv` (`idUserAdqAv`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colecav`
--

INSERT INTO `colecav` (`idPecAv`, `idObAvColec`, `idUserAdqAv`, `dataAdqObraAv`) VALUES
(36, 16, 9, '2023-02-28 15:26:10'),
(37, 15, 4, '2023-02-28 15:26:28'),
(38, 14, 9, '2023-02-28 15:27:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecmu`
--

DROP TABLE IF EXISTS `colecmu`;
CREATE TABLE IF NOT EXISTS `colecmu` (
  `idPecMu` int(11) NOT NULL AUTO_INCREMENT,
  `idObMuColec` int(11) NOT NULL,
  `idUserAdq` int(11) NOT NULL,
  `dataAdqObraMu` datetime DEFAULT NULL,
  PRIMARY KEY (`idPecMu`),
  KEY `FK_idObMu` (`idObMuColec`),
  KEY `FK_idUser` (`idUserAdq`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colecmu`
--

INSERT INTO `colecmu` (`idPecMu`, `idObMuColec`, `idUserAdq`, `dataAdqObraMu`) VALUES
(6, 3, 6, '2023-02-16 08:18:31'),
(11, 3, 7, '2023-02-05 11:28:16'),
(18, 7, 8, '2023-02-15 09:29:32'),
(27, 7, 6, '2023-02-25 14:53:06'),
(31, 7, 4, '2023-02-28 00:15:09'),
(32, 11, 4, '2023-02-28 00:15:09'),
(33, 20, 4, '2023-02-28 02:00:28'),
(35, 21, 9, '2023-02-28 02:23:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecvi`
--

DROP TABLE IF EXISTS `colecvi`;
CREATE TABLE IF NOT EXISTS `colecvi` (
  `idPecVi` int(11) NOT NULL AUTO_INCREMENT,
  `idObVi` int(11) NOT NULL,
  `idUserAdqVi` int(11) NOT NULL,
  `dataAdqObraVi` datetime DEFAULT NULL,
  PRIMARY KEY (`idPecVi`),
  KEY `FK_idObViColec` (`idObVi`),
  KEY `FK_idUserAdqViColec` (`idUserAdqVi`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colecvi`
--

INSERT INTO `colecvi` (`idPecVi`, `idObVi`, `idUserAdqVi`, `dataAdqObraVi`) VALUES
(37, 19, 9, '2023-02-24 09:00:16'),
(38, 20, 8, '2023-02-24 09:00:27'),
(43, 19, 4, '2023-02-25 14:52:16'),
(44, 20, 4, '2023-02-25 14:52:16'),
(47, 21, 9, '2023-02-28 15:29:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretorav`
--

DROP TABLE IF EXISTS `diretorav`;
CREATE TABLE IF NOT EXISTS `diretorav` (
  `idDirAv` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDirAv` varchar(255) NOT NULL,
  `diaNascDirAv` int(11) DEFAULT NULL,
  `mesNascDirAv` int(11) DEFAULT NULL,
  `anoNascDirAv` int(11) DEFAULT NULL,
  `diaFalecDirAv` int(11) DEFAULT NULL,
  `mesFalecDirAv` int(11) DEFAULT NULL,
  `anoFalecDirAv` int(11) DEFAULT NULL,
  `addUserDirAv` int(10) NOT NULL,
  PRIMARY KEY (`idDirAv`),
  KEY `FK_idUserDirAv` (`addUserDirAv`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `diretorav`
--

INSERT INTO `diretorav` (`idDirAv`, `nomeDirAv`, `diaNascDirAv`, `mesNascDirAv`, `anoNascDirAv`, `diaFalecDirAv`, `mesFalecDirAv`, `anoFalecDirAv`, `addUserDirAv`) VALUES
(1, 'Ari Aster', 15, 7, 1986, NULL, NULL, NULL, 4),
(2, 'Stanley Kubrick', 26, 7, 1928, 7, 3, 2003, 4),
(3, 'Quentin Tarantino', 27, 3, 1963, NULL, NULL, NULL, 4),
(4, 'Martin Scorsese', 17, 11, 1942, NULL, NULL, NULL, 4),
(5, 'Wong Kar-Wai', 17, 7, 1958, NULL, NULL, NULL, 9),
(6, 'George Miller', 3, 3, 1945, NULL, NULL, NULL, 9),
(7, 'Anthony Russo', 3, 2, 1970, NULL, NULL, NULL, 8),
(8, 'Patty Jenkins', 24, 1, 1971, NULL, NULL, NULL, 9),
(9, 'David Benioff / D. B. Weiss', NULL, NULL, NULL, NULL, NULL, NULL, 9),
(10, 'Matt Reeves', 27, 4, 1966, NULL, NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `distribav`
--

DROP TABLE IF EXISTS `distribav`;
CREATE TABLE IF NOT EXISTS `distribav` (
  `idDistAv` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDistAv` varchar(255) NOT NULL,
  `addUserDistAv` int(11) NOT NULL,
  PRIMARY KEY (`idDistAv`),
  KEY `FK_idUserDistAv` (`addUserDistAv`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `distribav`
--

INSERT INTO `distribav` (`idDistAv`, `nomeDistAv`, `addUserDistAv`) VALUES
(1, 'A24', 4),
(2, 'DreamWorks Pictures SKG', 4),
(4, 'Walt Disney Studios Motion Pictures', 8),
(5, 'Paramount Pictures', 4),
(7, 'Columbia Pictures', 4),
(8, 'Warner Bros. Television Distribution', 4),
(9, 'Warner Bros. Pictures', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formatoav`
--

DROP TABLE IF EXISTS `formatoav`;
CREATE TABLE IF NOT EXISTS `formatoav` (
  `idFormatoAv` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFormatoAv` varchar(255) NOT NULL,
  PRIMARY KEY (`idFormatoAv`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formatoav`
--

INSERT INTO `formatoav` (`idFormatoAv`, `nomeFormatoAv`) VALUES
(1, 'DVD'),
(2, 'Blu-Ray'),
(3, 'Fita de vídeo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formatomu`
--

DROP TABLE IF EXISTS `formatomu`;
CREATE TABLE IF NOT EXISTS `formatomu` (
  `IDformatoMu` int(11) NOT NULL AUTO_INCREMENT,
  `NomeFormato` varchar(255) NOT NULL,
  PRIMARY KEY (`IDformatoMu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formatomu`
--

INSERT INTO `formatomu` (`IDformatoMu`, `NomeFormato`) VALUES
(1, 'Vinil'),
(2, 'Cassette'),
(3, 'CD'),
(4, 'Reel to Reel'),
(5, 'Fita 8-Track');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gravadoramu`
--

DROP TABLE IF EXISTS `gravadoramu`;
CREATE TABLE IF NOT EXISTS `gravadoramu` (
  `idGravMu` int(11) NOT NULL AUTO_INCREMENT,
  `nomeGravMu` varchar(50) NOT NULL,
  `addUserGravMu` int(10) NOT NULL,
  PRIMARY KEY (`idGravMu`),
  KEY `FK_idUserGravadoraMu` (`addUserGravMu`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gravadoramu`
--

INSERT INTO `gravadoramu` (`idGravMu`, `nomeGravMu`, `addUserGravMu`) VALUES
(1, 'Universal Music Group', 4),
(2, 'American Recordings', 4),
(3, 'Reprise Records', 4),
(4, 'Matador', 4),
(5, 'Columbia', 4),
(6, 'DGC', 4),
(7, 'Maverick', 4),
(8, 'Interscope Records', 4),
(9, 'Too Pure Records Ltd', 4),
(10, 'Dead Oceans', 4),
(11, 'Del Imaginario Discos', 4),
(12, 'Capitol Records', 4),
(13, 'BMG Brasil Ltda.', 4),
(14, 'Warner Music Group Central Europe', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obraav`
--

DROP TABLE IF EXISTS `obraav`;
CREATE TABLE IF NOT EXISTS `obraav` (
  `idObAv` int(11) NOT NULL AUTO_INCREMENT,
  `tituloObAv` varchar(255) NOT NULL,
  `codBarAv` varchar(255) NOT NULL,
  `idDirAv` int(11) NOT NULL,
  `idRotAv` int(11) NOT NULL,
  `idFormatoAv` int(11) NOT NULL,
  `idDistAv` int(11) NOT NULL,
  `diaLancAV` int(11) DEFAULT NULL,
  `mesLancAv` int(11) DEFAULT NULL,
  `anoLancAv` int(11) DEFAULT NULL,
  `imagemObAv` varchar(255) DEFAULT NULL,
  `addUserObAv` int(10) NOT NULL,
  `dataObraAv` date DEFAULT NULL,
  PRIMARY KEY (`idObAv`),
  KEY `FK_idDirAv` (`idDirAv`),
  KEY `FK_idRotAv` (`idRotAv`),
  KEY `FK_idFormatoAv` (`idFormatoAv`),
  KEY `FK_idDistAv` (`idDistAv`),
  KEY `FK_idUserObraAv` (`addUserObAv`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obraav`
--

INSERT INTO `obraav` (`idObAv`, `tituloObAv`, `codBarAv`, `idDirAv`, `idRotAv`, `idFormatoAv`, `idDistAv`, `diaLancAV`, `mesLancAv`, `anoLancAv`, `imagemObAv`, `addUserObAv`, `dataObraAv`) VALUES
(14, 'Django Livre', '7892770032670', 3, 9, 2, 7, 25, 12, 2012, 'obraAudiovisual_14.jpg', 4, '2023-02-28'),
(15, 'Game of Thrones - a Série Completa', '7898512988298', 9, 6, 2, 8, NULL, NULL, NULL, 'obraAudiovisual_15.jpg', 4, '2023-02-28'),
(16, 'Batman', '7899814216478', 10, 7, 2, 9, 3, 3, 2022, 'obraAudiovisual_16.jpg', 4, '2023-02-28'),
(17, 'Mulher-Maravilha 1984 ', '7898512989264', 8, 14, 2, 9, 16, 12, 2020, 'obraAudiovisual_17.png', 9, '2023-02-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obramu`
--

DROP TABLE IF EXISTS `obramu`;
CREATE TABLE IF NOT EXISTS `obramu` (
  `IDobm` int(11) NOT NULL AUTO_INCREMENT,
  `tituloObMu` varchar(255) NOT NULL,
  `idArMu` int(11) NOT NULL,
  `IDformatoMu` int(11) NOT NULL,
  `IDtipoMu` int(11) NOT NULL,
  `codBarMu` varchar(255) NOT NULL,
  `labelMu` int(11) NOT NULL,
  `diaLancObMu` int(11) DEFAULT NULL,
  `mesLancObMu` int(11) DEFAULT NULL,
  `anoLancObMu` int(11) DEFAULT NULL,
  `imagemObMu` varchar(255) DEFAULT NULL,
  `addUserObMu` int(10) NOT NULL,
  `dataObraMu` date DEFAULT NULL,
  PRIMARY KEY (`IDobm`),
  KEY `FK_idArMu` (`idArMu`),
  KEY `FK_IDformatoMu` (`IDformatoMu`),
  KEY `FK_IDtipoMu` (`IDtipoMu`),
  KEY `FK_labelmu` (`labelMu`),
  KEY `FK_idUserObraMu` (`addUserObMu`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obramu`
--

INSERT INTO `obramu` (`IDobm`, `tituloObMu`, `idArMu`, `IDformatoMu`, `IDtipoMu`, `codBarMu`, `labelMu`, `diaLancObMu`, `mesLancObMu`, `anoLancObMu`, `imagemObMu`, `addUserObMu`, `dataObraMu`) VALUES
(3, 'Mezmerize', 28, 3, 1, '2 519000', 2, NULL, NULL, 2005, 'obraMusica_3.jpg', 4, '2023-02-12'),
(7, 'Nevermind', 29, 3, 1, 'DGCD-24425', 6, NULL, NULL, 1997, 'obraMusica_7.jpg', 4, '2023-02-09'),
(11, 'In Utero', 29, 3, 1, '0602537539222', 1, NULL, NULL, 2013, 'obraMusica_11.jpg', 4, '2023-02-14'),
(19, 'Leviathan', 34, 3, 1, '3256981466794', 11, NULL, NULL, 2006, 'obraMusica_19.jpg', 4, '2023-02-28'),
(20, 'Clarity', 35, 1, 1, '00602547473646', 12, NULL, NULL, 2015, 'obraMusica_20.jpg', 4, '2023-02-22'),
(21, 'Room On Fire', 36, 3, 1, '82876572332', 13, NULL, NULL, 2003, 'obraMusica_21.jpg', 4, '2023-02-15'),
(22, 'ééééééé pega o pai', 24, 1, 1, 'éééééééééééééééééééé', 13, 12, 9, 1203, NULL, 9, '2023-04-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obravi`
--

DROP TABLE IF EXISTS `obravi`;
CREATE TABLE IF NOT EXISTS `obravi` (
  `idObVi` int(11) NOT NULL AUTO_INCREMENT,
  `tituloObVi` varchar(255) DEFAULT NULL,
  `idArVi` int(11) NOT NULL,
  `idTipoVi` int(11) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `imagemObVi` varchar(255) DEFAULT NULL,
  `addUserObVi` int(10) NOT NULL,
  `dataObraVi` date DEFAULT NULL,
  PRIMARY KEY (`idObVi`),
  KEY `FK_idArVi` (`idArVi`),
  KEY `FK_idTipoVi` (`idTipoVi`),
  KEY `FK_idUserObraVi` (`addUserObVi`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obravi`
--

INSERT INTO `obravi` (`idObVi`, `tituloObVi`, `idArVi`, `idTipoVi`, `ano`, `imagemObVi`, `addUserObVi`, `dataObraVi`) VALUES
(19, 'Mona Cat', 3, 1, 2004, 'obraVisual_19.jpg', 9, '2023-02-24'),
(20, 'Rauschenberg', 3, 1, 2007, 'obraVisual_20.jpg', 9, '2023-02-24'),
(21, 'Velho', 4, 1, 2023, 'obraVisual_21.jpg', 4, '2023-02-28'),
(22, 'Morte Lenta no Frio', 4, 1, 2023, 'obraVisual_22.jpg', 4, '2023-02-28'),
(23, 'Janta', 4, 1, 2023, 'obraVisual_23.jpg', 4, '2023-02-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roteiristaav`
--

DROP TABLE IF EXISTS `roteiristaav`;
CREATE TABLE IF NOT EXISTS `roteiristaav` (
  `idRotAv` int(11) NOT NULL AUTO_INCREMENT,
  `nomeRotAv` varchar(255) NOT NULL,
  `diaNascRotAv` int(11) DEFAULT NULL,
  `mesNascRotAv` int(11) DEFAULT NULL,
  `anoNascRotAv` int(11) DEFAULT NULL,
  `diaFalecRotAv` int(11) DEFAULT NULL,
  `mesFalecRotAv` int(11) DEFAULT NULL,
  `anoFalecRotAv` int(11) DEFAULT NULL,
  `addUserRotAv` int(11) NOT NULL,
  PRIMARY KEY (`idRotAv`),
  KEY `FK_idUserRoteiristaAv` (`addUserRotAv`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roteiristaav`
--

INSERT INTO `roteiristaav` (`idRotAv`, `nomeRotAv`, `diaNascRotAv`, `mesNascRotAv`, `anoNascRotAv`, `diaFalecRotAv`, `mesFalecRotAv`, `anoFalecRotAv`, `addUserRotAv`) VALUES
(1, 'Michael Arndt', 22, 11, 1970, NULL, NULL, NULL, 4),
(2, 'Glauber Rocha', 14, 3, 1939, 22, 8, 1981, 4),
(4, 'Stephen McFeely', 24, 2, 1970, NULL, NULL, NULL, 8),
(6, 'David Benioff / D. B. Weiss', NULL, NULL, NULL, NULL, NULL, NULL, 9),
(7, 'Matt Reeves', 27, 4, 1966, NULL, NULL, NULL, 8),
(8, 'Joseph Kosinski', 3, 5, 1974, NULL, NULL, NULL, 4),
(9, 'Quentin Tarantino', 27, 3, 1963, NULL, NULL, NULL, 4),
(14, 'Patty Jenkins', 23, 7, 1971, NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoartistamu`
--

DROP TABLE IF EXISTS `tipoartistamu`;
CREATE TABLE IF NOT EXISTS `tipoartistamu` (
  `idTipoArtistaMu` int(11) NOT NULL,
  `nomeTipoArtistaMu` varchar(15) NOT NULL,
  PRIMARY KEY (`idTipoArtistaMu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipoartistamu`
--

INSERT INTO `tipoartistamu` (`idTipoArtistaMu`, `nomeTipoArtistaMu`) VALUES
(1, 'Artista solo'),
(2, 'Grupo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoobramu`
--

DROP TABLE IF EXISTS `tipoobramu`;
CREATE TABLE IF NOT EXISTS `tipoobramu` (
  `IDtipoMu` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipoMu` varchar(20) NOT NULL,
  PRIMARY KEY (`IDtipoMu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipoobramu`
--

INSERT INTO `tipoobramu` (`IDtipoMu`, `nomeTipoMu`) VALUES
(1, 'LP'),
(2, 'Single'),
(3, 'EP'),
(4, 'Compilação'),
(5, 'Ao Vivo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoobravi`
--

DROP TABLE IF EXISTS `tipoobravi`;
CREATE TABLE IF NOT EXISTS `tipoobravi` (
  `idTipoVi` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipoVi` varchar(30) NOT NULL,
  PRIMARY KEY (`idTipoVi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipoobravi`
--

INSERT INTO `tipoobravi` (`idTipoVi`, `nomeTipoVi`) VALUES
(1, 'Pintura'),
(2, 'Gravura'),
(3, 'Desenho'),
(4, 'Escultura'),
(5, 'Cerâmica'),
(7, 'Colagem');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `displayname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`iduser`, `username`, `email`, `senha`, `displayname`) VALUES
(4, 'gabrielktt', 'gabriel4@gmail.com', '55bddb726c7edb55c837a735edacda53', 'Gabriel Kettermann'),
(5, 'yuri_lll', 'gabriel5@gmail.com', '0e3cac38986f6d7e3e486547318d187d', 'Yuri Ellwanger'),
(6, 'pedrocosta', 'usuario37@gmail.com', 'b93551ccc147c869ed95ec432ea7c7d1', 'Pedro Costa da Silva'),
(7, 'viniciusrr', 'gabriel18@gmail.com', 'da2bb4fa9025237647e23f90dbe98f14', 'Vinicius Rosário'),
(8, 'bernardo', 'gabriel19@gmail.com', '9b17cd71adc2fe49c8cea673fc75e1b4', 'Bernardo'),
(9, 'frankiero', 'frankiero@gmail.com', '52697677e3248a88bff0d815cb7243a4', 'Frank Iero'),
(10, 'charlesEmanuel', 'gabriel30@gmail.com', '8433cea8862c0155f267af14192debe3', NULL),
(11, 'lucassilveira', 'lucassilveira@gmail.com', 'f4507b035e811684e45bcabd930322db', 'Lucas Silveira'),
(15, 'gabreiel60', 'gabriel60@gmail.com', 'c5171d229292e39aa8c8cd2bacedde1e', 'Gabriel 60'),
(16, 'bisaio_sjrp', 'bisaio@gmail.com', 'c450aee839e419f333fc618ae2df03fe', 'Guilherme Bisaio'),
(17, 'andrio_fg', 'andriofelipegrasel@gmail.com', '5fc256fd62783284564cd94831a69222', 'Andrio Grasel'),
(18, 'rogerio_augusto', 'desgraçado@gmail.com', 'bfa7b2921c4bd9e6d8325e8840296d6d', 'Rogerio Augusto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vinculo`
--

DROP TABLE IF EXISTS `vinculo`;
CREATE TABLE IF NOT EXISTS `vinculo` (
  `idVinculo` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idUsuarioSeguido` int(11) NOT NULL,
  PRIMARY KEY (`idVinculo`),
  KEY `FK_idUsuario` (`idUsuario`),
  KEY `FK_idUsuarioSeguido` (`idUsuarioSeguido`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vinculo`
--

INSERT INTO `vinculo` (`idVinculo`, `idUsuario`, `idUsuarioSeguido`) VALUES
(26, 6, 4),
(39, 6, 9),
(45, 4, 5),
(46, 4, 9),
(47, 16, 9),
(48, 16, 4),
(50, 9, 16),
(52, 9, 17),
(55, 9, 4),
(56, 18, 15);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `artistamu`
--
ALTER TABLE `artistamu`
  ADD CONSTRAINT `FK_idUserArtistaMu` FOREIGN KEY (`addUserArMu`) REFERENCES `usuarios` (`iduser`),
  ADD CONSTRAINT `FK_tipoArtista` FOREIGN KEY (`tipoArMu`) REFERENCES `tipoartistamu` (`idTipoArtistaMu`);

--
-- Limitadores para a tabela `artistavi`
--
ALTER TABLE `artistavi`
  ADD CONSTRAINT `FK_idUserArtistaVi` FOREIGN KEY (`addUserArVi`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `colecav`
--
ALTER TABLE `colecav`
  ADD CONSTRAINT `FK_idObAv` FOREIGN KEY (`idObAvColec`) REFERENCES `obraav` (`idObAv`),
  ADD CONSTRAINT `FK_idUserColecAv` FOREIGN KEY (`idUserAdqAv`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `colecmu`
--
ALTER TABLE `colecmu`
  ADD CONSTRAINT `FK_idObMu` FOREIGN KEY (`idObMuColec`) REFERENCES `obramu` (`IDobm`),
  ADD CONSTRAINT `FK_idUser` FOREIGN KEY (`idUserAdq`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `colecvi`
--
ALTER TABLE `colecvi`
  ADD CONSTRAINT `FK_idObViColec` FOREIGN KEY (`idObVi`) REFERENCES `obravi` (`idObVi`),
  ADD CONSTRAINT `FK_idUserAdqViColec` FOREIGN KEY (`idUserAdqVi`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `diretorav`
--
ALTER TABLE `diretorav`
  ADD CONSTRAINT `FK_idUserDirAv` FOREIGN KEY (`addUserDirAv`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `distribav`
--
ALTER TABLE `distribav`
  ADD CONSTRAINT `FK_idUserDistAv` FOREIGN KEY (`addUserDistAv`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `gravadoramu`
--
ALTER TABLE `gravadoramu`
  ADD CONSTRAINT `FK_idUserGravadoraMu` FOREIGN KEY (`addUserGravMu`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `obraav`
--
ALTER TABLE `obraav`
  ADD CONSTRAINT `FK_idDirAv` FOREIGN KEY (`idDirAv`) REFERENCES `diretorav` (`idDirAv`),
  ADD CONSTRAINT `FK_idDistAv` FOREIGN KEY (`idDistAv`) REFERENCES `distribav` (`idDistAv`),
  ADD CONSTRAINT `FK_idFormatoAv` FOREIGN KEY (`idFormatoAv`) REFERENCES `formatoav` (`idFormatoAv`),
  ADD CONSTRAINT `FK_idRotAv` FOREIGN KEY (`idRotAv`) REFERENCES `roteiristaav` (`idRotAv`),
  ADD CONSTRAINT `FK_idUserObraAv` FOREIGN KEY (`addUserObAv`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `obramu`
--
ALTER TABLE `obramu`
  ADD CONSTRAINT `FK_IDformatoMu` FOREIGN KEY (`IDformatoMu`) REFERENCES `formatomu` (`IDformatoMu`),
  ADD CONSTRAINT `FK_IDtipoMu` FOREIGN KEY (`IDtipoMu`) REFERENCES `tipoobramu` (`IDtipoMu`),
  ADD CONSTRAINT `FK_idArMu` FOREIGN KEY (`idArMu`) REFERENCES `artistamu` (`idArMu`),
  ADD CONSTRAINT `FK_idUserObraMu` FOREIGN KEY (`addUserObMu`) REFERENCES `usuarios` (`iduser`),
  ADD CONSTRAINT `FK_labelmu` FOREIGN KEY (`labelMu`) REFERENCES `gravadoramu` (`idGravMu`);

--
-- Limitadores para a tabela `obravi`
--
ALTER TABLE `obravi`
  ADD CONSTRAINT `FK_idArVi` FOREIGN KEY (`idArVi`) REFERENCES `artistavi` (`idArVi`),
  ADD CONSTRAINT `FK_idTipoVi` FOREIGN KEY (`idTipoVi`) REFERENCES `tipoobravi` (`idTipoVi`),
  ADD CONSTRAINT `FK_idUserObraVi` FOREIGN KEY (`addUserObVi`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `roteiristaav`
--
ALTER TABLE `roteiristaav`
  ADD CONSTRAINT `FK_idUserRoteiristaAv` FOREIGN KEY (`addUserRotAv`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `vinculo`
--
ALTER TABLE `vinculo`
  ADD CONSTRAINT `FK_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`iduser`),
  ADD CONSTRAINT `FK_idUsuarioSeguido` FOREIGN KEY (`idUsuarioSeguido`) REFERENCES `usuarios` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
