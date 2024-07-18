-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 07 mai 2024 à 12:16
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `foot`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `IdCategorie` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix` int DEFAULT NULL,
  PRIMARY KEY (`IdCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IdCategorie`, `nom`, `prix`) VALUES
(1, 'Centre Est', 80),
(2, 'Centre Nord', 78),
(3, 'Centre Ouest', 72),
(4, 'Centre Sud', 75),
(5, 'Est', 115),
(6, 'Nord', 105),
(7, 'Sud', 92),
(8, 'Ouest', 80),
(9, 'Premium', 300),
(10, 'Junior', 50),
(11, 'A', 250),
(12, 'Boss', 500);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `IdStade` int NOT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `link_evenement_lieu` (`IdStade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `nom`, `date`, `description`, `IdStade`) VALUES
(1, 'France vs Espagne', '2024-05-10 15:29:37', 'Match', 1),
(2, 'Italie vs Chine', '2024-06-12 10:31:04', 'Match', 2),
(3, 'Japon vs Inde', '2024-06-14 20:32:53', 'Match', 1),
(4, 'Suisse VS Ethiopie', '2024-05-05 21:00:31', 'Match', 3);

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `IdStade` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) NOT NULL,
  PRIMARY KEY (`IdStade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`IdStade`, `nom`, `adresse`, `ville`) VALUES
(1, 'Al Buth Stadium', 'Albayt street 393', 'Al Khar'),
(2, 'Khalifa', 'Al waab street ', 'Doha'),
(3, 'Thumama stadium', 'Al hazi street', 'Doha');

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `numPlace` int NOT NULL,
  `nbPlace` int NOT NULL,
  `IdCategorie` int NOT NULL,
  PRIMARY KEY (`numPlace`),
  KEY `link_place_catégorie` (`IdCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `place`
--

INSERT INTO `place` (`numPlace`, `nbPlace`, `IdCategorie`) VALUES
(1, 453, 11),
(2, 23, 1),
(3, 235, 2),
(4, 78, 3),
(5, 123, 4),
(6, 7896, 5),
(7, 365, 10),
(8, 124, 6),
(9, 653, 8),
(10, 87, 9),
(11, 648, 7);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `idUtilisateur` int NOT NULL,
  `IdCategorie` int NOT NULL,
  `idEvenement` int NOT NULL,
  `date_reservation` datetime NOT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL,
  `total_paye` int NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`IdCategorie`,`idEvenement`),
  KEY `link_reservation_evenement` (`idEvenement`),
  KEY `link_reservation_categorie` (`IdCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `support_client`
--

DROP TABLE IF EXISTS `support_client`;
CREATE TABLE IF NOT EXISTS `support_client` (
  `IdSupport` int NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `descripption` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_creation` datetime NOT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`IdSupport`),
  KEY `link_support_utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pwd` varchar(25) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `telephone`, `email`, `pwd`) VALUES
(1, 'GAVI', 'Holali David', '0763152591', 'davsholali@gmail.com', '0000');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `link_evenement_lieu` FOREIGN KEY (`IdStade`) REFERENCES `lieu` (`IdStade`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `link_place_catégorie` FOREIGN KEY (`IdCategorie`) REFERENCES `categorie` (`IdCategorie`) ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `link_reservation_categorie` FOREIGN KEY (`IdCategorie`) REFERENCES `categorie` (`IdCategorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `link_reservation_evenement` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`) ON UPDATE CASCADE,
  ADD CONSTRAINT `link_reservation_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `support_client`
--
ALTER TABLE `support_client`
  ADD CONSTRAINT `link_support_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
