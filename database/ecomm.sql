-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2018 at 03:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `codeArt` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
    `codecateg` varchar(20) NOT NULL,
  `libcateg` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL,
   PRIMARY KEY (`codecateg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `category`
--

INSERT INTO `category` (`codecateg`,`libcateg`, `cat_slug`) VALUES
('CAT001', 'VETEMENT','vetement'),
('CAT002', 'BOISSON','boisson'),
('CAT003', 'ALIMENT','aliment'),
('CAT004', 'USTENSIL','ustensil');
-- --------------------------------------------------------

--
-- Table structure for table `famille`
--

DROP TABLE IF EXISTS `famille`;

CREATE TABLE IF NOT EXISTS `famille` (
  `codeFamille` varchar(20) NOT NULL,
  `libelFamille` varchar(60) NOT NULL,
  `codeCat` varchar(20) NOT NULL,
  PRIMARY KEY (`codeFamille`),
  KEY `Cate_FK` (`codeCat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `famille`
--

INSERT INTO `famille` (`codeFamille`, `libelFamille`, `codeCat`) VALUES
('FAM01', 'HOMME', 'CAT001'),
('FAM02', 'FEMME', 'CAT001'),
('FAM03', 'ENFANT', 'CAT001'),
('FAM04', 'RIZ', 'CAT003'),
('FAM05', 'APERITIF', 'CAT002'),
('FAM06', 'Vin', 'CAT002');

-- --------------------------------------------------------

--
-- Table structure for table `sous_famille`
--

DROP TABLE IF EXISTS `sous_famille`;
CREATE TABLE IF NOT EXISTS `sous_famille` (
  `codeSousFamille` varchar(20) NOT NULL,
  `libelSousFamille` varchar(60) NOT NULL,
  `codeFamille` varchar(20) NOT NULL,
  PRIMARY KEY (`codeSousFamille`),
  KEY `CodeFam_FK` (`codeFamille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sous_famille`
--

INSERT INTO `sous_famille` (`codeSousFamille`, `libelSousFamille`, `codeFamille`) VALUES
('SF001', 'CHEMISE', 'FAM01'),
('SF002', 'PANTALON', 'FAM01'),
('SF003', 'CHAUSSURES', 'FAM01'),
('SF004', 'MONTRE', 'FAM01'),
('SF005', 'Haut', 'FAM02'),
('SF006', 'MONTRE', 'FAM02'),
('SF007', 'JUPE', 'FAM02');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `codeArt` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `codeArt`, `quantity`) VALUES
(14, 9,'ART0001', 2),
(15, 9,'ART0001', 5),
(16, 9,'ART0006', 2),
(17, 9,'ART0004', 3),
(18, 10,'ART0002', 3),
(19, 10,'ART0003', 4),
(20, 10,'ART0002', 5);
-- ------------------------------------------------------
-- 
-- Table structure for table `article`
--
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `codeArt` varchar(20) NOT NULL,
  `codeSousFamille` varchar(20) NOT NULL,
  `libelArt` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `qtestock` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  PRIMARY KEY (`codeArt`),
  KEY `codeSF_FK` (`codeSousFamille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Dumping data for table `articles`
--

INSERT INTO  `article`(`codeArt`,`codeSousFamille`, `libelArt`, `description`, `slug`, `price`, `qtestock`,`photo`,`date_view`) VALUES
('ART0001','SF001', 'LACOSTE', '<Lacoste,créateur du premier polo en 1993,s\'est imposé comme l\'unique marque de luxe CASUAL WEAR combinant élégance à la française et liberté.</p>\r\n', 'lacoste', 80.00, 8,'lacoste-polo-homme.jpg', '2020-03-09'),
('ART0002','SF001', 'LACOSTE', '<Polo de HOMBRE marca LACOSTE modelo PH5142 de algodo estilo CASUAL.</p>\r\n', 'lacoste', 99.00, 2, 'polo-lacoste.jpg', '2020-03-09'),
('ART0003','SF001', 'DEBADEUR', '<p>- Debardeur blanc 100% coton.&nbsp;<br />\r\n<br/>\r\n-Marque:Eminence&nbsp;<br />\r\n<br />\r\n-La coupe, T-shirt sans manche vendu à l\'unité&nbsp;<br />\r\n<br />\r\n- Col rond,le look&nbsp;<br />\r\n<br/>\r\n-Couleur:Blanc; Motifs:Uni.</p>\r\n', 'debadeur', 15.90, 10,'debardeur-blanc.jpg', '2020-05-10'),
('ART0004','SF005','LACOSTE GROUPON','<p>Marque: Groupon Goods Global GmbH</p>\r\n\r\n<p>Polo de marque Lacoste.</p>\r\n\r\n<p>Modèle:L1212,Bords côtelés au col et aux manches,Coupe classique.</p>\r\n\r\n<p>Matière:100% coton.</p>\r\n\r\n<p>>', 'lacoste-groupon',7.89, 20,'lacoste-groupon.jpg', '2020-04-09'),
('ART0005','SF005','DEBADEUR FINE BRETELLE', '<p>Acheter  votre Débardeur à 3 SUISSES.Selection de Débardeur faites pour vous.</p>\r\n', 'debardeur-fine-bretelle', 7.99, 9,'debardeur-fine-bretelle.jpg', '2020-04-2020'),
('ART0006','SF005','BLAZER FEMME TOPS', '<p>Cet article est de type asiatique.Assortie et posée pour vos réunions professiobbelles.</p>\r\n\r\n<p>Taille:xl</p>\r\n', 'blazer-femme-tops', 13.96, 15, 'blazer-femme-tops.jpg', '2020-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$0SHFfoWzz8WZpdu9Qw//E.tWamILbiNCX7bqhy3od0gvK5.kSJ8N2', 1, 'Code', 'Projects', '', '', 'thanos1.jpg', 1, '', '', '2018-05-01'),
(9, 'harry@den.com', '$2y$10$Oongyx.Rv0Y/vbHGOxywl.qf18bXFiZOcEaI4ZpRRLzFNGKAhObSC', 0, 'Harry', 'Den', 'Silay City, Negros Occidental', '09092735719', 'male2.png', 1, 'k8FBpynQfqsv', 'wzPGkX5IODlTYHg', '2018-05-09'),
(12, 'christine@gmail.com', '$2y$10$ozW4c8r313YiBsf7HD7m6egZwpvoE983IHfZsPRxrO1hWXfPRpxHO', 0, 'Christine', 'becker', 'demo', '7542214500', 'female3.jpg', 1, '', '', '2018-07-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `codeSF_FK` FOREIGN KEY (`codeSousFamille`) REFERENCES `sous_famille` (`codeSousFamille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `famille`
--
ALTER TABLE `famille`
  ADD CONSTRAINT `Cate_FK` FOREIGN KEY (`codeCat`) REFERENCES `category` (`codecateg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sous_famille`
--
ALTER TABLE `sous_famille`
  ADD CONSTRAINT `CodeFam_FK` FOREIGN KEY (`codeFamille`) REFERENCES `famille` (`codeFamille`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


