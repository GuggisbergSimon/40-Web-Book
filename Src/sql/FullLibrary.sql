-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2021 at 09:02 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--
CREATE DATABASE IF NOT EXISTS `book` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `book`;

-- --------------------------------------------------------

--
-- Table structure for table `t_author`
--

CREATE TABLE `t_author` (
  `idAuthor` int(11) NOT NULL,
  `autName` varchar(50) NOT NULL,
  `autSurname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_author`
--

INSERT INTO `t_author` (`idAuthor`, `autName`, `autSurname`) VALUES
(1, 'Frank', 'Hatem'),
(2, 'Marc', 'Troyanov'),
(3, 'Raymond', 'Queneau'),
(4, 'Georges', 'Perec'),
(5, 'Milan', 'Kundera'),
(6, 'William', 'Burroughs'),
(7, 'Alain', 'Damasio'),
(8, 'Anne', 'Onyme'),
(9, 'Nick', 'Land'),
(10, 'Tsukimizu', 'Tkmiz'),
(11, 'Haruko', 'Ichikawa'),
(12, 'François', 'Schuiten'),
(13, 'Juanjo', 'Guarnido');

-- --------------------------------------------------------

--
-- Table structure for table `t_book`
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

--
-- Dumping data for table `t_book`
--

INSERT INTO `t_book` (`idBook`, `booTitle`, `booNbrPages`, `booExcerptLink`, `booSummary`, `booYearEdited`, `booAverageNotes`, `booCoverLink`, `idAuthor`, `idUser`, `idEditor`, `idCategory`) VALUES
(1, 'Les Cinq Clefs : La Résistance "humani-terre" face aux reptiliens et au nouvel ordre mondialiste', 372, '20210103193815Doc', 'Ce livre donne des outils positifs et simples pour contrer subtilement l’écrasant pouvoir de ceux qui gouvernent notre planète.', 2002, -1, '2021010319381581j', 1, 1, 1, 2),
(2, 'Cours de géométrie', 374, '20210103194212Doc', 'Ce cours d\'introduction à la géométrie propose une vision et une pensée solides ainsi qu\'une initiation aux applications de la géométrie.', 2009, -1, '20210103194212Cou', 2, 1, 2, 2),
(3, 'Exercices de style', 158, '20210103194701Doc', 'Le narrateur rencontre, dans un autobus, un jeune homme au long cou, coiffé d\'un chapeau orné d\'une tresse au lieu de ruban.', 2006, -1, '20210103194701raq', 3, 1, 3, 2),
(4, 'La disparition', 328, '20210103195348Doc', 'Trahir qui disparut, dans La disparition, ravirait au lisant subtil tout plaisir.', 1989, -1, '20210103195348La-', 4, 1, 3, 2),
(5, 'L\'insoutenable légèreté de l\'être', 393, '20210103195732Doc', 'Qu\'est-il resté des agonisants du Cambodge ? Une grande photo de la star américaine tenant dans ses bras un enfant jaune.', 2020, -1, '20210103195732L-i', 5, 1, 3, 2),
(6, 'Le festin nu', 334, '20210103200008Doc', 'Le Festin nu est un tel fatras de notes éparpillées qu\'aucun éditeur n\'accepte de le publier, d\'autant que le contenu est d\'une obscénité rare et qu\'il heurte à peu près tous les principes.', 2002, -1, '20210103200008CVT', 6, 1, 3, 2),
(7, 'La horde du contrevent', 700, '20210103200428Doc', 'Alain Damasio a écrit un livre-univers, original aussi bien dans sa forme que dans son contenu. Une horde composée de vingt-trois membres, partis depuis longtemps pour l’Extrême-Amont.', 2015, -1, '20210103200428dam', 7, 1, 3, 2),
(8, 'L\'héritage du totalitarisme dans une toundra', 357, '20210103203111bla', 'Ecrit par plus de 3500 personnes, il s\'agit du premier roman de la partie litéraire de 4chan, couvrant un large spectrum de problèmes socio-politiques ou de pop culture et internet.', 2015, -1, '20210103203111142', 8, 2, 4, 2),
(9, 'Fanged Noumena', 560, '20210103203710bla', 'Un voyage dans l\'esprit de Nick Land à travers une collection d\'écrits de 1987 jusqu\'à 2007.', 2011, -1, '2021010320371051P', 9, 2, 5, 2),
(10, 'Girls\' Last Tour', 100, '20210103204405bla', 'Deux jeunes filles errent dans les décombres d\'une civilisation, tirant des leçon de vie de la moindre chose.', 2014, -1, '2021010320440561G', 10, 2, 6, 1),
(11, 'L\'ère des cristaux', 110, '20210103204622bla', 'Phos est une gemme parmi tant d\'autres mais ne parvient pas à trouver sa place dans la communauté tandis que les lunariens attaquent sans relâche ses connaissances.', 2012, -1, '20210103204622Hou', 11, 2, 7, 1),
(12, 'Les murailles de Samaris', 50, '20210103205032bla', 'Le jeune Franz Bauer, habitant de la ville de Xhystos, est envoyé en mission dans la très lointaine cité de Samaris pour une durée de plusieurs mois.', 1984, -1, '20210103205032vig', 12, 2, 8, 3),
(13, 'Blacksad l\'intégrale', 150, '20210103205433bla', 'Prennant place dans une atmosphère de film noir, dans les 1950 aux Etats-Unis. Tous les personnages sont des animaux anthropomorphes dont l’espèce reflète le caractère ainsi que leur rôle.', 2013, -1, '2021010320543381N', 13, 2, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Manga'),
(2, 'Livre'),
(3, 'BD'),
(4, 'Comic');

-- --------------------------------------------------------

--
-- Table structure for table `t_editor`
--

CREATE TABLE `t_editor` (
  `idEditor` int(11) NOT NULL,
  `ediName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_editor`
--

INSERT INTO `t_editor` (`idEditor`, `ediName`) VALUES
(1, 'Louise Courteau'),
(2, 'Presses Polytechniques Romandes'),
(3, 'Gallimard'),
(4, 'Anonyme'),
(5, 'Urbanomic'),
(6, 'Shinchosha'),
(7, 'Kodansha'),
(8, 'Casterman'),
(9, 'Dargaud');

-- --------------------------------------------------------

--
-- Table structure for table `t_evaluate`
--

CREATE TABLE `t_evaluate` (
  `idBook` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `evaNote` float NOT NULL,
  `evaRemark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `usePseudo` varchar(50) NOT NULL,
  `usePassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`idUser`, `usePseudo`, `usePassword`) VALUES
(1, 'paul', '$2y$10$UqpPCefjmclTg7X7VCr/Ke/n3o58d9VJM50DWqtrIXp8XJD3R4/8G'),
(2, 'root', '$2y$10$C5nmYpsmVueGqf7FHM/Pxu1KHVDhi.bLsbuTIq8kuPxVw5U.q7o9u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_author`
--
ALTER TABLE `t_author`
  ADD PRIMARY KEY (`idAuthor`),
  ADD UNIQUE KEY `ID_t_author_IND` (`idAuthor`);

--
-- Indexes for table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`idBook`),
  ADD UNIQUE KEY `ID_t_book_IND` (`idBook`),
  ADD KEY `FKt_write_IND` (`idAuthor`),
  ADD KEY `FKt_post_IND` (`idUser`),
  ADD KEY `FKt_edit_IND` (`idEditor`),
  ADD KEY `FKt_belong_IND` (`idCategory`);

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`),
  ADD UNIQUE KEY `ID_t_category_IND` (`idCategory`);

--
-- Indexes for table `t_editor`
--
ALTER TABLE `t_editor`
  ADD PRIMARY KEY (`idEditor`),
  ADD UNIQUE KEY `ID_t_editor_IND` (`idEditor`);

--
-- Indexes for table `t_evaluate`
--
ALTER TABLE `t_evaluate`
  ADD PRIMARY KEY (`idUser`,`idBook`),
  ADD UNIQUE KEY `ID_t_evaluate_IND` (`idUser`,`idBook`),
  ADD KEY `FKt_e_t_b_IND` (`idBook`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `ID_t_user_IND` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_author`
--
ALTER TABLE `t_author`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `idEditor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_book`
--
ALTER TABLE `t_book`
  ADD CONSTRAINT `FKt_belong_FK` FOREIGN KEY (`idCategory`) REFERENCES `t_category` (`idCategory`),
  ADD CONSTRAINT `FKt_edit_FK` FOREIGN KEY (`idEditor`) REFERENCES `t_editor` (`idEditor`),
  ADD CONSTRAINT `FKt_post_FK` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`),
  ADD CONSTRAINT `FKt_write_FK` FOREIGN KEY (`idAuthor`) REFERENCES `t_author` (`idAuthor`);

--
-- Constraints for table `t_evaluate`
--
ALTER TABLE `t_evaluate`
  ADD CONSTRAINT `FKt_e_t_b_FK` FOREIGN KEY (`idBook`) REFERENCES `t_book` (`idBook`),
  ADD CONSTRAINT `FKt_e_t_u` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
