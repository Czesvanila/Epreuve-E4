-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mgvpcdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idCli` int(11) NOT NULL,
  `nomCli` varchar(50) NOT NULL,
  `prenomCli` varchar(50) NOT NULL,
  `rueCli` varchar(50) NOT NULL,
  `cpCli` char(5) NOT NULL,
  `villeCli` varchar(50) NOT NULL,
  `numDepart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idCli`, `nomCli`, `prenomCli`, `rueCli`, `cpCli`, `villeCli`, `numDepart`) VALUES
(1, 'DUSSART', 'Jean', '5 rue Saint-Gilles', '91150', 'Etampes', 11),
(2, 'HURTAUX', 'Jeanne', '26 avenue Bollée', '72100', 'LE MANS', 11),
(3, 'PRAT', 'Marie', '3 rue Gilbert', '36000', 'Châteauroux', 55),
(4, 'GARNIER', 'Thierry', '5 rue du stade', '40200', 'Mimizan', 75),
(5, 'HAMON', 'Alban', '12 impasse Malconte', '47000', 'Agen', 27),
(6, 'ALBERT', 'Michel', '5 rue du 8 mai', '31000', 'Toulouse', 76),
(7, 'POUX', 'Jean-Paul', '156 avenue de Belgique', '80000', 'Amiens', 28),
(8, 'PELOU', 'Gérard', '1 impasse Jean Giono', '80100', 'Abbeville', 76),
(9, 'LE PENNEC', 'Gisèle', '96 route de Lorient', '35000', 'Rennes', 84),
(10, 'POUYOT', 'Mickaël', '8 rue des marais', '28000', 'Chartres', 55);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `numCde` int(11) NOT NULL,
  `dateCde` date NOT NULL,
  `etatCde` varchar(50) NOT NULL,
  `idCliCde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`numCde`, `dateCde`, `etatCde`, `idCliCde`) VALUES
(2, '2015-08-10', 'livrée', 4),
(3, '2015-09-05', 'livrée', 5),
(5, '2015-10-20', 'livrée', 6),
(6, '2015-11-07', 'livrée', 7),
(7, '2015-12-15', 'livrée', 5),
(8, '2015-12-18', 'livrée', 3),
(9, '2016-02-01', 'livrée', 10),
(10, '2016-05-07', 'livrée', 8),
(11, '2016-05-05', 'livrée', 9),
(12, '2016-05-06', 'livrée', 7),
(13, '2016-08-01', 'livrée', 10),
(14, '2016-09-05', 'livrée', 3),
(15, '2016-09-06', 'livrée', 9),
(17, '2016-09-08', 'livrée', 1),
(19, '2016-09-08', 'livrée', 10),
(20, '2016-09-08', 'livrée', 4),
(21, '2016-09-08', 'livrée', 1),
(22, '2016-09-12', 'en préparation', 3),
(23, '2016-09-12', 'en préparation', 1),
(24, '2016-09-12', 'en préparation', 3),
(25, '2016-09-18', 'en préparation', 3),
(26, '2016-09-19', 'en attente', 10),
(27, '2016-09-19', 'en attente', 9),
(28, '2016-09-19', 'en attente', 10),
(29, '2016-09-19', 'en attente', 5),
(30, '2016-09-19', 'en préparation', 5),
(31, '2016-09-19', 'en attente', 5),
(32, '2016-09-19', 'en préparation', 6);

-- --------------------------------------------------------

--
-- Structure de la table `comporter`
--

CREATE TABLE `comporter` (
  `numCde` int(11) NOT NULL,
  `idProd` varchar(8) NOT NULL,
  `qte` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comporter`
--

INSERT INTO `comporter` (`numCde`, `idProd`, `qte`) VALUES
(2, 'CHA-0001', 1),
(3, 'TAB-0001', 1),
(5, 'TBT-0001', 2),
(6, 'TBT-0002', 8),
(7, 'CHA-0002', 2),
(8, 'CHA-0001', 4),
(8, 'TBT-0002', 2),
(9, 'TBT-0001', 2),
(10, 'TAB-0002', 1),
(11, 'TAB-0002', 1),
(11, 'TBT-0001', 8),
(12, 'CHA-0001', 2),
(13, 'CHA-0002', 2),
(14, 'CHA-0001', 2),
(14, 'CHA-0002', 2),
(15, 'TAB-0002', 1),
(17, 'CHA-0002', 1),
(19, 'CHA-0001', 3),
(20, 'TAB-0001', 4),
(21, 'TAB-0001', 10),
(22, 'CHA-0002', 2),
(22, 'TAB-0002', 1),
(22, 'TBT-0001', 1),
(22, 'TBT-0002', 6),
(23, 'TBT-0001', 1),
(24, 'CHA-0001', 4),
(24, 'TAB-0001', 2),
(24, 'TBT-0002', 3),
(25, 'CHA-0001', 1),
(25, 'TAB-0002', 1),
(26, 'CHA-0001', 6),
(26, 'TAB-0002', 1),
(27, 'CHA-0001', 6),
(27, 'TAB-0002', 1),
(28, 'CHA-0001', 2),
(28, 'TBT-0001', 12),
(29, 'CHA-0001', 1),
(29, 'TAB-0002', 1),
(30, 'CHA-0001', 1),
(30, 'TAB-0002', 1),
(31, 'CHA-0001', 1),
(31, 'TAB-0002', 1),
(32, 'TAB-0001', 1),
(32, 'TBT-0002', 8);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `numDepart` int(11) NOT NULL,
  `libDepart` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`numDepart`, `libDepart`) VALUES
(11, 'Essonne'),
(27, 'Yonne'),
(28, 'Calvados'),
(55, 'Hautes-Alpes'),
(75, 'Creuse'),
(76, 'Aude'),
(84, 'Drôme');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProd` varchar(8) NOT NULL,
  `libProd` varchar(50) NOT NULL,
  `descProd` varchar(200) NOT NULL,
  `prixProd` decimal(8,2) NOT NULL,
  `imageProd` varchar(200) NOT NULL,
  `numTypeProd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idProd`, `libProd`, `descProd`, `prixProd`, `imageProd`, `numTypeProd`) VALUES
('CHA-0001', 'Chaise chene dossier haut', 'une chaise adaptée à tous les gabarits', '64.90', 'http://51.75.25.80/~rifflart/mgvpc/images/chaiseCheneH.jpg', 2),
('CHA-0002', 'Chaise chene dossier bas', 'une chaise adaptée à tous les gabarits', '54.90', 'http://51.75.25.80/~rifflart/mgvpc/images/chaiseCheneB.jpg', 2),
('TAB-0001', 'Table en bois', 'Une table bien robuste', '324.90', 'http://51.75.25.80/~rifflart/mgvpc/images/table.jpg', 1),
('TAB-0002', 'Table en fer forgé', 'Une table pleine de charme', '189.90', 'http://51.75.25.80/~rifflart/mgvpc/images/tableFer.jpg', 1),
('TBT-0001', 'Tabouret métal', 'Un coût raisonnable pour tous', '39.90', 'https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.hpBBuJt9S0DE9rRfldKS7AHaHa%26pid%3DApi&f=1', 3),
('TBT-0002', 'Tabouret bois', 'Le tabouret classique et indémodable', '34.90', 'http://51.75.25.80/~rifflart/mgvpc/images/tabouret.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `typeProd`
--

CREATE TABLE `typeProd` (
  `numTypeProd` int(11) NOT NULL,
  `libType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeProd`
--

INSERT INTO `typeProd` (`numTypeProd`, `libType`) VALUES
(1, 'Table'),
(2, 'Chaise'),
(3, 'Tabouret');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idCli`),
  ADD KEY `numDepart` (`numDepart`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numCde`),
  ADD KEY `FK__client` (`idCliCde`);

--
-- Index pour la table `comporter`
--
ALTER TABLE `comporter`
  ADD PRIMARY KEY (`numCde`,`idProd`),
  ADD KEY `idProd` (`idProd`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`numDepart`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProd`),
  ADD KEY `numTypeProd` (`numTypeProd`);

--
-- Index pour la table `typeProd`
--
ALTER TABLE `typeProd`
  ADD PRIMARY KEY (`numTypeProd`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `numCde` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`numDepart`) REFERENCES `departement` (`numDepart`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK__client` FOREIGN KEY (`idCliCde`) REFERENCES `client` (`idCli`);

--
-- Contraintes pour la table `comporter`
--
ALTER TABLE `comporter`
  ADD CONSTRAINT `comporter_ibfk_1` FOREIGN KEY (`numCde`) REFERENCES `commande` (`numCde`),
  ADD CONSTRAINT `comporter_ibfk_2` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`numTypeProd`) REFERENCES `typeProd` (`numTypeProd`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
