-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 11 déc. 2018 à 18:08
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `achat_eiffage`
--

-- --------------------------------------------------------

--
-- Structure de la table `analytique`
--

DROP TABLE IF EXISTS `analytique`;
CREATE TABLE IF NOT EXISTS `analytique` (
  `id_analytique` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeRubrique` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_analytique`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `analytique`
--

INSERT INTO `analytique` (`id_analytique`, `codeRubrique`, `created_at`, `updated_at`) VALUES
(1, '22522', NULL, NULL),
(2, '22523', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `boncommande`
--

DROP TABLE IF EXISTS `boncommande`;
CREATE TABLE IF NOT EXISTS `boncommande` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numBonCommande` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `id_fournisseur` int(11) NOT NULL,
  `total_ttc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numBonCommande` (`numBonCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boncommande`
--

INSERT INTO `boncommande` (`id`, `numBonCommande`, `id_user`, `created_at`, `updated_at`, `slug`, `date`, `etat`, `id_fournisseur`, `total_ttc`) VALUES
(25, '003FFF5', 13, '2018-12-11 11:07:58', '2018-12-11 15:22:08', '003fff511122018110758', '2018-12-21', 3, 37, 4543),
(26, '003FF', 13, '2018-12-11 12:00:05', '2018-12-11 14:57:07', '003ff11122018120005', '2018-12-19', 3, 43, 5310),
(27, '003Fcc', 13, '2018-12-11 16:09:17', '2018-12-11 16:41:01', '003fcc11122018040917', '2018-12-26', 1, 35, 13452);

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

DROP TABLE IF EXISTS `domaines`;
CREATE TABLE IF NOT EXISTS `domaines` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleDomainne` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `libelleDomainne`, `created_at`, `updated_at`) VALUES
(1, 'Matériels de quincaillerie', NULL, NULL),
(2, 'Matériels électriques ', NULL, NULL),
(3, 'Matériels de plomberie', NULL, NULL),
(4, 'Matériels mécaniques', NULL, NULL),
(5, 'Matériels informatiques', NULL, NULL),
(6, 'Matériels de laboratoire', NULL, NULL),
(7, 'Matériels d’entretien et nettoyage ', NULL, NULL),
(8, 'Fournitures de bureau et d’imprimerie ', NULL, NULL),
(9, 'E.P.I', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) NOT NULL,
  `domaine` varchar(191) NOT NULL,
  `conditionPaiement` text,
  `commentaire` text,
  `adresseGeographique` varchar(191) DEFAULT NULL,
  `responsable` varchar(191) DEFAULT NULL,
  `interlocuteur` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `libelle`, `domaine`, `conditionPaiement`, `commentaire`, `adresseGeographique`, `responsable`, `interlocuteur`, `email`, `created_at`, `updated_at`, `slug`) VALUES
(35, 'eburtis', '5', 'je suis la', 'fdfff', 'hhhh', 'd', 'df', 'cyriaquekodia@gmail.com', '2018-10-29 17:22:31', '2018-11-22 12:36:12', 'eburtis22112018123612'),
(36, 'La quincaillerie Abidjannaise', '5', 'orange money', 'dtft', 'abidjan', 'koffi landry', 'kone', 'cyriaquekodia@gmail.com', '2018-10-29 17:38:57', '2018-11-12 15:00:23', 'la-quincaillerie-abidjannaise12112018030023'),
(37, 'QUINCAILLROSS', '3', 'tout', NULL, 'Rosier programme 3', 'Melaine', 'Mélaine', 'thierry.koffi@eiffage.com', '2018-11-12 15:01:42', '2018-11-12 15:01:42', 'quincaillross12112018030142'),
(38, '3D solutions', '5', 'rrrr', NULL, 'rtrtr', 'je suis la', 'df', 'thierry.koffi@eiffage.com', '2018-11-22 12:36:38', '2018-11-22 12:36:38', '3d-solutions22112018123638'),
(39, 'cape nord', '5', 'f', NULL, 'rrr', 'je suis la', 'df', 'cyriaque.kodia.ext@eiffage.com', '2018-11-22 14:33:23', '2018-11-22 14:45:04', 'cape-nord22112018024504'),
(42, 'dddd', '1,2,3,4', NULL, NULL, NULL, NULL, 'df', 'cyriaquekodia@gmail.com', '2018-11-22 15:18:54', '2018-11-22 15:18:54', 'dddd22112018031854'),
(43, 'EDF TUYAUX', '3', 'je suis la', NULL, 'test', 'je suis la', 'rrr', 'cyriaquekodia@gmail.com', '2018-11-27 15:26:22', '2018-11-27 15:26:22', 'edf-tuyaux27112018032622');

-- --------------------------------------------------------

--
-- Structure de la table `lignebesoin`
--

DROP TABLE IF EXISTS `lignebesoin`;
CREATE TABLE IF NOT EXISTS `lignebesoin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unite` varchar(191) NOT NULL,
  `quantite` double(8,2) NOT NULL,
  `DateBesoin` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_reponse_fournisseur` int(11) DEFAULT NULL,
  `id_nature` int(11) DEFAULT NULL,
  `id_materiel` int(11) DEFAULT NULL,
  `id_bonCommande` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demandeur` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `etat` varchar(191) NOT NULL DEFAULT '1',
  `id_valideur` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lignebesoin`
--

INSERT INTO `lignebesoin` (`id`, `unite`, `quantite`, `DateBesoin`, `id_user`, `id_reponse_fournisseur`, `id_nature`, `id_materiel`, `id_bonCommande`, `created_at`, `updated_at`, `demandeur`, `slug`, `etat`, `id_valideur`) VALUES
(17, 'mètre', 3.00, '2018-12-13', 13, 12, 1, 7, 25, '2018-12-11 10:59:10', '2018-12-11 11:42:16', 'koffi', '711122018105910', '3', 'administrateur'),
(18, 'mètre', 6.00, '2018-12-21', 13, 14, 1, 5, 26, '2018-12-11 10:59:40', '2018-12-11 14:57:07', 'Mélaine', '511122018105940', '3', 'administrateur'),
(19, 'Installations', 2.00, '2018-12-19', 13, 16, 2, 6, 27, '2018-12-11 16:06:10', '2018-12-11 16:09:32', 'Mélaine', '611122018040610', '2', 'administrateur'),
(20, 'mètre', 2.00, '2018-12-12', 13, NULL, 1, 7, NULL, '2018-12-11 16:26:23', '2018-12-11 16:26:23', 'kodia', '711122018042623', '1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_bc`
--

DROP TABLE IF EXISTS `ligne_bc`;
CREATE TABLE IF NOT EXISTS `ligne_bc` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeRubrique` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remise_ligne_bc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite_ligne_bc` int(11) DEFAULT NULL,
  `unite_ligne_bc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix_unitaire_ligne_bc` float DEFAULT NULL,
  `id_reponse_fournisseur` int(11) DEFAULT NULL,
  `id_bonCommande` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_tot` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ligne_bc`
--

INSERT INTO `ligne_bc` (`id`, `codeRubrique`, `remise_ligne_bc`, `quantite_ligne_bc`, `unite_ligne_bc`, `prix_unitaire_ligne_bc`, `id_reponse_fournisseur`, `id_bonCommande`, `created_at`, `updated_at`, `slug`, `prix_tot`) VALUES
(13, '2', '5', 2, 'Installations', 12000, 16, 27, '2018-12-11 16:41:01', '2018-12-11 16:41:01', '21200011122018044101', 11400),
(10, '1', '10', 1, 'm', 5000, 14, 26, '2018-12-11 12:04:51', '2018-12-11 12:04:51', '1500011122018120451', 4500),
(9, '1', '23', 1, 'm', 5000, 14, 25, '2018-12-11 11:33:31', '2018-12-11 11:58:35', '1500011122018115835', 3850);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleMateriel` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `libelleMateriel`, `type`, `created_at`, `updated_at`, `slug`) VALUES
(5, 'tuyaux cylindrique', '3', '2018-10-30 16:51:34', '2018-11-13 10:49:42', 'tuyaux-cylindrique13112018104942'),
(6, 'Office', '5', '2018-10-30 16:54:06', '2018-11-22 12:35:43', 'office22112018123543'),
(7, 'filtre à eau', '3', '2018-10-30 16:54:13', '2018-11-13 10:50:47', 'filtre-a-eau13112018105047'),
(10, 'tuyaux en fer', '3', '2018-11-13 10:50:01', '2018-11-13 10:50:01', 'tuyaux-en-fer13112018105001');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_10_163336_add_id_profil_to_users_table', 1),
(4, '2018_10_18_103504_create_profil_table', 1),
(5, '2018_10_18_105538_create_materiel_table', 1),
(6, '2018_10_18_112422_create_nature_table', 1),
(7, '2018_10_18_113016_create_fournisseur_table', 1),
(8, '2018_10_18_115141_create_analytique_table', 1),
(9, '2018_10_18_115945_create_boncommande_table', 1),
(10, '2018_10_18_154205_create_lignebesoin_table', 1),
(11, '2018_10_26_170333_add_slug_to_fournisseur', 2),
(12, '2018_10_30_125617_add_slug_to_materiel_table', 3),
(13, '2018_10_30_173310_add_slug_to_users_table', 4),
(14, '2018_11_02_102004_add_slug_to_profil', 5),
(15, '2018_11_05_122909_create_table_tbprix', 6),
(16, '2018_11_05_141327_add_slug_to_tbprix_table', 7),
(17, '2018_11_05_150926_add_id_fournisseur_et_id_materiel_to_tbprix_table', 8),
(18, '2018_11_06_120314_add_demandeur_to_lignebesoin', 9),
(19, '2018_11_06_145046_add_slug_to_lignebesoin', 10),
(20, '2018_11_07_092915_add_etat_to_lignebesoin', 11),
(21, '2018_11_12_115716_creation_de_la_table_domaine', 12),
(22, '2018_11_19_080538_create_table_reponse_fournisseur', 13),
(23, '2018_11_19_081841_add_slug__and_id_lignebesoin_to_reponse_fournisseur', 14),
(24, '2016_03_31_065856_create_roles_table', 15),
(25, '2016_03_31_070114_create_user_role_table', 15),
(26, '2018_11_26_110237_create_ligne_bc_table', 16),
(27, '2018_11_26_114224_add_slug_to_ligne_bc_table', 17),
(28, '2018_11_26_114446_add_slug_to_bon_commande_table', 18),
(29, '2018_11_28_153729_add_date_to_boncommande', 19),
(30, '2018_11_28_164345_add_etat_to_boncommande', 20),
(31, '2018_11_29_142810_supprimer_id_fournisseur_select_pour_id_reponse_fournisseur', 21),
(32, '2018_11_30_081711_add_id_fournisseur', 22),
(33, '2018_12_03_082757_add_remise_and_dateprecis_to_table_reponse_fournisseur', 23),
(34, '2018_12_03_151342_add_prix_tot_to_ligne_bc', 24),
(35, '2018_12_06_174847_create_table_service', 25),
(36, '2018_12_07_102916_add_numero_to_user', 25),
(37, '2018_12_11_153440_add_total_ttc_to_boncommande', 25);

-- --------------------------------------------------------

--
-- Structure de la table `nature`
--

DROP TABLE IF EXISTS `nature`;
CREATE TABLE IF NOT EXISTS `nature` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleNature` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nature`
--

INSERT INTO `nature` (`id`, `libelleNature`, `created_at`, `updated_at`) VALUES
(1, 'Materiel', NULL, NULL),
(2, 'Consultation', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleProfil` varchar(191) NOT NULL,
  `descriptionProfil` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelleProfil`, `descriptionProfil`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Administrateur', '1000,2000,3000,4000,5000,6000,7000,8000', '2018-11-02 10:43:59', '2018-11-09 15:49:32', 'administrateur09112018034932');

-- --------------------------------------------------------

--
-- Structure de la table `reponse_fournisseur`
--

DROP TABLE IF EXISTS `reponse_fournisseur`;
CREATE TABLE IF NOT EXISTS `reponse_fournisseur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(11) NOT NULL,
  `titre_ext` varchar(191) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `unite` text,
  `prix` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `id_lignebesoin` int(11) NOT NULL,
  `remise` int(11) DEFAULT NULL,
  `date_precise` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse_fournisseur`
--

INSERT INTO `reponse_fournisseur` (`id`, `id_fournisseur`, `titre_ext`, `quantite`, `unite`, `prix`, `created_at`, `updated_at`, `slug`, `id_lignebesoin`, `remise`, `date_precise`) VALUES
(12, 37, 'filtre à liquide au ph neutre', 1, 'm', '5000', '2018-12-11 11:03:36', '2018-12-11 11:03:36', 'filtre-a-liquide-au-ph-neutrem11122018110336', 17, 23, '2018-12-11'),
(13, 43, 'filtre à liquide au ph neutre', 1, 'm', '5000', '2018-12-11 11:04:18', '2018-12-11 11:04:18', 'filtre-a-liquide-au-ph-neutrem11122018110418', 17, 10, '2018-12-11'),
(14, 43, 'tuyaux b2', 1, 'm', '5000', '2018-12-11 11:05:36', '2018-12-11 11:05:36', 'tuyaux-b2m11122018110536', 18, 10, '2018-12-11'),
(15, 37, 'tyaux allu', 1, 'm', '6000', '2018-12-11 11:07:14', '2018-12-11 11:07:14', 'tyaux-allum11122018110714', 18, 10, '2018-12-11'),
(16, 35, 'Assistance logiciel', 2, 'Installations', '12000', '2018-12-11 16:07:54', '2018-12-11 16:07:54', 'assistance-logicielinstallations11122018040754', 19, 5, '2018-12-11');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(79, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Parametrage', 'PARAMETRAGE'),
(80, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_DA', 'GESTION DES D.A'),
(81, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Valideur_DA', 'VALIDATION DES D.A'),
(82, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_Pro_Forma', 'GESTION DES PRO FORMA'),
(83, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Gestionnaire_BC', 'GESTION DES B.C'),
(84, '2018-11-23 13:23:55', '2018-11-23 13:23:55', 'Valideur_BC', 'VALIDATION DES B.C'),
(85, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Parametrage', 'PARAMETRAGE'),
(86, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Gestionnaire_DA', 'GESTION DES D.A'),
(87, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Valideur_DA', 'VALIDATION DES D.A'),
(88, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Gestionnaire_Pro_Forma', 'GESTION DES PRO FORMA'),
(89, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Gestionnaire_BC', 'GESTION DES B.C'),
(90, '2018-11-26 08:11:56', '2018-11-26 08:11:56', 'Valideur_BC', 'VALIDATION DES B.C');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tbprix`
--

DROP TABLE IF EXISTS `tbprix`;
CREATE TABLE IF NOT EXISTS `tbprix` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prix` varchar(191) NOT NULL,
  `unite` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbprix`
--

INSERT INTO `tbprix` (`id`, `prix`, `unite`, `date`, `created_at`, `updated_at`, `slug`, `id_fournisseur`, `id_materiel`) VALUES
(4, '360', 'Unité', '2018-11-22', '2018-11-05 17:57:49', '2018-11-09 16:58:09', '36009112018045809', 35, 6),
(5, '120000', 'Sac - 15 kilo', '2018-11-15', '2018-11-06 08:42:57', '2018-11-06 08:42:57', '12000006112018084257', 19, 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `abréviation` varchar(191) DEFAULT NULL,
  `function` varchar(191) DEFAULT NULL,
  `telephone` varchar(16) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `contact` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `abréviation`, `function`, `telephone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_profil`, `slug`, `id_service`, `contact`) VALUES
(13, 'administrateur', 'Admin', 'Gestionnaire Application ', '+XXX XX XX XX XX', 'admin@eiffage.com', NULL, '$2y$10$.k1X.RyevXjktAPrTIZ.Ze9.07DGbI.GNtmEsEJuKQOFa5GKNPWfG', 'vKhsgj8AF3anszDfgg8vDzidiYpyMiGIje6rVnrnl4ht4jHfVRpe9aToAu5z', '2018-11-26 08:11:56', '2018-11-26 08:11:56', NULL, 'admin-at-eiffagecom26112018081156', NULL, NULL),
(14, 'Thierry Koffi', 'TKO', 'Informaticien Terrain', '+XXX XX XX XX XX', 'thierry.koffi@eiffage.com', NULL, '$2y$10$SKNOTGJ/oxmtRLD4PgsK0.0CS2Lt/kxbUPmjGx.Qeacjcsjss.GrS', NULL, '2018-11-27 17:31:36', '2018-11-27 17:31:36', NULL, 'thierrykoffi-at-eiffagecom27112018053136', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(11, NULL, NULL, 13, 85),
(12, NULL, NULL, 13, 86),
(13, NULL, NULL, 13, 87),
(14, NULL, NULL, 13, 82),
(15, NULL, NULL, 13, 83),
(16, NULL, NULL, 13, 90),
(17, NULL, NULL, 14, 79),
(18, NULL, NULL, 14, 80),
(19, NULL, NULL, 14, 81),
(20, NULL, NULL, 14, 82),
(21, NULL, NULL, 14, 83),
(22, NULL, NULL, 14, 84);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
