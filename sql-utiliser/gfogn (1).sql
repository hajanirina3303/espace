-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 avr. 2022 à 18:38
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

-- --------------------------------------------------------

--
-- Structure de la table `bilan`
--

DROP TABLE IF EXISTS `bilan`;
CREATE TABLE IF NOT EXISTS `bilan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(17),
(18),
(20),
(21);

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
('DoctrineMigrations\\Version20220305175350', '2022-03-05 17:54:01', 651),
('DoctrineMigrations\\Version20220414175644', '2022-04-14 17:57:33', 384);

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
('Test', 16),
('DIan', 19),
('DIan', 22);

-- --------------------------------------------------------

--
-- Structure de la table `don_objet`
--

DROP TABLE IF EXISTS `don_objet`;
CREATE TABLE IF NOT EXISTS `don_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_objet` date NOT NULL,
  `nom_donnateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `don_objet`
--

INSERT INTO `don_objet` (`id`, `date_objet`, `nom_donnateur`, `numero_phone`, `addresse`) VALUES
(1, '2022-04-14', 'Hariniaina', '4564564', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
CREATE TABLE IF NOT EXISTS `mouvement` (
  `piece_id` int(11) DEFAULT NULL,
  `rubrique_ref` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idMouvement` int(11) NOT NULL AUTO_INCREMENT,
  `dateMouvement` date NOT NULL,
  `Montant` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idMouvement`),
  KEY `piece_id` (`piece_id`),
  KEY `rubrique_ref` (`rubrique_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`piece_id`, `rubrique_ref`, `idMouvement`, `dateMouvement`, `Montant`, `description`) VALUES
(1, 'RCT', 16, '2020-01-08', 900000, 'test'),
(125, 'CA', 17, '2020-02-08', 500000, 'deplacement miarinarivo'),
(628, 'CA', 18, '2020-02-08', 500000, 'deplacement miarinarivo'),
(1021, 'RCT', 19, '2022-03-01', 2000000, 'approvisionnement don Dlan'),
(1254, 'CL', 20, '2022-03-01', 130000, 'picnik pensionnaire andasibe'),
(126, 'GJ', 21, '2022-03-02', 20000, 'gouter'),
(233, 'RCT', 22, '2022-03-08', 200000, 'Podsijof');

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

DROP TABLE IF EXISTS `objet`;
CREATE TABLE IF NOT EXISTS `objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `don_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `valeur` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_46CD4C388FA4097C` (`rubrique`),
  KEY `IDX_46CD4C387B3C9061` (`don_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`id`, `rubrique`, `don_id`, `description`, `quantite`, `valeur`) VALUES
(1, 'CANAL+', 1, 'loll', 10, '1500.00');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `idPiece` int(11) NOT NULL AUTO_INCREMENT,
  `libellePiece` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datePiece` date NOT NULL,
  `numero_piece` int(11) NOT NULL,
  PRIMARY KEY (`idPiece`)
) ENGINE=InnoDB AUTO_INCREMENT=1255 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`idPiece`, `libellePiece`, `datePiece`, `numero_piece`) VALUES
(1, 'test', '2020-01-08', 0),
(125, 'quittance', '2020-02-08', 0),
(126, 'quittance', '2022-03-02', 0),
(233, 'quittance', '2022-03-08', 0),
(628, 'quittance', '2020-02-08', 0),
(1021, 'quittance', '2022-03-01', 0),
(1254, 'facture', '2022-03-01', 0);

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
(16),
(19),
(22);

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
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idreleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('CANAL+', 'REABONNEMENT CANALSAT', 'Centre'),
('CDA', 'CACHET ET DOCUMENT ADMINISTRATIFS', 'Centre'),
('CI', 'CONSOMPTIBLES INFORMATIQUES', 'Centre'),
('CL', 'CARBURANT ET LUBRIFIANT CENTRE', 'Centre'),
('CLP', 'CARBURANT ET LUBRIFIANT PENSIONNAIRE', 'Pensionnaire'),
('CM', 'CONSOMPTIBLES MEDICAUX', 'Centre'),
('DFI', 'DEPENSES FRAIS IMPRIMES', 'Centre'),
('EB', 'ENTRETIENS DE BATIMENT', 'Centre'),
('EFC', 'ECOLAGE ET FRAIS DE COURS', 'Pensionnaire'),
('EMT', 'ENTRETIENS MATERIELS DE TRANSPORTS', 'Centre'),
('EMTEC', 'ENTRETIENS MATERIELS TECHNIQUES', 'Centre'),
('FBI', 'FOURNITURES ET ARTICLES DE BUREAU', 'Centre'),
('FC', 'FETE ET CEREMONIE', 'Centre'),
('FDIP', 'FRAIS DE DEPLACEMENT INTERIEUR PENSIONNAIRES', 'Pensionnaire'),
('FDIS', 'FRAIS DE DEPLACEMENT INTERIEUR CENTRE', 'Centre'),
('FG', 'FRAIS GENERAUX', 'Pensionnaire'),
('FM', 'FOURNITURES MENAGERES', 'Pensionnaire'),
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
('SSE', 'SUPPLEMNT DE STAGE ET EXAMEN', 'Pensionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `sortie_objet`
--

DROP TABLE IF EXISTS `sortie_objet`;
CREATE TABLE IF NOT EXISTS `sortie_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet_id` int(11) NOT NULL,
  `date_sortie` date NOT NULL,
  `unite_objet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DFC3E93CF520CF5A` (`objet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sortie_objet`
--

INSERT INTO `sortie_objet` (`id`, `objet_id`, `date_sortie`, `unite_objet`) VALUES
(1, 1, '2022-04-14', 6),
(2, 1, '2022-04-14', 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_db`
--

INSERT INTO `user_db` (`id`, `username`, `roles`, `password`, `nom`, `prenom`) VALUES
(1, 'admin', '{\"0\": \"ROLE_ADMIN\"}', '$2y$13$gIr4.Q2q3CM.tooZ44RlJeTeZnIHqbU8mSA0i.MyvoQbgMfePiIpK', 'admin', '-'),
(6, 'consult', '[\"ROLE_CONSULTANT\"]', '$2y$13$WQdTDGXch0Z0bKoBTs6Y3.etcSgzZLppqP1r6JrCO.JDoD30QGLMa', 'cons', 'ultant'),
(7, 'exemple', '[\"ROLE_EDITEUR\"]', '$2y$13$rV7YI5KIa7D6CBxPBhLv9OyorGx028O.6.QNzPAq4f0dQS.El5vMu', 'RAKOTOARIVELO', 'Pierrot'),
(8, 'admin1', '[\"ROLE_CONSULTANT\"]', '$2y$13$.QGQkCegsuLjqEPH1xrRIegwzhRBMrWJzSJnxQ5iLa5AAB7PaOoO.', 'rakoto', 'mamonjy');

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
  ADD CONSTRAINT `FK_5B51FC3EC050E4AE` FOREIGN KEY (`rubrique_ref`) REFERENCES `rubrique` (`RefRubrique`),
  ADD CONSTRAINT `FK_5B51FC3EC40FCFA8` FOREIGN KEY (`piece_id`) REFERENCES `piece` (`idPiece`);

--
-- Contraintes pour la table `objet`
--
ALTER TABLE `objet`
  ADD CONSTRAINT `FK_46CD4C387B3C9061` FOREIGN KEY (`don_id`) REFERENCES `don_objet` (`id`),
  ADD CONSTRAINT `FK_46CD4C388FA4097C` FOREIGN KEY (`rubrique`) REFERENCES `rubrique` (`RefRubrique`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB639059020862` FOREIGN KEY (`idRecette`) REFERENCES `mouvement` (`idMouvement`);

--
-- Contraintes pour la table `sortie_objet`
--
ALTER TABLE `sortie_objet`
  ADD CONSTRAINT `FK_DFC3E93CF520CF5A` FOREIGN KEY (`objet_id`) REFERENCES `objet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
