-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 06 mars 2022 à 16:24
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gfogn`
--

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

DROP TABLE IF EXISTS `approvisionnement`;
CREATE TABLE IF NOT EXISTS `approvisionnement` (
  `idApprovisionnement` int(11) NOT NULL,
  PRIMARY KEY (`idApprovisionnement`),
  KEY `idApprovisionnement` (`idApprovisionnement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `approvisionnement`
--

INSERT INTO `approvisionnement` (`idApprovisionnement`) VALUES
(4),
(7);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `idDepense` int(11) NOT NULL,
  PRIMARY KEY (`idDepense`),
  KEY `idDepense` (`idDepense`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`idDepense`) VALUES
(2),
(5),
(6),
(10),
(11),
(12),
(13),
(14),
(15);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220123125906', '2022-01-23 12:59:12', 513),
('DoctrineMigrations\\Version20220123133359', '2022-01-23 13:34:03', 34),
('DoctrineMigrations\\Version20220123133622', '2022-01-23 13:39:49', 112),
('DoctrineMigrations\\Version20220212130422', '2022-02-12 13:04:36', 428),
('DoctrineMigrations\\Version20220213102334', '2022-02-13 10:32:00', 265),
('DoctrineMigrations\\Version20220213141414', '2022-02-13 14:14:22', 218),
('DoctrineMigrations\\Version20220213143605', '2022-02-13 14:36:14', 218),
('DoctrineMigrations\\Version20220213145522', '2022-02-13 14:55:30', 425),
('DoctrineMigrations\\Version20220219100311', '2022-02-19 10:04:02', 168),
('DoctrineMigrations\\Version20220219114304', '2022-02-19 11:43:26', 168),
('DoctrineMigrations\\Version20220220112526', '2022-02-20 11:25:36', 272),
('DoctrineMigrations\\Version20220305175350', '2022-03-05 17:54:01', 651);

-- --------------------------------------------------------

--
-- Structure de la table `don`
--

DROP TABLE IF EXISTS `don`;
CREATE TABLE IF NOT EXISTS `don` (
  `nomDonnateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDon` int(11) NOT NULL,
  PRIMARY KEY (`idDon`),
  KEY `idDon` (`idDon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `don`
--

INSERT INTO `don` (`nomDonnateur`, `idDon`) VALUES
('565', 1),
('6969', 3),
('rambola', 8),
('don gouverneur', 9);

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
CREATE TABLE IF NOT EXISTS `mouvement` (
  `piece_id` int(11) DEFAULT NULL,
  `rubrique_ref` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idMouvement` int(11) NOT NULL AUTO_INCREMENT,
  `dateMouvement` date NOT NULL,
  `Montant` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idMouvement`),
  KEY `piece_id` (`piece_id`),
  KEY `rubrique_ref` (`rubrique_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`piece_id`, `rubrique_ref`, `idMouvement`, `dateMouvement`, `Montant`, `description`) VALUES
(12, 'RCT', 1, '2022-02-05', 90000, 'dsfsdf90'),
(123, 'CA', 2, '2022-02-19', 50000, 'gdfgdfg'),
(6969, 'RCT', 3, '2022-02-19', 60000, '6969'),
(1239, 'RCT', 4, '2022-02-19', 9000000, '452'),
(3214, 'CL', 5, '2022-02-28', 30000, 'deplacement miarinarivo'),
(768, 'CA', 6, '2022-03-01', 80000, 'cadeau anniverasaire koto'),
(3251, 'RCT', 7, '2022-03-01', 200000, 'approvisionnement'),
(25422, 'RCT', 8, '2022-03-01', 500000, 'don député Andry'),
(255432, 'RCT', 9, '2022-03-01', 100000, 'approvisionnement'),
(546546, 'CL', 10, '2022-03-01', 20000, 'deplacement miarinarivo'),
(321, 'CL', 11, '2022-03-04', 50000, 'depl'),
(125, 'EB', 12, '2022-03-04', 900000, 'peinture bat'),
(254, 'GJ', 13, '2022-03-05', 150000, 'gouter'),
(355, 'HTS', 14, '2022-03-05', 2300000, 'achat medicament noel'),
(236, 'SSE', 15, '2022-03-05', 600000, 'payement droit inscription bema');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `idPiece` int(11) NOT NULL,
  `libellePiece` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datePiece` date NOT NULL,
  PRIMARY KEY (`idPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`idPiece`, `libellePiece`, `datePiece`) VALUES
(12, 'dsfsd', '2022-02-19'),
(123, 'fdgdfgdf', '2022-02-07'),
(125, 'quittance', '2022-03-04'),
(236, 'quittance', '2022-03-05'),
(254, 'quittance', '2022-03-05'),
(321, 'quittance', '2022-03-04'),
(355, 'facture', '2022-03-05'),
(768, 'quittance', '2022-03-01'),
(1239, '32313', '2022-02-19'),
(3214, 'quittance', '2022-02-28'),
(3251, 'quittance', '2022-03-01'),
(6969, 'FAtc ejhdfhjsd', '2022-02-17'),
(25422, 'quittance', '2022-03-01'),
(225556, 'utyury', '2022-02-28'),
(255432, 'quittance', '2022-03-01'),
(546546, 'dfdfsdf', '2022-03-01');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `idRecette` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`),
  KEY `idRecette` (`idRecette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`) VALUES
(1),
(3),
(4),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Structure de la table `releve`
--

DROP TABLE IF EXISTS `releve`;
CREATE TABLE IF NOT EXISTS `releve` (
  `idreleve` int(11) NOT NULL AUTO_INCREMENT,
  `dateReleve` date NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `montantDebut` double NOT NULL,
  `montantFin` double NOT NULL,
  PRIMARY KEY (`idreleve`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `releve`
--

INSERT INTO `releve` (`idreleve`, `dateReleve`, `dateDebut`, `dateFin`, `montantDebut`, `montantFin`) VALUES
(1, '2021-12-15', '2021-02-01', '2022-03-31', 5000, 9000);

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

DROP TABLE IF EXISTS `rubrique`;
CREATE TABLE IF NOT EXISTS `rubrique` (
  `RefRubrique` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LibelleRubrique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`RefRubrique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rubrique`
--

INSERT INTO `rubrique` (`RefRubrique`, `LibelleRubrique`, `type`) VALUES
('BC', 'BOIS DE CUISSON', 'Centre'),
('CA', 'CADEAU', 'Pensionnaire'),
('CANAL+', 'REABONNEMENTS CANALSAT', 'Centre'),
('CDA', 'CAHET ET DOCUMENTS ADMINISTRATIFS', 'Centre'),
('CI', 'CONSOMPTIBLES INFORMATIQUES', 'Centre'),
('CL', 'CARBURANT ET LUBRIFIANT', 'Pensionnaire'),
('DFI', 'DEPENSES FRAIS IMPRIMES', 'Centre'),
('DIV', 'DIVERS', 'Centre'),
('EB', 'ENTRETIENS DE BATIMENT', 'Centre'),
('EFC', 'ECOLAGE ET FRAIS DE COURS', 'Pensionnaire'),
('EMT', 'ENTRETIEN MATERIELS DE TRANSPORTS', 'Centre'),
('EMTEC', 'ENTRETIEN MATERIELS DE TECHNIQUES', 'Centre'),
('FBI', 'FOURNITURES ET ARTICLES DE BUREAU', 'Centre'),
('FC', 'FETE ET CEREMONIE', 'Centre'),
('FDIP', 'FRAIS DE DEPLACEMENT INTERIEUR PENSIONNAIRES', 'Pensionnaire'),
('FG', 'FRAIS GENERAUX', 'Pensionnaire'),
('FSCO', 'FOURNITURES SCOLAIRES', 'Pensionnaire'),
('FSPORT', 'FOURNITURES SPORTIVES', 'Pensionnaire'),
('GJ', 'GOUTE JOURNALIER', 'Pensionnaire'),
('HC', 'HABILLEMENT ET COIFFURE', 'Pensionnaire'),
('HTS', 'HOSPITALISATION TRAITEMENT ET SOIN', 'Pensionnaire'),
('JIRAMA', 'PAIEMENT FACTURE JIRAMA', 'Centre'),
('LEP', 'LESSIVE ET ENTRETIEN PHYSIQUE', 'Pensionnaire'),
('MMI', 'MAINTENANCE MATERIELS INFORMATIQUES', 'Centre'),
('PA', 'PRODUITS ALIMENTAIRES', 'Pensionnaire'),
('PP', 'PRODUITS PHARMACEUTIQUES', 'Centre'),
('PPMMDE', 'PRODUITS PETIT MATERIELS MENUES DEPENSES ENTRETIEN', 'Centre'),
('PRO', 'PRIX ET RECOMPENSE OFFICIELLES', 'Pensionnaire'),
('QE', 'QUETE A L°EGLISE', 'Pensionnaire'),
('RCT', 'RECETTE', 'Recette'),
('SSE', 'SUPPLEMENT STAGE ET EXAMEN', 'Pensionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `user_db`
--

DROP TABLE IF EXISTS `user_db`;
CREATE TABLE IF NOT EXISTS `user_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FBA308EDF85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_db`
--

INSERT INTO `user_db` (`id`, `username`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'admin', '{\"0\": \"ROLE_ADMIN\"}', '$2y$13$gIr4.Q2q3CM.tooZ44RlJeTeZnIHqbU8mSA0i.MyvoQbgMfePiIpK', 'admin', '-'),
(6, 'consult', '[\"ROLE_CONSULTANT\"]', '$2y$13$WQdTDGXch0Z0bKoBTs6Y3.etcSgzZLppqP1r6JrCO.JDoD30QGLMa', 'cons', 'ultant'),
(7, 'exemple', '[\"ROLE_EDITEUR\"]', '$2y$13$rV7YI5KIa7D6CBxPBhLv9OyorGx028O.6.QNzPAq4f0dQS.El5vMu', 'RAKOTOARIVELO', 'Pierrot');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD CONSTRAINT `FK_516C3FAA35842D35` FOREIGN KEY (`idApprovisionnement`) REFERENCES `recette` (`idRecette`);

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `FK_3405975724BCFCA5` FOREIGN KEY (`idDepense`) REFERENCES `mouvement` (`idMouvement`);

--
-- Contraintes pour la table `don`
--
ALTER TABLE `don`
  ADD CONSTRAINT `FK_F8F081D9D9B89C5E` FOREIGN KEY (`idDon`) REFERENCES `recette` (`idRecette`);

--
-- Contraintes pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`rubrique_ref`) REFERENCES `rubrique` (`RefRubrique`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`piece_id`) REFERENCES `piece` (`idPiece`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB639059020862` FOREIGN KEY (`idRecette`) REFERENCES `mouvement` (`idMouvement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
