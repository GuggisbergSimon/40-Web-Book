-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 04 Janvier 2021 à 14:14
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `book`
--
CREATE DATABASE IF NOT EXISTS `book` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `book`;

-- --------------------------------------------------------

--
-- Structure de la table `t_author`
--

CREATE TABLE `t_author` (
  `idAuthor` int(11) NOT NULL,
  `autName` varchar(50) NOT NULL,
  `autSurname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_book`
--

CREATE TABLE `t_book` (
  `idBook` int(11) NOT NULL,
  `booTitle` varchar(200) NOT NULL,
  `booNbrPages` int(11) NOT NULL,
  `booExcerptLink` varchar(50) NOT NULL,
  `booSummary` varchar(200) NOT NULL,
  `booYearEdited` int(11) NOT NULL,
  `booAverageNotes` float NOT NULL,
  `booCoverLink` varchar(50) NOT NULL,
  `idAuthor` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idEditor` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Manga'),
(2, 'Livre'),
(3, 'BD'),
(4, 'Comic');

-- --------------------------------------------------------

--
-- Structure de la table `t_editor`
--

CREATE TABLE `t_editor` (
  `idEditor` int(11) NOT NULL,
  `ediName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_evaluate`
--

CREATE TABLE `t_evaluate` (
  `idBook` int(11) NOT NULL,
  `idUserEvaluer` int(11) NOT NULL,
  `evaNote` float NOT NULL,
  `evaRemark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `usePseudo` varchar(50) NOT NULL,
  `usePassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `usePseudo`, `usePassword`) VALUES
(1, 'paul', '$2y$10$UqpPCefjmclTg7X7VCr/Ke/n3o58d9VJM50DWqtrIXp8XJD3R4/8G');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_author`
--
ALTER TABLE `t_author`
  ADD PRIMARY KEY (`idAuthor`),
  ADD UNIQUE KEY `ID_t_author_IND` (`idAuthor`);

--
-- Index pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`idBook`),
  ADD UNIQUE KEY `ID_t_book_IND` (`idBook`),
  ADD KEY `FKt_write_IND` (`idAuthor`),
  ADD KEY `FKt_post_IND` (`idUser`),
  ADD KEY `FKt_edit_IND` (`idEditor`),
  ADD KEY `FKt_belong_IND` (`idCategory`);

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`),
  ADD UNIQUE KEY `ID_t_category_IND` (`idCategory`);

--
-- Index pour la table `t_editor`
--
ALTER TABLE `t_editor`
  ADD PRIMARY KEY (`idEditor`),
  ADD UNIQUE KEY `ID_t_editor_IND` (`idEditor`);

--
-- Index pour la table `t_evaluate`
--
ALTER TABLE `t_evaluate`
  ADD PRIMARY KEY (`idUserEvaluer`,`idBook`),
  ADD UNIQUE KEY `ID_t_evaluate_IND` (`idUserEvaluer`,`idBook`),
  ADD KEY `FKt_e_t_b_IND` (`idBook`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `ID_t_user_IND` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_author`
--
ALTER TABLE `t_author`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `idEditor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD CONSTRAINT `FKt_belong_FK` FOREIGN KEY (`idCategory`) REFERENCES `t_category` (`idCategory`),
  ADD CONSTRAINT `FKt_edit_FK` FOREIGN KEY (`idEditor`) REFERENCES `t_editor` (`idEditor`),
  ADD CONSTRAINT `FKt_post_FK` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`),
  ADD CONSTRAINT `FKt_write_FK` FOREIGN KEY (`idAuthor`) REFERENCES `t_author` (`idAuthor`);

--
-- Contraintes pour la table `t_evaluate`
--
ALTER TABLE `t_evaluate`
  ADD CONSTRAINT `FKt_e_t_b_FK` FOREIGN KEY (`idBook`) REFERENCES `t_book` (`idBook`),
  ADD CONSTRAINT `FKt_e_t_u` FOREIGN KEY (`idUserEvaluer`) REFERENCES `t_user` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
