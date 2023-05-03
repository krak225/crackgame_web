-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 02 Janvier 2018 à 21:12
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `vmsoft_db2`
--

-- --------------------------------------------------------

--
-- Structure de la table `cadeaudistribue`
--

CREATE TABLE IF NOT EXISTS `cadeaudistribue` (
  `AK_CADEAUDISTRIBUE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_VISITE_ID` int(11) NOT NULL,
  `AK_CADEAU_LIBELLE` varchar(255) NOT NULL,
  `AK_CADEAU_TYPE` varchar(255) NOT NULL,
  PRIMARY KEY (`AK_CADEAUDISTRIBUE_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `cadeaudistribue`
--

INSERT INTO `cadeaudistribue` (`AK_CADEAUDISTRIBUE_ID`, `AK_VISITE_ID`, `AK_CADEAU_LIBELLE`, `AK_CADEAU_TYPE`) VALUES
(1, 75, 'Un stylo de luxe', 'GADGET'),
(2, 69, '1 platquette de 12 gelulles', 'ECHANTILLON'),
(3, 51, 'Un calendrier 2018', 'GADGET'),
(4, 51, '2 flacon de sirop 300ml', 'ECHANTILLON'),
(5, 69, 'Un T-shirt ', 'GADGET'),
(6, 71, 'cgh', 'GADGET'),
(21, 71, 'zg dhh vdj', 'GADGET'),
(19, 59, 'gzyhcnhi', 'ECHANTILLON'),
(20, 59, 'gjk bju', 'ECHANTILLON'),
(17, 59, 'hhhhk. kg', 'GADGET'),
(11, 74, 'Flacon de doliparne siro', 'ECHANTILLON'),
(12, 74, '300mg de paracÃ©tamol', 'GADGET'),
(16, 74, 'Un calendrier 2018', 'GADGET'),
(29, 69, 'ryd kifs uzefvnky viht ', 'ECHANTILLON'),
(23, 63, 'vwb sksk sksbs bkzh ks', 'ECHANTILLON'),
(24, 63, 'g sjqk skoq nwjdj ak', 'AUTRES'),
(25, 63, 'hdvdks kzj izhbbzi kzh zj', 'GADGET'),
(26, 63, 'fjxbh gsx bjge. nku CZ agj kkv', 'ECHANTILLON'),
(28, 49, 'hfgxvx GG bgkv. xd', 'ECHANTILLON'),
(30, 69, 'fjc kcjg ddfk', 'GADGET'),
(31, 52, 'GD kgj bsgv', 'AUTRES'),
(32, 52, 'djv jgjhu nos usj ', 'ECHANTILLON');

-- --------------------------------------------------------

--
-- Structure de la table `famille_produit`
--

CREATE TABLE IF NOT EXISTS `famille_produit` (
  `FAMILLE_PRODUIT_ID` int(11) NOT NULL,
  `FAMILLE_PRODUIT_LIBELLE` int(11) NOT NULL,
  `FAMILLE_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `hopitals`
--

CREATE TABLE IF NOT EXISTS `hopitals` (
  `AK_CENTRE_MEDICAL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_CENTRE_MEDICAL_RAISON_SOCIALE` varchar(255) NOT NULL,
  `AK_CENTRE_MEDICAL_REPRESENTANT_NOM_PRENOMS` varchar(255) NOT NULL,
  `AK_CENTRE_MEDICAL_REPRESENTANT_TELEPHONE_BUREAU` varchar(25) NOT NULL,
  `AK_CENTRE_MEDICAL_REPRESENTANT_TELEPHONE_MOBILE` varchar(50) NOT NULL,
  `AK_CENTRE_MEDICAL_REPRESENTANT_EMAIL` varchar(50) NOT NULL,
  `AK_CENTRE_MEDICAL_LOCALISATION` varchar(255) NOT NULL,
  `AK_CENTRE_MEDICAL_LATITUDE` float NOT NULL,
  `AK_CENTRE_MEDICAL_LONGITUDE` int(11) NOT NULL,
  `AK_CENTRE_MEDICAL_STATUT` enum('BROUILLLON','VALIDE') NOT NULL,
  PRIMARY KEY (`AK_CENTRE_MEDICAL_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Contenu de la table `hopitals`
--

INSERT INTO `hopitals` (`AK_CENTRE_MEDICAL_ID`, `AK_CENTRE_MEDICAL_RAISON_SOCIALE`, `AK_CENTRE_MEDICAL_REPRESENTANT_NOM_PRENOMS`, `AK_CENTRE_MEDICAL_REPRESENTANT_TELEPHONE_BUREAU`, `AK_CENTRE_MEDICAL_REPRESENTANT_TELEPHONE_MOBILE`, `AK_CENTRE_MEDICAL_REPRESENTANT_EMAIL`, `AK_CENTRE_MEDICAL_LOCALISATION`, `AK_CENTRE_MEDICAL_LATITUDE`, `AK_CENTRE_MEDICAL_LONGITUDE`, `AK_CENTRE_MEDICAL_STATUT`) VALUES
(2, 'CENTRE MEDICALE LE GRAND CENTRE', '', '', '08392271', '', 'Yopougon Niangon Canal', 0, 0, 'BROUILLLON'),
(4, 'PHARMACIE LES ELYSEES', '', '', '08632612', '', 'Yopougon Ananeraie', 0, 0, 'BROUILLLON'),
(3, 'Polyclinique des 2 Plateaux', 'Dr Konan', '', '02883201', '', 'Cocody 2 Plateaux', 0, 0, 'VALIDE'),
(1, 'CLINIQUE STE RITA', '', '', '07371600', '', 'Yopougon Niangon Nord', 0, 0, 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE IF NOT EXISTS `medecins` (
  `AK_MEDECIN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_SPECIALITE_ID` int(11) NOT NULL DEFAULT '0',
  `AK_MEDECIN_MATRICULE` varchar(25) DEFAULT NULL,
  `AK_MEDECIN_NOM` varchar(50) DEFAULT NULL,
  `AK_MEDECIN_PRENOMS` varchar(255) DEFAULT NULL,
  `AK_MEDECIN_PHOTO` varchar(255) DEFAULT NULL,
  `AK_MEDECIN_TELEPHONE` varchar(255) DEFAULT NULL,
  `AK_MEDECIN_EMAIL` varchar(50) DEFAULT NULL,
  `AK_MEDECIN_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`AK_MEDECIN_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Contenu de la table `medecins`
--

INSERT INTO `medecins` (`AK_MEDECIN_ID`, `AK_SPECIALITE_ID`, `AK_MEDECIN_MATRICULE`, `AK_MEDECIN_NOM`, `AK_MEDECIN_PRENOMS`, `AK_MEDECIN_PHOTO`, `AK_MEDECIN_TELEPHONE`, `AK_MEDECIN_EMAIL`, `AK_MEDECIN_STATUT`) VALUES
(1, 1, 'DR1', 'Dr KONE', 'MARIAM', '2-min.jpg', '09324424', 'mariam.kone@gmail.com', 'VALIDE'),
(2, 3, 'DR2', 'Dr N''GORAN', 'AMOIN ISABELLE', '1-min.jpg', '03221981', 'isabelle.ngoran@gmail.com', 'VALIDE'),
(3, 2, 'DR3', 'Dr KOUASSI', 'YAO DESIRE', '1-min.jpg', '03221981', 'desire.kouassi@gmail.com', 'VALIDE'),
(4, 2, 'DR4', 'Dr KONAN', 'MATTHIEU', '1-min.jpg', '03221981', 'matthieu.konan@gmail.com', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `AK_PRODUIT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FAMILLE_PRODUIT_ID` int(11) NOT NULL,
  `AK_PRODUIT_CODE` varchar(50) NOT NULL,
  `AK_PRODUIT_NOM` varchar(50) NOT NULL,
  `AK_PRODUIT_NOM_SCIENTIFIQUE` varchar(255) NOT NULL,
  `AK_PRODUIT_PRIX` float NOT NULL,
  `AK_PRODUIT_DATE_CREATION` datetime NOT NULL,
  `AK_PRODUIT_DATE_MODIFICATION` datetime NOT NULL,
  `AK_PRODUIT_DATE_SUPRESSION` datetime NOT NULL,
  PRIMARY KEY (`AK_PRODUIT_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`AK_PRODUIT_ID`, `FAMILLE_PRODUIT_ID`, `AK_PRODUIT_CODE`, `AK_PRODUIT_NOM`, `AK_PRODUIT_NOM_SCIENTIFIQUE`, `AK_PRODUIT_PRIX`, `AK_PRODUIT_DATE_CREATION`, `AK_PRODUIT_DATE_MODIFICATION`, `AK_PRODUIT_DATE_SUPRESSION`) VALUES
(1, 1, 'P1', 'FEBRILEX', 'FEBRILEX', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'P2', 'ANTALGEX-T', 'ANTALGEX-T', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'P3', 'DOLIPRANE', '', 4770, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'P4', 'CARDURINE', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 'P5', 'EXXIB', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 3, 'P6', 'LETHAMOL', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 'P7', 'PARACETAMOL', '', 200, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 3, 'P8', 'LUFANTHER', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `produitspresentes`
--

CREATE TABLE IF NOT EXISTS `produitspresentes` (
  `AK_PRODUIT_ID` int(11) NOT NULL,
  `AK_VISITE_ID` int(11) NOT NULL,
  `AK_PRODUIT_PRESENTE_AVIS_EFFICACITE` varchar(20) NOT NULL,
  `AK_PRODUIT_PRESENTE_AVIS_TOLERANCE` varchar(20) NOT NULL,
  `AK_PRODUIT_PRESENTE_AVIS_OBSERVANCE` varchar(20) NOT NULL,
  `AK_PRODUIT_PRESENTE_AVIS_PRIX` varchar(20) NOT NULL,
  UNIQUE KEY `AK_PRODUIT_ID` (`AK_PRODUIT_ID`,`AK_VISITE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produitspresentes`
--

INSERT INTO `produitspresentes` (`AK_PRODUIT_ID`, `AK_VISITE_ID`, `AK_PRODUIT_PRESENTE_AVIS_EFFICACITE`, `AK_PRODUIT_PRESENTE_AVIS_TOLERANCE`, `AK_PRODUIT_PRESENTE_AVIS_OBSERVANCE`, `AK_PRODUIT_PRESENTE_AVIS_PRIX`) VALUES
(1, 67, 'Bon', 'moyen', 'assez-bon', 'pas bon'),
(2, 63, 'Bon', 'moyen', 'assez-bon', 'pas bon'),
(3, 57, 'Bon', 'pas bon', 'bon ', 'bon'),
(3, 58, 'Bon', 'pas bon', 'bon ', 'bon'),
(2, 65, 'Bon', 'bon', 'bon', 'bon'),
(0, 0, '', '', '', ''),
(7, 55, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(1, 55, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(1, 1, 'bon', 'bon', 'bon', 'bon'),
(5, 55, 'Assez-bon', 'Assez-bon', 'Assez-bon', 'Assez-bon'),
(7, 53, 'Moyen', 'Moyen', 'Moyen', 'Moyen'),
(5, 58, 'Pas bon', 'Bon', 'Pas bon', 'TrÃ¨s bon'),
(6, 66, 'TrÃ¨s bon', 'Bon', 'Assez-bon', 'Moyen'),
(8, 66, 'Bon', 'Bon', 'Pas bon', 'Moyen'),
(4, 66, 'Bon', 'Moyen', 'Moyen', 'Bon'),
(1, 66, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(2, 55, 'Pas bon', 'Bon', 'Assez-bon', 'Moyen'),
(6, 65, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(1, 65, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(5, 74, 'Moyen', 'Bon', 'Assez-bon', 'TrÃ¨s bon'),
(6, 53, 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon', 'TrÃ¨s bon'),
(7, 65, 'Assez-bon', 'Moyen', 'TrÃ¨s bon', 'Bon'),
(0, 69, '', '', '', ''),
(1, 56, 'Assez-bon', 'Moyen', 'Moyen', 'Assez-bon'),
(1, 74, 'Assez-bon', 'Moyen', 'Moyen', 'TrÃ¨s bon'),
(1, 69, 'Assez-bon', 'Pas bon', 'Moyen', 'TrÃ¨s bon'),
(5, 63, 'Assez-bon', 'TrÃ¨s bon', 'Assez-bon', 'Moyen'),
(1, 59, 'Assez-bon', 'TrÃ¨s bon', 'Assez-bon', 'Moyen'),
(1, 71, 'Assez-bon', 'TrÃ¨s bon', 'Bon', 'Assez-bon'),
(6, 71, 'Bon', 'Moyen', 'Moyen', 'Pas bon'),
(3, 69, 'Moyen', 'Bon', 'Bon', 'TrÃ¨s bon'),
(2, 69, 'Moyen', 'Assez-bon', 'TrÃ¨s bon', 'Moyen'),
(8, 69, 'Assez-bon', 'Moyen', 'TrÃ¨s bon', 'Moyen'),
(6, 69, 'Assez-bon', 'Bon', 'Assez-bon', 'Bon'),
(7, 69, 'Assez-bon', 'Bon', 'TrÃ¨s bon', 'Assez-bon');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `AK_PROFIL_UTILISATEUR_ID` int(11) NOT NULL,
  `AK_PROFIL_UTILISATEUR_LIBELLE` varchar(255) NOT NULL,
  `AK_PROFIL_UTILISATEUR_STATUT` enum('BROUILLLON','VALIDE') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`AK_PROFIL_UTILISATEUR_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`AK_PROFIL_UTILISATEUR_ID`, `AK_PROFIL_UTILISATEUR_LIBELLE`, `AK_PROFIL_UTILISATEUR_STATUT`) VALUES
(1, 'Administrateur', 'VALIDE'),
(2, 'Delegue medical', 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

CREATE TABLE IF NOT EXISTS `specialites` (
  `AK_SPECIALITE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_SPECIALITE_LIBELLE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AK_SPECIALITE_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `specialites`
--

INSERT INTO `specialites` (`AK_SPECIALITE_ID`, `AK_SPECIALITE_LIBELLE`) VALUES
(1, 'Medecine Generale'),
(2, 'Dermatologie'),
(3, 'Ophtamologie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Richmond Kouassi', 'krak225@gmail.com', '$2y$10$27DPy2ya1qv4Y3AB1e/vOeij4Kj8t./zv44hTnpLJI0AAO5IY0LCy', 'yiLw4xOlBpM04BnXjHVaPXz2xBJm7ZFN9eEn2SoyiPmeW5opARn6YNseEScW', '2017-12-01 08:03:55', '2017-12-01 08:03:55');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `AK_UTILISATEUR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_PROFIL_UTILISATEUR_ID` int(11) NOT NULL,
  `AK_UTILISATEUR_MATRICULE` varchar(25) NOT NULL,
  `AK_UTILISATEUR_NOM` varchar(50) NOT NULL,
  `AK_UTILISATEUR_PRENOMS` varchar(255) NOT NULL,
  `AK_UTILISATEUR_DATE_NAISSANCE` date NOT NULL,
  `AK_UTILISATEUR_PHOTO` varchar(100) NOT NULL,
  `AK_UTILISATEUR_LOGIN` varchar(50) NOT NULL,
  `AK_UTILISATEUR_PASSWORD` varchar(50) NOT NULL,
  `AK_UTILISATEUR_TELEPHONE` varchar(50) NOT NULL,
  `AK_UTILISATEUR_EMAIL` varchar(50) NOT NULL,
  `AK_UTILISATEUR_DATE_CREATION` datetime NOT NULL,
  `AK_UTILISATEUR_DATE_MODIFICATION` datetime NOT NULL,
  `AK_UTILISATEUR_DATE_SUPPRESSION` datetime NOT NULL,
  `AK_UTILISATEUR_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`AK_UTILISATEUR_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `visites`
--

CREATE TABLE IF NOT EXISTS `visites` (
  `AK_VISITE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AK_UTILISATEUR_ID` int(11) DEFAULT NULL,
  `AK_MEDECIN_ID` int(11) DEFAULT NULL,
  `AK_CENTRE_MEDICAL_ID` int(11) DEFAULT NULL,
  `AK_VISITE_DATE` datetime DEFAULT NULL,
  `AK_VISITE_HEURE` time DEFAULT NULL,
  `AK_VISITE_DATE_EXECUTION` datetime DEFAULT NULL,
  `AK_VISITE_STATUT` enum('PROGRAMMEE','EFFECTUEE','REPORTEE','ANNULEE','SUPPRIMEE') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`AK_VISITE_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=83 ;

--
-- Contenu de la table `visites`
--

INSERT INTO `visites` (`AK_VISITE_ID`, `AK_UTILISATEUR_ID`, `AK_MEDECIN_ID`, `AK_CENTRE_MEDICAL_ID`, `AK_VISITE_DATE`, `AK_VISITE_HEURE`, `AK_VISITE_DATE_EXECUTION`, `AK_VISITE_STATUT`, `created_at`, `updated_at`) VALUES
(55, 1, 2, 4, '2017-12-24 00:00:00', '10:00:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:33:12', '2017-12-24 10:33:12'),
(54, 1, 1, 4, '2017-12-24 00:00:00', '12:30:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:21:44', '2017-12-24 10:21:44'),
(53, 1, 3, 1, '2017-12-27 00:00:00', '11:00:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:20:30', '2017-12-24 10:20:30'),
(52, 1, 1, 3, '2017-12-30 00:00:00', '18:30:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:15:08', '2017-12-24 10:15:08'),
(51, 1, 4, 3, '2017-12-24 00:00:00', '18:10:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:10:38', '2017-12-24 10:10:38'),
(50, 1, 2, 3, '2017-12-24 00:00:00', '17:10:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:10:17', '2017-12-24 10:10:17'),
(49, 1, 2, 4, '2018-01-06 00:00:00', '17:30:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:03:12', '2017-12-24 10:03:12'),
(56, 1, 3, 4, '2017-12-09 00:00:00', '05:39:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:39:57', '2017-12-24 10:39:57'),
(57, 1, 4, 3, '2017-12-24 00:00:00', '10:41:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:41:32', '2017-12-24 10:41:32'),
(58, 1, 1, 4, '2017-12-24 00:00:00', '10:41:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:41:55', '2017-12-24 10:41:55'),
(59, 1, 1, 3, '2017-12-21 00:00:00', '05:30:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:48:26', '2017-12-24 10:48:26'),
(60, 1, 4, 4, '2018-01-06 00:00:00', '17:48:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 10:48:51', '2017-12-24 10:48:51'),
(61, 1, 1, 0, '2017-12-24 00:00:00', '00:00:00', '0000-00-00 00:00:00', 'PROGRAMMEE', '2017-12-24 10:49:14', '2017-12-24 10:49:14'),
(62, 1, 1, 0, '2017-12-24 00:00:00', '00:00:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 11:29:44', '2017-12-24 11:29:44'),
(63, 1, 3, 1, '2017-12-24 00:00:00', '11:29:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 11:30:02', '2017-12-24 11:30:02'),
(64, 1, 2, 4, '2017-12-24 00:00:00', '17:53:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 17:53:03', '2017-12-24 17:53:03'),
(65, 1, 3, 3, '2017-12-24 00:00:00', '17:53:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 17:53:27', '2017-12-24 17:53:27'),
(66, 1, 2, 1, '2017-12-24 00:00:00', '21:04:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-24 21:04:30', '2017-12-24 21:04:30'),
(67, 1, 3, 1, '2017-12-25 00:00:00', '13:02:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-25 13:03:00', '2017-12-25 13:03:00'),
(68, 1, 3, 4, '2017-12-25 00:00:00', '14:49:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-25 14:49:12', '2017-12-25 14:49:12'),
(69, 1, 1, 2, '2017-12-25 00:00:00', '15:11:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-25 15:11:25', '2017-12-25 15:11:25'),
(71, 1, 1, 2, '2017-12-25 00:00:00', '15:57:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-25 15:57:25', '2017-12-25 15:57:25'),
(82, 1, 1, 2, '2018-01-26 00:00:00', '05:08:00', '0000-00-00 00:00:00', 'PROGRAMMEE', '2018-01-02 21:08:10', '2018-01-02 21:08:10'),
(74, 1, 1, 2, '2017-12-26 00:00:00', '02:53:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-26 02:54:00', '2017-12-26 02:54:00'),
(75, 1, 3, 2, '2017-12-26 00:00:00', '20:37:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-26 20:37:47', '2017-12-26 20:37:47'),
(76, 1, 1, 2, '2017-12-30 00:00:00', '00:03:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-27 00:03:59', '2017-12-27 00:03:59'),
(77, 1, 1, 2, '2017-12-31 00:00:00', '19:00:00', '0000-00-00 00:00:00', 'EFFECTUEE', '2017-12-31 20:00:16', '2017-12-31 20:00:16'),
(79, 1, 3, 1, '2018-01-01 00:00:00', '10:13:00', '0000-00-00 00:00:00', 'PROGRAMMEE', '2018-01-01 11:12:59', '2018-01-01 11:12:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
