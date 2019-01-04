-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 04 jan. 2019 à 17:50
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
  `numBonCommande` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `date` date DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `id_fournisseur` int(11) NOT NULL,
  `total_ttc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numBonCommande` (`numBonCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boncommande`
--

INSERT INTO `boncommande` (`id`, `numBonCommande`, `id_user`, `created_at`, `updated_at`, `slug`, `date`, `etat`, `id_fournisseur`, `total_ttc`) VALUES
(6, '003FFF5', 13, '2019-01-04 17:46:01', '2019-01-04 17:46:01', '003fff504012019054601', NULL, 1, 6, NULL),
(7, '003FFF6', 13, '2019-01-04 17:46:30', '2019-01-04 17:46:30', '003fff604012019054630', NULL, 1, 1, NULL),
(8, '003FFF7', 13, '2019-01-04 17:46:48', '2019-01-04 17:46:48', '003fff704012019054648', NULL, 1, 8, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_materiel` int(11) DEFAULT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire` bigint(20) DEFAULT NULL,
  `titre_ext` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `id_bc` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `codeRubrique` int(11) DEFAULT NULL,
  `id_da` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `id_materiel`, `id_fournisseur`, `quantite`, `prix_unitaire`, `titre_ext`, `devise`, `created_at`, `updated_at`, `etat`, `id_bc`, `remise`, `codeRubrique`, `id_da`, `unite`) VALUES
(15, 35, 6, 3, 15000, 'tuyaux à eaux', 'Fr CFA', '2019-01-04 17:44:28', '2019-01-04 17:46:01', 2, 6, 15, 22521, '12', 'U'),
(16, 34, 1, 3, 9000, 'office 365', 'Fr CFA', '2019-01-04 17:44:28', '2019-01-04 17:46:30', 2, 7, 10, 22521, '13', 'U'),
(14, 37, 8, 3, 12000, 'tuyaux d\'aspiration', 'Fr CFA', '2019-01-04 17:44:28', '2019-01-04 17:46:48', 2, 8, 12, 22523, '11', 'm'),
(13, 34, 1, 3, 14000, 'office 365', 'Fr CFA', '2019-01-04 17:44:28', '2019-01-04 17:46:30', 2, 7, 20, 22522, '10', 'U');

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
  `contact` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `libelle`, `domaine`, `conditionPaiement`, `commentaire`, `adresseGeographique`, `responsable`, `interlocuteur`, `email`, `created_at`, `updated_at`, `slug`, `contact`) VALUES
(1, 'EBURTIS', '5', NULL, NULL, 'Abidjan', 'konan', 'kone', 'cyriaquekodia@gmail.com', '2018-12-14 12:07:53', '2018-12-18 15:17:26', 'eburtis18122018031726', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaquekodia@gmail.com\"}]'),
(5, 'sogelux', '4', NULL, NULL, 'Abidjan', 'konan', NULL, 'admin@eiffage.com', '2018-12-17 16:33:49', '2018-12-18 15:08:58', 'sogelux18122018030858', '[{\"titre_c\":\"youri\",\"type_c\":\"EMA\",\"valeur_c\":\"cyriaquekodia@gmail.com\"},{\"titre_c\":\"koffi\",\"type_c\":\"EMA\",\"valeur_c\":\"y@gmail.com\"},{\"titre_c\":\"francky\",\"type_c\":\"EMA\",\"valeur_c\":\"franck@gmail.com\"},{\"titre_c\":\"test\",\"type_c\":\"MOB\",\"valeur_c\":\"02336655\"]'),
(6, 'test', '3', NULL, NULL, 'Abidjan', 'konan', NULL, 'cyriaquekodia@gmail.com', '2018-12-18 10:48:30', '2018-12-18 15:15:21', 'test18122018031521', '[{\"titre_c\":\"kone\",\"type_c\":\"MOB\",\"valeur_c\":\"cyriaquekodia@gmail.com\"},{\"titre_c\":\"youri\",\"type_c\":\"MOB\",\"valeur_c\":\"cyriaquekodia@gmail.com\"}]'),
(7, 'InfoProGICIEL', '5', 'je suis la', NULL, 'test', 'konan', NULL, 'landrykoffi@gmail.com', '2019-01-04 09:32:40', '2019-01-04 09:32:40', 'infoprogiciel04012019093240', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"landrykoffi@gmail.com\"}]'),
(8, 'Y Entretien', '7', 'test', NULL, 'Abidjan', 'konan', NULL, 'cyriaquekodia@gmail.com', '2019-01-04 16:28:42', '2019-01-04 16:28:42', 'y-entretien04012019042842', '[{\"titre_c\":\"kone\",\"type_c\":\"EMA\",\"valeur_c\":\"landrykoffi@gmail.com\"}]');

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
  `motif` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lignebesoin`
--

INSERT INTO `lignebesoin` (`id`, `unite`, `quantite`, `DateBesoin`, `id_user`, `id_reponse_fournisseur`, `id_nature`, `id_materiel`, `id_bonCommande`, `created_at`, `updated_at`, `demandeur`, `slug`, `etat`, `id_valideur`, `motif`) VALUES
(10, 'U', 3.00, '2018-12-29', 16, NULL, 1, 34, NULL, '2018-12-27 17:26:27', '2019-01-04 17:44:28', 'koffi', '3427122018052627', '3', '13', ''),
(11, 'm', 3.00, '2018-12-30', 16, NULL, 1, 37, NULL, '2018-12-28 10:38:46', '2019-01-04 17:44:28', 'kodia', '3728122018103846', '3', '13', ''),
(12, 'U', 3.00, '2018-12-30', 13, NULL, 1, 35, NULL, '2018-12-28 10:40:53', '2019-01-04 17:44:28', 'koffi', '3528122018104053', '3', '', ''),
(13, 'U', 3.00, '2018-12-21', 22, NULL, 1, 34, NULL, '2018-12-28 10:44:18', '2019-01-04 17:44:28', 'Mélaine', '3428122018104418', '3', '13', ''),
(14, 'U', 3.00, '2018-12-30', 13, NULL, 1, 33, NULL, '2018-12-28 11:23:24', '2018-12-28 14:30:51', 'Mélaine', '3328122018023051', '0', '13', 'on en a en stock');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `image` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `libelleMateriel`, `type`, `created_at`, `updated_at`, `slug`, `image`) VALUES
(33, 'Windows 10', '5', '2018-12-27 09:37:22', '2018-12-27 09:37:22', 'windows-1027122018093722', 'microsoft_windows_10_pro_64.png'),
(34, 'office 365', '5', '2018-12-27 09:40:20', '2018-12-27 09:40:20', 'office-36527122018094020', '617GjtWatCL._SL1500_.jpg'),
(35, 'tuyaux à eaux', '3', '2018-12-27 09:40:47', '2018-12-27 09:40:47', 'tuyaux-a-eaux27122018094047', 'tuyaux-plat-diametre-75-equipe-raccord-symetrique-guillemin.jpg'),
(36, 'tuyaux cylindrique', '3', '2018-12-27 09:41:26', '2018-12-27 10:05:58', 'tuyaux-cylindrique27122018100558', 'tuyaux-pvc-vert-epandage-diametre-40-mm.jpg'),
(37, 'tuyaux d\'aspiration', '7', '2018-12-27 09:41:57', '2018-12-27 09:41:57', 'tuyaux-daspiration27122018094157', 'tuyaux-d-aspirateur-pour-aspirateur-ct-festool-ig-41836.jpg'),
(38, 'novad', '3', '2018-12-27 10:00:06', '2018-12-27 10:00:06', 'novad27122018100006', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

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
(37, '2018_12_11_153440_add_total_ttc_to_boncommande', 25),
(38, '2018_12_17_153415_add_contact_to_fournisseur', 26),
(39, '2018_12_19_121900_add_motif_to_da', 27),
(40, '2018_12_27_092141_add_image_to_materiel', 28),
(41, '2018_12_30_230821_create_table_devis', 29),
(42, '2019_01_03_163411_add_etat_to_devis', 29),
(43, '2019_01_04_140622_add_id_bc_to_devi', 30),
(44, '2019_01_04_152830_add_remise_cod_rubrique_id_da_to_devis', 31),
(45, '2019_01_04_163129_add_unite_to_devi', 32);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse_fournisseur`
--

INSERT INTO `reponse_fournisseur` (`id`, `id_fournisseur`, `titre_ext`, `quantite`, `unite`, `prix`, `created_at`, `updated_at`, `slug`, `id_lignebesoin`, `remise`, `date_precise`) VALUES
(1, 1, 'Microsoft office 360', 1, 'u', '12000', '2018-12-14 17:15:20', '2018-12-14 17:15:20', 'microsoft-office-360u14122018051520', 1, 10, '2018-12-14'),
(2, 1, 'torsade', 2, 'u', '6500', '2018-12-17 08:55:39', '2018-12-17 08:55:39', 'torsadeu17122018085539', 1, 10, '2018-12-17');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(15) NOT NULL,
  `abréviation` varchar(191) DEFAULT NULL,
  `service` varchar(30) DEFAULT NULL,
  `function` varchar(191) DEFAULT NULL,
  `contact` varchar(16) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `prenoms` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `abréviation`, `service`, `function`, `contact`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_profil`, `slug`, `prenoms`) VALUES
(13, 'administrateur', 'Admin', 'Secrétariat', 'Gestionnaire Application', '+XXX XX XX XX XX', 'admin@eiffage.com', NULL, '$2y$10$.k1X.RyevXjktAPrTIZ.Ze9.07DGbI.GNtmEsEJuKQOFa5GKNPWfG', 'QqRPYG5wvdICqoAT9T6b6qqdkh3JHD5YRVvoq2BgdtJuJxBv0765oXurZw47', '2018-11-26 08:11:56', '2018-12-28 10:40:14', NULL, 'admin-at-eiffagecom28122018104014', NULL),
(16, 'kodia', NULL, 'Service informatique', NULL, NULL, 'Cyriaque.kodia@eiffage.com', NULL, '$2y$10$z1jF8bp8mSNCyS8pwhQLJeKxHxBFSCaXw3ZHAFeB6OjA6GHRlBNni', 'wZ10zB4gYv0Rvk219sdgT9HkeHJP7E1PWZvkTP0dMJuBdjgFE3cZfhkpByy0', '2018-12-14 11:34:42', '2018-12-28 10:39:17', NULL, 'cyriaquekodia-at-eiffagecom28122018103917', 'Cyriaque'),
(22, 'koffi', 'CK', 'Direction', 'informaticien', '67988805', 'Thierry.koff@eiffage.com', NULL, '$2y$10$a.jb1Ooxu04TISYaGwO2ju2HFQhn6UW5h9oC8KpimJfUNDzilWKKW', 'FHlZ4isHlBo35ogLuuS5hZsggHdyBslbZi39BjCi1o0wv7vxrmqrKI7IKpV4', '2018-12-27 16:46:48', '2018-12-28 10:43:37', NULL, 'thierrykoff-at-eiffagecom28122018104337', 'Thierry');

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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(23, NULL, NULL, 15, 80),
(37, NULL, NULL, 17, 80),
(38, NULL, NULL, 18, 80),
(39, NULL, NULL, 19, 80),
(40, NULL, NULL, 20, 80),
(41, NULL, NULL, 21, 80),
(65, NULL, NULL, 16, 80),
(66, NULL, NULL, 16, 81),
(67, NULL, NULL, 16, 80),
(68, NULL, NULL, 16, 81),
(69, NULL, NULL, 13, 79),
(70, NULL, NULL, 13, 80),
(71, NULL, NULL, 13, 81),
(72, NULL, NULL, 13, 82),
(73, NULL, NULL, 13, 83),
(74, NULL, NULL, 13, 84),
(75, NULL, NULL, 13, 79),
(76, NULL, NULL, 13, 80),
(77, NULL, NULL, 13, 81),
(78, NULL, NULL, 13, 82),
(79, NULL, NULL, 13, 83),
(80, NULL, NULL, 13, 84),
(81, NULL, NULL, 22, 80),
(82, NULL, NULL, 22, 80);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
