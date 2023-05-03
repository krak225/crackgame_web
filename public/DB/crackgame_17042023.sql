-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 17 avr. 2023 à 13:24
-- Version du serveur : 10.3.38-MariaDB-0+deb10u1
-- Version de PHP : 7.3.31-1~deb10u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reuss1935499_4p5pe8`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `abonnement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type_jeu` varchar(50) DEFAULT NULL,
  `abonnement_date` datetime DEFAULT NULL,
  `abonnement_statut` enum('EN COURS','EXPIRE') DEFAULT 'EN COURS'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`abonnement_id`, `user_id`, `type_jeu`, `abonnement_date`, `abonnement_statut`) VALUES
(1, 13, 'DUEL', '2019-11-25 18:00:00', 'EN COURS'),
(2, 5, 'DUEL', '2019-11-25 18:07:36', 'EN COURS'),
(3, 6, 'DUEL', '2019-11-25 18:43:37', 'EN COURS'),
(7, 5, 'CHAP', '2019-11-26 11:46:08', 'EN COURS'),
(5, 5, 'DUEL', '2019-11-26 09:23:06', 'EN COURS'),
(6, 6, 'DUEL', '2019-11-26 11:23:18', 'EN COURS'),
(8, 6, 'CHAP', '2019-11-26 11:52:45', 'EN COURS'),
(9, 14, 'CHAP', '2019-11-26 16:56:42', 'EN COURS'),
(10, 2, 'CHAP', '2019-11-26 18:09:30', 'EN COURS'),
(11, 5, 'DUEL', '2021-09-01 15:49:38', 'EN COURS'),
(12, 5, 'QUIZ', '2021-09-01 16:59:47', 'EN COURS'),
(13, 5, 'DUEL', '2022-03-05 01:44:11', 'EN COURS'),
(14, 15, 'QUIZ', '2022-03-05 02:31:36', 'EN COURS'),
(15, 15, 'QUIZ', '2022-03-05 02:50:59', 'EN COURS');

-- --------------------------------------------------------

--
-- Structure de la table `abonnement_chap`
--

CREATE TABLE `abonnement_chap` (
  `abonnement_chap_id` int(11) NOT NULL,
  `chap_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type_jeu` varchar(50) DEFAULT NULL,
  `abonnement_chap_date` datetime DEFAULT NULL,
  `abonnement_chap_statut` enum('EN COURS','EXPIRE') DEFAULT 'EN COURS'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cagnotte`
--

CREATE TABLE `cagnotte` (
  `cagnotte_id` int(11) NOT NULL,
  `cagnotte_montant` int(11) DEFAULT NULL,
  `cagnotte_date` date DEFAULT NULL,
  `cagnotte_date_creation` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `cagnotte`
--

INSERT INTO `cagnotte` (`cagnotte_id`, `cagnotte_montant`, `cagnotte_date`, `cagnotte_date_creation`) VALUES
(1, 500, '2022-01-17', '2022-01-17 17:35:52'),
(2, 7000, '2022-01-17', '2022-01-17 17:35:56'),
(3, 200, '2022-01-17', '2022-01-17 17:36:00'),
(4, 1000, '2022-01-17', '2022-01-17 17:36:02');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` int(11) NOT NULL,
  `categorie_libelle` varchar(100) DEFAULT NULL,
  `categorie_description` varchar(100) DEFAULT NULL,
  `categorie_date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `categorie_statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci PACK_KEYS=0 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie_libelle`, `categorie_description`, `categorie_date_creation`, `categorie_statut`) VALUES
(1, 'Culture Générale', 'Culture Générale', '2023-04-17 11:24:57', 'VALIDE'),
(2, 'Sport', 'Découvrez toutes les infos sportifs', '2023-04-17 11:24:57', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `chap`
--

CREATE TABLE `chap` (
  `chap_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chap_participants` int(11) DEFAULT NULL,
  `chap_vainqueur_id` int(11) DEFAULT NULL,
  `chap_etape` int(11) DEFAULT NULL,
  `chap_date_debut` datetime DEFAULT NULL,
  `chap_date_creation` datetime DEFAULT NULL,
  `readystate` enum('READY','NOT READY') NOT NULL DEFAULT 'NOT READY',
  `chap_statut` enum('BROUILLON','VALIDE','EN COURS','TERMINE') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `chap`
--

INSERT INTO `chap` (`chap_id`, `user_id`, `chap_participants`, `chap_vainqueur_id`, `chap_etape`, `chap_date_debut`, `chap_date_creation`, `readystate`, `chap_statut`) VALUES
(5, 1, 3, NULL, 1, NULL, '2019-11-26 19:59:39', 'NOT READY', 'EN COURS');

-- --------------------------------------------------------

--
-- Structure de la table `chap_question`
--

CREATE TABLE `chap_question` (
  `chap_id` int(11) DEFAULT 1,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `repondeur_id` int(11) DEFAULT NULL,
  `reponse` varchar(2) DEFAULT NULL,
  `observation` varchar(50) DEFAULT NULL,
  `statut` enum('UTILISE','DISPONIBLE') DEFAULT 'DISPONIBLE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `chap_question`
--

INSERT INTO `chap_question` (`chap_id`, `question_id`, `user_id`, `repondeur_id`, `reponse`, `observation`, `statut`) VALUES
(1, 13, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 39, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 31, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 2, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 5, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 7, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 19, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 25, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(1, 27, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 2, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 5, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 7, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 19, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 25, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 27, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 33, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 34, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 35, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 36, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(2, 37, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 2, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 5, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 7, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 19, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 25, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 27, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 33, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 34, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 35, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 36, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(3, 37, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 2, 6, 6, NULL, NULL, 'UTILISE'),
(4, 5, 6, 6, 'A', 'bad', 'UTILISE'),
(4, 7, 6, 6, 'C', 'bad', 'UTILISE'),
(4, 19, 6, 6, 'C', 'bad', 'UTILISE'),
(4, 25, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 27, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 33, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 34, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 35, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(4, 36, 2, 6, 'C', 'bad', 'UTILISE'),
(4, 37, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 2, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 5, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 7, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 19, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 25, 6, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 13, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 39, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 31, 5, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 33, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 34, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 35, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 36, 2, NULL, NULL, NULL, 'DISPONIBLE'),
(5, 37, 2, NULL, NULL, NULL, 'DISPONIBLE');

-- --------------------------------------------------------

--
-- Structure de la table `chap_score`
--

CREATE TABLE `chap_score` (
  `chap_id` int(11) DEFAULT NULL,
  `chap_etape` int(11) DEFAULT 1,
  `cpt_question` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `statut` enum('BROUILLON','TERMINE','ELIMINE','RETENU') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `chap_score`
--

INSERT INTO `chap_score` (`chap_id`, `chap_etape`, `cpt_question`, `user_id`, `score`, `statut`) VALUES
(1, 1, 0, 5, 0, 'BROUILLON'),
(1, 1, 0, 6, 0, 'BROUILLON'),
(2, 1, 0, 6, 0, 'BROUILLON'),
(2, 1, 0, 2, 0, 'BROUILLON'),
(3, 1, 0, 6, 0, 'BROUILLON'),
(3, 1, 0, 2, 0, 'BROUILLON'),
(4, 1, 5, 6, 0, 'BROUILLON'),
(4, 1, 0, 2, 0, 'BROUILLON'),
(5, 1, 0, 6, 0, 'BROUILLON'),
(5, 1, 0, 5, 0, 'BROUILLON'),
(5, 1, 0, 2, 0, 'BROUILLON');

-- --------------------------------------------------------

--
-- Structure de la table `conversion`
--

CREATE TABLE `conversion` (
  `conversion_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conversion_point` int(11) DEFAULT NULL,
  `conversion_taux` double DEFAULT NULL,
  `total_points_duel` int(11) DEFAULT NULL,
  `conversion_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `defi`
--

CREATE TABLE `defi` (
  `defi_id` int(11) NOT NULL,
  `defi_montant` int(11) NOT NULL,
  `defi_date` date NOT NULL,
  `defi_date_creation` datetime NOT NULL,
  `defi_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `defi`
--

INSERT INTO `defi` (`defi_id`, `defi_montant`, `defi_date`, `defi_date_creation`, `defi_statut`) VALUES
(1, 5000, '2023-04-17', '2023-04-17 10:28:15', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `depot_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `depot_montant` int(11) DEFAULT NULL,
  `depot_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`depot_id`, `user_id`, `depot_montant`, `depot_date`) VALUES
(1, 13, 1000, NULL),
(2, 5, 100, NULL),
(3, 6, 500, NULL),
(4, 5, 500, NULL),
(5, 2, 200, NULL),
(6, 5, 100, NULL),
(7, 5, 400, NULL),
(8, 14, 1000, NULL),
(9, 2, 400, NULL),
(10, 5, 10000, '2021-09-01 16:59:36'),
(11, 5, 450000, '2022-03-05 01:44:36'),
(12, 15, 1000, '2022-03-05 02:31:36');

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `devise_id` int(11) NOT NULL,
  `devise_code` varchar(5) DEFAULT NULL,
  `devise_libelle` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci PACK_KEYS=0 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `devise`
--

INSERT INTO `devise` (`devise_id`, `devise_code`, `devise_libelle`) VALUES
(1, 'Eur', 'Euro'),
(2, '$', 'Dollard'),
(3, 'FCFA', 'XOF (cfa)');

-- --------------------------------------------------------

--
-- Structure de la table `duel`
--

CREATE TABLE `duel` (
  `duel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adversaire_id` int(11) NOT NULL,
  `duel_date_creation` datetime DEFAULT NULL,
  `duel_date_validation` datetime DEFAULT NULL,
  `duel_date_debut` datetime DEFAULT NULL,
  `duel_date_fin` datetime DEFAULT NULL,
  `duel_vainqueur_id` int(11) DEFAULT NULL,
  `duel_abandonneur_id` int(11) DEFAULT NULL,
  `current_player_id` int(11) DEFAULT NULL,
  `compteur_question` int(11) DEFAULT 0,
  `readystate` enum('READY','NOT READY') DEFAULT 'NOT READY',
  `connected_users` int(11) DEFAULT 0,
  `duel_statut` enum('BROUILLON','VALIDE','EN COURS','TERMINE','ANNULE') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `duel`
--

INSERT INTO `duel` (`duel_id`, `user_id`, `adversaire_id`, `duel_date_creation`, `duel_date_validation`, `duel_date_debut`, `duel_date_fin`, `duel_vainqueur_id`, `duel_abandonneur_id`, `current_player_id`, `compteur_question`, `readystate`, `connected_users`, `duel_statut`) VALUES
(1, 5, 6, NULL, '2019-11-26 11:41:40', NULL, NULL, NULL, NULL, 5, 2, 'READY', 2, 'ANNULE');

-- --------------------------------------------------------

--
-- Structure de la table `duel_jocker`
--

CREATE TABLE `duel_jocker` (
  `duel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jocker_utilise` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `duel_jocker`
--

INSERT INTO `duel_jocker` (`duel_id`, `user_id`, `jocker_utilise`) VALUES
(1, 5, 0),
(1, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `duel_question`
--

CREATE TABLE `duel_question` (
  `duel_id` int(11) DEFAULT NULL,
  `duel_question_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `statut` enum('BONNE','MAUVAISE') DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `time_actuel` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='enregistre les questions posée dans un duel';

--
-- Déchargement des données de la table `duel_question`
--

INSERT INTO `duel_question` (`duel_id`, `duel_question_id`, `question_id`, `from_user_id`, `to_user_id`, `statut`, `date`, `time_actuel`) VALUES
(1, 1, 13, 5, 6, NULL, NULL, '1574768638829'),
(1, 2, 5, 6, 5, NULL, NULL, '1574768652088');

-- --------------------------------------------------------

--
-- Structure de la table `duel_score`
--

CREATE TABLE `duel_score` (
  `duel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `connected` enum('CONNECTED','NOT CONNECTED') DEFAULT 'NOT CONNECTED'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `duel_score`
--

INSERT INTO `duel_score` (`duel_id`, `user_id`, `score`, `connected`) VALUES
(1, 5, 100, 'CONNECTED'),
(1, 6, 100, 'CONNECTED');

-- --------------------------------------------------------

--
-- Structure de la table `entrainement`
--

CREATE TABLE `entrainement` (
  `entrainement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_jeu` varchar(50) DEFAULT NULL,
  `objectif_financier` int(11) DEFAULT NULL,
  `entrainement_score` int(11) DEFAULT NULL,
  `entrainement_compteur_question` int(11) DEFAULT NULL,
  `entrainement_date` datetime DEFAULT NULL,
  `entrainement_issue` enum('GAGNE','PERDU','EN ATTENTE') NOT NULL DEFAULT 'EN ATTENTE',
  `entrainement_statut` enum('BROUILLON','EN COURS','TERMINE') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `entrainement`
--

INSERT INTO `entrainement` (`entrainement_id`, `user_id`, `categorie_id`, `type_jeu`, `objectif_financier`, `entrainement_score`, `entrainement_compteur_question`, `entrainement_date`, `entrainement_issue`, `entrainement_statut`) VALUES
(1, 5, 2, 'TEST', NULL, 0, 15, '2021-09-01 16:34:01', 'EN ATTENTE', 'TERMINE'),
(2, 5, 2, 'TEST', NULL, 0, 15, '2021-09-01 16:37:26', 'EN ATTENTE', 'TERMINE'),
(3, 5, 2, 'TEST', NULL, 200, 15, '2021-09-01 16:38:02', 'EN ATTENTE', 'TERMINE'),
(4, 5, 2, 'TEST', NULL, 100, 15, '2021-09-01 16:39:43', 'EN ATTENTE', 'TERMINE'),
(5, 5, 1, 'QUIZ', 500, 0, 15, '2021-09-01 16:59:58', 'EN ATTENTE', 'TERMINE'),
(6, 5, 1, 'QUIZ', 500, 100, 15, '2021-09-01 17:00:14', 'EN ATTENTE', 'EN COURS');

-- --------------------------------------------------------

--
-- Structure de la table `jockerquestion`
--

CREATE TABLE `jockerquestion` (
  `jockerquestion_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `beneficiaire_user_id` int(11) DEFAULT NULL,
  `jockerquestion_quantite` int(11) DEFAULT NULL,
  `jockerquestion_montant` int(11) DEFAULT NULL,
  `jockerquestion_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `jockerquestion`
--

INSERT INTO `jockerquestion` (`jockerquestion_id`, `user_id`, `beneficiaire_user_id`, `jockerquestion_quantite`, `jockerquestion_montant`, `jockerquestion_date`) VALUES
(1, 2, 2, 5, NULL, NULL),
(2, 6, 6, 5, NULL, NULL),
(3, 5, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `kw_administrateur`
--

CREATE TABLE `kw_administrateur` (
  `kw_administrateur_id` int(10) UNSIGNED NOT NULL,
  `kw_administrateur_login` varchar(255) NOT NULL,
  `kw_administrateur_pass` varchar(255) NOT NULL,
  `kw_administrateur_email` varchar(50) NOT NULL,
  `kw_administrateur_rang` int(11) NOT NULL,
  `kw_administrateur_statut` enum('ACTIVE','DESACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='enregistre les administrateurs du site';

--
-- Déchargement des données de la table `kw_administrateur`
--

INSERT INTO `kw_administrateur` (`kw_administrateur_id`, `kw_administrateur_login`, `kw_administrateur_pass`, `kw_administrateur_email`, `kw_administrateur_rang`, `kw_administrateur_statut`) VALUES
(1, 'admin', 'fece6adde0ec8c975e2b5ec91fce57ab1852fca4', 'krak225@gmail.com', 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `langue_id` int(11) NOT NULL,
  `langue_code` varchar(3) NOT NULL DEFAULT '0',
  `langue_libelle` varchar(20) DEFAULT NULL,
  `langue_drapeau` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci PACK_KEYS=0 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`langue_id`, `langue_code`, `langue_libelle`, `langue_drapeau`) VALUES
(1, 'Fr', 'français', 'fr.png'),
(2, 'En', 'anglais', 'gb.png');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `niveau_id` int(11) NOT NULL,
  `niveau_libelle` varchar(100) NOT NULL,
  `niveau_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`niveau_id`, `niveau_libelle`, `niveau_statut`) VALUES
(1, 'NIVEAU 1', 'VALIDE'),
(2, 'NIVEAU 2', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `pays_id` smallint(5) UNSIGNED NOT NULL,
  `pays_code` int(3) NOT NULL,
  `pays_alpha2` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pays_alpha3` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pays_nom_en` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pays_nom_fr` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`pays_id`, `pays_code`, `pays_alpha2`, `pays_alpha3`, `pays_nom_en`, `pays_nom_fr`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albania', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctica', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'Algeria', 'Algérie'),
(5, 16, 'AS', 'ASM', 'American Samoa', 'Samoa Américaines'),
(6, 20, 'AD', 'AND', 'Andorra', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaïdjan'),
(10, 32, 'AR', 'ARG', 'Argentina', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australia', 'Australie'),
(12, 40, 'AT', 'AUT', 'Austria', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahrain', 'Bahreïn'),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Armenia', 'Arménie'),
(17, 52, 'BB', 'BRB', 'Barbados', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgium', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermuda', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhutan', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivia', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine'),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Bouvet Island', 'Île Bouvet'),
(25, 76, 'BR', 'BRA', 'Brazil', 'Brésil'),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize'),
(27, 86, 'IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Océan Indien'),
(28, 90, 'SB', 'SLB', 'Solomon Islands', 'Îles Salomon'),
(29, 92, 'VG', 'VGB', 'British Virgin Islands', 'Îles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'Brunei Darussalam', 'Brunéi Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgaria', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Belarus', 'Bélarus'),
(35, 116, 'KH', 'KHM', 'Cambodia', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroon', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cape Verde', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'Cayman Islands', 'Îles Caïmanes'),
(40, 140, 'CF', 'CAF', 'Central African', 'République Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Chad', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chile', 'Chili'),
(44, 156, 'CN', 'CHN', 'China', 'Chine'),
(45, 158, 'TW', 'TWN', 'Taiwan', 'Taïwan'),
(46, 162, 'CX', 'CXR', 'Christmas Island', 'Île Christmas'),
(47, 166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombia', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comoros', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte'),
(51, 178, 'CG', 'COG', 'Republic of the Congo', 'République du Congo'),
(52, 180, 'CD', 'COD', 'The Democratic Republic Of The Congo', 'République Démocratique du Congo'),
(53, 184, 'CK', 'COK', 'Cook Islands', 'Îles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatia', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Cyprus', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'Czech Republic', 'République Tchèque'),
(59, 204, 'BJ', 'BEN', 'Benin', 'Bénin'),
(60, 208, 'DK', 'DNK', 'Denmark', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominica', 'Dominique'),
(62, 214, 'DO', 'DOM', 'Dominican Republic', 'République Dominicaine'),
(63, 218, 'EC', 'ECU', 'Ecuador', 'Équateur'),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Guinée Équatoriale'),
(66, 231, 'ET', 'ETH', 'Ethiopia', 'Éthiopie'),
(67, 232, 'ER', 'ERI', 'Eritrea', 'Érythrée'),
(68, 233, 'EE', 'EST', 'Estonia', 'Estonie'),
(69, 234, 'FO', 'FRO', 'Faroe Islands', 'Îles Féroé'),
(70, 238, 'FK', 'FLK', 'Falkland Islands', 'Îles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud'),
(72, 242, 'FJ', 'FJI', 'Fiji', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finland', 'Finlande'),
(74, 248, 'AX', 'ALA', 'Åland Islands', 'Îles Åland'),
(75, 250, 'FR', 'FRA', 'France', 'France'),
(76, 254, 'GF', 'GUF', 'French Guiana', 'Guyane Française'),
(77, 258, 'PF', 'PYF', 'French Polynesia', 'Polynésie Française'),
(78, 260, 'TF', 'ATF', 'French Southern Territories', 'Terres Australes Françaises'),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Georgia', 'Géorgie'),
(82, 270, 'GM', 'GMB', 'Gambia', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occupé'),
(84, 276, 'DE', 'DEU', 'Germany', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Greece', 'Grèce'),
(89, 304, 'GL', 'GRL', 'Greenland', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenada', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinea', 'Guinée'),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haiti', 'Haïti'),
(97, 334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Îles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Vatican City State', 'Saint-Siège (état de la Cité du Vatican)'),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong Kong', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hungary', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Iceland', 'Islande'),
(103, 356, 'IN', 'IND', 'India', 'Inde'),
(104, 360, 'ID', 'IDN', 'Indonesia', 'Indonésie'),
(105, 364, 'IR', 'IRN', 'Islamic Republic of Iran', 'République Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Ireland', 'Irlande'),
(108, 376, 'IL', 'ISR', 'Israel', 'Israël'),
(109, 380, 'IT', 'ITA', 'Italy', 'Italie'),
(110, 225, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaica', 'Jamaïque'),
(112, 392, 'JP', 'JPN', 'Japan', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordan', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya'),
(116, 408, 'KP', 'PRK', 'Democratic People\'s Republic of Korea', 'République Populaire Démocratique de Corée'),
(117, 410, 'KR', 'KOR', 'Republic of Korea', 'République de Corée'),
(118, 414, 'KW', 'KWT', 'Kuwait', 'Koweït'),
(119, 417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'République Démocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Lebanon', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Latvia', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'Liberia', 'Libéria'),
(125, 434, 'LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne'),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lithuania', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaysia', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malta', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritania', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Mauritius', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexico', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolia', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'Republic of Moldova', 'République de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Morocco', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibia', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Nepal', 'Népal'),
(150, 528, 'NL', 'NLD', 'Netherlands', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Netherlands Antilles', 'Antilles Néerlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba'),
(153, 540, 'NC', 'NCL', 'New Caledonia', 'Nouvelle-Calédonie'),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'New Zealand', 'Nouvelle-Zélande'),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigeria', 'Nigéria'),
(159, 570, 'NU', 'NIU', 'Niue', 'Niué'),
(160, 574, 'NF', 'NFK', 'Norfolk Island', 'Île Norfolk'),
(161, 578, 'NO', 'NOR', 'Norway', 'Norvège'),
(162, 580, 'MP', 'MNP', 'Northern Mariana Islands', 'Îles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'Îles Mineures Éloignées des États-Unis'),
(164, 583, 'FM', 'FSM', 'Federated States of Micronesia', 'États Fédérés de Micronésie'),
(165, 584, 'MH', 'MHL', 'Marshall Islands', 'Îles Marshall'),
(166, 585, 'PW', 'PLW', 'Palau', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée'),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Peru', 'Pérou'),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Poland', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinea-Bissau', 'Guinée-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Puerto Rico', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Romania', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'Russian Federation', 'Fédération de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Saint Helena', 'Sainte-Hélène'),
(185, 659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'San Marino', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomé-et-Principe'),
(192, 682, 'SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'Senegal', 'Sénégal'),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapore', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovakia', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Vietnam', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'Slovenia', 'Slovénie'),
(200, 706, 'SO', 'SOM', 'Somalia', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'South Africa', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Spain', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Western Sahara', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Sudan', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard etÎle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Sweden', 'Suède'),
(210, 756, 'CH', 'CHE', 'Switzerland', 'Suisse'),
(211, 760, 'SY', 'SYR', 'Syrian Arab Republic', 'République Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tajikistan', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'Thailand', 'Thaïlande'),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinité-et-Tobago'),
(218, 784, 'AE', 'ARE', 'United Arab Emirates', 'Émirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisia', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turkey', 'Turquie'),
(221, 795, 'TM', 'TKM', 'Turkmenistan', 'Turkménistan'),
(222, 796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Îles Turks et Caïques'),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Uganda', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-République Yougoslave de Macédoine'),
(227, 818, 'EG', 'EGY', 'Egypt', 'Égypte'),
(228, 826, 'GB', 'GBR', 'United Kingdom', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'Isle of Man', 'Île de Man'),
(230, 834, 'TZ', 'TZA', 'United Republic Of Tanzania', 'République-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'United States', 'États-Unis'),
(232, 850, 'VI', 'VIR', 'U.S. Virgin Islands', 'Îles Vierges des États-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Uzbekistan', 'Ouzbékistan'),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yemen', 'Yémen'),
(240, 891, 'CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Monténégro'),
(241, 894, 'ZM', 'ZMB', 'Zambia', 'Zambie');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `profil_id` int(11) DEFAULT NULL,
  `profil_nom` varchar(50) DEFAULT NULL,
  `profil_statut` enum('VALIDE') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_fr` varchar(256) DEFAULT NULL,
  `question_en` varchar(256) DEFAULT NULL,
  `proposition_a_fr` varchar(256) DEFAULT NULL,
  `proposition_a_en` varchar(256) DEFAULT NULL,
  `proposition_b_fr` varchar(256) DEFAULT NULL,
  `proposition_b_en` varchar(256) DEFAULT NULL,
  `proposition_c_fr` varchar(256) DEFAULT NULL,
  `proposition_c_en` varchar(256) DEFAULT NULL,
  `reponse` varchar(256) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_jeu_id` int(11) DEFAULT NULL,
  `niveau_id` int(11) DEFAULT NULL,
  `statut_selection` enum('SELECTED','NOT SELECTED') DEFAULT 'NOT SELECTED',
  `statut_selection_chap` enum('SELECTED','NOT SELECTED') DEFAULT 'NOT SELECTED',
  `question_date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `user_id`, `question_fr`, `question_en`, `proposition_a_fr`, `proposition_a_en`, `proposition_b_fr`, `proposition_b_en`, `proposition_c_fr`, `proposition_c_en`, `reponse`, `categorie_id`, `type_jeu_id`, `niveau_id`, `statut_selection`, `statut_selection_chap`, `question_date_creation`, `statut`) VALUES
(1, 6, 'Quelle est la capitale de la Côte d\'Ivoire?', 'What is the capital of Ivory Coast', 'Abidjan', 'Bouaké', 'Daloa', 'Daloa', 'Yamoussoukro', 'Yamoussoukro', 'C', 7, 1, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(2, 6, 'En quelle année la Côte d\'Ivoire a-t-elle obtenu son indépendance?', 'In wich year, Ivory Coast get its independancy?', '1956', '1956', '1960', '1960', '1962', '1962', 'B', 2, 1, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(5, 6, 'Quelle est la capitale de la France?', 'What is the capital of France', 'Marseille', 'Marseille', 'Alsace', 'Alsace', 'Paris', 'Paris', 'C', 2, 1, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(7, 6, 'Dans l\'industrie cinématographique américaine, que signifie l\'abréviation MGM ?', '', 'Metro Goldwyn Mayer', '', 'Millenium Good Media', '', 'Middle Glass Musics', '', 'A', 7, 1, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(8, 10, 'Que signifie ONU?', NULL, 'Organisation Nationale des Universités', NULL, 'Organisation des Nations Unies', NULL, 'Office Nationale de l\'Unité', NULL, 'B', 3, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(9, 10, 'Comment appelle t-on la version 5 d\'Android?', NULL, 'Ice cream sandwich', NULL, 'Lolipop', NULL, 'Oreo', NULL, 'B', 4, 1, 1, 'NOT SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(10, 6, 'Comment appelle t-on la version 8 d\'Android?', '', 'Ice cream sandwich', '', 'Lolipop', '', 'Oreo', '', 'C', 7, 1, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(11, 6, 'Que signifie ONG?', '', 'Organisation Nationale des Gares', '', 'Organisation Non Gouvernementale', '', 'Office Nationale des Gouverneurs', '', 'B', 7, 1, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(12, 6, 'Quelle est la formule du poids d\'un objet?', '', 'P = m x g', '', 'P = m + g', '', 'P = m - g', '', 'A', 7, 1, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(13, 5, 'Dans quelle pays se trouve le Mont Tonkpi?', '', 'Mali', '', 'Ghana', '', 'Côte d\'Ivoire', '', 'C', 2, 1, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(15, 10, 'Que signifie UEMOA?', NULL, 'Unité Electorale Mondiale pour l\'Ordre en Afrique', NULL, 'Union des Electricien du Monde en Afrique', NULL, 'Union Economique et Monetaire Ouest Africaine', NULL, 'C', 2, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(16, 10, 'Qeulle est le chef lieu de la région du hambole?', NULL, 'Bouaké', NULL, 'Katiola', NULL, 'Dabakala', NULL, 'B', 2, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(17, 10, 'De qui est le roman Les frasques d\'Ebinto?', NULL, 'Isaie Binton Coulibaly', NULL, 'Tidiane Dem', NULL, 'Amadou Koné', NULL, 'C', 1, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(18, 10, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', NULL, 'Koumassi', NULL, 'Port-Bouet', NULL, 'Yopougon', NULL, 'B', 1, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(19, 6, 'Qui est l\'auteur de cette phrase : “Je souhaite que la  santé  soit  enfin considérée non plus comme une bénédiction que l’on espère mais comme un droit de l’homme pour lequel on se bat.” ?', '', 'Kofi Annan', '', 'Mahatma Gandhi', '', 'Nelson Mandela', '', 'A', 1, 1, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(20, 5, 'Selon le plan comptable SYSCOHADA laquelle de ces affirmations est fausse ?', '', 'Classe 5: comptes de tiers', '', 'Classe 7: comptes de produits Activité Ordinaire', '', 'Classe 1: comptes de ressources durables', '', 'A', 6, 2, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(21, 10, 'Selon le plan comptable SYSCOHADA, laquelle de ces classes ne relève pas de la comptabilité générale ?', '', 'Classe 5', '', 'Classe 9', '', 'Classe 8', '', 'B', 6, 2, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(22, 5, 'Lequel de ces principes est un principe comptable?', '', 'Le principe de la sincérité', '', 'Le principe de la continuité de l\'exploitation', '', 'Le principe de l\'honnêteté', '', 'B', 6, 2, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(23, 5, 'Que signifie TVA ?', '', 'Taux variable d’Authenticité', '', 'Taxe sur  vente  abattue', '', 'Taxe sur la valeur ajoutée', '', 'C', 7, 2, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(24, 2, 'Que signifie FRDE en  comptabilité?', '', 'Front de recherche Dana', '', 'Frais de recherche et de développement', '', 'Finir, ralentir et développer', '', 'B', 6, 2, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(25, 6, 'Combien de variantes  existe-t-il dans la méthode du coût moyen pondéré ? ', '', '2', '', '4', '', '8', '', 'A', 6, 2, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(28, 5, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', '', 'Port-Bouet', '', 'Koumassi', '', 'Yopougon', '', 'A', 2, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(39, 5, 'De quelle nationalité est la chantre Débora Lukalu ?', NULL, 'Sud africaine', NULL, 'Concolaise', NULL, 'Centrafricaine', NULL, 'B', NULL, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(30, 5, 'Qui est le fondateur du PDCI-RDA', '', 'Laurent Gbagbo', '', 'Henri Konan Bédié', '', 'Felix Houphouet Boigny', '', 'C', 2, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(31, 5, 'Que signifie BURIDA', '', 'Bureau Ivoirien du Droit des Auteurs', '', 'Bureau Ivoirien du Droit d\'Auteur', '', 'Bureau Ivoirien du Droit d\'Artiste', '', 'B', 7, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(32, 10, 'Que signifie ONU?', 'What is UN?', 'Office Nationale pour l\'UnitÃ©', 'Union of Nation', 'Office des Nations Unies', 'Union of Natural', 'Organisation des Nations Unies', 'United Nation', 'C', 2, 2, 1, 'NOT SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'VALIDE'),
(33, 2, 'Quel est le double de 28', '', '288', '', '56', '', '82', '', 'B', 8, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(34, 2, 'Quel est la moitié de 256', '', '156', '', '128', '', '123', '', 'B', 8, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(35, 2, 'En quelle année la RCA a-t-elle obtenu son indépendance', '', '1960', '', '1965', '', '1964', '', 'A', 2, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(36, 2, 'Quel est la capitale de la Centrafrique', '', 'Bimbo', '', 'Bangui', '', 'Birao', '', 'B', 2, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(37, 2, 'Quel est le tiers de 300', '', '3', '', '30', '', '100', '', 'C', 7, 2, 1, 'SELECTED', 'SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(38, 2, 'Quel est le triple de 300', '', '100', '', '900', '', '1', '', 'B', 8, 2, 1, 'SELECTED', 'NOT SELECTED', '0000-00-00 00:00:00', 'BROUILLON'),
(40, 1, 'TEST BY RICHMOND', NULL, 'sfsf', NULL, 'sfsf', NULL, 'sfsf', NULL, 'C', 5, 2, 1, 'NOT SELECTED', 'NOT SELECTED', '2023-04-17 10:12:15', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_jeu` varchar(50) DEFAULT NULL,
  `objectif_financier` int(11) DEFAULT NULL,
  `quiz_score` int(11) DEFAULT NULL,
  `quiz_compteur_question` int(11) DEFAULT NULL,
  `quiz_date` datetime DEFAULT NULL,
  `quiz_statut` enum('BROUILLON','EN COURS','TERMINE') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recompense`
--

CREATE TABLE `recompense` (
  `recompense_id` int(11) NOT NULL,
  `type_classement_id` int(11) NOT NULL,
  `recompense_rang` int(11) NOT NULL,
  `recompense_montant` int(11) NOT NULL,
  `recompense_date` date NOT NULL,
  `recompense_date_creation` datetime NOT NULL,
  `recompense_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `recompense`
--

INSERT INTO `recompense` (`recompense_id`, `type_classement_id`, `recompense_rang`, `recompense_montant`, `recompense_date`, `recompense_date_creation`, `recompense_statut`) VALUES
(1, 1, 1, 5000, '2023-04-17', '2023-04-17 10:35:47', 'VALIDE'),
(2, 2, 2, 2000, '2023-04-17', '2023-04-17 10:36:44', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `retrait`
--

CREATE TABLE `retrait` (
  `retrait_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `retrait_montant` double NOT NULL,
  `retrait_date_demande` datetime DEFAULT NULL,
  `retrait_date_validation` datetime DEFAULT NULL,
  `retrait_statut` enum('BROUILLON','VALIDE','REJETE') NOT NULL DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `souscription`
--

CREATE TABLE `souscription` (
  `souscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `beneficiaire_user_id` int(11) DEFAULT NULL,
  `souscription_quantite` int(11) DEFAULT NULL,
  `souscription_montant` double DEFAULT NULL,
  `souscription_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci PACK_KEYS=0 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `souscription`
--

INSERT INTO `souscription` (`souscription_id`, `user_id`, `beneficiaire_user_id`, `souscription_quantite`, `souscription_montant`, `souscription_date`) VALUES
(1, 13, 13, 1, 200, '2019-11-25 17:59:55'),
(2, 5, 5, 1, 200, '2019-11-25 18:07:10'),
(3, 6, 6, 1, 200, '2019-11-25 18:43:34'),
(4, 5, 5, 5, 1000, '2019-11-25 21:51:46'),
(5, 2, 2, 2, 400, '2019-11-26 09:22:52'),
(6, 6, 6, 2, 400, '2019-11-26 11:23:11'),
(7, 14, 14, 5, 1000, '2019-11-26 16:56:38'),
(8, 5, 5, 2, 400, '2021-09-01 15:49:26');

-- --------------------------------------------------------

--
-- Structure de la table `tb_password_resets`
--

CREATE TABLE `tb_password_resets` (
  `email` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tb_profil`
--

CREATE TABLE `tb_profil` (
  `profil_id` int(11) NOT NULL,
  `profil_libelle` varchar(50) DEFAULT NULL,
  `profil_statut` enum('VALIDE','BROUILLON') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tb_profil`
--

INSERT INTO `tb_profil` (`profil_id`, `profil_libelle`, `profil_statut`) VALUES
(1, 'ADMINISTRATEUR', 'VALIDE'),
(2, 'UTILISATEUR', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `tb_request`
--

CREATE TABLE `tb_request` (
  `request_id` int(11) NOT NULL,
  `request_url` varchar(255) DEFAULT NULL,
  `request_querystring` varchar(255) DEFAULT NULL,
  `request_statut` enum('BON','FAUX','BROUILLON') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `tb_request`
--

INSERT INTO `tb_request` (`request_id`, `request_url`, `request_querystring`, `request_statut`) VALUES
(1, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(2, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(3, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(4, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(5, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(6, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(7, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(8, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(9, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(10, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(11, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(12, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(13, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(14, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(15, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(16, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(17, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(18, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(19, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(20, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(21, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(22, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(23, 'http://webapp.test/password/eventually.ogg', 'password/eventually.ogg', 'BROUILLON'),
(24, 'http://webapp.test/password/eventually.mp3', 'password/eventually.mp3', 'BROUILLON'),
(25, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(26, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(27, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(28, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(29, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(30, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(31, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(32, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(33, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(34, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(35, 'http://webapp.test/css/select2x2.png', 'css/select2x2.png', 'BROUILLON'),
(36, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(37, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(38, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(39, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(40, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(41, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(42, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(43, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(44, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(45, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(46, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(47, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(48, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(49, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(50, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(51, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(52, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(53, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(54, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(55, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(56, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(57, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(58, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(59, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(60, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(61, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(62, 'http://webapp.test/presence', 'presence', 'BROUILLON'),
(63, 'http://webapp.test/presence', 'presence', 'BROUILLON'),
(64, 'http://webapp.test/participant', 'participant', 'BROUILLON'),
(65, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(66, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(67, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(68, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(69, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(70, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(71, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(72, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(73, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(74, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(75, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(76, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(77, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(78, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(79, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(80, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(81, 'http://webapp.test/list-participant', 'list-participant', 'BROUILLON'),
(82, 'http://webapp.test/list-participant', 'list-participant', 'BROUILLON'),
(83, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
(84, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
(85, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
(86, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
(87, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
(88, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(89, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(90, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(91, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(92, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(93, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(94, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(95, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(96, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(97, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(98, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(99, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(100, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(101, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(102, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(103, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(104, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(105, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(106, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(107, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(108, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(109, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(110, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(111, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(112, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(113, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(114, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(115, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(116, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(117, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(118, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(119, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(120, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(121, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(122, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(123, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(124, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(125, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(126, 'http://webapp.test/particpants/1', 'particpants/1', 'BROUILLON'),
(127, 'http://webapp.test/particpants/1', 'particpants/1', 'BROUILLON'),
(128, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(129, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(130, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(131, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(132, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(133, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(134, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(135, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(136, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(137, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(138, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(139, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(140, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(141, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(142, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(143, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(144, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(145, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(146, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(147, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(148, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(149, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(150, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(151, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(152, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(153, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(154, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(155, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(156, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(157, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(158, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(159, 'http://webapp.test/participant/5', 'participant/5', 'BROUILLON'),
(160, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(161, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(162, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
(163, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(164, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(165, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(166, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(167, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
(168, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
(169, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
(170, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
(171, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
(172, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
(173, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(174, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(175, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(176, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(177, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(178, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(179, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(180, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(181, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(182, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(183, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(184, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(185, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(186, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(187, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(188, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(189, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(190, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(191, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(192, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(193, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(194, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(195, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(196, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(197, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(198, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(199, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(200, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(201, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(202, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
(203, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(204, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(205, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(206, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(207, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(208, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(209, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(210, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(211, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(212, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(213, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(214, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(215, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(216, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(217, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(218, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(219, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(220, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(221, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(222, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(223, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(224, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(225, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(226, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(227, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(228, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(229, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(230, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(231, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(232, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(233, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(234, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(235, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(236, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(237, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(238, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(239, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(240, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(241, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(242, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(243, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(244, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(245, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(246, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(247, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(248, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(249, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(250, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(251, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(252, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(253, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(254, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(255, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(256, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(257, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(258, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(259, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(260, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(261, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(262, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(263, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(264, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(265, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(266, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(267, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(268, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(269, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(270, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(271, 'http://webapp.test/admin', 'admin', 'BROUILLON'),
(272, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(273, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(274, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(275, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(276, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(277, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(278, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(279, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(280, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(281, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(282, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(283, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(284, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(285, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(286, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(287, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(288, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(289, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(290, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(291, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(292, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(293, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(294, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(295, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(296, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(297, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(298, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(299, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
(300, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(301, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(302, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(303, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(304, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(305, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(306, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(307, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(308, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(309, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(310, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(311, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(312, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(313, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(314, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(315, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(316, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(317, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(318, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(319, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(320, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(321, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(322, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(323, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(324, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(325, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(326, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(327, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(328, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(329, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(330, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(331, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
(332, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(333, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(334, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(335, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(336, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(337, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(338, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(339, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(340, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(341, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(342, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(343, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(344, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(345, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(346, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(347, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(348, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(349, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(350, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(351, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(352, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(353, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(354, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(355, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(356, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(357, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(358, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(359, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(360, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(361, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(362, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(363, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(364, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(365, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(366, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(367, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(368, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(369, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(370, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(371, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
(372, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(373, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(374, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(375, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(376, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(377, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(378, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(379, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(380, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(381, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(382, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(383, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(384, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(385, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(386, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(387, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(388, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(389, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(390, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(391, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(392, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(393, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(394, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(395, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(396, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(397, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(398, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(399, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(400, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(401, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(402, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(403, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(404, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(405, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(406, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(407, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(408, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(409, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(410, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(411, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(412, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
(413, 'http://localhost/webapp', 'webapp', 'BROUILLON'),
(414, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
(415, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
(416, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
(417, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
(418, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON');
INSERT INTO `tb_request` (`request_id`, `request_url`, `request_querystring`, `request_statut`) VALUES
(419, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(420, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(421, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(422, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(423, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(424, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(425, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(426, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(427, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(428, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(429, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(430, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(431, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(432, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(433, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(434, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(435, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(436, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(437, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(438, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(439, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(440, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(441, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(442, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(443, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(444, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
(445, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(446, 'http://localhost/dipdip.fr/ecommerce-admin/login', 'dipdip.fr/ecommerce-admin/login', 'BROUILLON'),
(447, 'http://dipdip.fr.com/ecommerce-admin', 'ecommerce-admin', 'BROUILLON'),
(448, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(449, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(450, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(451, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(452, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(453, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(454, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(455, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(456, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(457, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(458, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(459, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(460, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(461, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(462, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(463, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(464, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(465, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(466, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(467, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(468, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(469, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(470, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(471, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(472, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(473, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(474, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
(475, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
(476, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(477, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(478, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
(479, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(480, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(481, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(482, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
(483, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(484, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(485, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(486, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(487, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(488, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(489, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(490, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(491, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(492, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(493, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(494, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(495, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(496, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(497, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(498, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(499, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(500, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(501, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(502, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(503, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(504, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(505, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(506, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(507, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(508, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(509, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(510, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(511, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(512, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(513, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(514, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(515, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(516, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(517, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(518, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(519, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(520, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(521, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(522, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(523, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(524, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(525, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
(526, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(527, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(528, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(529, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(530, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(531, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(532, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(533, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(534, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(535, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
(536, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(537, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
(538, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
(539, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(540, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(541, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(542, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(543, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
(544, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(545, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
(546, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
(547, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
(548, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(549, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(550, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
(551, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON');

-- --------------------------------------------------------

--
-- Structure de la table `tb_service`
--

CREATE TABLE `tb_service` (
  `service_id` int(11) NOT NULL,
  `direction_id` int(11) DEFAULT 0,
  `service_nom` varchar(255) DEFAULT NULL,
  `service_libelle_imputation` varchar(255) DEFAULT NULL,
  `service_numero_ordre_imputation_dg` int(11) DEFAULT NULL,
  `service_statut_autorisation_imputation_dg` enum('AUTORISE','NON AUTORISE') DEFAULT 'NON AUTORISE',
  `service_statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Ex : Bureau urbain, antenne de san pédro, Siège, etc.';

-- --------------------------------------------------------

--
-- Structure de la table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(11) NOT NULL DEFAULT 2,
  `service_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `categorie_personnel_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `type_personnel_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `equipe_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `bureauID` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `civilite` enum('M.','Mme','Mlle') DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `adresse_email` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_derniere_connexion` varchar(255) DEFAULT NULL,
  `date_derniere_connexion` datetime DEFAULT NULL,
  `statut_connexion` enum('CONNECTE','DECONNECTE') DEFAULT 'DECONNECTE',
  `statut_signature` varchar(50) DEFAULT NULL,
  `statut` enum('VALIDE','SUPPRIME') DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tb_users`
--

INSERT INTO `tb_users` (`id`, `profil_id`, `service_id`, `categorie_personnel_id`, `type_personnel_id`, `equipe_id`, `bureauID`, `nom`, `prenoms`, `civilite`, `date_naissance`, `telephone`, `matricule`, `photo`, `adresse_email`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `ip_derniere_connexion`, `date_derniere_connexion`, `statut_connexion`, `statut_signature`, `statut`) VALUES
(2, 1, 1, 4, 1, 0, 0, 'ACHY', 'CHRISTIAN', 'M.', '2020-06-06', '0151215087', NULL, 'ph2_1624290376317IMG_20210607_164641.jpg', '', 'christian', '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', '5zbu9spPXykjJl1pJ1JH2N0owePe25y6j3AZMpOw9PpsJmIp2qLXoW0KNpR9', '2021-03-09 23:00:00', '2021-07-05 06:30:52', '127.0.0.1', '2021-07-05 08:30:52', 'CONNECTE', NULL, 'VALIDE'),
(1, 1, 1, 1, 1, 0, 0, 'KOUASSI', 'RICHMOND', 'M.', '2020-06-06', '0708031746', NULL, 'ph1_1620901561048ph4_1615373851975135160607_10164592007005223_8140133135769055267_o.jpg', '', 'richmond', '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'vHJAQr7VNsaXkTTiwfMiPniaA5xYS80VBOPuhWX7g1rh596D2PyqMLScId5k', '2021-03-09 23:00:00', '2021-07-26 15:12:12', '127.0.0.1', '2021-07-26 17:12:12', 'CONNECTE', NULL, 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `type_classement`
--

CREATE TABLE `type_classement` (
  `type_classement_id` int(11) NOT NULL,
  `type_classement_libelle` varchar(255) NOT NULL,
  `type_classement_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `type_classement`
--

INSERT INTO `type_classement` (`type_classement_id`, `type_classement_libelle`, `type_classement_statut`) VALUES
(1, 'Type classement 1', 'VALIDE'),
(2, 'Type classement 2', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(11) NOT NULL DEFAULT 2,
  `nom` varchar(25) DEFAULT NULL,
  `prenoms` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `adresse_email` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `code_postal` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `pays_origine_id` int(11) DEFAULT NULL,
  `pays_residence_id` int(11) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `lang_code` enum('fr','en') DEFAULT 'fr',
  `lang_libelle` enum('Français','Anglais') DEFAULT 'Français',
  `devise` varchar(50) DEFAULT NULL,
  `total_points` int(11) DEFAULT 0,
  `total_points_test` int(11) DEFAULT 0,
  `total_points_duel` int(11) DEFAULT 0,
  `score_general` int(11) DEFAULT 0,
  `souscription` int(11) DEFAULT 0,
  `jocker_question` int(11) DEFAULT 0,
  `jocker_duel` int(11) DEFAULT 0,
  `jocker_jeu` int(11) DEFAULT 0,
  `money` float NOT NULL DEFAULT 0,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `api_token` varchar(100) DEFAULT NULL,
  `parrain` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statut` enum('VALIDE','SUPPRIME') DEFAULT 'VALIDE',
  `statut_abonnement` enum('ACTIVE','DESACTIVE') DEFAULT 'DESACTIVE',
  `statut_abonnement_chap` enum('ACTIVE','DESACTIVE') DEFAULT 'DESACTIVE',
  `statut_matrice` enum('Hors matrice','Dans') DEFAULT 'Hors matrice',
  `statut_connexion` enum('DECONNECTE','CONNECTE') DEFAULT 'DECONNECTE',
  `communaute` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `profil_id`, `nom`, `prenoms`, `sexe`, `date_naissance`, `telephone`, `adresse_email`, `pseudo`, `adresse`, `code_postal`, `ville`, `pays_origine_id`, `pays_residence_id`, `photo`, `lang_code`, `lang_libelle`, `devise`, `total_points`, `total_points_test`, `total_points_duel`, `score_general`, `souscription`, `jocker_question`, `jocker_duel`, `jocker_jeu`, `money`, `email`, `password`, `remember_token`, `api_token`, `parrain`, `created_at`, `updated_at`, `statut`, `statut_abonnement`, `statut_abonnement_chap`, `statut_matrice`, `statut_connexion`, `communaute`) VALUES
(1, 2, 'Kouassi', 'Armand', 'Masculin', '2017-07-04', '04783689', 'richmond@gmail.com', 'krak225', 'PO Box 198 Porto', NULL, 'Porto', 36, 175, '30.jpg', 'en', 'Anglais', 'EUR', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'krak225', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'A6sUiQhGzoupBKizNzgP1luoZWPAzzRAyEE9o72W9PH8HXeNCbHgWi7BIxSO', NULL, 'bacouly', '2018-07-14 13:56:34', '2018-09-09 12:13:18', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', 'Génies'),
(2, 2, 'Gué', 'Dako Maryse', 'Feminin', '2018-07-14', '56152799', 'maryse@gmail.com', 'angela', 'BP 1038 Paris', NULL, 'Paris', 18, 10, 'images_020.png', NULL, 'Français', 'FCFA', 0, 0, 0, 0, 1, 5, 3, 0, 300, 'angela', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'tcwhajdlHVqACGxFqeBdCcJqoW1HCXPm4g2v8HvhNwuU5qDPjaK3rp5KVNxI', NULL, NULL, '2018-07-08 19:23:14', '2019-11-26 16:09:30', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'DECONNECTE', 'Pro'),
(3, 2, 'Coulibaly', 'Bakary', 'Masculin', '2018-07-14', '04000000', 'bakary@gmail.com', 'bakouly', 'PO Box 218 NY', NULL, 'New York', 18, 18, 'images_175.jpg', 'en', 'Anglais', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'bakouly', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'ME2E7j8DMjsvhnJd9xXZOGlFSbXMXdz8faMbefhAOWTahvk8THVZ043UZmrN', NULL, NULL, '2018-06-16 09:30:55', '2018-12-22 15:39:52', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(5, 2, 'KOUASSI', 'RICHMOND', 'Masculin', '2018-02-06', '033928442', 'krak225@gmail.com', 'richmond', NULL, NULL, 'Andore', 1, 6, 'images_094.jpg', 'fr', 'Français', 'FCFA', 0, 500, 50, 0, 4, 5, 3, 0, 459900, 'richmond', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'YKU2O3H3fNW5H5zz2xQkjs0MVnQgdkpusuEnLkRMk84LiivashT4tPmrg0zK', 'xia7skQcMJBa9LKcSm9zOZwFJ3a5wV7SxGbShht7GOVSffRtUv1idOODQKpB', NULL, '2019-03-08 21:31:43', '2023-04-17 07:02:34', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'CONNECTE', 'Pro'),
(6, 2, 'N\'goran', 'Kouadio Honoré', 'Masculin', '1992-01-01', '04828923', 'ngoran@yahoo.fr', 'ngoran', NULL, NULL, 'Kinshassa', 51, 51, 'Copie de 1.jpg', 'en', 'Anglais', 'FCFA', 0, 0, 0, 0, 1, 0, 0, 0, 100, 'ngoran', '$2y$10$OONvHBW0r3kaKL1XtKOC0ObSCPeiRESMRZJwF9lQVYd/fuXbHc6SW', 'dHmgfRyG1cZ8C2HU0aANHJLU43i7zvACuYAt62QwIvo7ILgfd5nARMXiR6MF', NULL, NULL, '2019-03-14 21:04:44', '2019-11-26 17:00:09', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'DECONNECTE', 'Pro'),
(7, 2, 'Koffi', 'Marius', NULL, NULL, '04512451', 'jeu.christian@outlook.fr', 'marius', NULL, NULL, 'Paris', NULL, 75, NULL, 'fr', 'Français', 'EUR', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'marius', '$2y$10$DcWjkhlPBrz/w3xYEEMB0OPBpxfj.AulGZ.toq/hUAe2NrsvaRN16', 'r5h8Pd72IHqHzNwFU1KY70upgJ4S9ZISlHreCeKpiq0yz6cZhCgsVcHM4m31', NULL, NULL, '2019-11-12 13:14:13', '2019-11-12 13:14:13', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(8, 2, 'Achy', 'christian', NULL, NULL, '0244545', 'christian@yahoo.fr', 'mariam', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'mariam', '$2y$10$K.1J8HfjN8nGttBnDce5wOG7CLpBBDZWyXSrJ3CKPCHbujyvW9a7.', 'WS1meMXXDTuABeTfIdr63Xm281AgRp1cQctTZy8pqi3Y3Twb2ng6BVUNDmDc', NULL, NULL, '2019-11-12 13:37:44', '2019-11-12 13:38:36', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(9, 2, 'ATTOUNGBRE', 'KOUAKOU JULES', NULL, NULL, '01010101', 'attoungbre@yahoo.fr', 'attoungbre', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'attoungbre', '$2y$10$jMKdRV2tVJxH0nzOc9.zzu1vueAdAh6818ZabGeZYFBIwBkFtl/46', NULL, NULL, NULL, '2019-11-12 13:40:38', '2019-11-12 14:08:06', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(10, 1, 'Administrateur', '', NULL, NULL, NULL, NULL, 'administrateur', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(11, 2, NULL, NULL, NULL, NULL, '04512451', NULL, 'mariam2', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'mariam2', '$2y$10$f/VWakGQwxrcE7Y9jsYCaeQvAFfO0pohdcRYdoLntbrB7aENvt0jK', 'ykMWTmrTWsvtsBpV9Ujhm6RgmxfIr3sXs3ND0VQMe7hiJu2fkZASUfiNRsX2', NULL, NULL, '2019-11-25 15:34:19', '2019-11-25 15:34:19', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(12, 2, NULL, NULL, NULL, NULL, '01010101', NULL, 'krak', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'krak', '$2y$10$dOZ8eKTUsxL6vvPb4GVKu.TtN/uDhVzhdWrk1QSTm4e2zCRvUzSdG', 'yWhzAKJzY9oG1w1z1GjDIsLSLdXoft0i8x2j5w616TnNBskrb8eWa5KE4Bx5', NULL, NULL, '2019-11-25 15:35:09', '2019-11-25 15:35:09', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(13, 2, NULL, NULL, NULL, NULL, '01244545', NULL, 'fondio', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 3, 0, 900, 'fondio', '$2y$10$3C6CovblE.tyTK3Rmx28cuHVaVcm7YZzfKcj6d6pp73RFLCUaWv6u', 'EGA1sPmPtBqoTkVeDoIA8ie8wuTuQO3g2pzPoN8MIEisAZqwZbKlo6Ld1seu', NULL, NULL, '2019-11-25 15:36:25', '2019-11-25 16:00:00', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(14, 1, 'Administrateur', NULL, NULL, '0000-00-00', '08779408', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 5, 0, 0, 0, 400, 'administrateur', '$2y$10$lFR39tqpJopl28Jo5NilI.29Te3sPINzApu2hAXXIyzBe2O1NSHvO', 'DtCpEaly7sTjy4v14ZTuGeMB6XmlQCLFpWzmYTy2nn20xq4WrmEpUv9TGmTu', NULL, NULL, '2019-11-26 14:03:57', '2019-11-26 14:56:42', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
(15, 2, NULL, NULL, NULL, NULL, '0748569061', NULL, 'fabrice', NULL, NULL, NULL, NULL, NULL, NULL, 'fr', 'Français', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 800, 'fabrice', '$2y$10$6RIlwDqbePl82F983vCJY..c6qYz6tlG4GnS5/.7WXMIgjrbnC6zy', NULL, 'hywgZs8z8wdTK2fQ5CzQDCkC0EfooHyvAdzeKx4lWg0EbXMszE3y3C0ZqXaF', NULL, '2022-03-05 00:52:35', '2022-03-05 01:50:59', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'CONNECTE', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`abonnement_id`);

--
-- Index pour la table `abonnement_chap`
--
ALTER TABLE `abonnement_chap`
  ADD PRIMARY KEY (`abonnement_chap_id`);

--
-- Index pour la table `avatar`
--
ALTER TABLE `avatar`
  ADD KEY `Index 1` (`id`);

--
-- Index pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  ADD PRIMARY KEY (`cagnotte_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`),
  ADD UNIQUE KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `chap`
--
ALTER TABLE `chap`
  ADD PRIMARY KEY (`chap_id`);

--
-- Index pour la table `defi`
--
ALTER TABLE `defi`
  ADD PRIMARY KEY (`defi_id`);

--
-- Index pour la table `depot`
--
ALTER TABLE `depot`
  ADD KEY `Index 1` (`depot_id`);

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`devise_id`),
  ADD UNIQUE KEY `money_id` (`devise_id`);

--
-- Index pour la table `duel`
--
ALTER TABLE `duel`
  ADD PRIMARY KEY (`duel_id`);

--
-- Index pour la table `duel_question`
--
ALTER TABLE `duel_question`
  ADD PRIMARY KEY (`duel_question_id`);

--
-- Index pour la table `entrainement`
--
ALTER TABLE `entrainement`
  ADD PRIMARY KEY (`entrainement_id`);

--
-- Index pour la table `jockerquestion`
--
ALTER TABLE `jockerquestion`
  ADD KEY `Index 1` (`jockerquestion_id`);

--
-- Index pour la table `kw_administrateur`
--
ALTER TABLE `kw_administrateur`
  ADD PRIMARY KEY (`kw_administrateur_id`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`langue_id`),
  ADD UNIQUE KEY `langue_id` (`langue_id`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`niveau_id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`pays_id`),
  ADD UNIQUE KEY `alpha2` (`pays_alpha2`),
  ADD UNIQUE KEY `alpha3` (`pays_alpha3`),
  ADD UNIQUE KEY `code_unique` (`pays_code`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`) USING BTREE;

--
-- Index pour la table `recompense`
--
ALTER TABLE `recompense`
  ADD PRIMARY KEY (`recompense_id`);

--
-- Index pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD PRIMARY KEY (`retrait_id`);

--
-- Index pour la table `souscription`
--
ALTER TABLE `souscription`
  ADD PRIMARY KEY (`souscription_id`),
  ADD UNIQUE KEY `id_souscription` (`souscription_id`),
  ADD KEY `users_id` (`user_id`);

--
-- Index pour la table `tb_password_resets`
--
ALTER TABLE `tb_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`profil_id`);

--
-- Index pour la table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Index pour la table `tb_service`
--
ALTER TABLE `tb_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Index pour la table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `type_classement`
--
ALTER TABLE `type_classement`
  ADD PRIMARY KEY (`type_classement_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `abonnement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `abonnement_chap`
--
ALTER TABLE `abonnement_chap`
  MODIFY `abonnement_chap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  MODIFY `cagnotte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `chap`
--
ALTER TABLE `chap`
  MODIFY `chap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `defi`
--
ALTER TABLE `defi`
  MODIFY `defi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `depot`
--
ALTER TABLE `depot`
  MODIFY `depot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `devise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `duel`
--
ALTER TABLE `duel`
  MODIFY `duel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `duel_question`
--
ALTER TABLE `duel_question`
  MODIFY `duel_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `entrainement`
--
ALTER TABLE `entrainement`
  MODIFY `entrainement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `jockerquestion`
--
ALTER TABLE `jockerquestion`
  MODIFY `jockerquestion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `kw_administrateur`
--
ALTER TABLE `kw_administrateur`
  MODIFY `kw_administrateur_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `langue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `niveau_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `pays_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recompense`
--
ALTER TABLE `recompense`
  MODIFY `recompense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `retrait`
--
ALTER TABLE `retrait`
  MODIFY `retrait_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `souscription`
--
ALTER TABLE `souscription`
  MODIFY `souscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- AUTO_INCREMENT pour la table `tb_service`
--
ALTER TABLE `tb_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_classement`
--
ALTER TABLE `type_classement`
  MODIFY `type_classement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
