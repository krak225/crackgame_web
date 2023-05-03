-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.2.3-MariaDB-log - mariadb.org binary distribution
-- SE du serveur:                Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table jeu_db. abonnement
CREATE TABLE IF NOT EXISTS `abonnement` (
  `abonnement_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type_jeu` varchar(50) DEFAULT NULL,
  `abonnement_date` datetime DEFAULT NULL,
  `abonnement_statut` enum('EN COURS','EXPIRE') DEFAULT 'EN COURS',
  PRIMARY KEY (`abonnement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.abonnement : 1 rows
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
INSERT INTO `abonnement` (`abonnement_id`, `user_id`, `type_jeu`, `abonnement_date`, `abonnement_statut`) VALUES
	(1, 5, 'DUEL', '2019-11-24 21:56:35', 'EN COURS');
/*!40000 ALTER TABLE `abonnement` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. avatar
CREATE TABLE IF NOT EXISTS `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(50) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.avatar : 0 rows
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;

-- Export de la structure de la vue jeu_db. cagnotte
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `cagnotte` (
	`cagnotte_id` INT(11) NOT NULL,
	`cagnotte_montant` INT(11) NULL,
	`cagnotte_date` DATE NULL,
	`cagnotte_date_creation` DATETIME NULL
) ENGINE=MyISAM;

-- Export de la structure de la table jeu_db. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_libelle` varchar(100) DEFAULT NULL,
  `categorie_description` varchar(100) DEFAULT NULL,
  `categorie_statut` enum('BROUILLON','VALIDE') DEFAULT 'VALIDE',
  PRIMARY KEY (`categorie_id`),
  UNIQUE KEY `categorie_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 PACK_KEYS=0 ROW_FORMAT=COMPACT;

-- Export de données de la table jeu_db.categorie : 6 rows
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`categorie_id`, `categorie_libelle`, `categorie_description`, `categorie_statut`) VALUES
	(1, 'Medecine', 'DÃ©couvrez la mÃ©dÃ©cine dans toutes ses facettes', 'VALIDE'),
	(2, 'Histoire-Geographie', 'Voyagez Ã  travers le temps et le monde', 'VALIDE'),
	(3, 'Informatique', 'Entrez dans un monde binaire', 'VALIDE'),
	(4, 'RÃ©ligion', 'DÃ©couvrez les rÃ©ligions du monde', 'VALIDE'),
	(5, 'Sport', 'DÃ©couvrez toutes les infos sportifs', 'VALIDE'),
	(6, 'LittÃ©rature', 'Testez vos connaissance en littÃ©rature', 'VALIDE');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. chap
CREATE TABLE IF NOT EXISTS `chap` (
  `chap_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `chap_participants` int(11) DEFAULT NULL,
  `chap_vainqueur_id` int(11) DEFAULT NULL,
  `chap_etape` int(11) DEFAULT NULL,
  `chap_date_creation` datetime DEFAULT NULL,
  `chap_statut` enum('BROUILLON','VALIDE','EN COURS','TERMINE') DEFAULT 'VALIDE',
  PRIMARY KEY (`chap_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.chap : 1 rows
/*!40000 ALTER TABLE `chap` DISABLE KEYS */;
INSERT INTO `chap` (`chap_id`, `user_id`, `chap_participants`, `chap_vainqueur_id`, `chap_etape`, `chap_date_creation`, `chap_statut`) VALUES
	(6, 1, 0, NULL, 1, '2019-09-08 21:09:40', 'EN COURS');
/*!40000 ALTER TABLE `chap` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. chap_question
CREATE TABLE IF NOT EXISTS `chap_question` (
  `chap_id` int(11) DEFAULT 1,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `repondeur_id` int(11) DEFAULT NULL,
  `reponse` varchar(2) DEFAULT NULL,
  `observation` varchar(50) DEFAULT NULL,
  `statut` enum('UTILISE','DISPONIBLE') DEFAULT 'DISPONIBLE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.chap_question : 58 rows
/*!40000 ALTER TABLE `chap_question` DISABLE KEYS */;
INSERT INTO `chap_question` (`chap_id`, `question_id`, `user_id`, `repondeur_id`, `reponse`, `observation`, `statut`) VALUES
	(1, 13, 5, 5, 'C', 'good', 'UTILISE'),
	(1, 15, 5, 5, 'C', 'good', 'UTILISE'),
	(1, 16, 5, 5, 'B', 'good', 'UTILISE'),
	(1, 17, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(1, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(1, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(1, 31, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(1, 32, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 13, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 15, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 16, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 17, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(3, 30, 5, 5, 'C', 'good', 'UTILISE'),
	(3, 31, 5, 5, 'B', 'good', 'UTILISE'),
	(3, 32, 5, 5, 'B', 'bad', 'UTILISE'),
	(4, 13, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(4, 15, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(4, 16, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(4, 17, 5, 5, 'A', 'bad', 'UTILISE'),
	(4, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(4, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(4, 31, 5, 5, 'C', 'bad', 'UTILISE'),
	(4, 32, 5, 5, 'A', 'bad', 'UTILISE'),
	(5, 13, 5, 5, 'B', 'bad', 'UTILISE'),
	(5, 15, 5, 5, 'C', 'good', 'UTILISE'),
	(5, 16, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(5, 17, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(5, 28, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(5, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(5, 31, 5, 5, 'C', 'bad', 'UTILISE'),
	(5, 32, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 13, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 15, 5, 5, 'B', 'bad', 'UTILISE'),
	(6, 16, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 17, 5, 5, 'B', 'bad', 'UTILISE'),
	(6, 28, 5, 2, 'A', 'good', 'UTILISE'),
	(6, 30, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 31, 5, 2, 'B', 'good', 'UTILISE'),
	(6, 32, 5, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 19, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 20, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 21, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 22, 2, 2, 'B', 'good', 'UTILISE'),
	(6, 23, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 24, 2, 5, 'A', 'bad', 'UTILISE'),
	(6, 25, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 27, 2, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 1, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 2, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 5, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 7, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 8, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 9, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 10, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 11, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 12, 6, NULL, NULL, NULL, 'DISPONIBLE'),
	(6, 26, 6, NULL, NULL, NULL, 'DISPONIBLE');
/*!40000 ALTER TABLE `chap_question` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. chap_score
CREATE TABLE IF NOT EXISTS `chap_score` (
  `chap_id` int(11) DEFAULT NULL,
  `chap_etape` int(11) DEFAULT 1,
  `cpt_question` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `statut` enum('BROUILLON','TERMINE','ELIMINE','RETENU') DEFAULT 'BROUILLON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.chap_score : 7 rows
/*!40000 ALTER TABLE `chap_score` DISABLE KEYS */;
INSERT INTO `chap_score` (`chap_id`, `chap_etape`, `cpt_question`, `user_id`, `score`, `statut`) VALUES
	(1, 1, 3, 5, 300, 'BROUILLON'),
	(3, 1, 3, 5, 200, 'BROUILLON'),
	(4, 1, 3, 5, 0, 'BROUILLON'),
	(5, 1, 3, 5, 100, 'BROUILLON'),
	(6, 1, 5, 5, 100, 'BROUILLON'),
	(6, 1, 3, 2, 300, 'BROUILLON'),
	(6, 1, 0, 6, 0, 'BROUILLON');
/*!40000 ALTER TABLE `chap_score` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. conversion
CREATE TABLE IF NOT EXISTS `conversion` (
  `conversion_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conversion_point` int(11) DEFAULT NULL,
  `conversion_taux` double DEFAULT NULL,
  `total_points_duel` int(11) DEFAULT NULL,
  `conversion_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.conversion : 1 rows
/*!40000 ALTER TABLE `conversion` DISABLE KEYS */;
INSERT INTO `conversion` (`conversion_id`, `user_id`, `conversion_point`, `conversion_taux`, `total_points_duel`, `conversion_date`) VALUES
	(NULL, 2, 400, 0.25, 100, '2019-05-14 20:40:53');
/*!40000 ALTER TABLE `conversion` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. depot
CREATE TABLE IF NOT EXISTS `depot` (
  `depot_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `depot_montant` int(11) DEFAULT NULL,
  `depot_date` datetime DEFAULT NULL,
  KEY `Index 1` (`depot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.depot : 10 rows
/*!40000 ALTER TABLE `depot` DISABLE KEYS */;
INSERT INTO `depot` (`depot_id`, `user_id`, `depot_montant`, `depot_date`) VALUES
	(1, 2, 2500, '2019-04-07 17:52:44'),
	(2, 5, 3, '2019-04-07 17:53:21'),
	(3, 5, 9, '2019-04-07 17:53:38'),
	(4, 5, 500, '2019-04-13 21:40:46'),
	(5, 6, 3, '2019-04-14 11:10:30'),
	(6, 6, 14, NULL),
	(7, 6, 200, NULL),
	(8, 2, 10000, NULL),
	(9, 2, 2000, NULL),
	(10, 2, 2000, NULL);
/*!40000 ALTER TABLE `depot` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. devise
CREATE TABLE IF NOT EXISTS `devise` (
  `devise_id` int(11) NOT NULL AUTO_INCREMENT,
  `devise_code` varchar(5) DEFAULT NULL,
  `devise_libelle` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`devise_id`),
  UNIQUE KEY `money_id` (`devise_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 PACK_KEYS=0 ROW_FORMAT=COMPACT;

-- Export de données de la table jeu_db.devise : 3 rows
/*!40000 ALTER TABLE `devise` DISABLE KEYS */;
INSERT INTO `devise` (`devise_id`, `devise_code`, `devise_libelle`) VALUES
	(1, 'Eur', 'Euro'),
	(2, '$', 'Dollard'),
	(3, 'FCFA', 'XOF (cfa)');
/*!40000 ALTER TABLE `devise` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. duel
CREATE TABLE IF NOT EXISTS `duel` (
  `duel_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `duel_statut` enum('BROUILLON','VALIDE','EN COURS','TERMINE','ANNULE') DEFAULT 'BROUILLON',
  PRIMARY KEY (`duel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.duel : 2 rows
/*!40000 ALTER TABLE `duel` DISABLE KEYS */;
INSERT INTO `duel` (`duel_id`, `user_id`, `adversaire_id`, `duel_date_creation`, `duel_date_validation`, `duel_date_debut`, `duel_date_fin`, `duel_vainqueur_id`, `duel_abandonneur_id`, `current_player_id`, `compteur_question`, `readystate`, `connected_users`, `duel_statut`) VALUES
	(1, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 'NOT READY', 0, 'BROUILLON'),
	(2, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 'NOT READY', 0, 'BROUILLON');
/*!40000 ALTER TABLE `duel` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. duel_jocker
CREATE TABLE IF NOT EXISTS `duel_jocker` (
  `duel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jocker_utilise` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.duel_jocker : 6 rows
/*!40000 ALTER TABLE `duel_jocker` DISABLE KEYS */;
INSERT INTO `duel_jocker` (`duel_id`, `user_id`, `jocker_utilise`) VALUES
	(1, 2, 0),
	(1, 5, 0),
	(1, 2, 0),
	(1, 5, 0),
	(2, 5, 0),
	(2, 2, 0);
/*!40000 ALTER TABLE `duel_jocker` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. duel_question
CREATE TABLE IF NOT EXISTS `duel_question` (
  `duel_id` int(11) DEFAULT NULL,
  `duel_question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `statut` enum('BONNE','MAUVAISE') DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `time_actuel` varchar(50) DEFAULT '0',
  PRIMARY KEY (`duel_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='enregistre les questions posée dans un duel';

-- Export de données de la table jeu_db.duel_question : 1 rows
/*!40000 ALTER TABLE `duel_question` DISABLE KEYS */;
INSERT INTO `duel_question` (`duel_id`, `duel_question_id`, `question_id`, `from_user_id`, `to_user_id`, `statut`, `date`, `time_actuel`) VALUES
	(1, 1, 24, 2, 5, NULL, NULL, '1566645863356');
/*!40000 ALTER TABLE `duel_question` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. duel_score
CREATE TABLE IF NOT EXISTS `duel_score` (
  `duel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `connected` enum('CONNECTED','NOT CONNECTED') DEFAULT 'NOT CONNECTED'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.duel_score : 6 rows
/*!40000 ALTER TABLE `duel_score` DISABLE KEYS */;
INSERT INTO `duel_score` (`duel_id`, `user_id`, `score`, `connected`) VALUES
	(1, 2, 0, 'CONNECTED'),
	(1, 5, 100, 'CONNECTED'),
	(1, 2, 0, 'NOT CONNECTED'),
	(1, 5, 0, 'NOT CONNECTED'),
	(2, 5, 0, 'NOT CONNECTED'),
	(2, 2, 0, 'NOT CONNECTED');
/*!40000 ALTER TABLE `duel_score` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. entrainement
CREATE TABLE IF NOT EXISTS `entrainement` (
  `entrainement_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `entrainement_score` int(11) DEFAULT NULL,
  `entrainement_compteur_question` int(11) DEFAULT NULL,
  `entrainement_date` datetime DEFAULT NULL,
  `entrainement_statut` enum('BROUILLON','EN COURS','TERMINE') DEFAULT 'BROUILLON',
  PRIMARY KEY (`entrainement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.entrainement : 21 rows
/*!40000 ALTER TABLE `entrainement` DISABLE KEYS */;
INSERT INTO `entrainement` (`entrainement_id`, `user_id`, `categorie_id`, `entrainement_score`, `entrainement_compteur_question`, `entrainement_date`, `entrainement_statut`) VALUES
	(1, 2, 2, 100, 11, '2019-04-07 23:32:32', 'TERMINE'),
	(2, 2, 2, 300, 11, '2019-04-07 23:34:12', 'EN COURS'),
	(3, 5, 3, 0, 35, '2019-04-22 19:03:44', 'TERMINE'),
	(4, 5, 3, 500, 35, '2019-05-12 16:52:16', 'TERMINE'),
	(5, 5, 3, 0, 35, '2019-05-12 16:53:56', 'TERMINE'),
	(6, 5, 3, 0, 35, '2019-05-12 16:54:25', 'TERMINE'),
	(7, 5, 3, 100, 35, '2019-05-12 16:54:39', 'TERMINE'),
	(8, 5, 3, 0, 35, '2019-05-12 16:55:27', 'TERMINE'),
	(9, 5, 2, 0, 35, '2019-05-17 10:36:04', 'TERMINE'),
	(10, 5, 2, 0, 35, '2019-05-24 12:16:53', 'TERMINE'),
	(11, 6, 2, 700, 37, '2019-06-29 16:59:59', 'TERMINE'),
	(12, 6, 3, 200, 37, '2019-06-29 17:03:07', 'TERMINE'),
	(13, 6, 1, 600, 37, '2019-06-29 17:04:11', 'TERMINE'),
	(14, 6, 5, 300, 37, '2019-06-29 17:06:42', 'TERMINE'),
	(15, 6, 4, 400, 37, '2019-06-29 17:08:22', 'TERMINE'),
	(16, 6, 5, 0, 37, '2019-06-29 17:10:02', 'TERMINE'),
	(17, 6, 5, 0, 37, '2019-06-30 05:59:09', 'EN COURS'),
	(18, 5, 2, 300, 35, '2019-07-06 09:19:11', 'TERMINE'),
	(19, 5, 6, 0, 35, '2019-11-19 23:53:51', 'TERMINE'),
	(20, 5, 6, 0, 35, '2019-11-19 23:54:11', 'TERMINE'),
	(21, 5, 5, 200, 35, '2019-11-19 23:54:33', 'EN COURS');
/*!40000 ALTER TABLE `entrainement` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. jockerquestion
CREATE TABLE IF NOT EXISTS `jockerquestion` (
  `jockerquestion_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `beneficiaire_user_id` int(11) DEFAULT NULL,
  `jockerquestion_quantite` int(11) DEFAULT NULL,
  `jockerquestion_montant` int(11) DEFAULT NULL,
  `jockerquestion_date` datetime DEFAULT NULL,
  KEY `Index 1` (`jockerquestion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.jockerquestion : 10 rows
/*!40000 ALTER TABLE `jockerquestion` DISABLE KEYS */;
INSERT INTO `jockerquestion` (`jockerquestion_id`, `user_id`, `beneficiaire_user_id`, `jockerquestion_quantite`, `jockerquestion_montant`, `jockerquestion_date`) VALUES
	(1, 2, 2, 10, 1000, '2019-04-07 17:50:17'),
	(2, 5, 5, 9, 2, '2019-04-14 11:23:04'),
	(3, 5, 5, 20, 4, '2019-04-22 19:07:43'),
	(4, 5, 5, 20, NULL, NULL),
	(5, 5, 5, 20, NULL, NULL),
	(6, 5, 5, 20, NULL, NULL),
	(7, 5, 5, 20, NULL, NULL),
	(8, 5, 5, 30, NULL, NULL),
	(9, 5, 5, 30, NULL, NULL),
	(10, 6, 6, 5, NULL, NULL);
/*!40000 ALTER TABLE `jockerquestion` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. kw_administrateur
CREATE TABLE IF NOT EXISTS `kw_administrateur` (
  `kw_administrateur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kw_administrateur_login` varchar(255) NOT NULL,
  `kw_administrateur_pass` varchar(255) NOT NULL,
  `kw_administrateur_email` varchar(50) NOT NULL,
  `kw_administrateur_rang` int(11) NOT NULL,
  `kw_administrateur_statut` enum('ACTIVE','DESACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`kw_administrateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='enregistre les administrateurs du site';

-- Export de données de la table jeu_db.kw_administrateur : 1 rows
/*!40000 ALTER TABLE `kw_administrateur` DISABLE KEYS */;
INSERT INTO `kw_administrateur` (`kw_administrateur_id`, `kw_administrateur_login`, `kw_administrateur_pass`, `kw_administrateur_email`, `kw_administrateur_rang`, `kw_administrateur_statut`) VALUES
	(1, 'admin', 'fece6adde0ec8c975e2b5ec91fce57ab1852fca4', 'krak225@gmail.com', 1, 'ACTIVE');
/*!40000 ALTER TABLE `kw_administrateur` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. langue
CREATE TABLE IF NOT EXISTS `langue` (
  `langue_id` int(11) NOT NULL AUTO_INCREMENT,
  `langue_code` varchar(3) NOT NULL DEFAULT '0',
  `langue_libelle` varchar(20) DEFAULT NULL,
  `langue_drapeau` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`langue_id`),
  UNIQUE KEY `langue_id` (`langue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 PACK_KEYS=0 ROW_FORMAT=COMPACT;

-- Export de données de la table jeu_db.langue : 2 rows
/*!40000 ALTER TABLE `langue` DISABLE KEYS */;
INSERT INTO `langue` (`langue_id`, `langue_code`, `langue_libelle`, `langue_drapeau`) VALUES
	(1, 'Fr', 'français', 'fr.png'),
	(2, 'En', 'anglais', 'gb.png');
/*!40000 ALTER TABLE `langue` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. pays
CREATE TABLE IF NOT EXISTS `pays` (
  `pays_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pays_code` int(3) NOT NULL,
  `pays_alpha2` varchar(2) CHARACTER SET utf8 NOT NULL,
  `pays_alpha3` varchar(3) CHARACTER SET utf8 NOT NULL,
  `pays_nom_en` varchar(45) CHARACTER SET utf8 NOT NULL,
  `pays_nom_fr` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`pays_id`),
  UNIQUE KEY `alpha2` (`pays_alpha2`),
  UNIQUE KEY `alpha3` (`pays_alpha3`),
  UNIQUE KEY `code_unique` (`pays_code`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Export de données de la table jeu_db.pays : 241 rows
/*!40000 ALTER TABLE `pays` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `pays` ENABLE KEYS */;

-- Export de la structure de la vue jeu_db. profil
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `profil` (
	`profil_id` INT(11) NULL,
	`profil_nom` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`profil_statut` ENUM('VALIDE') NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Export de la structure de la table jeu_db. question
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `statut_selection` enum('SELECTED','NOT SELECTED') DEFAULT 'NOT SELECTED',
  `statut_selection_chap` enum('SELECTED','NOT SELECTED') DEFAULT 'NOT SELECTED',
  `statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'BROUILLON',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.question : 28 rows
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`, `user_id`, `question_fr`, `question_en`, `proposition_a_fr`, `proposition_a_en`, `proposition_b_fr`, `proposition_b_en`, `proposition_c_fr`, `proposition_c_en`, `reponse`, `categorie_id`, `statut_selection`, `statut_selection_chap`, `statut`) VALUES
	(1, 6, 'Quelle est la capitale de la Côte d\'Ivoire?', 'What is the capital of Ivory Coast', 'Abidjan', 'Bouaké', 'Daloa', 'Daloa', 'Yamoussoukro', 'Yamoussoukro', 'C', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(2, 6, 'En quelle année la Côte d\'Ivoire a-t-elle obtenu son indépendance?', 'In wich year, Ivory Coast get its independancy?', '1956', '1956', '1960', '1960', '1962', '1962', 'B', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(5, 6, 'Quelle est la capitale de la France?', 'What is the capital of France', 'Marseille', 'Marseille', 'Alsace', 'Alsace', 'Paris', 'Paris', 'C', 2, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(7, 6, 'Dans l\'industrie cinématographique américaine, que signifie l\'abréviation MGM ?', NULL, 'Metro Goldwyn Mayer', NULL, 'Millenium Good Media', NULL, 'Middle Glass Musics', NULL, 'A', 2, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(8, 6, 'Que signifie ONU?', NULL, 'Organisation Nationale des Universités', NULL, 'Organisation des Nations Unies', NULL, 'Office Nationale de l\'Unité', NULL, 'B', 3, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(9, 6, 'Comment appelle t-on la version 5 d\'Android?', NULL, 'Ice cream sandwich', NULL, 'Lolipop', NULL, 'Oreo', NULL, 'B', 4, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(10, 6, 'Comment appelle t-on la version 8 d\'Android?', NULL, 'Ice cream sandwich', NULL, 'Lolipop', NULL, 'Oreo', NULL, 'C', 5, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(11, 6, 'Que signifie ONG?', NULL, 'Organisation Nationale des Gares', NULL, 'Organisation Non Gouvernementale', NULL, 'Office Nationale des Gouverneurs', NULL, 'B', 4, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(12, 6, 'Quelle est la formule du poids d\'un objet?', NULL, 'P = m x g', NULL, 'P = m + g', NULL, 'P = m - g', NULL, 'A', 5, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(13, 5, 'Dans quelle pays se trouve le Mont Tonkpi?', NULL, 'Mali', NULL, 'Ghana', NULL, 'Côte d\'Ivoire', NULL, 'C', 2, 'SELECTED', 'SELECTED', 'VALIDE'),
	(15, 5, 'Que signifie UEMOA?', NULL, 'Unité Electorale Mondiale pour l\'Ordre en Afrique', NULL, 'Union des Electricien du Monde en Afrique', NULL, 'Union Economique et Monetaire Ouest Africaine', NULL, 'C', 2, 'SELECTED', 'SELECTED', 'VALIDE'),
	(16, 5, 'Qeulle est le chef lieu de la région du hambole?', NULL, 'Bouaké', NULL, 'Katiola', NULL, 'Dabakala', NULL, 'B', 2, 'SELECTED', 'SELECTED', 'VALIDE'),
	(17, 5, 'De qui est le roman Les frasques d\'Ebinto?', NULL, 'Isaie Binton Coulibaly', NULL, 'Tidiane Dem', NULL, 'Amadou Koné', NULL, 'C', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(18, 3, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', NULL, 'Koumassi', NULL, 'Port-Bouet', NULL, 'Yopougon', NULL, 'B', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(19, 2, 'Qui est l\'auteur de cette phrase : “Je souhaite que la  santé  soit  enfin considérée non plus comme une bénédiction que l’on espère mais comme un droit de l’homme pour lequel on se bat.” ?', NULL, 'Kofi Annan', NULL, 'Mahatma Gandhi', NULL, 'Nelson Mandela', NULL, 'A', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(20, 2, 'Selon le plan comptable SYSCOHADA laquelle de ces affirmations est fausse ?', NULL, 'Classe 5: comptes de tiers', NULL, 'Classe 7: comptes de produits Activité Ordinaire', NULL, 'Classe 1: comptes de ressources durables', NULL, 'A', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(21, 2, 'Selon le plan comptable SYSCOHADA, laquelle de ces classes ne relève pas de la comptabilité générale ?', NULL, 'Classe 5', NULL, 'Classe 9', NULL, 'Classe 8', NULL, 'B', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(22, 2, 'Lequel de ces principes est un principe comptable?', '', 'Le principe de la sincï¿½ritï¿½', '', 'Le principe de la continuitï¿½ de lï¿½exploitation', '', 'Le principe de lï¿½honnï¿½tetï¿½', '', 'B', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(23, 2, 'Que signifie TVA ?', NULL, 'Taux variable d’Authenticité', NULL, 'Taxe sur  vente  abattue', NULL, 'Taxe sur la valeur ajoutée', NULL, 'C', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(24, 2, 'Que signifie FRDE en  comptabilitÃ© ?', '', 'Front de recherche Dana', '', 'Frais de recherche et de dÃ©veloppement', '', 'Finir, ralentir et dÃ©velopper', '', 'B', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(25, 2, 'Combien de variantes  existe-t-il dans la mÃ©thode du coÃ»t moyen pondÃ©rÃ©?', '', '2', '', '4', '', '8', '', 'A', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(26, 6, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', NULL, 'Port-Bouet', NULL, 'Koumassi', NULL, 'Yopougon', NULL, 'A', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(27, 2, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', NULL, 'Koumassi', NULL, 'Yopougon', NULL, 'Port-Bouet', NULL, 'C', 1, 'NOT SELECTED', 'SELECTED', 'VALIDE'),
	(28, 5, 'Dans quelle commune se trouve le monument AKWABA en Côte d\'Ivoire?', NULL, 'Port-Bouet', NULL, 'Koumassi', NULL, 'Yopougon', NULL, 'A', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(30, 5, 'Qui est le fondateur du PDCI-RDA', NULL, 'Laurent Gbagbo', NULL, 'Henri Konan Bédié', NULL, 'Felix Houphouet Boigny', NULL, 'C', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(31, 5, 'Que signifie BURIDA', NULL, 'Bureau Ivoirien du Droit des Auteurs', NULL, 'Bureau Ivoirien du Droit d\'Auteur', NULL, 'Bureau Ivoirien du Droit d\'Artiste', NULL, 'B', 1, 'SELECTED', 'SELECTED', 'VALIDE'),
	(32, 5, 'Que signifie ONU?', 'What is UN?', 'Office Nationale pour l\'UnitÃ©', 'Union of Nation', 'Office des Nations Unies', 'Union of Natural', 'Organisation des Nations Unies', 'United Nation', 'C', 2, 'SELECTED', 'SELECTED', 'VALIDE'),
	(33, 0, 'Quelle est la capitale de l\'Espagne?', 'What is SPAIN Capital?', 'Dallas', 'Dallas', 'Madrid', 'Madrid', 'Luxembourg', 'Luxembourg', 'B', 2, 'NOT SELECTED', 'NOT SELECTED', 'VALIDE');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. retrait
CREATE TABLE IF NOT EXISTS `retrait` (
  `retrait_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `retrait_montant` double NOT NULL,
  `retrait_date_demande` datetime DEFAULT NULL,
  `retrait_date_validation` datetime DEFAULT NULL,
  `retrait_statut` enum('BROUILLON','VALIDE','REJETE') NOT NULL DEFAULT 'BROUILLON',
  PRIMARY KEY (`retrait_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Export de données de la table jeu_db.retrait : 3 rows
/*!40000 ALTER TABLE `retrait` DISABLE KEYS */;
INSERT INTO `retrait` (`retrait_id`, `user_id`, `retrait_montant`, `retrait_date_demande`, `retrait_date_validation`, `retrait_statut`) VALUES
	(1, 6, 100, NULL, NULL, 'BROUILLON'),
	(2, 6, 100, NULL, NULL, 'BROUILLON'),
	(3, 6, 10, NULL, NULL, 'BROUILLON');
/*!40000 ALTER TABLE `retrait` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. souscription
CREATE TABLE IF NOT EXISTS `souscription` (
  `souscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `beneficiaire_user_id` int(11) DEFAULT NULL,
  `souscription_quantite` int(11) DEFAULT NULL,
  `souscription_montant` double DEFAULT NULL,
  `souscription_date` datetime DEFAULT NULL,
  PRIMARY KEY (`souscription_id`),
  UNIQUE KEY `id_souscription` (`souscription_id`),
  KEY `users_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 PACK_KEYS=0 ROW_FORMAT=COMPACT;

-- Export de données de la table jeu_db.souscription : 23 rows
/*!40000 ALTER TABLE `souscription` DISABLE KEYS */;
INSERT INTO `souscription` (`souscription_id`, `user_id`, `beneficiaire_user_id`, `souscription_quantite`, `souscription_montant`, `souscription_date`) VALUES
	(1, 2, 2, 10, 2000, '2019-04-07 17:40:22'),
	(2, 5, 5, 10, 3.7, '2019-04-07 17:40:44'),
	(3, 6, 6, 1, 0.31, '2019-04-14 11:12:17'),
	(4, 6, 6, 2, 0.62, '2019-04-14 23:34:58'),
	(5, 6, 6, 4, 1.24, '2019-05-14 20:22:23'),
	(6, 5, 5, 35, 12.95, '2019-05-14 21:30:11'),
	(7, 5, 5, 9, 3.33, '2019-05-19 19:11:49'),
	(8, 5, 5, 5, 1.85, '2019-05-19 19:34:10'),
	(9, 5, 5, 5, 1.85, '2019-05-19 19:35:21'),
	(10, 5, 5, 10, 3.7, '2019-05-19 19:35:32'),
	(11, 5, 5, 15, 5.55, '2019-05-19 19:36:09'),
	(12, 5, 5, 15, 5.55, '2019-05-19 19:36:25'),
	(13, 5, 5, 15, 5.55, '2019-05-19 19:39:28'),
	(14, 5, 5, 5, 1.85, '2019-05-19 19:39:38'),
	(15, 5, 5, 15, 5.55, '2019-05-19 19:39:52'),
	(16, 5, 5, 50, 18.5, '2019-05-19 19:40:00'),
	(17, 5, 5, 25, 9.25, '2019-05-19 19:40:16'),
	(18, 5, 5, 10, 3.7, '2019-05-19 19:40:22'),
	(19, 5, 5, 40, 14.8, '2019-05-19 19:42:17'),
	(20, 5, 5, 25, 9.25, '2019-05-19 19:42:47'),
	(21, 6, 6, 2, 0.62, '2019-06-20 05:29:29'),
	(22, 6, 6, 50, 15.5, '2019-07-09 19:46:16'),
	(23, 2, 2, 10, 2000, '2019-07-20 15:54:14');
/*!40000 ALTER TABLE `souscription` ENABLE KEYS */;

-- Export de la structure de la table jeu_db. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profil_id` int(11) NOT NULL DEFAULT 2,
  `nom` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenoms` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_origine_id` int(11) DEFAULT NULL,
  `pays_residence_id` int(11) DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_code` enum('fr','en') COLLATE utf8mb4_unicode_ci DEFAULT 'fr',
  `lang_libelle` enum('Français','Anglais') COLLATE utf8mb4_unicode_ci DEFAULT 'Français',
  `devise` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_points` int(11) DEFAULT 0,
  `total_points_test` int(11) DEFAULT 0,
  `total_points_duel` int(11) DEFAULT 0,
  `score_general` int(11) DEFAULT 0,
  `souscription` int(11) DEFAULT 0,
  `jocker_question` int(11) DEFAULT 0,
  `jocker_duel` int(11) DEFAULT 0,
  `jocker_jeu` int(11) DEFAULT 0,
  `money` float NOT NULL DEFAULT 0,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parrain` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statut` enum('VALIDE','SUPPRIME') COLLATE utf8mb4_unicode_ci DEFAULT 'VALIDE',
  `statut_abonnement` enum('ACTIVE','DESACTIVE') COLLATE utf8mb4_unicode_ci DEFAULT 'DESACTIVE',
  `statut_abonnement_chap` enum('ACTIVE','DESACTIVE') COLLATE utf8mb4_unicode_ci DEFAULT 'DESACTIVE',
  `statut_matrice` enum('Hors matrice','Dans') COLLATE utf8mb4_unicode_ci DEFAULT 'Hors matrice',
  `statut_connexion` enum('DECONNECTE','CONNECTE') COLLATE utf8mb4_unicode_ci DEFAULT 'DECONNECTE',
  `communaute` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table jeu_db.users : 5 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `profil_id`, `nom`, `prenoms`, `sexe`, `date_naissance`, `telephone`, `adresse_email`, `pseudo`, `adresse`, `code_postal`, `ville`, `pays_origine_id`, `pays_residence_id`, `photo`, `lang_code`, `lang_libelle`, `devise`, `total_points`, `total_points_test`, `total_points_duel`, `score_general`, `souscription`, `jocker_question`, `jocker_duel`, `jocker_jeu`, `money`, `email`, `password`, `remember_token`, `api_token`, `parrain`, `created_at`, `updated_at`, `statut`, `statut_abonnement`, `statut_abonnement_chap`, `statut_matrice`, `statut_connexion`, `communaute`) VALUES
	(1, 2, 'Kouassi', 'Armand', 'Masculin', '2017-07-04', '04783689', 'richmond@gmail.com', 'krak225', 'PO Box 198 Porto', NULL, 'Porto', 36, 175, '30.jpg', 'en', 'Anglais', 'EUR', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'armand', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'A6sUiQhGzoupBKizNzgP1luoZWPAzzRAyEE9o72W9PH8HXeNCbHgWi7BIxSO', NULL, 'bacouly', '2018-07-14 17:56:34', '2018-09-09 16:13:18', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', 'Génies'),
	(2, 2, 'Gué', 'Dako Maryse', 'Feminin', '2018-07-14', '56152799', 'maryse@gmail.com', 'angela', 'BP 1038 Paris', NULL, 'Paris', 18, 10, 'images_020.png', 'fr', 'Français', 'XOF', 0, 300, 0, 0, 8, 7, 3, -3, 13400, 'angela', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'EhJWCVVP4GbcJDtNrXgmqusZHHF7VujRTYr8Da39Ed0T0sWPKRlHOhDJQMhh', NULL, NULL, '2018-07-08 23:23:14', '2019-11-20 01:23:28', 'VALIDE', 'DESACTIVE', 'ACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
	(3, 2, 'Coulibaly', 'Bakary', 'Masculin', '2018-07-14', '04000000', 'bakary@gmail.com', 'bakouly', 'PO Box 218 NY', NULL, 'New York', 18, 18, 'images_175.jpg', 'en', 'Anglais', 'XOF', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'bakary', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'ME2E7j8DMjsvhnJd9xXZOGlFSbXMXdz8faMbefhAOWTahvk8THVZ043UZmrN', NULL, NULL, '2018-06-16 13:30:55', '2018-12-22 17:39:52', 'VALIDE', 'DESACTIVE', 'DESACTIVE', 'Hors matrice', 'DECONNECTE', NULL),
	(5, 2, 'KOUASSI', 'RICHMOND', 'Masculin', '2018-02-06', '033928442', 'krak225@gmail.com', 'richmond', NULL, NULL, 'Andore', 1, 6, 'images_007.png', 'fr', 'Français', 'USD', 0, 2500, 13650, 0, 270, 126, 3, -3, 353.109, 'richmond', '$2y$10$RSLmbj5y8mE4YK/BKsp/6.dSiZzTuqLL3FS564T9lBBJ2fQPA4JMS', 'A7nVHGr9510LY8r0QxNdMEYLtLhbRfY3lvSOpjiTFoiIKSL0HPpBPGhnnTOQ', NULL, NULL, '2019-03-08 23:31:43', '2019-11-24 21:56:35', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'CONNECTE', NULL),
	(6, 2, 'N\'goran', 'Kouadio Honoré', 'Masculin', '1992-01-01', '04828923', 'ngoran@yahoo.fr', 'ngoran', NULL, NULL, 'Kinshassa', 51, 51, 'Copie de 1.jpg', 'fr', 'Français', 'EUR', 0, 6800, 300, 0, 51, 5, 3, 0, 107.999, 'ngoran', '$2y$10$OONvHBW0r3kaKL1XtKOC0ObSCPeiRESMRZJwF9lQVYd/fuXbHc6SW', 'VxHP0DUtRmY2zjOuyn8BSE7cx07rwBqM0MN176C7mD8lESU1GCB9K0YwKbUz', NULL, NULL, '2019-03-14 23:04:44', '2019-11-24 21:50:00', 'VALIDE', 'ACTIVE', 'ACTIVE', 'Hors matrice', 'CONNECTE', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Export de la structure de la vue jeu_db. cagnotte
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `cagnotte`;
;

-- Export de la structure de la vue jeu_db. profil
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `profil`;
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
