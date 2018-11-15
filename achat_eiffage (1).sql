-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 09 nov. 2018 à 17:23
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
  `codeRubrique` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_analytique`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boncommande`
--

DROP TABLE IF EXISTS `boncommande`;
CREATE TABLE IF NOT EXISTS `boncommande` (
  `id_bonCommande` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prixUnitaire` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remise` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numBonCommande` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_analytique` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bonCommande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conditionPaiement` text COLLATE utf8mb4_unicode_ci,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `adresseGeographique` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interlocuteur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `libelle`, `domaine`, `conditionPaiement`, `commentaire`, `adresseGeographique`, `responsable`, `interlocuteur`, `email`, `created_at`, `updated_at`, `slug`) VALUES
(36, 'EBURTIS', 'logiciel', 'orange money', 'dtft', 'abidjan', 'koffi landry', 'kone', 'cyriaquekodia@gmail.com', '2018-10-29 17:38:57', '2018-10-29 17:56:04', 'eburtis29102018055604'),
(35, 'EBURNI', 'logiciel', 'je suis la', 'fdfff', 'hhhh', 'd', 'df', 'cyriaquekodia@gmail.com', '2018-10-29 17:22:31', '2018-10-29 17:51:35', 'eburtis29102018055135'),
(19, 'NOGRAD', 'ghhg', 'ggg', 'fgfg', 'ggg', 'ggg', 'ggg', 'cyriaquekodia@gmail.com', '2018-10-26 18:37:00', '2018-10-26 18:37:00', 'gh26102018063700');

-- --------------------------------------------------------

--
-- Structure de la table `lignebesoin`
--

DROP TABLE IF EXISTS `lignebesoin`;
CREATE TABLE IF NOT EXISTS `lignebesoin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` double(8,2) NOT NULL,
  `DateBesoin` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_fournisseur_select` int(11) DEFAULT NULL,
  `id_nature` int(11) DEFAULT NULL,
  `id_materiel` int(11) DEFAULT NULL,
  `id_bonommande` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demandeur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `id_valideur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lignebesoin`
--

INSERT INTO `lignebesoin` (`id`, `unite`, `quantite`, `DateBesoin`, `id_user`, `id_fournisseur_select`, `id_nature`, `id_materiel`, `id_bonommande`, `created_at`, `updated_at`, `demandeur`, `slug`, `etat`, `id_valideur`) VALUES
(5, 'unite', 1.00, '2018-11-07', 4, 4, 1, 6, NULL, '2018-11-07 17:50:42', '2018-11-09 16:58:17', 'kodia', '607112018055042', '2', 'Cyriaque Kodia'),
(8, 'Sac - 15 kilo', 5.00, '2018-11-09', 4, 4, 1, 5, NULL, '2018-11-09 10:21:21', '2018-11-09 16:58:20', 'koffi', '509112018102121', '2', 'Cyriaque Kodia'),
(7, 'Sac - 15 kilo', 5.00, '2018-11-07', 4, 4, 1, 6, NULL, '2018-11-07 18:12:02', '2018-11-09 16:58:18', 'kodia', '607112018061202', '2', 'Cyriaque Kodia'),
(9, 'Sac - 15 kilo', 4.00, '2018-11-22', 4, 4, 2, 5, NULL, '2018-11-09 10:42:18', '2018-11-09 16:58:22', 'Mélaine', '509112018104218', '2', 'Cyriaque Kodia');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleMateriel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `libelleMateriel`, `type`, `created_at`, `updated_at`, `slug`) VALUES
(7, 'SAAG COMPTABILITE', 'logiciel', '2018-10-30 16:54:13', '2018-10-30 16:54:13', 'novad30102018045413'),
(6, 'Office', 'logiciel', '2018-10-30 16:54:06', '2018-10-30 16:54:06', 'novad30102018045406'),
(5, 'Ciment belier', 'Construction', '2018-10-30 16:51:34', '2018-10-30 16:51:34', 'novad30102018045134');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(20, '2018_11_07_092915_add_etat_to_lignebesoin', 11);

-- --------------------------------------------------------

--
-- Structure de la table `nature`
--

DROP TABLE IF EXISTS `nature`;
CREATE TABLE IF NOT EXISTS `nature` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleNature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelleProfil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionProfil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelleProfil`, `descriptionProfil`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Administrateur', '1000,2000,3000,4000,5000,6000,7000,8000', '2018-11-02 10:43:59', '2018-11-09 15:49:32', 'administrateur09112018034932');

-- --------------------------------------------------------

--
-- Structure de la table `tbprix`
--

DROP TABLE IF EXISTS `tbprix`;
CREATE TABLE IF NOT EXISTS `tbprix` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abréviation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `abréviation`, `function`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_profil`, `slug`) VALUES
(2, 'Cyriaque Kodia', 'CK', 'informaticien', 'cyriaque.kodia@eiffage.com', NULL, '$2y$10$IaJjYzjEhIjLb4vFsLUiy.rXbvkeE3D1R7FvnnwiJvildd822xJ4i', 'dXyaU8JCv9LEAg7BOKEz6AVA7sJ2qZ08VZ9WtqtKwJqkczZdfjZEkMAeaDmT', '2018-10-22 17:18:51', '2018-10-30 17:47:34', NULL, 'cyriaquekodia-at-gmailcom30102018054734'),
(1, 'Thierry Koffi', 'LK', 'informaticien', 'thierry.koffi@eiffage.com', NULL, '$2y$10$Yd2Qe9OeGSosDKAQ.QCzC.sk/5BOFUyaib1L0v4Emu23IqUSFuPS.', 'VDqcmAJx5GPzZeDrmVsWtcqaS7Htks84zl7jJBZku1nv9f9HxFTm2snOFcac', '2018-10-30 17:56:37', '2018-10-30 17:56:37', NULL, 'landrykoffi-at-gmailcom30102018055637');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
