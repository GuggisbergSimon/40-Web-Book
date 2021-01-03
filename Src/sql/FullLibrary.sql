-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2021 at 06:58 PM
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
(1, 'Fushimi', 'Tsukasa');

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
(1, 'Ore no Imouto ga Konna ni Kawaii Wake ga Nai', 271, '20210103184952bla', 'The series follows the life of a high school boy named Kyousuke Kousaka who has troubles getting along with his younger sister Kirino. One day, Kyousuke discovers that Kirino is an otaku in secret.', 2008, 5, '20210103184952Ore', 1, 2, 1, 2);

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
(1, 'ASCII Media Works');

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

--
-- Dumping data for table `t_evaluate`
--

INSERT INTO `t_evaluate` (`idBook`, `idUser`, `evaNote`, `evaRemark`) VALUES
(1, 2, 5, 'Une merde bien dorée');

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
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `idEditor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
